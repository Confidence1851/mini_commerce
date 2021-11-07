@extends("dashboards.user.layout.app" , ["breadcrumb_title" => "Dashboard"])
@section("content_")

<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Dashboard</h3>
        <div class="welcome">
            <p>Hello, <strong>{{$user->names()}}</strong> </p>
        </div>

        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
    </div>
</div>

@endsection
