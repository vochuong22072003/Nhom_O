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
            <button class="btn no-box-shadow"
                style="color: inherit;">
                <i class="far fa-bell fa-lg"></i>
            </button>

            
        </div>
    </div>
</div>