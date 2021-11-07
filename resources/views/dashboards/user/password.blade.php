@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Dashboard"])
@section("content_")

<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Change Password</h3>

        <form action="{{ route("user.change_password")}}" method="post">@csrf
            <div class="billing-info-wrap mr-50 mt-4">
                <div class="row ">

                    <div class="mt-4 col-12"></div>

                    <div class="col-md-6 mt-4">
                        <div class="billing-info mb-20">
                            <label>Current Password <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="Enter current password" name="old_password" type="password" required>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <div class="billing-info">
                            <label>New Password <abbr class="required" title="required">*</abbr></label>
                            <input class="billing-address" required placeholder="Enter new password" name="new_password" type="password" required>
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
