<?php

namespace App\Http\Controllers\Web;

use App\Constants\PaymentConstants;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Services\Payment\CreateCardPaymentService;
use App\Services\Payment\CreateManualPaymentService;
use App\Services\Payment\PaymentService;
use App\Services\Shop\CartService;
use App\Services\Shop\DeliveryAddressService;
use App\Services\Shop\Order\OrderService;
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
                dd("ghg");
            }
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
