<div class="p-l-10 p-rl-0-sr991 p-b-20">
    <!--  -->
    <div class="">
        <div class="how2 how2-cl4 d-flex justify-content-between align-items-center">
            <h3 class="f1-m-2 cl3 tab01-title">Các bài viết được xem hàng đầu</h3>
        </div>
    
        <ul class="list-group p-t-35">
            @if (!is_null($posts_view))
                @foreach ($posts_view as $post_view)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="top-post-content">
                            <a href="{{ route('client.detail', $post_view->encrypted_id) }}"
                                class="how-txt1 size-a-6 cl69 hov-cl10 trans-03">
                                {{ $post_view->post_name }}
                            </a>
                            <div>
                                {{ $post_view->views->view_count }} views
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="list-group-item text-center">
                    Không có dữ liệu
                </li>
            @endif
        </ul>
    
    </div>
    

    <!--  -->
    <div class="p-t-50">
        <div class="how2 how2-cl4 flex-s-c">
            <h3 class="f1-m-2 cl3 tab01-title">
                Stay Connected
            </h3>
        </div>

        <ul class="p-t-35">
            <li class="flex-wr-sb-c p-b-20">
                <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-facebook fs-16 cl0 hov-cl0">
                    <span class="fab fa-facebook-f"></span>
                </a>

                <div class="size-w-3 flex-wr-sb-c">
                    <span class="f1-s-8 cl3 p-r-20">
                        6879 Fans
                    </span>

                    <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                        Like
                    </a>
                </div>
            </li>

            <li class="flex-wr-sb-c p-b-20">
                <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-twitter fs-16 cl0 hov-cl0">
                    <span class="fab fa-twitter"></span>
                </a>

                <div class="size-w-3 flex-wr-sb-c">
                    <span class="f1-s-8 cl3 p-r-20">
                        568 Followers
                    </span>

                    <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                        Follow
                    </a>
                </div>
            </li>

            <li class="flex-wr-sb-c p-b-20">
                <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-youtube fs-16 cl0 hov-cl0">
                    <span class="fab fa-youtube"></span>
                </a>

                <div class="size-w-3 flex-wr-sb-c">
                    <span class="f1-s-8 cl3 p-r-20">
                        5039 Subscribers
                    </span>

                    <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                        Subscribe
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <div class="flex-c-s p-b-50">
        <a href="#">
            <img class="max-w-full" src="{{ asset('client/images/banner-04.jpg') }}" alt="IMG">
        </a>
    </div>
    <!-- Tag -->
    <div class="p-t-50">
        <div class="how2 how2-cl4 flex-s-c m-b-30">
            <h3 class="f1-m-2 cl3 tab01-title">
                Tags
            </h3>
        </div>
        @if (Route::currentRouteName() == 'client.index')
            @if (isset($tags) && $tags->isNotEmpty())


                <div class="flex-wr-s-s m-rl--5">

                    @foreach ($tags as $tag)
                        <a href=" {{ route('client.tag.posts', ['tagId' => $tag->tag_id]) }}"
                            class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5" style="color: black">
                            {{ $tag->tag_name }}
                        </a>
                    @endforeach
                </div>
            @else
                <h2>Không có dữ liệu</h2>
            @endif
        @endif

    </div>
</div>
