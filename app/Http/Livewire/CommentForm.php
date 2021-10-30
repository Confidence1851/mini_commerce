<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentForm extends Component
{
    public $phone;
    public $name;
    public $email;
    public $message;
    public $messageSent = false;

    public function send()
    {
        $data = $this->validate([
            "name" => "string|required",
            "email" => "string|email|required",
            "phone" => "required|string",
            "message" => "required|string",
        ]);


        sendMailHelper([
            "data" => $data,
            "to" => $data["email"],
            "template" => "emails.general.contact_us",
            "subject" => "New Contact Support",
        ]);

        $this->messageSent = true;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email' , 'phone' , 'message']);
    }


    public function render()
    {
        return view('livewire.comment-form');
    }
}
