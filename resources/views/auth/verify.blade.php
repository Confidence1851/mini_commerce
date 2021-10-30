@extends("auth.layouts.app" , ["meta_title" => "Verify Email"])
@section('content')


    <h1 class="title">Verify Email</h1>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form action="{{ route('verification.resend') }}" method="POST" class="subscription-form form-row">
        @csrf


        <div class="col-12 row mb-4 mt-2">
            <div class="col-md-6">
                <button type="submit" class="axil-button button-rounded"><span>Click to resend</span></button>
            </div>
        </div>

    </form>


@endsection
