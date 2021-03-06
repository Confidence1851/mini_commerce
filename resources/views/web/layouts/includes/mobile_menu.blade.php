<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close"><i class="la la-close"></i></a>
    <div class="header-mobile-aside-wrap">
        <div class="mobile-search">
            <form class="search-form" action="{{ route('web.shop.index')}}" method="GET">
                <input type="text" value="{{ request()->query('builder')}}" name="search" placeholder="Search entire store…">
                <button class="button-search"><i class="la la-search"></i></button>
            </form>
        </div>
        <div class="mobile-menu-wrap">
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                @include("web.layouts.includes.main_menu_nav")
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
        </div>

        <div class="quick-info">
            <ul>
                <li><i class="la la-phone"></i> <a href="tel:+234 (0) 706 324 0620">+234 (0) 706 324 0620</a></li>
                <li> <i class="la la-envelope"></i> <a href="mailto:Sales@gelly.ng">Sales@gelly.ng</a></li>
                <li> <i class="la la-clock-o"></i> MON-SAT:8AM TO 9PM</li>
            </ul>
        </div>
    </div>
</div>
