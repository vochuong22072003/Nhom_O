$(document).ready(function () {
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
            if (res.success) {
                toastr.success(res.success); // Hiển thị thông báo thành công
            }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 401) {
                // console.log(jqXHR.responseJSON.error)
                // toastr.error(jqXHR.responseJSON.error); // Hiển thị lỗi khi chưa đăng nhập
                // Chuyển hướng người dùng đến trang login
                // window.location.href = jqXHR.responseJSON.redirect_url;
            } else {
                toastr.error('Có lỗi xảy ra, vui lòng thử lại!');
            }
        }
    });
});
