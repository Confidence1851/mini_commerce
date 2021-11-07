@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Dashboard"])
@section("content_")

<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Account Information</h3>

        <form action="{{ route("user.account")}}" method="post">@csrf
            <div class="billing-info-wrap mr-50 mt-4">
                <div class="row ">

                    <div class="mt-4 col-12"></div>

                    <div class="col-md-6">
                        <div class="billing-info">
                            <label>First name <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="John..." name="first_name" type="text" value="{{ old("first_name") ?? $user->first_name }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="billing-info">
                            <label>Last name <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="Doe..." name="last_name" type="text" value="{{ old("last_name") ?? $user->last_name }}">
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="billing-info">
                            <label>Email <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required readonly type="text" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="billing-info mb-20">
                            <label>Phone <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="Doe..." name="phone" type="text" value="{{ old("phone") ?? $user->phone }}">
                        </div>
                    </div>

                </div>
                <div class="additional-info-wrap">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
