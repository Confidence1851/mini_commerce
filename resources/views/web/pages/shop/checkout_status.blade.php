@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Checkout</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ url("/")}}">Home</a>
                </li>
                <li class="active">Checkout Status </li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                    <div class="alert alert-{{$status}} p-4">{{$message}}</div>
            </div>
        </div>
    </div>
</div>
@endsection
