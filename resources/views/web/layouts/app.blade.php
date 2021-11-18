<!doctype html>
<html class="no-js" lang="en">
@include("web.layouts.includes.head" , ["metaData" => $metaData ?? []])


<body>

    <div class="main-wrapper wrapper-2">
        @include("web.layouts.includes.general_header")

        @include("web.layouts.includes.mobile_menu")

        <!-- search start -->
        <div class="search-content-wrap main-search-active">
            <a class="search-close"><i class="la la-close"></i></a>
            <div class="search-content">
                <p>Start typing and press Enter to search</p>
                <form class="search-form" action="{{ route('web.shop.index')}}" method="GET">
                    <input type="text" name="search" placeholder="Search entire store…" value="{{ request()->query('builder')}}">
                    <button class="button-search"><i class="la la-search"></i></button>
                </form>
            </div>
        </div>

        {{-- @include("web.layouts.includes.sidebar_cart") --}}

        @yield("content")

    </div>
    @include("web.layouts.includes.footer")

    @include("web.layouts.includes.scripts")
    @livewireScripts()
</body>
</html>
