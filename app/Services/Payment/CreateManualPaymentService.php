<?php

namespace App\Services\Finance;

use App\Constants\StatusConstants;
use App\Constants\TransactionActivityConstants;
use App\Constants\TransactionConstants;
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
            $transaction = TransactionService::create([
                "user_id" => $user->id,
                "amount" => $amount,
                "fee" => 0,
                "description" => $description,
                "activity" => TransactionActivityConstants::FUND_WITH_BANK,
                "batch_no" => null,
                "type" => TransactionConstants::CREDIT,
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
            return $transaction;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
