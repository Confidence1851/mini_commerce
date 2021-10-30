<?php

namespace App\Http\Livewire\Shop;

use App\Services\Shop\CartItemService;
use App\Services\Shop\CartService;
use Illuminate\Http\Request;
use Livewire\Component;

class CartComponent extends Component
{
    public $in_cart = false;
    public $product;
    public $quantity = 1;
    public $color;
    public $size;

    protected $rules = [
        "quantity" => "required",
        "color" => "nullable|string",
        "size" => "nullable|string",
    ];


    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $cart_item = CartItemService::inCart($user->id, $this->product->id);
            if($cart_item){
                $this->quantity = $cart_item->quantity;
                $this->in_cart = true;
            }
        }
    }


    public function save()
    {
        if (auth()->check()) {
            $data = $this->validate();
            $user = auth()->user();
            $in_cart = CartItemService::inCart($user->id, $this->product->id);
            if ($in_cart) {
                CartService::removeFromCart($user->id, $this->product->id);
                // dd("remove");
            } else {
                CartService::addToCart($user->id, $this->product->id, $data);
                // dd("add");
            }
            $this->in_cart = !$in_cart;
        }

    }


    public function render()
    {
        return view('livewire.shop.cart-component');
    }
}
