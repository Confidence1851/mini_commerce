@extends("web.layouts.app")
@section("content")
        @include("web.pages.home.fragments.slider")
        @include("web.pages.home.fragments.banners")
        @include("web.pages.home.fragments.list_products" , ["title" => "Best Sells" , "sub_title" => "SUbtitle goes here"])
@endsection
