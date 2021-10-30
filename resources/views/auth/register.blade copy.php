@extends("auth.layouts.app" , ["meta_title" => "Register"])
@section('content')



    <h1 class="title">Register</h1>
    @if (!empty($referrer))
        <div>
            You were referred by {{ $referrer['name'] }}
        </div>
    @endif

    <div class="mt-2 mb-2">
        @include("notifications.flash_messages")
    </div>
    <form method="POST" action="{{ route('register') }}" class="subscription-form form-row">
        @csrf
        <div class="form-group col-md-6">
            <label for="">First Name</label>
            <input id="fname" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="">

            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="">Last Name</label>
            <input id="lname" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label for="">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-8">
            <label for="">Phone Number</label>
            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                value="{{ old('phone') }}" required autocomplete="phone">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="">Referral Code</label>
            <input id="ref_code" type="text" class="form-control @error('ref_code') is-invalid @enderror" name="ref_code"
                value="{{ old('ref_code') ?? ($referrer['ref_code'] ?? '') }}" placeholder="Optional">
            @error('ref_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>
        <div class="form-group col-md-6">
            <label for="">Plan</label>
            <select class="form-control @error('plan_name') is-invalid @enderror" name="plan_name" required>
                <option value="" disabled selected>Select Plan</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->name }}">{{ $plan->name }} - {{ format_money($plan->price) }}</option>
                @endforeach
            </select>

            @error('plan_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="">Coupon Code</label>
            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" required >

            @error('coupon_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2">
                <a href="{{ route("web.approved_vendors")}}" class="text-danger"><small>Click here to buy from a vendor</small></a>
            </div>
        </div>


        <div class="col-6 row mb-4 mt-2">
            <div class="col-md-7">
                <button class="axil-button button-rounded"><span>Register</span></button>
            </div>
        </div>

        <div class="col-md-6 mb-2 mt-2">
            <a class="" href="{{ route('login') }}" style="float: right;">
                Already a user? Login
            </a>
        </div>
        <br class="mb-5">
    </form>
@endsection
