@if (auth()->check())
    <form class="header-search-form" action="{{ route('blog.search') }}">
        <div class="axil-search form-group">
            <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
            <input type="text" class="form-control" placeholder="Search" name="search"
                value="{{ $searchKeyword ?? '' }}">
        </div>
    </form>

    @include("web.layouts.includes.profile_dropdown")

    <!-- Start Hamburger Menu  -->
    <div class="hamburger-menu d-block d-xl-none">
        <div class="hamburger-inner">
            <div class="icon"><i class="fal fa-bars"></i></div>
        </div>
    </div>
@else
    <a class="ml-5 mr-5" href="{{ route('login') }}">Login</a>
    <a class="auth_button" href="{{ route('register') }}">Register</a>
@endif
<!-- End Hamburger Menu  -->
