<?php

namespace App\Http\Controllers\User\Payment;

use App\Constants\CurrencyConstants;
use App\Constants\NotificationConstants;
use App\Constants\StatusConstants;
use App\Constants\TransactionActivityConstants;
use App\Constants\TransactionConstants;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Finance\FundWalletService;
use App\Services\Finance\UserTransactionService;
use App\Services\PayementGateways\FlutterwaveService;
use App\Services\Payment\PaymentService;
use App\Services\Plan\SubscriptionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
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
                    $payment = PaymentService::handlePaymentAction($transaction->reference);
                    $order = Order::where("payment_id", $payment->id)->first();

                    DB::commit();
                    return redirect()
                        ->route("web.shop.checkout.status", [
                            "reference" => $order->reference,
                            "status" => "success"
                        ])
                        ->with($processData["success"] ? NotificationConstants::SUCCESS_MSG :
                            NotificationConstants::ERROR_MSG, $processData["message"]);
                }
            }

            return redirect()->route("user.dashboard")
                ->with(NotificationConstants::SUCCESS_MSG, "Unable to process transaction!");
        } catch (Exception $e) {
            logger("Payment gateway error - " . $e->getMessage(), $e->getTrace());

            DB::rollBack();
            return redirect()->route("user.dashboard")
                ->with(NotificationConstants::SUCCESS_MSG, "An error occured while processing payment request!");
        }
    }
}
