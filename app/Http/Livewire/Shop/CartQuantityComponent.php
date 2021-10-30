<?php

namespace App\Http\Livewire\Shop;

use App\Services\Shop\CartItemService;
use Livewire\Component;

class CartQuantityComponent extends Component
{

    public $product;
    public $quantity = 1;

    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $cart_item = CartItemService::inCart($user->id, $this->product->id);
            if($cart_item){
                $this->quantity = $cart_item->quantity;
            }
        }
    }

    public function render()
    {
        return view('livewire.shop.cart-quantity-component');
    }
}
