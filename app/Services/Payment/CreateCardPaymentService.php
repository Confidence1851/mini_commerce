<?php

namespace App\Services\Payment;

use App\Constants\CurrencyConstants;
use App\Constants\PaymentConstants;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateCardPaymentService
{
    public static function create($data)
    {
        try {
            $validator = Validator::make($data, [
                "amount" => "required|numeric|gt:0"
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $data = $validator->validated();


            $user = auth()->user();
            $amount = $data["amount"];

            $initialization = PaymentService::byGateway(
                CurrencyConstants::FLUTTERWAVE,
                $amount,
            );

            $payment = Payment::create([
                "user_id" => $user->id,
                "payer_email" => $user->email,
                "reference" => $initialization["transaction"]->reference,
                "transaction_id" => $initialization["transaction"]->id,
                "currency" => "NGN",
                "amount" => $amount,
                "fee" => 0,
                "method" => PaymentConstants::PAY_WITH_CARD,
                "gateway" => CurrencyConstants::FLUTTERWAVE,
                "activity" => PaymentConstants::CART_CHECKOUT
            ]);

            session([
                "redirect_url" => url()->previous()
            ]);

            return [
                "payment" => $payment,
                "initialization" => $initialization
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
