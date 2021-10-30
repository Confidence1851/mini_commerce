<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ApiConstants;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Services\Shop\CartItemService;
use App\Services\Shop\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{


    public function index()
    {
        $cart = CartService::getCartByUser(auth()->id());
        $cartItems = CartItem::where("cart_id", $cart->id)->whereHas("product")->with("product")->latest()->get();
        return view("web.pages.shop.cart", ["cart" => $cart , "cartItems" => $cartItems]);
    }
    public function save(Request $request, $id)
    {
        try {
            if (auth()->check()) {
                $validator = Validator::make($request->all(), [
                    "quantity" => "required",
                    "color" => "nullable|string",
                    "size" => "nullable|string",
                ]);
                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                $data = $validator->validated();
                $user = auth()->user();
                $in_cart = CartItemService::inCart($user->id, $id);
                if (!empty($in_cart)) {
                   $cart = CartService::removeFromCart($user->id, $id);
                } else {
                   $cart = CartService::addToCart($user->id, $id, $data);
                }
            }
            $in_cart = !empty(CartItemService::inCart($user->id, $id));

            DB::commit();
            return validResponse("Cart saved successfully", [
                "in_cart" => $in_cart,
                "btn_text" => $in_cart ? "Remove from Cart" : "Add to Cart",
                "items" => $cart->items
            ]);
        } catch (ValidationException $e) {
            $message = "The given data was invalid.";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (auth()->check()) {
                $validator = Validator::make($request->all(), [
                    "quantity" => "nullable|required",
                    "color" => "nullable|string",
                    "size" => "nullable|string",
                ]);
                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                $data = $validator->validated();
                $user = auth()->user();
                $in_cart = CartItemService::inCart($user->id, $id);
                if (!empty($in_cart)) {
                    $cart = CartService::addToCart($user->id, $id, $data);
                }

                $in_cart->refresh();

                return validResponse("Cart updated successfully" , [
                    "cart" => $cart,
                    "cartItem" => [
                        "unit_price" => $in_cart->getPrice(),
                        "quantity" => $in_cart->quantity,
                        "sub_total" => format_money($in_cart->getSubtotal()),
                    ]
                ]);
            }


        } catch (ValidationException $e) {
            $message = "The given data was invalid.";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
