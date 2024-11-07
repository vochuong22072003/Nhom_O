<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
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
                    <a href="#">
                        <span class="fab fa-facebook-f"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-twitter"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-pinterest-p"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-vimeo-v"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-youtube"></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="{{ route('client.index') }}"><img src="{{ asset('client/images/icons/logo-01.png') }}"
                        alt="IMG-LOGO"></a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li class="left-topbar">
                    <span class="left-topbar-item flex-wr-s-c">
                        <span>
                            Nhóm O
                        </span>
                    </span>
                </li>

                <li class="left-topbar">
                    <a href="#" class="left-topbar-item">
                        About
                    </a>

                    <a href="#" class="left-topbar-item">
                        Contact
                    </a>

                    <a href="#" class="left-topbar-item">
                        Sing up
                    </a>

                    <a href="#" class="left-topbar-item">
                        Log in
                    </a>
                </li>

                <li class="right-topbar">
                    <a href="#">
                        <span class="fab fa-facebook-f"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-twitter"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-pinterest-p"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-vimeo-v"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-youtube"></span>
                    </a>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="{{ route('client.index') }}">Home</a>
                    <ul class="sub-menu-m">
                        <li><a href="{{ route('client.index') }}">Homepage v1</a></li>
                        <li><a href="home-02.html">Homepage v2</a></li>
                        <li><a href="home-03.html">Homepage v3</a></li>
                    </ul>

                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="category-01.html">News</a>
                </li>

                <li>
                    <a href="category-02.html">Entertainment </a>
                </li>

                <li>
                    <a href="category-01.html">Business</a>
                </li>

                <li>
                    <a href="category-02.html">Travel</a>
                </li>

                <li>
                    <a href="category-01.html">Life Style</a>
                </li>

                <li>
                    <a href="category-02.html">Video</a>
                </li>

                <li>
                    <a href="#">Features</a>
                    <ul class="sub-menu-m">
                        <li><a href="category-01.html">Category Page v1</a></li>
                        <li><a href="category-02.html">Category Page v2</a></li>
                        <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                        <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                        <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                        <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                        <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>

                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
            </ul>
        </div>

        <!-- Header desktop  -->
        <div class="wrap-logo container">
            <!-- Logo desktop -->
            <div class="logo">
                <a href="{{ route('client.index') }}"><img src="{{ asset('client/images/icons/logo-01.png') }}"
                        alt="LOGO"></a>
            </div>
        </div>

        <!-- Header desktop -->
        <div class="wrap-main-nav">
            <div class="main-nav">
                <!-- Menu desktop -->
                <nav class="menu-desktop">
                    <a class="logo-stick" href="{{ route('client.index') }}">
                        <img src="{{ asset('client/images/icons/logo-01.png') }}" alt="LOGO">
                    </a>

                    <ul class="main-menu">
                        <li class="main-menu-active">
                            <a href="{{ route('client.index') }}">Home</a>
                        </li>
                        {{-- lấy danh mục cha con --}}
                        @if (count($menus) > 0)
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($menus as $category)
                                @if ($count == 7)
                                @break
                            @endif
                            <li>
                                <a
                                    href="{{ route('client.category', ['id' => $category->encrypted_id, 'model' => 'parent']) }}">{{ $category->post_catalogue_parent_name }}</a>
                                @if (count($category->post_catalogue_children) > 0)
                                    <ul class="sub-menu">
                                        @foreach ($category->post_catalogue_children as $child)
                                            <li>
                                                <a
                                                    href="{{ route('client.category', ['id' => $child->encrypted_id, 'model' => 'children']) }}">{{ $child->post_catalogue_children_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                @endif
                            </li>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        <div class="btn-show-menu-desktop hamburger hamburger--squeeze" id="ham">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </div>
                        <!-- Mega Menu -->
                        <div id="mega-menu" class="mega-menu">
                            <div class="menu-content">
                                <!-- Thêm các danh mục, liên kết hoặc nội dung tùy thích vào đây -->
                                <ul>
                                    <div class="row">
                                        @foreach ($menus as $category)
                                            <div class="col-lg-4 col-sm-12 pb-4">
                                                <div class="list-group list-group-flush">
                                                    <a href="{{ route('client.category', ['id' => $category->encrypted_id, 'model' => 'parent']) }}
"
                                                        class="mb-0 list-group-item text-uppercase font-weight-bold" id="mega-parent">
                                                        {{ $category->post_catalogue_parent_name }}
                                                    </a>
                                                    @if (count($category->post_catalogue_children) > 0)
                                                        @foreach ($category->post_catalogue_children as $child)
                                                            <li>
                                                                <a href="{{ route('client.category', ['id' => $child->encrypted_id, 'model' => 'children']) }}
"
                                                                    class="list-group-item list-group-item-action">{{ $child->post_catalogue_children_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li>
                                                            <p id="no-child" href=""
                                                                class="list-group-item list-group-item-action"
                                                                disabled>không có danh mục con</p>
                                                        </li>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </ul>
                            </div>
                        </div>
                    @else
                        <p>Danh mục rỗng</p>
                    @endif


                </ul>

            </nav>
        </div>
    </div>
</header>