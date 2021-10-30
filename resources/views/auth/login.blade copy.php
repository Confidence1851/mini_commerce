@extends("auth.layouts.app" , ["meta_title" => "Login"])
{{-- @section('title', 'Login') --}}
@section('content')


    <h1 class="title">Login</h1>
    <form action="{{ route('login') }}" method="POST" class="subscription-form form-row">
        @csrf
        <div class="form-group col-12">
            <label for="">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="Enter your password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12 row mb-4 mt-2">
            <div class="col-md-4">
                <button type="submit" class="axil-button button-rounded"><span>Login</span></button>
            </div>
        </div>


        <div class="col-md-6 mb-2 mt-2">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        <div class="col-md-6 mb-2 mt-2">
            <a class="" href="{{ route("register") }}" style="float: right;">
                New user? Register
            </a>
        </div>
    </form>


@endsection
