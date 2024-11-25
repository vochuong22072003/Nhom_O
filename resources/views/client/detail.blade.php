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
                        <i class="fa fa-eye"> view</i>
                        <p id="view-count" data-post-id="{{ $getPost->id }}">
                            Lượt xem:{{ $getPost->getView() }} </p>
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
                        {{-- <p>tổng lượt thích {{ $getPost->getTotalLikes($getPost->id)}}</p> --}}
                    </span>
                    <span class="f1-s-3 cl8 m-rl-7 txt-center">
                        <i class="fa fa-save" data-toggle="modal" data-post-id="{{ $getPost->id }}"
                            data-target="#saveModal"> Lưu bài viết </i>
                    </span>


                    <!-- Modal: -->
                    <!-- Modal: Chọn thư mục lưu hoặc tạo thư mục mới -->
                </div>
            </div>

        </div>
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
                                <h1 class="text-center" style="margin-left: 120px; color:red;">các danh mục sẵn có của bạn
                                </h1>
                                <!-- Options -->
                                @auth('customers')
                                    <div class="text-center" style="margin-left: 100px">
                                        @foreach (Auth::guard('customers')->user()->saveFolders as $y)
                                            <div class="checkbox-item" style="color:yellow">
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

                            {{-- end modal --}}
                            {{-- <input type="hidden" name="post_id" value="{{ $getPost->id }}"> --}}
                            <!-- Form nhập tên danh mục mới -->
                            <div class="mb-3">
                                <label for="save_folder_name" class="form-label text-center"
                                    style="margin-left: 120px ; color:red;">Hoặc tạo danh mục mới:</label>
                                <input type="text" class="form-control" name="save_folder_name" id="save_folder_name"
                                    placeholder="Nhập tên danh mục mới" style="margin-left: 80px">
                            </div>
                            <button type="submit" class="btn btn-primary bt" style="margin-left: 180px;"
                                id="savePost">Lưu</button>
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
                                {!!$getPost->post_content!!}
                            </p>
                           
                            <textarea id="postContent" rows="4" cols="50">alo 1 2 3 4 </textarea><br>
                            <button onclick="readText()">Đọc văn bản</button>
                            <button onclick="stopReading()">Dừng đọc</button>
                            <!-- Tag -->
                            <div class="flex-s-s p-t-12 p-b-15">
                                <span class="f1-s-12 cl5 m-r-8">
                                    Tags:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <br>
                                    <i class="fa fa-tag"></i>
                                    <a href="" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        @foreach ($getPost->tags as $tag)
                                            <a href="{{ route('client.tag.posts', ['tagId' => $tag->tag_id]) }}"
                                                class="f1-s-12 cl8 hov-link1 m-r-15">
                                                {{ $tag->tag_name }}
                                            </a>
                                        @endforeach
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
                            <div class="flex-s-s">
                                <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                    Author: {{ $getPost->userInfo->name }}
                                </span>
                                <div class="flex-wr-s-s size-w-0">
                                    <form action="{{ route('follow') }}" method="post">
                                        @csrf
                                        <input name="author_name" type="hidden" value="{{ $getPost->userInfo->name }}">
                                        <input name="author_id" type="hidden" value="{{ $getPost->users->id }}">

                                        @auth
                                            @if ($getPost->users->followers->contains('cus_id', auth('customers')->user()->cus_id))
                                                <button type="submit"
                                                    class="dis-block f1-s-13 cl0 bg-danger borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                                    <i class="fa-solid fa-bell m-r-7"></i>
                                                    Unfollow
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="dis-block f1-s-13 cl0 bg-danger borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                                    <i class="fa-regular fa-bell m-r-7"></i>
                                                    Follow
                                                </button>
                                            @endif
                                        @else
                                            <button type="button"
                                                class="dis-block f1-s-13 cl0 bg-danger borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                                <i class="fa-regular fa-bell m-r-7"></i>
                                                Follow
                                            </button>
                                        @endauth

                                    </form>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('comment.create') }}">
                                @csrf
                                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20 comments" cols="100"
                                    name="content" placeholder="Comment...">{{ old('content', $comment->content ?? '') }}</textarea>

                                <input type="hidden" name="post_id" value="{{ $getPost->id }}">

                                <!-- <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                                name="name" placeholder="Name*">

                                            <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                                name="email" placeholder="Email*">

                                            <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text"
                                                name="website" placeholder="Website"> -->

                                <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                                    Post Comment
                                </button>
                            </form>

                            @if ($comments->isNotEmpty())
                                <select class="mt-5" name="arrange" id="arrange-comments">
                                    <option value="date">Mới nhất xếp trước</option>
                                    <option value="popular">Bình luận hàng đầu</option>
                                </select>
                                <div class="comment-container mt-5">

                                </div>
                            @else
                                <h2 class="mt-4">Hãy là người bình luận đầu tiên</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let comments = @json($comments);
        let client_logged = @json($client_logged);
        var getReplyUrl = '{{ route('ajax.comment.reply') }}';
        var getShowReplyUrl = '{{ route('ajax.comment.showReply') }}';
        var getReplyNUrl = '{{ route('ajax.comment.replyN') }}';
        var getCommentUpdate = '{{ route('ajax.comment.update') }}';
        var getCommentNUpdate = '{{ route('ajax.comment.updateN') }}';
        var getCommentDelete = '{{ route('ajax.comment.delete') }}';
        var getCommentNDelete = '{{ route('ajax.comment.deleteN') }}'
    </script>





@endsection
