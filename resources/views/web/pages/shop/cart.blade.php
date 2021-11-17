@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>cart page</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ url("/")}}">Home</a>
                </li>
                <li class="active">cart </li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr id="cart_item_row_{{$item->id}}">
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ $item->product->getDefaultImage() }}" class="img-fluid" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="{{ $item->product->detailurl() }}">{{ $item->product->name }}</a></td>
                                    <td class="product-price-cart"><span class="amount" id="cart_item_unit_price_{{$item->product->id}}">{{ $item->getPrice() }}</span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input value="{{$item->quantity}}" class="cart-plus-minus-box cart_update_data" id="cart_product_qty_{{$item->product->id}}" type="text" name="qtybutton" data-product_id="{{$item->product->id}}" data-url="{{route("web.shop.cart.update" , $item->product->id )}}" >
                                        </div>
                                    </td>
                                    <td class="product-subtotal" id="cart_item_subtotal_{{$item->product->id}}">{{ format_money($item->getSubtotal())}}</td>
                                    <td class="product-remove">
                                        <a title="Remove from cart" data-product_id="{{$item->product->id}}" data-url="{{route("web.shop.cart.save" , $item->product->id )}}" class="btn-group cart_add_or_remove_btn" data-hide="#cart_item_row_{{$item->id}}">
                                            <span class="spinner spinner-border spinner-border-sm d-none"></span>
                                            <span class="label">
                                                <i class="la la-close"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{ route("web.shop.index")}}">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <a href="{{ route("web.shop.checkout.index")}}">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@include("web.pages.shop.includes.cart_script")
