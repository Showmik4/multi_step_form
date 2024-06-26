<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(isset(Auth::user()->image))
                    <img src="{{url(Auth::user()->image)}}" alt="{{ Auth::user()->alt_tag }}" class="rounded-circle">
                    @else
                    <img src="{{url('public/assets/images/users/user_avater.png')}}" alt="User Avater"
                        class="rounded-circle">
                    @endif
                    <span class="pro-user-name ms-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome {{ Auth::user()->name }}!</h6>
                    </div>
                    <!-- item-->
                    <a href="" class="dropdown-item notify-item">
                        {{-- <a href="{{ route('profile.edit', \Auth::id()) }}" class="dropdown-item notify-item">--}}
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- item-->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{ route('dashboard') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    {{-- <img src="{{url($setting->logo_1 ?? $setting->logo_2)}}" alt="" height="22">--}}
                </span>
                <span class="logo-lg">
                    {{-- <img src="{{url($setting->logo_1 ?? $setting->logo_2)}}" alt="" height="60">--}}
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>