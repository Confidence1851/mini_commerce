<?php

namespace App\Services\Payment;

use App\Constants\PaymentConstants;
use App\Constants\StatusConstants;
use App\Models\Payment;
use App\Services\Notifications\AppMailerService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateManualPaymentService
{

    public static function create($data)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($data, [
                "amount" => "required|string",
                "reference" => "required|string"
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $data = $validator->validated();

            $user = auth()->user();
            $amount = $data["amount"];
            $reference = $data["reference"];

            $description = "Paid to Bank with Reference Number: #$reference";

            $payment = Payment::create([
                "user_id" => $user->id,
                "payer_email" => $user->email,
                "currency" => "NGN",
                "reference" => $reference,
                "amount" => $amount,
                "fees" => 0,
                "method" => PaymentConstants::PAY_WITH_BANK,
                "gateway" => null,
                "status" => StatusConstants::PENDING
            ]);

            DB::commit();

            AppMailerService::send([
                "data" => [
                    "user" => $user,
                    "amount" => $amount,
                    "description" => $description
                ],
                "to" => env("MAIL_FROM_ADDRESS",  "flairbo@gmail.com"),
                "template" => "emails.payments.new",
                "subject" => "New Payment Notification",
            ]);
            return $payment;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
