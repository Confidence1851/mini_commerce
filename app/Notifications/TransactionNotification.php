<?php

namespace App\Notifications;

use App\Models\Transaction;
use App\Services\Notifications\AppMailerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database' , 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $transaction_type = $this->transaction->type;
        $ref =  $this->transaction->reference;
        AppMailerService::send([
            "data" => [
                "user" => $notifiable,
                "transaction" => $this->transaction,
            ],
            "to" => $notifiable->email,
            "template" => "emails.transactions.new_transaction",
            "subject" => "New $transaction_type Transaction Ref#$ref",
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
       return [];
    }

    public function toDatabase($notifiable)
    {
        $transaction_type = $this->transaction->type;
        $ref =  $this->transaction->reference;
        return [
            "data" => [
                "id" => $this->transaction->id
            ],
            "title" => "New $transaction_type Transaction Ref#$ref",
            "message" => "A new <b> {{strtolower($transaction_type)}} </b> transaction occured on your account.",
            "link" => route("user.wallet.transactions" , ["reference" => $ref])
        ];
    }
}

