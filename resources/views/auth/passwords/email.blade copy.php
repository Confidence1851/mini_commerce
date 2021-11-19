@extends("web.layouts.app" , ["meta_title" => "password-reset"])
{{-- @section('title', 'Login') --}}
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<h1 class="title">Forgot Password</h1>
<form method="POST" action="{{ route('password.email') }}" class="subscription-form form-row">
    @csrf
    <div class="form-group col-12">
        <label for="">Email Address</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @enderror
    </div>
    <div class="col-12 row mb-4 mt-2">
        <div class="col-md-4">
            <button class="axil-button button-rounded"><span>Send Password Reset Link</span></button>
        </div>
    </div>
</form>

@endsection
