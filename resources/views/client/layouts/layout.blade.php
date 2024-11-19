<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (isset($config['css']) && is_array($config['css']))
        @foreach ($config['css'] as $key => $val)
            <link href="{{ asset($val) }}" rel="stylesheet">
        @endforeach
    @endif

</head>

<body class="animsition">
    <!-- Header -->
    @include('client.layouts.header')

    <!-- Headline -->
    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8 flex-nowrap">
            {{-- Breadcrumb --}}
            @section('breadcrumb')
                <div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
                </div>
            @show

            <form action="{{ route('client.search') }}" method="post" class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                @csrf
                <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search" value="">
                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </form>
        </div>
    </div>

    @yield('main')

    <!-- Footer -->
    <footer>
        <div class="bg2 p-t-40 p-b-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <a href="{{ route('client.index') }}">
                                <img class="max-s-full" src="{{ asset('client/images/icons/logo-02.png') }}"
                                    alt="LOGO">
                            </a>
                        </div>

                        <div>
                            <p class="f1-s-1 cl11 p-b-16">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tempor magna eget
                                elit efficitur, at accumsan sem placerat. Nulla tellus libero, mattis nec molestie at,
                                facilisis ut turpis. Vestibulum dolor metus, tincidunt eget odio
                            </p>

                            <p class="f1-s-1 cl11 p-b-16">
                                Any questions? Call us on (+1) 96 716 6879
                            </p>

                            <div class="p-t-15">
                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-facebook-f"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-twitter"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-pinterest-p"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-vimeo-v"></span>
                                </a>

                                <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                    <span class="fab fa-youtube"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Popular Posts
                            </h5>
                        </div>

                        <ul>
                            <li class="flex-wr-sb-s p-b-20">
                                <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img src="{{ asset('client/images/popular-post-01.jpg') }}" alt="IMG">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                            Donec metus orci, malesuada et lectus vitae
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                        Feb 17
                                    </span>
                                </div>
                            </li>

                            <li class="flex-wr-sb-s p-b-20">
                                <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img src="{{ asset('client/images/popular-post-02.jpg') }}" alt="IMG">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                            Lorem ipsum dolor sit amet, consectetur
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                        Feb 16
                                    </span>
                                </div>
                            </li>

                            <li class="flex-wr-sb-s p-b-20">
                                <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img src="{{ asset('client/images/popular-post-03.jpg') }}" alt="IMG">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                            Suspendisse dictum enim quis imperdiet auctor
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                        Feb 15
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Category
                            </h5>
                        </div>

                        <ul class="m-t--12">
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Fashion (22)
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Technology (29)
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Street Style (15)
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Life Style (28)
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    DIY & Crafts (16)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

       
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>


    @if (isset($config['js']) && is_array($config['js']))
        @foreach ($config['js'] as $key => $val)
            <script src=" {{ asset($val) }} "></script>
        @endforeach
    @endif
    <script>
        const hamburger = document.querySelector('.btn-show-menu-desktop');
        const megaMenu = document.getElementById('mega-menu');

        // Mở/tắt mega menu khi bấm hamburger
        hamburger.addEventListener('click', (event) => {
            event.stopPropagation();
            megaMenu.classList.toggle('active');
        });

        // Đóng mega menu khi bấm ra ngoài khu vực menu
        document.addEventListener('click', (event) => {
            if (!megaMenu.contains(event.target) && !hamburger.contains(event.target)) {
                megaMenu.classList.remove('active');
            }
        });
    </script>
</body>
{{-- xử lý like --}}
<script>
    // SỬ LÝ LIKE
    $(document).ready(function() {
        $('#likeButton').on('click', function(event) {
            event.preventDefault();
            // Lấy URL và token từ form
            //var token = $('input[name="_token"]').val();

            var post_id = $(this).data('post-id');

            // Gửi yêu cầu AJAX
            $.ajax({
                url: '{{ route('posts.like') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    post_id: post_id
                },

                success: function(response) {

                    if (response.status === 'liked') {
                        $('#likeButton').removeClass('liked').text('Like');
                    } else if (response.status === 'unliked') {
                        $('#likeButton').addClass('liked').text('Unlike');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        alert("Bạn cần đăng nhập để thực hiện thao tác này.");
                    } else {
                        alert("Có lỗi xảy ra. Vui lòng thử lại!");

                    }
                }
            });
        });
    });
</script>
{{-- su ly luu bai viet  --}}
<script>
    // 
    $(document).ready(function() {

        $('.fa-save').click(function() {
            var postId = $(this).data('post-id');
            $('#post_id').val(postId);
            $('#saveModal').modal('show');
        });

        $('#savePostForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('post_id', $('#post_id').val());
            // Đảm bảo post_id được gửi đi
            $.ajax({
                url: '{{ route('create-folder') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('Danh mục đã được tạo và bài viết đã được lưu thành công!');
                        $('#saveModal').modal('hide');
                    } else {
                        alert('Có lỗi xảy ra: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                    alert(
                        'bạn chưa đăng nhập , vui lòng đăng nhập để thực hiện thao tác này'
                    );
                }
            });
        });
    });
</script>
{{-- xử lý lưu trong checkbox --}}
<script>
    //  
    $(document).ready(function() {

        $('.folder-checkbox').on('change', function() {
            const postId = $('#post_id').val();
            const saveFolderId = $(this).data('folder-id');

            console.log('postId:', postId);
            console.log('saveFolderId:', saveFolderId);

            $.ajax({
                url: '{{ route('posts.saveToFolder') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    post_id: postId,
                    save_folder_id: saveFolderId,

                },

                success: function(response) {
                    //console.log(response.message);

                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    alert('Đã xảy ra lỗi, vui lòng thử lại.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
{{-- xử lý nút micro cho việc tìm kiếm bằng giọng nói  --}}
<script>
    function startRecognition() {

        if (!('webkitSpeechRecognition' in window)) {
            alert('Trình duyệt không hỗ trợ nhận diện giọng nói.');
            return;
        }

        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'vi-VN';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        recognition.onresult = (event) => {

            const transcript = event.results[0][0].transcript;
            document.getElementById('searchInput').value = transcript;

            performSearch(transcript);
        };

        recognition.onerror = (event) => {
            alert('Có lỗi xảy ra: ' + event.error);
        };

        recognition.start();
    }

    function performSearch(query) {
        console.log("Tìm kiếm: " + query);

    }
</script>
<script>
    document.getElementById('readButton').addEventListener('click', function() {
        // Lấy nội dung bài viết
        const postContent = document.getElementById('postContent').innerText; // Giả sử bài viết có ID 'postContent'

        // Kiểm tra xem API SpeechSynthesis có sẵn không
        if ('speechSynthesis' in window) {
            const speech = new SpeechSynthesisUtterance(postContent);

            // Tuỳ chỉnh cài đặt giọng nói
            speech.lang = 'en-US'; // Thiết lập ngôn ngữ đọc là Tiếng Việt
            speech.volume = 1; // Mức âm lượng (0 - 1)
            speech.rate = 1; // Tốc độ đọc (0.1 - 10)
            speech.pitch = 1; // Độ cao giọng nói (0 - 2)

            // Bắt đầu đọc
            window.speechSynthesis.speak(speech);
        } else {
            alert("Trình duyệt của bạn không hỗ trợ tính năng đọc giọng nói.");
        }
    });
</script>

</html>
