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
                    <form action="{{ route('posts.like') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $getPost->id }}">
                        <button type="submit" class="f1-s-3 cl8 m-rl-7 txt-center">
                            <i class="fa fa-heart">like</i>
                        </button>
                    </form>
                    <span class="f1-s-3 cl8 m-rl-7 txt-center">
                        <a href="#" data-toggle="modal" data-target="#saveModal">
                            <i class="fa fa-save"> Lưu bài viết </i>
                        </a>
                    </span>

                    <!-- Modal: -->
                    <!-- Modal: Chọn thư mục lưu hoặc tạo thư mục mới -->
                    <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="saveModalLabel">Lưu bài viết</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form lưu bài viết vào thư mục -->
                                    {{-- thêm vào action	{{ route('save-to-exists-folder') }} --}}
                                    <form action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="">
                                        {{-- thêm vào value	{{ $getPost->id }} --}}

                                        <div class="form-group">
                                            <label for="folderSelect">Chọn thư mục đã có</label>
                                            <select class="form-control" id="folderSelect" name="folder_id">
                                                <option value="">Chọn thư mục...</option>
                                                <!-- Dữ liệu thư mục được lấy từ backend -->
                                                {{-- @foreach ($folders as $folder)
                                                    <option value="{{ $folder->folder_id }}">{{ $folder->folder_name }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                        <!-- Hoặc tạo thư mục mới -->
                                        <div class="form-group">
                                            <label for="newFolderName">Tạo thư mục mới</label>
                                            <input type="text" class="form-control" id="newFolderName"
                                                name="new_folder_name" placeholder="Tên thư mục mới">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">Lưu vào thư mục</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- end modal --}}
                </div>
            </div>
        </div>

        <!-- Detail -->
        <div class="container p-t-50">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-100">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->
                        <div class="p-b-70 blog-content-wrap">
                            <p class="f1-s-11 cl6">
                                {!! $getPost->post_content !!}
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
            </div>
        </div>
    </section>





@endsection
