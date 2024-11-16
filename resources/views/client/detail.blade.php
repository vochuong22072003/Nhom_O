@extends('client.layouts.layout')

@section('title', 'Detail')

@section('main')
    <!-- Content -->
    <section class="bg0 p-b-70 p-t-5">
        <!-- Title -->
        <div class="bg-img1 size-a-18 how-overlay1" style="background-image: url({{ asset($getPost->image) }});">
            <div class="container h-full flex-col-e-c p-b-58">
                <div class="category-links">
                    @if (isset($getPost->postCatalogueChildren))
                        <!-- Link đến danh mục cha -->
                        <a
                            href="{{ route('client.category', ['id' => $getPost->postCatalogueParent_encrypted_id, 'model' => 'parent']) }}">
                            {{ $getPost->postCatalogueParent->post_catalogue_parent_name }}
                        </a>
                        <span class="separator"> > </span>
                        <!-- Link đến danh mục con -->
                        <a
                            href="{{ route('client.category', ['id' => $getPost->postCatalogueChildren_encrypted_id, 'model' => 'children']) }}">
                            {{ $getPost->postCatalogueChildren->post_catalogue_children_name }}
                        </a>
                    @else
                        <!-- Chỉ có danh mục cha -->
                        <a
                            href="{{ route('client.category', ['id' => $getPost->postCatalogueParent_encrypted_id, 'model' => 'parent']) }}">
                            {{ $getPost->postCatalogueParent->post_catalogue_parent_name }}
                        </a>
                    @endif
                </div>



                <h3 class="f1-l-5 cl0 p-b-16 txt-center respon2">
                    {{ $getPost->post_name }}
                </h3>

                <div class="flex-wr-c-s">
                    <span class="f1-s-3 cl8 m-rl-7 txt-center">
                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                            by {{ $getPost->userInfo->name }}
                        </a>

                        <span class="m-rl-3">-</span>

                        <span>
                            {{ \Carbon\Carbon::parse($getPost->created_at)->format('d/m/Y') }}
                        </span>
                    </span>

                    <span class="f1-s-3 cl8 m-rl-7 txt-center">
                        <a href=""><i class="fa fa-eye"> view</i></a>
                        <p>Lượt xem: {{ $getPost->viewCount($getPost->id) }}</p>
                    </span>
                    <span class="f1-s-3 cl8 m-rl-7 txt-center">

                        @auth
                            <i class="fa fa-heart {{ $getPost->isLike() == true ? 'liked' : '' }}" id="likeButton"
                                data-post-id="{{ $getPost->id }}">
                                @if ($getPost->isLike())
                                    Unlike
                                @else
                                    Like
                                @endif
                            </i>
                        @else
                            <i class="fa fa-heart" id="likeButton" data-post-id="{{ $getPost->id }}">Like</i>
                        @endauth
                    </span>

                    <span class="f1-s-3 cl8 m-rl-7 txt-center">
                        <i class="fa fa-save" data-toggle="modal" data-post-id="{{ $getPost->id }}"
                            data-target="#saveModal"> Lưu bài viết </i>
                    </span>
                </div>
            </div>
        </div>
        <!-- Modal: -->
        <!-- Modal: Chọn thư mục lưu hoặc tạo thư mục mới -->
        <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="saveModalLabel">Lưu bài viết vào danh mục</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="savePostForm" action="{{ route('posts.saveToFolder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" id="post_id" value="{{ $getPost->id }}">
                            <!-- Danh sách danh mục (không bắt buộc) -->
                            <div class="mb-3">
                                <h4 class="text-center">các danh mục sẵn có của bạn</h4>
                                <!-- Options -->
                                @auth('customers')
                                    <div class="text-center">
                                        @foreach (Auth::guard('customers')->user()->saveFolders as $y)
                                            <div class="checkbox-item">
                                                <input class="folder-checkbox" type="checkbox"
                                                    data-folder-id="{{ $y->folder_id }}"
                                                    data-folder-name="{{ $y->folder_name }}" name="folder[]"
                                                    {{ $y->isSave($getPost->id, $y->folder_id) ? 'checked' : '' }}>
                                                <span>{{ $y->folder_name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endauth

                            </div>

                            {{-- <input type="hidden" name="post_id" value="{{ $getPost->id }}"> --}}
                            <!-- Form nhập tên danh mục mới -->
                            <div class="mb-3">
                                <label for="save_folder_name" class="form-label text-center">Hoặc tạo danh mục mới:</label>
                                <input type="text" class="form-control" name="save_folder_name" id="save_folder_name"
                                    placeholder="Nhập tên danh mục mới">
                            </div>
                            <button type="submit" class="btn btn-primary" id="savePost">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- end modal --}}
        <!-- Detail -->
        <div class="container p-t-50">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-100">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->

                        <div class="p-b-70 blog-content-wrap">
                            <p class="f1-s-11 cl6" id="postContent">
                                {!! $getPost->post_content !!}
                            </p>

                            <button id="readButton">Đọc bài viết</button>
                            <!-- Tag -->
                            <div class="flex-s-s p-t-12 p-b-15">
                                <span class="f1-s-12 cl5 m-r-8">
                                    Tags:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <br>
                                    <i class="fa fa-tag"></i>


                                    <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        Streetstyle
                                    </a>


                                </div>
                            </div>

                            <!-- Share -->
                            <div class="flex-s-s">
                                <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                    Share:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://example.com/path-to-article"
                                        target="_blank"
                                        class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-facebook-f m-r-7"></i>
                                        Facebook
                                    </a>

                                    <a href="https://twitter.com/share?url=https://example.com/path-to-article&text=Nội+dung+tuyệt+vời!"
                                        target="_blank"
                                        class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-twitter m-r-7"></i>
                                        Twitter
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Leave a comment -->
                        <div>
                            <h4 class="f1-l-4 cl3 p-b-12">
                                Leave a Comment
                            </h4>

                            <p class="f1-s-13 cl8 p-b-40">
                                Your email address will not be published. Required fields are marked *
                            </p>

                            <form>
                                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg"
                                    placeholder="Comment..."></textarea>

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="name" placeholder="Name*">

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="email" placeholder="Email*">

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="website" placeholder="Website">

                                <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="bg0 p-b-140 p-t-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->
                        <div class="p-b-70">
                            <a href="#" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
                                Technology
                            </a>

                            <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                Nulla non interdum metus non laoreet nisi tellus eget aliquam lorem pellentesque
                            </h3>

                            <div class="flex-wr-s-s p-b-40">
                                <span class="f1-s-3 cl8 m-r-15">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by John Alvarado
                                    </a>

                                    <span class="m-rl-3">-</span>

                                    <span>
                                        Feb 18
                                    </span>
                                </span>

                                <span class="f1-s-3 cl8 m-r-15">
                                    5239 Views
                                </span>

                                <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                    0 Comment
                                </a>
                            </div>

                            <div class="wrap-pic-max-w p-b-30">
                                <img src="{{ asset('client/images/blog-list-01.jpg') }}" alt="IMG">
                            </div>

                            <p class="f1-s-11 cl6 p-b-25">
                                Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper. Aliquam a dui
                                suscipit, fringilla metus id, maximus leo. Vivamus sapien arcu, mollis eu pharetra vitae,
                                condimentum in orci. Integer eu sodales dolor. Maecenas elementum arcu eu convallis rhoncus.
                                Donec tortor sapien, euismod a faucibus eget, porttitor quis libero.
                            </p>

                            <p class="f1-s-11 cl6 p-b-25">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sit amet est vel orci luctus
                                sollicitudin. Duis eleifend vestibulum justo, varius semper lacus condimentum dictum. Donec
                                pulvinar a magna ut malesuada. In posuere felis diam, vel sodales metus accumsan in. Duis
                                viverra dui eu pharetra pellentesque. Donec a eros leo. Quisque sed ligula vitae lorem
                                efficitur faucibus. Praesent sit amet imperdiet ante. Nulla id tellus auctor, dictum libero
                                a, malesuada nisi. Nulla in porta nibh, id vestibulum ipsum. Praesent dapibus tempus erat
                                quis aliquet. Donec ac purus id sapien condimentum feugiat.
                            </p>

                            <p class="f1-s-11 cl6 p-b-25">
                                Praesent vel mi bibendum, finibus leo ac, condimentum arcu. Pellentesque sem ex, tristique
                                sit amet suscipit in, mattis imperdiet enim. Integer tempus justo nec velit fringilla, eget
                                eleifend neque blandit. Sed tempor magna sed congue auctor. Mauris eu turpis eget tortor
                                ultricies elementum. Phasellus vel placerat orci, a venenatis justo. Phasellus faucibus
                                venenatis nisl vitae vestibulum. Praesent id nibh arcu. Vivamus sagittis accumsan felis,
                                quis vulputate
                            </p>

                            <!-- Tag -->
                            <div class="flex-s-s p-t-12 p-b-15">
                                <span class="f1-s-12 cl5 m-r-8">
                                    Tags:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        Streetstyle
                                    </a>

                                    <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        Crafts
                                    </a>
                                </div>
                            </div>

                            <!-- Share -->
                            <div class="flex-s-s">
                                <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                    Share:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-facebook-f m-r-7"></i>
                                        Facebook
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-twitter m-r-7"></i>
                                        Twitter
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-google-plus-g m-r-7"></i>
                                        Google+
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-pinterest-p m-r-7"></i>
                                        Pinterest
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Leave a comment -->
                        <div>
                            <h4 class="f1-l-4 cl3 p-b-12">
                                Leave a Comment
                            </h4>

                            <p class="f1-s-13 cl8 p-b-40">
                                Your email address will not be published. Required fields are marked *
                            </p>

                            <form>
                                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg"
                                    placeholder="Comment..."></textarea>

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="name" placeholder="Name*">

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="email" placeholder="Email*">

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                    name="website" placeholder="Website">

                                <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-10 col-lg-4 p-b-30">
                    <div class="p-l-10 p-rl-0-sr991 p-t-70">
                        <!-- Category -->
                        <div class="p-b-60">
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Category
                                </h3>
                            </div>

                            <ul class="p-t-35">
                                <li class="how-bor3 p-rl-4">
                                    <a href="#"
                                        class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
                                        Fashion
                                    </a>
                                </li>

                                <li class="how-bor3 p-rl-4">
                                    <a href="#"
                                        class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
                                        Beauty
                                    </a>
                                </li>

                                <li class="how-bor3 p-rl-4">
                                    <a href="#"
                                        class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
                                        Street Style
                                    </a>
                                </li>

                                <li class="how-bor3 p-rl-4">
                                    <a href="#"
                                        class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
                                        Life Style
                                    </a>
                                </li>

                                <li class="how-bor3 p-rl-4">
                                    <a href="#"
                                        class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
                                        DIY & Crafts
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Archive -->
                        <div class="p-b-37">
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Archive
                                </h3>
                            </div>

                            <ul class="p-t-32">
                                <li class="p-rl-4 p-b-19">
                                    <a href="#" class="flex-wr-sb-c f1-s-10 text-uppercase cl2 hov-cl10 trans-03">
                                        <span>
                                            July 2018
                                        </span>

                                        <span>
                                            (9)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-rl-4 p-b-19">
                                    <a href="#" class="flex-wr-sb-c f1-s-10 text-uppercase cl2 hov-cl10 trans-03">
                                        <span>
                                            June 2018
                                        </span>

                                        <span>
                                            (39)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-rl-4 p-b-19">
                                    <a href="#" class="flex-wr-sb-c f1-s-10 text-uppercase cl2 hov-cl10 trans-03">
                                        <span>
                                            May 2018
                                        </span>


                                    @endsection
