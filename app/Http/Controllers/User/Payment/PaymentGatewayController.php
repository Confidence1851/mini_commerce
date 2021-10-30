<?php

namespace App\Http\Controllers\User\Payment;

use App\Constants\CurrencyConstants;
use App\Constants\NotificationConstants;
use App\Constants\StatusConstants;
use App\Constants\TransactionActivityConstants;
use App\Constants\TransactionConstants;
use App\Http\Controllers\Controller;
use App\Services\Finance\FundWalletService;
use App\Services\Finance\UserTransactionService;
use App\Services\PayementGateways\FlutterwaveService;
use App\Services\Payment\PaymentService;
use App\Services\Plan\SubscriptionService;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function handleCallback(Request $request, $gateway)
    {
        if ($gateway == CurrencyConstants::FLUTTERWAVE) {
            return $this->handleFlutterwaveCallback($request);
        }
    }

    public function handleFlutterwaveCallback(Request $request)
    {
        $flutterwaveService = new FlutterwaveService;

        if ($request->status == "cancelled") {
            UserTransactionService::markAs($request->tx_ref, StatusConstants::CANCELLED);
            $redirect_url = session("redirect_url") ?? route("home");
            return redirect($redirect_url)->with(NotificationConstants::ERROR_MSG, "Transaction cancelled!");
        }



        $response = $flutterwaveService->verify($request->transaction_id);
        $data = $response["data"];
        if ($response["status"] == "success") {
            $transaction = UserTransactionService::getByReference($data["tx_ref"]);
            $processData = FundWalletService::processGatewayCallback($transaction);

            if ($transaction->activity == TransactionActivityConstants::FUND_WITH_FLUTTERWAVE) {
                PaymentService::handlePaymentAction($transaction->reference);
                return redirect($processData["link"])
                    ->with($processData["success"] ? NotificationConstants::SUCCESS_MSG :
                        NotificationConstants::ERROR_MSG, $processData["message"]);
            }


        }

        dd("here");

        // return redirect()->route()
        //     ->with(NotificationConstants::SUCCESS_MSG, "Transaction completed successfully!");
    }
}
