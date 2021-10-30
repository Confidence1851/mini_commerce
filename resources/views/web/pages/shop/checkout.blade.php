@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Checkout page</h2>
            </div>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">checkout </li>
            </ul>
        </div>
    </div>
</div>
<div class="checkout-main-area pt-100 pb-100">
    <div class="container">

        <div class="checkout-wrap pt-30">
            <form action="{{ route("web.shop.checkout.process")}}" id="checkout_form" method="POST">@csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20">
                                        <label>First Name <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="first_name" required value="{{ old("first_name") ?? $user->first_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20">
                                        <label>Last Name <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="last_name" required value="{{ old("last_name")  ?? $user->last_name}}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Delivery Address <abbr class="required" title="required">*</abbr></label>
                                        <input class="billing-address" required placeholder="House number and street name" name="address" type="text" value="{{ old("address")}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Town / City <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="city" required value="{{ old("city")}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>State <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="state" required value="{{ old("state")}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>Postcode / ZIP <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="zipcode" value="{{ old("zipcode")}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="phone" required value="{{ old("phone")  ?? $user->phone}}">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" name="email" required value="{{ old("email")  ?? $user->email}}">
                                    </div>
                                </div>

                            </div>

                            {{-- @guest
                            <div class="checkout-account mb-25">
                                <input class="checkout-toggle2" type="checkbox" name="create_account" checked>
                                <span>Create an account?</span>
                            </div>
                            <div class="checkout-account-toggle open-toggle2 mb-30">
                                <label>Password</label>
                                <input placeholder="Password" type="text" name="password">
                            </div>
                            @endguest --}}

                            <div class="additional-info-wrap">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li>Product <span>Total</span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach ($cartItems as $item)
                                            <li>{{ $item->product->name }} X {{ $item->quantity }} <span>{{ format_money($item->getSubtotal())}} </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li>Subtotal <span>{{ format_money($cart->total) }} </span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li>Shipping Fee<p> Free</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>Total <span>{{format_money($cart->total)}} </span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="payment-method">
                                    <div class="pay-top sin-payment">
                                        <input id="payment_method_1" class="input-radio" type="radio" value="Bank" checked="checked" name="payment_method">
                                        <label for="payment_method_1"> Direct Bank Transfer </label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>Make your payment directly into our bank account. Please use your email as the payment reference.</p>
                                            <p>Bank Name: <b>First Bank</b></p>
                                            <p>Account Name: <b>First Bank</b></p>
                                            <p>Account Number: <b>1111111111</b></p>
                                        </div>
                                    </div>

                                    <div class="pay-top sin-payment">
                                        <input id="payment-method-3" class="input-radio" type="radio" value="Card" name="payment_method">
                                        <label for="payment-method-3">Pay with Card </label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>You would be directed to a payment gateway to complete payment.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="Place-order mt-40">
                                <button type="submit" class="checkout_btn btn p-3">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
