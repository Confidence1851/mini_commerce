 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{ route("admin.dashboard") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Home</span>
                    </div>
                </a>
            </li>

            {{-- <b>Blog</b>
            <br>
            @can("can_read_posts")
            <li class="menu">
                <a href="{{ route("admin.blog.posts.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Posts</span>
                    </div>
                </a>
            </li>
            @endcan
            @can("can_read_post_categories")
            <li class="menu">
                <a href="{{ route("admin.blog.category.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Category</span>
                    </div>
                </a>
            </li>
            @endcan --}}

            @can("can_read_users")
            <li class="menu">
                <a href="{{ route("admin.users.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Users</span>
                    </div>
                </a>
            </li>
            @endcan

            @can("can_read_products")
            <li class="menu">
                <a href="{{ route("admin.products.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Users</span>
                    </div>
                </a>
            </li>
            @endcan

            @can("can_read_payments")
            <li class="menu">
                <a href="{{ route("admin.payments.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Payments</span>
                    </div>
                </a>
            </li>
            @endcan
            @can("can_read_orders")
            <li class="menu">
                <a href="{{ route("admin.orders.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Orders</span>
                    </div>
                </a>
            </li>
            @endcan

            @can("can_read_user_activities")
            <li class="menu">
                <a href="{{ url("/admin/user-activity")}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>User Activities</span>
                    </div>
                </a>
            </li>
            @endcan
            <hr>
            @if (isDev())

            <b>Authorization</b>
            <br>
            <li class="menu">
                <a href="{{ route("admin.authorization.roles.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Roles</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route("admin.authorization.permissions.index") }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>Permissions</span>
                    </div>
                </a>
            </li>
            @endif
            <br>
            <br>

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->
