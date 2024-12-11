$(document).ready(function () {
    // Hiển thị form đăng nhập
    function showLoginForm() {
        $('#create-form').show();
        $('#user-data').hide();
    }
    
    // Biến lưu trữ ID của setInterval
    // let intervalId;
    // Ẩn form đăng nhập
    function hideLoginForm() {
        $('#create-form').hide();
        $('#email').val('');
        $('#password').val('');
        $('#userIdToken').val('')
        $('#user-data').show();
    }
    showLoginForm()

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    let isUpdating = false; // Cờ để ngăn sự kiện lặp vô hạn

    $('#abilities').on('change', function () {
        if (isUpdating) return; // Nếu đang cập nhật, thoát sự kiện

        const selectedValues = $(this).val();

        if (selectedValues.includes('all')) {
            isUpdating = true; // Đặt cờ để ngăn lặp vô hạn
            $(this).val(['all']); // Chỉ giữ lại "all"
            isUpdating = false; // Tắt cờ sau khi cập nhật
        }
    });

    // Tạo API Token
    $('#create-button').on('click', function () {
        const email = $('#email').val();
        const password = $('#password').val();
        const modelToken = $('#modelToken').val();
        const userIdToken = $('#userIdToken').val();
        const expiresAt = $('#expires-at').val();
        const abilities = $('#abilities').val();
        // console.log(modelToken);

        // if (!email) {
        //     alert('Vui lòng nhập đầy đủ thông tin.');
        //     return;
        // }

        $.ajax({
            url: 'http://127.0.0.1:8000/api/create', // API create
            type: 'POST',
            data: { 
                email: email, 
                password: password, 
                expiresAt: expiresAt,
                modelToken: modelToken,  
                userIdToken: userIdToken, 
                abilities: abilities 
            },
            success: function (res) {
                // console.log(res)
                // localStorage.setItem('authToken', response.token);
                // alert('Tạo Token thành công!...');
                toastr.success('Tạo Token thành công!');
                toastr.success(res.success.token);
                $('#email').val('');
                $('#password').val('');
                $('#modelToken').val('0').trigger('change');;
                $('#userIdToken').val('');
                $('#expires-at').val('0').trigger('change');
                $('#abilities').val('0').trigger('change');
                // const expirationTime = Date.now() + 10000; // 10 giây
                // localStorage.setItem('authTokenExpiration', expirationTime);
                // hideLoginForm();
                // fetchUserData();
                // Đặt thời gian hết hạn (1 phút)
                // intervalId = setInterval(checkLoginStatus, 1000);

            },
            beforeSend: function(){
                $('.error-api').text('')
                $('#loading-spinner').show()
                $('body').css('pointer-events', 'none'); // Vô hiệu hóa tất cả thao tác trên trang
                $('body').addClass('dimmed'); // Làm tối nền trang
                $('#create-form').addClass('dimmed');
            },
            error: function(jqXHR, textStatus, errorThrown){
                // console.log(jqXHR)
                if(jqXHR.status === 422){
                    let errors = jqXHR.responseJSON.errors
                    console.log(errors)

                    for(let field in errors){
                        let errorMessage = errors[field]
                        console.log(errorMessage)
                        errorMessage.forEach(function(message){
                            $('#'+field+'-error').html(message)
                        })
                    }
                }else if(jqXHR.status === 403){
                    toastr.error(jqXHR.responseJSON.message); 
                }
                // else{
                //     // alert('Không thể lấy dữ liệu. Vui lòng đăng nhập lại.');
                //     localStorage.removeItem('authToken');
                //     showLoginForm(); // Hiển thị lại form đăng nhập
                // }
            },
            complete: function() {
                $('#loading-spinner').hide();
                $('body').css('pointer-events', 'auto'); // Kích hoạt lại thao tác trên trang
                $('body').removeClass('dimmed'); // Khôi phục nền trang
                $('#create-form').removeClass('dimmed');
            }
        });
    });

    // Biến cờ toàn cục để theo dõi trạng thái đã thông báo hay chưa
    // let isTokenInitialized = false;

    // Lấy dữ liệu user
    // function fetchUserData() {
    //     const token = getValidToken();
    //     if (!token) {
    //         showLoginForm(); // Nếu chưa có token, bắt người dùng đăng nhập
    //         return;
    //     }

    //     $.ajax({
    //         url: 'http://127.0.0.1:8000/api/user',
    //         type: 'GET',
    //         headers: {
    //             Authorization: `Bearer ${token}`,
    //         },
    //         success: function (response) {
    //             // const users = response.data;
    //             // let html = '<ul>';
    //             // users.forEach(user => {
    //             //     html += `<li>${user.name} - ${user.email}</li>`;
    //             // });
    //             // html += '</ul>';
    //             // $('#user-data').html(html).show();

    //             // Kiểm tra nếu thông báo chưa được hiển thị
    //             if (!isTokenInitialized) {
    //                 alert('Khởi tạo token thành công!');
    //                 isTokenInitialized = true; // Đánh dấu là đã thông báo
    //             }
    //         },
    //         error: function () {
    //             showLoginForm();
    //             alert('Khởi tạo token thất bại vui lòng thử lại sau!.');
    //             localStorage.removeItem('authToken');
    //             localStorage.removeItem('authTokenExpiration');
    //         }
    //     });
    // }

    // Kiểm tra token hợp lệ
    // function getValidToken() {
    //     const token = localStorage.getItem('authToken');
    //     const expiration = localStorage.getItem('authTokenExpiration');

    //     if (token && expiration && Date.now() < parseInt(expiration)) {
    //         return token;
    //     } else {
    //         localStorage.removeItem('authToken');
    //         localStorage.removeItem('authTokenExpiration');
    //         return null;
    //     }
    // }

    // Kiểm tra trạng thái đăng nhập
    // function checkLoginStatus() {
    //     const token = getValidToken();
    //     // console.log(token);
    //     if (token) {
    //         console.log('Token hợp lệ. Đang lấy dữ liệu người dùng...');
    //         fetchUserData();
    //     } else {
    //         // Ngừng kiểm tra khi token hết hạn
    //         clearInterval(intervalId);
    //         console.log('Phiên đăng nhập đã hết hạn. Hiển thị form đăng nhập.');
    //         // alert('Không thể lấy dữ liệu. Vui lòng đăng nhập lại checklogin.');
    //         showLoginForm();
    //     }
    // }

    // Gọi kiểm tra trạng thái ban đầu
    // checkLoginStatus();

    // Thiết lập kiểm tra lặp lại sau mỗi 1 giây (1000ms) và lưu lại ID của setInterval
    // intervalId = setInterval(checkLoginStatus, 1000);
});