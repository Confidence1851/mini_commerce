@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Dashboard"])
@section("content_")

<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Enter your correct details below</h3>

        <form action="{{ route("user.address")}}" method="post">@csrf
            <div class="billing-info-wrap mr-50">
                <div class="row">

                    <input type="hidden" name="id" value="{{$address->id}}">

                    <div class="col-lg-12 mt-4">
                        <div class="billing-info mb-20">
                            <label>Delivery Address <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="House number and street name" name="address" type="text" value="{{ old("address") ?? $address->address }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="billing-info mb-20">
                            <label>Town / City <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="city" required value="{{ old("city")  ?? $address->city}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20">
                            <label>State <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="state" required value="{{ old("state") ?? $address->state}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20">
                            <label>Country <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="country" required value="{{ old("country") ?? $address->country}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20">
                            <label>Postcode / ZIP <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="zipcode" value="{{ old("zip_code") ?? $address->address}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20">
                            <label>Phone <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="phone" required value="{{ old("phone")  ??  $address->phone ?? $user->phone}}">
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20">
                            <label>Email Address <abbr class="required" title="required">*</abbr></label>
                            <input type="email" name="email" required value="{{ old("email")  ??  $address->email ?? $user->email}}">
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
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
