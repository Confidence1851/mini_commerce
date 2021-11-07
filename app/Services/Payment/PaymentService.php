<?php

namespace App\Services\Payment;

use App\Constants\CurrencyConstants;
use App\Constants\StatusConstants;
use App\Constants\TransactionActivityConstants;
use App\Constants\TransactionConstants;
use App\Exceptions\Payment\PaymentException;
use App\Models\Payment;
use App\Models\User;
use App\Models\Transaction;
use App\Services\Finance\TransactionService;
use App\Services\PaymentGateways\FlutterwaveService;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{



    public static function byGateway(string $gateway, float $amount): array
    {
        $user = auth()->user();
        if ($gateway == CurrencyConstants::FLUTTERWAVE) {
            return self::withFlutterwave($user, $amount);
        }
        throw new PaymentException("Gateway is currently inactve");
    }

    public static function withFlutterwave(User $user, float $amount): array
    {
        DB::beginTransaction();
        try {
            $callbackUrl = route("user.payment.callback", ["gateway" => CurrencyConstants::FLUTTERWAVE]);
            $flutterwaveService = new FlutterwaveService;

            $transaction = TransactionService::create([
                "user_id" => $user->id,
                "amount" => $amount,
                "fee" => 0,
                "description" => "Fund via Flutterwave",
                "activity" => TransactionActivityConstants::FUND_WITH_FLUTTERWAVE,
                "batch_no" => null,
                "type" => TransactionConstants::CREDIT,
                "status" => StatusConstants::PENDING
            ]);


            $initializeData = $flutterwaveService
                ->setCustomization(null, "Fund with Card")
                ->setPaymentOption("Card")
                ->setCustomerData([
                    "name" => $user->first_name,
                    "email" => $user->email
                ])
                ->setMetaData([
                    "user_id" => $user->id,
                    "activity" => $transaction->activity,
                ])
                ->initialize($transaction->reference, $callbackUrl, $amount);

            if ($initializeData["status"] != "success") {
                throw new PaymentException($initializeData["message"]);
            }

            DB::commit();
            return [
                "link" => $initializeData["data"]["link"],
                "transaction" => $transaction,
                "success" => true,
                "message" => $initializeData["message"]
            ];
        } catch (Exception $e) {
            throw $e;
            DB::rollback();
            throw new PaymentException("Couldn`t initiate transaction with Flutterwave");
        }
    }


    public static function processGatewayCallback(Transaction $transaction): array
    {
        DB::beginTransaction();
        try {
            if ($transaction->status == StatusConstants::COMPLETED) {
                throw new PaymentException("Transaction has been completed!");
            }

            $transaction->update(["status" => StatusConstants::COMPLETED]);
            DB::commit();
            return [
                "link" => route("home"),
                "success" => true,
                "message" => "Wallet funded successfully"
            ];
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function newRefCode()
    {

        // Generate a random code
        $code = strtoupper(getRandomToken(6));

        // Check if the code exists in the user table
        if (Payment::where("reference", $code)->count() > 0) {

            // If it is in the database , call the function again
            return self::newRefCode();
        }

        // Else return the generated code
        return $code;
    }

}
