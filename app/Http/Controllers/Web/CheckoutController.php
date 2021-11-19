<?php

namespace App\Http\Controllers\Web;

use App\Constants\PaymentConstants;
use App\Exceptions\Shop\OrderException;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Services\Payment\CreateCardPaymentService;
use App\Services\Payment\CreateManualPaymentService;
use App\Services\Payment\PaymentService;
use App\Services\Shop\CartService;
use App\Services\Shop\DeliveryAddressService;
use App\Services\Shop\Order\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = CartService::getCartByUser(auth()->id());
        $cartItems = CartItem::where("cart_id", $cart->id)->whereHas("product")->with("product")->latest()->get();
        $user = auth()->user();

        if(empty($user->payment_ref)){
            $user->update([
                "payment_ref" => PaymentService::newRefCode()
            ]);
        }
        return view("web.pages.shop.checkout", [
            "cart" => $cart,
            "cartItems" => $cartItems,
            "shipping_fee" => 0,
            "user" => $user
        ]);
    }

    public function process(Request $request)
    {

        try {
            $request->validate([
                "payment_method" => "required|string|" . Rule::in(PaymentConstants::PAYMENT_OPTIONS),
            ]);

            $user = auth()->user();
            $request["user_id"] = $user->id;
            $address = DeliveryAddressService::save($request->all());
            $cart = CartService::getCartByUser($user->id);

            $data["user_id"] = $user->id;
            $data["delivery_address_id"] = $address->id;
            $data["cart_id"] = $cart->id;
            $payment_method = $request->payment_method;
            $data["payment_method"] = $payment_method;

            $order = OrderService::create($data);

            if ($payment_method == PaymentConstants::PAY_WITH_CARD) {
                $process = CreateCardPaymentService::create([
                    "pay_with" => $payment_method,
                    "amount" => $order->amount,
                ]);
                $order->update([
                    "payment_id" => $process["payment"]->id
                ]);
                return redirect()->away($process["initialization"]["link"]);
            }

            if ($payment_method == PaymentConstants::PAY_WITH_BANK) {
                $process = CreateManualPaymentService::create([
                    "amount" => $order->amount,
                    "reference" => $user->payment_ref
                ]);
                $order->update([
                    "payment_id" => $process->id
                ]);
                $user->update([
                    "payment_ref" => PaymentService::newRefCode()
                ]);

                return redirect()->route("web.shop.checkout.status", [
                    "reference" => $order->reference,
                    "status" => "success"
                ]);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (ValidationException $e) {
            return redirect()->route("web.shop.checkout.status", [
                "reference" => $order->reference,
                "status" => "error",
            ]);
        }
    }

    public function status(Request $request)
    {

        try {
            $order = OrderService::getByReference($request->reference);
            $status = $request->status;
            $message = $request->message ?? "Unable to verify your order. Kindly check your dashboard or reach out to the admin.";

            if ($status == "success") {
                $message = "Your order with reference #$order->reference has been created successfully.";
            }
            return view("web.pages.shop.checkout_status", ["status" => $status, "message" => $message]);
        } catch (OrderException $e) {
            return view("web.pages.shop.checkout_status", ["status" => "warning", "message" => $e->getMessage()]);
        } catch (Exception $e) {
            return view("web.pages.shop.checkout_status", ["status" => "danger", "message" => $message]);
        }
    }
}
