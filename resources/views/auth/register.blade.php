@extends("web.layouts.app" , ["meta_title" => "Register"])
@section('content')
<div class="login-register-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ms-auto me-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a href="{{ route("login")}}">
                            <h4> login </h4>
                        </a>
                        <a class="active" data-bs-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        @include("notifications.flash_messages")
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="POST" action="{{ route('register') }}" >
                                        @csrf
                                        <input type="text" name="name" required placeholder="First and Last names">
                                        <input name="email" placeholder="Email" required type="email">
                                        <input type="password" name="password" required placeholder="Password">
                                        <div class="button-box">
                                            <button type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
