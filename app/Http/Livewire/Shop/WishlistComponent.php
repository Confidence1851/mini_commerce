<?php

namespace App\Http\Livewire\Shop;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistComponent extends Component
{

    public $product;
    public $is_wishlisted = false;

    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $count = Wishlist::where("product_id", $this->product->id)
                ->where("user_id", $user->id)
                ->count();

            $this->is_wishlisted = $count > 0;
        }
    }


    public function save()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($this->is_wishlisted) {
                Wishlist::where("product_id", $this->product->id)->where("user_id", $user->id)->delete();
                $this->is_wishlisted = false;
            } else {
                Wishlist::create([
                    "product_id" => $this->product->id,
                    "user_id" => $user->id
                ]);
                $this->is_wishlisted = true;
            }
        }
    }




    public function render()
    {
        return view('livewire.shop.wishlist-component');
    }
}
