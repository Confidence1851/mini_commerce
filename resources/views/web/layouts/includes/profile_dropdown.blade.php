
    {{-- <div class="btn-group dropleft" role="group">
        <div class="dropdown">
            <a href="#" class="ml-3" type="button" id="userNotificationDropDown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
            </a>
            <div class="dropdown-menu profileDropDownContent" aria-labelledby="userProfileDropDown"
                id="userNotificationDropDownContent">
                <button class="dropdown-item" type="button">Lorem ipsum dolor sit amet.</button>
            </div>
        </div>
    </div> --}}

    <div class="btn-group dropleft" role="group">
        <div class="dropdown">
            <a href="{{ auth()->user()->avatarUrl() }}" class="ml-3" type="button" id="userProfileDropDown" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Author Images" class="img-fluid" style="height: 37px">
            </a>
            <div class="dropdown-menu profileDropDownContent" aria-labelledby="userProfileDropDown"
                id="userProfileDropDownContent">
                @if (auth()->user()->isAdmin())
                <a href="{{ route("admin.dashboard")}}" class="dropdown-item" type="button">Dashboard</a>
                @else
                <a href="{{ route("user.dashboard")}}" class="dropdown-item" type="button">Dashboard</a>
                <a href="{{ route('user.account.bank.details') }}" class="dropdown-item" type="button">My Account</a>
                @endif

                <form action="{{ route("logout")}}" method="post" >@csrf
                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
