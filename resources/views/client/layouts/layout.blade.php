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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.search') }}" method="POST"
                class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                @csrf
                <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search"
                    value="">
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
                    <div class="col-lg-7 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <a href="{{ route('client.index') }}">
                                <img class="max-s-full" src="{{ asset('client/images/icons/logo-02.png') }}"
                                    alt="LOGO">
                            </a>
                        </div>

                        <div>
                            <p class="f1-s-1 cl11 p-b-16">
                                Chúng tôi cam kết mang đến cho bạn những tin tức mới nhất, chính xác và đa dạng từ mọi
                                lĩnh vực trong cuộc sống. Hãy đồng hành cùng chúng tôi để không bỏ lỡ bất kỳ thông tin
                                quan trọng nào, giúp bạn luôn cập nhật và hiểu biết hơn về thế giới xung quanh.
                            </p>

                            <p class="f1-s-1 cl11 p-b-5 footer-title">
                                Chịu trách nhiệm quản lý nội dung
                            </p>

                            <p class="f1-s-1 cl11 p-b-16">
                                Võ Tiến Chương <br>
                                Nguyễn Hiếu Nghĩa
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

                    <div class="col-sm-6 col-lg-5 p-b-20">
                        <div class="flex-s-c">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4749098516213!2d106.75548917451812!3d10.851437757806705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1732262007314!5m2!1svi!2s"
                                width="650" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
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
    $(document).ready(function() {
        $('#likeButton').on('click', function(event) {
            event.preventDefault();
            //var token = $('input[name="_token"]').val();
            var post_id = $(this).data('post-id');
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

        const postContent = document.getElementById('postContent').innerText;
        if ('speechSynthesis' in window) {
            const speech = new SpeechSynthesisUtterance(postContent);
            speech.lang = 'en-US';
            speech.volume = 1;
            speech.rate = 1;
            speech.pitch = 1;
            window.speechSynthesis.speak(speech);
        } else {
            alert("Trình duyệt của bạn không hỗ trợ tính năng đọc giọng nói.");
        }
    });
</script>

{{-- Xử lý hiện ẩn bài viế đã lưu vào thư mục  --}}

<script>
    document.querySelectorAll('.folder-name').forEach(function(folder) {
        folder.addEventListener('click', function(e) {
            e.preventDefault();

            // Lấy ID của thư mục được nhấn
            var folderId = this.getAttribute('data-folder-id');
            var savedPostsDiv = document.getElementById('folder-' + folderId);

            // Đóng tất cả các thư mục
            document.querySelectorAll('.saved-posts').forEach(function(div) {
                div.classList.remove('show'); // Dùng Bootstrap "collapse" class
            });

            // Mở thư mục được nhấn
            if (!savedPostsDiv.classList.contains('show')) {
                savedPostsDiv.classList.add('show');
            }
        });
    });
</script>

</html>
