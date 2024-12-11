$(document).ready(function () {
    // Hiển thị form đăng nhập
    function showLoginForm() {
        $('#login-form').show();
        $('#user-data').hide();
    }
    
    // Biến lưu trữ ID của setInterval
    // let intervalId;
    // Ẩn form đăng nhập
    // function hideLoginForm() {
    //     $('#login-form').hide();
    //     $('#email').val('');
    //     $('#password').val('');
    //     $('#token').val('')
    //     $('#user-data').show();
    // }
    showLoginForm()
    // Đăng nhập
    $('#login-button').on('click', function () {
        const email = $('#email').val();
        const password = $('#password').val();
        const token = $('#token').val();
        const roleAccount = $('#roleAccount').val();

        // if (!email) {
        //     alert('Vui lòng nhập đầy đủ thông tin.');
        //     return;
        // }

        $.ajax({
            url: 'http://127.0.0.1:8000/api/user/auth', // API đăng nhập
            type: 'POST',
            data: { 
                email: email, 
                password: password, 
                token: token,
                roleAccount: roleAccount,
            },
            success: function (res) {
                // alert('Đăng nhập thành công!...');
                window.location.href = 'http://127.0.0.1:8000/api/user/profile/'+res.model;
                // $('#email').val('');
                // $('#password').val('');
                // $('#token').val('')
                // const expirationTime = Date.now() + 10000; // 10 giây
                // localStorage.setItem('authTokenExpiration', expirationTime);
                // hideLoginForm();
                // fetchUserData();
                // Đặt thời gian hết hạn (1 phút)
                // intervalId = setInterval(checkLoginStatus, 1000);

            },
            beforeSend: function(){
                $('.error-api').text('');
                $('body').css('pointer-events', 'none'); // Vô hiệu hóa tất cả thao tác trên trang
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
                    const errorMessage = jqXHR.responseJSON.message;
                    console.log(errorMessage)
                    $('#general-error').text(errorMessage);
                }
            },
            complete: function() {
                $('body').css('pointer-events', 'auto'); // Kích hoạt lại thao tác trên trang
            }
        });
    });

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
    
    // Gửi yêu cầu AJAX đến API
    $.ajax({
        url: 'http://127.0.0.1:8000/api/protected-route', // Thay bằng API của bạn
        type: 'GET',
        success: function (res) {
            // if (res.success) {
            //     toastr.success(res.success); // Hiển thị thông báo thành công
            // }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 401) {
                console.log(jqXHR.responseJSON.error)
                toastr.error(jqXHR.responseJSON.error); // Hiển thị lỗi khi chưa đăng nhập
                // // Chuyển hướng người dùng đến trang login
                // window.location.href = jqXHR.responseJSON.redirect_url;
            } else {
                toastr.error('Có lỗi xảy ra, vui lòng thử lại!');
            }
        }
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