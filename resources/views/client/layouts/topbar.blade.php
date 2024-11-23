<div class="topbar">
    <div class="content-topbar container h-100">
        <div class="left-topbar">
            <span class="left-topbar-item flex-wr-s-c">
                <span>
                    Nhóm O
                </span>
            </span>
            @auth
            <a href="{{ route('client.myactive') }}" class="left-topbar-item">
                Xem lịch sử bài viết 
            </a>
            @endauth
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
                    @php
                        $avt_src = Auth::guard('customers')->user()->customerInfo->getAvtUrl()
                    @endphp
                    {{--  AVATAR --}}
                    <img src="{{ $avt_src ?? '' }}" class="rounded-circle img-avt">
                </button>
                <div class="dropdown-menu menu-drop-setting p-1" aria-labelledby="dropdownMenu1">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ $avt_src ?? '' }}" alt="" class="rounded-circle img-avt m-2">
                        <p>{{ '@' . Auth::guard('customers')->user()->cus_user }}</p>
                    </div>
                    <hr style="background-color: azure">
                    {{-- ------------------------------- --}}

                    <a class="dropdown-item item-fix text-light" href="{{ route('setting.general') }}">Setting</a>
                    <hr style="background-color: azure">
                    {{-- ------------------------------- --}}
                    <a class="dropdown-item item-fix text-light" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endauth

        </div>
    </div>
</div>
