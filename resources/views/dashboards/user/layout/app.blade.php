@extends("web.layouts.app")
@section("content")

<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>{{$breadcrumb_title}}</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ url("/")}}">Home</a>
                </li>
                <li class="active">{{$breadcrumb_title}} </li>
            </ul>
        </div>
    </div>
</div>
<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include("notifications.flash_messages")

            </div>
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="{{ route("user.dashboard")}}" class="{{ Route::current()->getName() == "user.dashboard" ? "active" : ""}}"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>
                                <a href="{{ route("user.orders")}}" class="{{ Route::current()->getName() == "user.orders" ? "active" : ""}}"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="{{ route("user.payments")}}" class="{{ Route::current()->getName() == "user.payments" ? "active" : ""}}"><i class="fa fa-credit-card"></i> Payments</a>
                                <a href="{{ route("user.address")}}" class="{{ Route::current()->getName() == "user.address" ? "active" : ""}}"><i class="fa fa-map-marker"></i>Delivery Address</a>
                                <a href="{{ route("user.account")}}" class="{{ Route::current()->getName() == "user.account" ? "active" : ""}}"><i class="fa fa-user"></i> Account Details</a>
                                <a href="{{ route("user.change_password")}}" class="{{ Route::current()->getName() == "user.change_password" ? "active" : ""}}"><i class="fa fa-user"></i> Change password</a>
                                <a href="#" onclick="return $('#logoutForm').trigger('submit');"><i class="fa fa-sign-out"></i> Logout</a>
                                <form action="{{route("logout")}}" id="logoutForm" method="post">@csrf</form>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                @yield("content_")
                            </div>
                        </div>
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>


@endsection
