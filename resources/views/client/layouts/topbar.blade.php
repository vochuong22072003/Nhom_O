<div class="topbar">
    <div class="content-topbar container h-100">
        <div class="left-topbar">
            <span class="left-topbar-item flex-wr-s-c">
                <span>
                    Nhóm O
                </span>
            </span>

            <a href="#" class="left-topbar-item">
                About
            </a>

            <a href="#" class="left-topbar-item">
                Contact
            </a>

            @guest
                <a href="{{ route('register') }}" class="left-topbar-item">
                    Sign up
                </a>

                <a href="{{ route('login') }}" class="left-topbar-item">
                    Log in
                </a>
            @endguest

        </div>

        <div class="right-topbar">
            {{-- Notification and avatar --}}
            @auth
                <button class="btn no-box-shadow mr-2" style="color: inherit;">
                    <i class="far fa-bell fa-lg"></i>
                </button>

                <button role="button" class="btn dropdown p-0 rounded-circle overflow-hidden text-center"
                    style="width: 30px;height: 30px" data-toggle="dropdown">
                    <img src="{{ asset('client/images/upload/avt-default.png') }}" class="rounded-circle img-avt">
                </button>
                <div class="dropdown-menu menu-drop-setting p-1" aria-labelledby="dropdownMenu1">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('client/images/upload/avt-default.png') }}" alt=""
                            class="rounded-circle img-avt m-2">
                        <p>{{ '@' . Auth::guard('customers')->user()->cus_user}}</p>
                    </div>
                    <hr style="background-color: azure">
                    {{-- ------------------------------- --}}

                    <a class="dropdown-item item-fix text-light" href="{{ route('setting.general')}}">Setting</a>
                    <hr style="background-color: azure">
                    {{-- ------------------------------- --}}
                    <a class="dropdown-item item-fix text-light" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endauth

        </div>
    </div>
</div>
