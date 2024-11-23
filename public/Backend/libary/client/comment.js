(function($){

    var HT={};
    var _token = $('meta[name="csrf-token"]').attr('content')

    HT.checkLoggedComment = (check) => {
        $(document).on('click', '.'+check, function(e) {
            e.preventDefault();
            let _this = $(this);
            
            $.ajax({
                url: '/check-login',
                method: 'GET',
                success: function(response) {
                    if (response.loggedIn) {
                        //alert('Bạn có thể bình luận.');
                    } else {
                        alert('Vui lòng đăng nhập để bình luận.');
                        // window.location.href = '/login';
                        _this.parents('.comment-item-parent').find('.store-reply .comment-item-reply').remove()
                        _this.blur()
                        _this.siblings('.hov-btn1').remove()
                        _this.siblings('a').remove()
                        _this.after('<a href="/login">Ấn vào đây để đăng nhập</a')
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
    };

    HT.checkLoggedComment('comments');
    HT.checkLoggedComment('reply-comment');

    HT.storeReply = () => {
        $(document).on('click', '.reply-comment', function(e) {
            e.preventDefault();
            let _this = $(this)
            _this.parents('.comment-container').find('.comment-item-parent .reply-container .btn-hidden-reply').remove();
            _this.parents('.comment-container').find('.comment-item-parent .reply-container .comment-item-reply').remove();
            _this.parents('.comment-container').find('.comment-item-parent .reply-container .load-more-replies').remove();
            if (_this.parents('.comment-container').find('.store-reply .comment-item-reply').length > 0) {
                return;
            }
            let html = ''
            html += HT.renderCommentReplyHtml()
            _this.parents('.comment-item-parent').find('.store-reply .content-error').remove()
            _this.parents('.comment-item-parent').find('.store-reply').append(html)
        })
    }

    HT.closeReply = () => {
        $(document).on('click', '.btn-close-reply', function(e) {
            e.preventDefault();
            let _this = $(this)
            _this.parents('.comment-item-parent').find('.store-reply .content-error').remove()
            _this.parents('.comment-item-parent').find('.store-reply .comment-item-reply').remove() // n-u for ht.check
            _this.parents('.comment-item-parent').find('.reply-container .comment-item-reply').remove() // n-u for ht.show
        })
    }

    HT.renderCommentReplyHtml = () => {
        let html = '';
        html += '    <div class="error content-error"></div>';
        html += '<div class="comment-item-reply row align-items-start">';
        html += '    <div class="col">';
        html += '        <div class="comment-content">';
        html += '            <textarea name="reply-comment" class="comment-text-item"></textarea>';
        html += '        </div>';
        html += '    </div>';
        html += '    <div class="col-12 text-right">';
        html += '        <button class="btn-close-reply bg-danger borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 mr-2">Hủy</button>';
        html += '        <button class="btn-submit-reply size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">Post Comment</button>';
        html += '    </div>';
        html += '</div>';
        return html;
    }

    HT.createReply = () => {
        $(document).on('click', '.btn-submit-reply', function(e) {
            let _this = $(this)

            let commentId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-commentId')
            let postId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-postId')
            let customerId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-customerId')
            let content = _this.parents('.comment-item-reply').find('textarea.comment-text-item').val()

            let option = {
                commentId: commentId,
                postId: postId,
                customerId: customerId,
                content: content,
                _token: _token
            }
            // console.log(option)

            $.ajax({
                url: getReplyUrl,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    // console.log(res.html);

                    // Lấy phần tử reply container
                    let replyContainer = _this.parents('.comment-item-parent').find('.reply-container');

                    // Trigger để lấy ra các bình luận cũ
                    let commentTextReply = _this.parents('.comment-item-parent').find('.comment-text-reply');
                    commentTextReply.trigger('click');
                    // console.log(commentTextReply.attr('data-replyIds'))

                    // lấy phần gd thêm bình luận
                    let storeReply = _this.parents('.comment-item-parent').find('.store-reply .comment-item-reply');
                    
                    // Sử dụng setTimeout để trì hoãn việc append nội dung mới một chút
                    setTimeout(function() {
                        storeReply.remove();
                        // Thêm nội dung mới vào reply container
                        replyContainer.prepend(res.html);

                        if (replyContainer.find('.btn-hidden-reply').length === 0) {
                            replyContainer.append('<button class="btn-hidden-reply bg-danger borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 mr-2">ẩn</button>');
                        }                        
                                        
                        // Kiểm tra xem phần tử commentTextReply có tồn tại không
                        if (commentTextReply.length) {
                            // Lấy giá trị reply_count từ span
                            let replyCountElem = commentTextReply.find('span:first');
                            let replyCount = parseInt(replyCountElem.text().trim()) || 0;

                            // Tăng reply_count lên 1
                            replyCount += 1;

                            // Cập nhật lại giá trị reply_count trong HTML
                            replyCountElem.text(replyCount);

                            // Lấy giá trị data-replyIds
                            let replyIdsStr = commentTextReply.attr('data-replyIds');
                            // console.log(replyIdsStr); // Kiểm tra giá trị của data-replyIds
                    
                            // Kiểm tra nếu replyIdsStr không phải là chuỗi hợp lệ hoặc undefined
                            let replyIds = [];
                            if (replyIdsStr && replyIdsStr !== "undefined") {
                                try {
                                    replyIds = JSON.parse(replyIdsStr);
                                } catch (e) {
                                    console.error("JSON.parse error: ", e);
                                }
                            }
                    
                            // // Thêm comment_id mới vào mảng
                            // replyIds.push(res.comment_id);

                            // Thêm comment_id mới vào đầu mảng
                            replyIds.unshift(res.comment_id);
                    
                            // Cập nhật lại data-replyIds với mảng replyIds mới
                            commentTextReply.attr('data-replyIds', JSON.stringify(replyIds));
                        } else {
                            console.error("commentTextReply element not found!");
                        }
                    }, 500);
                    
                },
                beforeSend: function(){
                    _this.parents('.store-reply').find('.error').html('')
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status === 422){
                        let errors = jqXHR.responseJSON.errors
                        // console.log(errors)

                        for(let field in errors){
                            let errorMessage = errors[field]
                            // console.log(errorMessage)
                            errorMessage.forEach(function(message){
                                $('.'+field+'-error').html(message)
                            })
                        }
                    }else if(jqXHR.status === 404){
                        alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                        location.reload();
                    }
                }
            });
        })
    }

    HT.showReply = () => {
        $(document).on('click', '.comment-text-reply', function(e) {
            let _this = $(this)

            _this.parents('.comment-container').find('.comment-item-parent .store-reply .comment-item-reply').remove();

            let replyIds = _this.attr('data-replyIds')
            // console.log(replyIds)

            let option = {
                replyIds: replyIds,
                _token: _token
            }

            // console.log(option)

            let pageSize = 3; // Số lượng comment hiển thị mỗi lần
            let currentPage = 0
            // console.log(currentPage)
            

            $.ajax({
                url: getShowReplyUrl,
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function(res){
                    // console.log(res.html);

                    // Xóa nội dung cũ trong .reply-container
                    let replyContainer = _this.parents('.comment-item-parent').find('.reply-container');
                    replyContainer.empty();

                    let comments = $(res.html); // Tạo DOM từ response
                    let totalComments = comments.length; // Tổng số comment

                    // Hàm hiển thị comment
                    const renderComments = () => {
                        let startIndex = currentPage * pageSize;
                        let endIndex = startIndex + pageSize;

                        // Đảm bảo không lấy quá tổng số comment
                        if (endIndex > totalComments) {
                            endIndex = totalComments;
                        }

                        // Lấy danh sách comment để hiển thị
                        let visibleComments = comments.slice(startIndex, endIndex);
                        console.log(startIndex+' '+endIndex)
                        replyContainer.append(visibleComments); // Thêm comment vào container

                        // Xóa nút "Xem thêm" cũ (nếu có)
                        replyContainer.find('.load-more-replies').remove();
                        replyContainer.find('.btn-hidden-reply').remove();

                        currentPage++;
                        // console.log(endIndex+' '+totalComments)
                        // Nếu đã hiển thị tất cả comment, xóa nút "Xem thêm"
                        if (endIndex >= totalComments) {
                            replyContainer.find('.load-more-replies').remove();
                           
                        } else if (replyContainer.find('.load-more-replies').length == 0) {
                            // Nếu chưa có nút "Xem thêm", thêm vào
                            replyContainer.append(`
                                <button class="load-more-replies btn btn-primary mt-2">Xem thêm</button>
                            `);
                        }
                        replyContainer.append(`
                                <button class="btn-hidden-reply btn btn-danger mt-2">ẩn</button>
                            `);
                    };

                    renderComments(); // Hiển thị 3 comment đầu tiên

                    // Xử lý khi nhấn nút "Xem thêm"
                    replyContainer.off('click', '.load-more-replies').on('click', '.load-more-replies', function () {
                        renderComments(); // Hiển thị thêm comment
                    });

                    // Xử lý khi nhấn nút "Ẩn"
                    replyContainer.off('click', '.btn-hidden-reply').on('click', '.btn-hidden-reply', function () {
                        currentPage = 0; // Reset lại trang hiện tại
                        replyContainer.empty();
                    });
                    
                    // // Thêm nội dung mới
                    // replyContainer.append(res.html);
                },
                // error: function(jqXHR, textStatus, errorThrown){
                //     console.log('Lỗi: '+jqXHR);
                //     console.log('Lỗi request: '+ textStatus);
                //     console.log('Lỗi nội dung: '+ errorThrown);
                // }
            });
        })
    }

    // n-u for ht.show
    HT.hiddenReply = () => {
        $(document).on('click', '.btn-hidden-reply', function(e) {
            e.preventDefault();
            let _this = $(this)
            _this.parents('.comment-item-parent').find('.reply-container .comment-item-reply').remove()
            _this.remove()
        })
    }

    HT.storeReplyN = () => {
        $(document).on('click', '.reply-comment-n', function(e) {
            e.preventDefault();
            let _this = $(this)
            _this.parents('.comment-container').find('.comment-item-parent .reply-container-n .btn-hidden-reply').remove();
            _this.parents('.comment-container').find('.comment-item-parent .reply-container-n .comment-item-reply-n').remove();
            if (_this.parents('.comment-container').find('.store-reply-n .comment-item-reply-n').length > 0) {
                return;
            }
            let html = ''
            html += HT.renderCommentReplyNHtml()
            let storeReply = _this.siblings('.store-reply-n')
            let classes = storeReply.attr('class');
            let classList = classes.split(/\s+/);
            console.log(classList[1])

            _this.parents('.comment-item-parent').find('.'+classList[1]).append(html)
        })
    }

    HT.renderCommentReplyNHtml = () => {
        let html = '';
        html += '    <div class="error content-error"></div>';
        html += '<div class="comment-item-reply-n row align-items-start">';
        html += '    <div class="col">';
        html += '        <div class="comment-content">';
        html += '            <textarea name="reply-comment" class="comment-text-item"></textarea>';
        html += '        </div>';
        html += '    </div>';
        html += '    <div class="col-12 text-right">';
        html += '        <button class="btn-close-reply-n bg-danger borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 mr-2">Hủy</button>';
        html += '        <button class="btn-submit-reply-n size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">Post Comment</button>';
        html += '    </div>';
        html += '</div>';
        return html;
    }

    HT.closeReplyN = () => {
        $(document).on('click', '.btn-close-reply-n', function(e) {
            e.preventDefault();
            let _this = $(this)
            _this.parents('.comment-item-parent').find('.store-reply-n .content-error').remove()
            _this.parents('.comment-item-parent').find('.store-reply-n .comment-item-reply-n').remove()
        })
    }

    HT.createReplyN = () => {
        $(document).on('click', '.btn-submit-reply-n', function(e) {
            let _this = $(this);

            let replyComment = _this.closest('.comment-item-reply').find('.reply-comment-n');

            let commentId = replyComment.data('commentid');
            let postId = replyComment.data('postid');
            let customerId = replyComment.data('customerid');
            let content = _this.closest('.comment-item-reply-n').find('textarea.comment-text-item').val();

            // Tạo object option
            let option = {
                commentId: commentId,
                postId: postId,
                customerId: customerId,
                content: content,
                _token: _token
            };

            // console.log(option);

            $.ajax({
                url: getReplyNUrl,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    // Lấy phần tử comment được trả lời dựa trên ID từ res.from_comment_id
                    let replyContainer = _this.parents('.comment-item-parent').find('.comment-item-reply-' + res.from_comment_id);

                    if (replyContainer.length) {
                        // Lấy phần tử store-reply-n
                        let storeReplyN = _this.parents('.comment-item-parent').find('.store-reply-n .comment-item-reply-n');
                        
                        // Trigger để lấy ra các bình luận cũ
                        let commentTextReply = _this.parents('.comment-item-parent').find('.comment-text-reply');
                        
                        // Sử dụng setTimeout để trì hoãn việc append nội dung mới một chút
                        setTimeout(function () {
                            storeReplyN.remove();

                            // Chèn comment mới ngay sau phần tử được trả lời
                            replyContainer.after(res.html);

                            // Kiểm tra nếu cần cập nhật reply_count và data-replyIds
                            if (commentTextReply.length) {
                                // Lấy số lượng reply hiện tại
                                let replyCountElem = commentTextReply.find('span:first');
                                let replyCount = parseInt(replyCountElem.text().trim()) || 0;

                                // Tăng reply_count lên 1
                                replyCount += 1;
                                replyCountElem.text(replyCount);

                                // Cập nhật data-replyIds
                                let replyIdsStr = commentTextReply.attr('data-replyIds');
                                let replyIds = [];
                                if (replyIdsStr && replyIdsStr !== "undefined") {
                                    try {
                                        replyIds = JSON.parse(replyIdsStr);
                                    } catch (e) {
                                        console.error("JSON.parse error: ", e);
                                    }
                                }

                                // Thêm ID mới vào mảng (sau ID hiện tại)
                                let index = replyIds.indexOf(parseInt(res.from_comment_id));
                                if (index !== -1) {
                                    replyIds.splice(index + 1, 0, res.comment_id); // Thêm ngay sau ID hiện tại
                                } else {
                                    replyIds.push(res.comment_id); // Nếu không tìm thấy, thêm vào cuối
                                }

                                // Cập nhật lại data-replyIds
                                commentTextReply.attr('data-replyIds', JSON.stringify(replyIds));
                            }
                        }, 1000); // Thời gian trì hoãn có thể điều chỉnh
                    } else {
                        console.error("Không tìm thấy comment-item-reply-" + res.from_comment_id);
                    }
                    
                },
                beforeSend: function(){
                    _this.parents('.store-reply-n').find('.error').html('')
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status === 422){
                        let errors = jqXHR.responseJSON.errors
                        // console.log(errors)

                        for(let field in errors){
                            let errorMessage = errors[field]
                            // console.log(errorMessage)
                            errorMessage.forEach(function(message){
                                $('.'+field+'-error').html(message)
                            })
                        }
                    }else if(jqXHR.status === 404){
                        alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                        location.reload();
                    }
                }
            });
        })
    }

    HT.initComments = () => {
        let currentPage = 0;
        const commentsPerPage = 3; // Số bình luận hiển thị mỗi lần
        let sortedComments = [...comments]; // Dữ liệu bình luận hiện tại (có thể đã được sắp xếp)
    
        const container = $('.comment-container');
        const loadMoreBtn = $('<button class="btn btn-primary mt-3">Xem thêm</button>');
        const hideAllBtn = $('<button class="btn btn-danger mt-3 d-none">Ẩn</button>');
    
        // Hàm render comments
        const renderComments = (startIndex, endIndex) => {
            for (let i = startIndex; i < endIndex; i++) {
                if (i >= sortedComments.length) break;
                let comment = sortedComments[i];
                if (comment.parent_id === 0) {
                    let commentHTML = `
                        <div class="comment-item-parent comment-item-parent-${comment.id} row align-items-start mt-3">
                            <div class="col-auto">
                                <img src="${comment.avatar}" alt="Avatar" class="comment-avatar">
                            </div>
                            <div class="col">
                                <div class="comment-content">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="comment-name">${comment.customers?.cus_user ?? 'Người dùng'}</div>
                                        ${
                                            comment.customer_id === client_logged
                                                ? `<div class="comment-options">
                                                       <i class="fas fa-ellipsis-v"></i>
                                                   </div>`
                                                : ''
                                        }
                                        <div class="comment-actions d-none">
                                            <div class="action-item action-edit">Sửa</div>
                                            <div class="action-item action-delete">Xóa</div>
                                        </div>
                                    </div>
                                    <div class="comment-time">${new Date(comment.created_at).toLocaleString('vi-VN', {
                                        timeZone: 'Asia/Ho_Chi_Minh'
                                    })}</div>
                                    <div class="comment-text">${comment.content}</div>
                                    <div class="reply-comment" 
                                        data-commentId="${comment.id}" 
                                        data-postId="${comment.post_id}" 
                                        data-customerId="${client_logged ?? ''}">
                                        Trả lời
                                    </div>
                                    <div class="comment-text-reply" 
                                        style="background: url('${comment.img_reply}') no-repeat left center;" 
                                        data-replyIds='${JSON.stringify(comment.reply_ids)}'>
                                        <span style="padding-left: 20px;">${comment.reply_count}</span> <span>trả lời</span>
                                    </div>
                                </div>
                                <div class="store-reply"></div>
                                <div class="reply-container"></div>
                            </div>
                        </div>`;
                    container.append(commentHTML);
                }
            }
        };
    
        // Hiển thị lần đầu
        container.empty();
        renderComments(0, commentsPerPage);
    
        // Thêm nút Xem thêm và Ẩn tất cả
        if(sortedComments.length > 3){
            container.after(loadMoreBtn);
            container.after(hideAllBtn);
        }
    
        // Xử lý sự kiện nút Xem thêm
        loadMoreBtn.on('click', function () {
            currentPage++;
            let startIndex = currentPage * commentsPerPage;
            let endIndex = startIndex + commentsPerPage;
    
            renderComments(startIndex, endIndex);
    
            // Kiểm tra nếu đã hiển thị hết bình luận
            if (endIndex >= sortedComments.length) {
                $(this).addClass('d-none'); // Ẩn nút Xem thêm
                hideAllBtn.removeClass('d-none'); // Hiển thị nút Ẩn tất cả
            }
        });
    
        // Xử lý sự kiện nút Ẩn tất cả
        hideAllBtn.on('click', function () {
            currentPage = 0;
            container.empty();
            renderComments(0, commentsPerPage);
    
            $(this).addClass('d-none'); // Ẩn nút Ẩn tất cả
            loadMoreBtn.removeClass('d-none'); // Hiển thị nút Xem thêm
        });
    
        // Xử lý sự kiện sắp xếp
        $(document).on('change', '#arrange-comments', function () {
            const arrangeBy = $(this).val(); // Lấy giá trị của option được chọn (date hoặc popular)
    
            // Sắp xếp comments
            if (arrangeBy === 'date') {
                sortedComments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (arrangeBy === 'popular') {
                sortedComments.sort((a, b) => b.reply_count - a.reply_count);
            }
    
            // Reset giao diện sau khi sắp xếp
            currentPage = 0;
            container.empty();
            renderComments(0, commentsPerPage);
    
            // Reset trạng thái nút
            loadMoreBtn.removeClass('d-none');
            hideAllBtn.addClass('d-none');
        });
    };

    HT.showCommentOptions = () => {
        $(document).on('click', '.comment-options', function (e) {
            e.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài
            let parent = $(this).closest('.comment-item-parent'); // Lấy phần tử cha
            let actionsBox = parent.find('.comment-actions');
    
            // Ẩn tất cả các khung action khác
            $('.comment-actions').not(actionsBox).addClass('d-none');
    
            // Hiển thị hoặc ẩn khung action hiện tại
            actionsBox.toggleClass('d-none');
        });
    
        // Đóng khung action khi click ra ngoài
        $(document).on('click', function () {
            $('.comment-actions').addClass('d-none');
        });
    }

    HT.renderCommentEditHtml = (val) => {
        let html = '';
        html += '    <div class="error content-error"></div>';
        html += '<div class="comment-item-edit row align-items-start">';
        html += '    <div class="col">';
        html += '        <div class="comment-content">';
        html += '            <textarea name="reply-comment" class="comment-text-item">'+val+'</textarea>';
        html += '        </div>';
        html += '    </div>';
        html += '    <div class="col-12 text-right">';
        html += '        <button class="btn-close-edit-comment bg-danger borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 mr-2">Hủy</button>';
        html += '        <button class="btn-submit-edit-comment size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">Cập nhật</button>';
        html += '    </div>';
        html += '</div>';
        return html;
    }

    
    HT.actionEdit = () => {
        $(document).on('click', '.action-edit', function () {
            // alert('Sửa bình luận');
            // Thực hiện logic sửa tại đây
            let _this = $(this)
            let parent = _this.parents('.comment-item-parent')
            let commentText = parent.find('.comment-text')
            let val = commentText.text()
            commentText.hide()
            // console.log(val)
            
            let html = ''
            html += HT.renderCommentEditHtml(val)
            parent.find('.comment-text').after(html)
            parent.find('.reply-comment').hide()
            parent.find('.comment-text-reply').hide()
            parent.find('.store-reply').empty()
        });
        
    }
    
    HT.closeEditComment = () =>{
        $(document).on('click', '.btn-close-edit-comment', function (e) {
            let _this = $(this)
            
            let parent = _this.parents('.comment-content')
            let commentText = parent.find('.comment-text')
            commentText.show()
            parent.find('.reply-comment').show()
            parent.find('.comment-text-reply').show()
            
            _this.parents('.comment-content').find('.error').remove()
            _this.parents('.comment-content').find('.comment-item-edit').remove()
        })
    }

    HT.submitEdit = () => {
        $(document).on('click', '.btn-submit-edit-comment', function (e) {
            let _this = $(this)
            let parent = _this.parents('.comment-item-edit')
            let content = parent.find('.comment-text-item').val()
            // console.log(content)

            let commentId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-commentId')
            let postId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-postId')
            let customerId = _this.parents('.comment-item-parent').find('.reply-comment').attr('data-customerId')

            let option = {
                commentId: commentId,
                postId: postId,
                customerId: customerId,
                content: content,
                _token: _token
            }
            // console.log(option)

            $.ajax({
                url: getCommentUpdate,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    // Lấy phần tử comment được trả lời dựa trên ID từ res.from_comment_id
                    let parent = _this.parents('.comment-item-parent');

                    // setTimeout(() => {
                    // }, 1000); 
                    
                    parent.find('.comment-item-edit').remove();

                    parent.find('.comment-text').html(res.content)
                    parent.find('.comment-text').show()
                    parent.find('.reply-comment').show()
                    parent.find('.comment-text-reply').show()

                },
                beforeSend: function(){
                    _this.parents('.comment-item-parent ').find('.error').html('')
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status === 422){
                        let errors = jqXHR.responseJSON.errors
                        console.log(errors)

                        for(let field in errors){
                            let errorMessage = errors[field]
                            // console.log(errorMessage)
                            errorMessage.forEach(function(message){
                                $('.'+field+'-error').html(message)
                            })
                        }
                    }else if(jqXHR.status === 404){
                        alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                        location.reload();
                    }
                }
            });
        })
    }


    HT.showCommentOptionsN = () => {
        $(document).on('click', '.comment-options-n', function (e) {
            e.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài
            let parent = $(this).closest('.comment-item-reply'); // Lấy phần tử cha
            let actionsBox = parent.find('.comment-actions-n');
    
            // Ẩn tất cả các khung action khác
            $('.comment-actions-n').not(actionsBox).addClass('d-none');
    
            // Hiển thị hoặc ẩn khung action hiện tại
            actionsBox.toggleClass('d-none');
        });
    
        // Đóng khung action khi click ra ngoài
        $(document).on('click', function () {
            $('.comment-actions-n').addClass('d-none');
        });
    }

    HT.renderCommentNEditHtml = (val) => {
        let html = '';
        html += '    <div class="error content-error"></div>';
        html += '<div class="comment-item-edit-n row align-items-start">';
        html += '    <div class="col">';
        html += '        <div class="comment-content">';
        html += '            <textarea name="reply-comment" class="comment-text-item">'+val+'</textarea>';
        html += '        </div>';
        html += '    </div>';
        html += '    <div class="col-12 text-right">';
        html += '        <button class="btn-close-edit-comment-n bg-danger borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10 mr-2">Hủy</button>';
        html += '        <button class="btn-submit-edit-comment-n size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">Cập nhật</button>';
        html += '    </div>';
        html += '</div>';
        return html;
    }

    HT.actionEditN = () => {
        $(document).on('click', '.action-edit-n', function () {
            // alert('Sửa bình luận');
            // Thực hiện logic sửa tại đây
            let _this = $(this)
            let parent = _this.parents('.comment-item-reply')
            let commentText = parent.find('.comment-text')
            let val = commentText.text()
            commentText.hide()
            // console.log(val)
            
            let html = ''
            html += HT.renderCommentNEditHtml(val)
            parent.find('.comment-text').after(html)

            parent.find('.reply-comment-n').hide()
            parent.find('.comment-text-reply').hide()
            parent.find('.store-reply-n').empty()
        });
        
    }

    HT.closeEditCommentN = () =>{
        $(document).on('click', '.btn-close-edit-comment-n', function (e) {
            let _this = $(this)
            
            let parent = _this.parents('.comment-content')
            let commentText = parent.find('.comment-text')
            commentText.show()
            parent.find('.reply-comment-n').show()

            let reply = _this.parents('.comment-item-reply')
            reply.find('.reply-comment-n').show()
            
            _this.parents('.comment-content').find('.error').remove()
            _this.parents('.comment-content').find('.comment-item-edit-n').remove()
        })
    }

    HT.submitEditN = () => {
        $(document).on('click', '.btn-submit-edit-comment-n', function (e) {
            let _this = $(this)
            let parent = _this.parents('.comment-item-reply')
            let content = parent.find('.comment-text-item').val()
            console.log(content)

            let commentId = parent.find('.reply-comment-n').attr('data-commentId')
            let postId = parent.find('.reply-comment-n').attr('data-postId')
            let customerId = parent.find('.reply-comment-n').attr('data-customerId')

            let option = {
                commentId: commentId,
                postId: postId,
                customerId: customerId,
                content: content,
                _token: _token
            }
            console.log(option)

            $.ajax({
                url: getCommentNUpdate,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    // Lấy phần tử comment được trả lời dựa trên ID từ res.from_comment_id
                    let parent = _this.parents('.comment-item-reply');

                    // setTimeout(() => {
                    // }, 1000); 
                    
                    parent.find('.comment-item-edit-n').remove();

                    parent.find('.comment-text').html(res.content)
                    parent.find('.comment-text').show()
                    parent.find('.reply-comment-n').show()
                },
                beforeSend: function(){
                    _this.parents('.comment-item-reply').find('.error').html('')
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status === 422){
                        let errors = jqXHR.responseJSON.errors
                        // console.log(errors)

                        for(let field in errors){
                            let errorMessage = errors[field]
                            // console.log(errorMessage)
                            errorMessage.forEach(function(message){
                                $('.'+field+'-error').html(message)
                            })
                        }
                    }
                    else if(jqXHR.status === 404){
                        alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                        location.reload();
                    }
                }
            });
        })
    }

    HT.actionDelete = () => {
        $(document).on('click', '.action-delete', function (e) {
            if (confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
                
                // Thực hiện logic xóa tại đây
                let _this = $(this)
                let parent = _this.parents('.comment-item-parent')
                let commentId = parent.find('.reply-comment').attr('data-commentId')
                // console.log(commentId)
    
                let option = {
                    commentId: commentId,
                }
    
                $.ajax({
                    url: getCommentDelete,
                    type: 'GET',
                    data: option,
                    dataType: 'json',
                    success: function(res){
                        _this.parents('.comment-container').find('.comment-item-parent-'+commentId).remove();
                        alert(res.message);

                        // // Cập nhật biến comments
                        // comments = comments.filter(comment => comment.id !== commentId);
                    },
                    // beforeSend: function(){
                    //     _this.parents('.comment-item-reply').find('.error').html('')
                    // },
                    error: function(jqXHR, textStatus, errorThrown){
                        if(jqXHR.status === 422){
                            let errors = jqXHR.responseJSON.errors
                            // console.log(errors)
    
                            for(let field in errors){
                                let errorMessage = errors[field]
                                // console.log(errorMessage)
                                errorMessage.forEach(function(message){
                                    $('.'+field+'-error').html(message)
                                })
                            }
                        }
                        else if(jqXHR.status === 404){
                            alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                            location.reload();
                        }
                    }
                });
                // if (confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
                //     alert('Bình luận đã được xóa');
                // }
            }
        })
    }

    HT.actionDeleteN = () => {
        $(document).on('click', '.action-delete-n', function (e) {
            if (confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
                let _this = $(this);
                let parent = _this.parents('.comment-item-reply');
                let commentId = parent.find('.reply-comment-n').attr('data-commentId');
                
                let option = { commentId: commentId };
    
                $.ajax({
                    url: getCommentNDelete,
                    type: 'GET',
                    data: option,
                    dataType: 'json',
                    success: function(res) {
                        let deletedComments = res.deleted_comments; // Mảng ID cần xóa
                        let commentTextReply = _this.parents('.comment-item-parent').find('.comment-text-reply');
                        let replyCountElem = commentTextReply.find('span:first');
    
                        if (Array.isArray(deletedComments)) {
                            deletedComments.forEach(function(commentId) {
                                _this.parents('.comment-container').find('.comment-item-reply-' + commentId).remove();
                            });
                        } else {
                            _this.parents('.comment-container').find('.comment-item-reply-' + deletedComments).remove();
                        }
    
                        // Kiểm tra lại số lượng reply
                        setTimeout(() => {
                            if (replyCountElem.length > 0) {
                                let replyCount = parseInt(replyCountElem.text().trim()) || 0;
                                replyCount -= Array.isArray(deletedComments) ? deletedComments.length : 1; // Trừ số lượng ID đã xóa
                                replyCount = Math.max(replyCount, 0); // Không để âm
                                replyCountElem.text(replyCount);
    
                                // Cập nhật data-replyIds
                                let replyIdsStr = commentTextReply.attr('data-replyIds');
                                let replyIds = [];
                                if (replyIdsStr && replyIdsStr !== "undefined") {
                                    try {
                                        replyIds = JSON.parse(replyIdsStr);
                                    } catch (e) {
                                        console.error("JSON.parse error: ", e);
                                    }
                                }
    
                                // console.log(deletedComments)
                                // Loại bỏ ID đã xóa khỏi replyIds
                                if (Array.isArray(deletedComments)) {
                                    // Chuyển toàn bộ deletedComments sang dạng số
                                    let normalizedDeletedComments = deletedComments.map(item => parseInt(item));
                                
                                    // Lọc replyIds bằng cách kiểm tra tồn tại trong normalizedDeletedComments
                                    replyIds = replyIds.filter(id => !normalizedDeletedComments.includes(parseInt(id)));
                                } else {
                                    replyIds = replyIds.filter(id => id !== parseInt(deletedComments));
                                }
                                
                                // Cập nhật lại data-replyIds
                                commentTextReply.attr('data-replyIds', JSON.stringify(replyIds));

                               
                                // Xóa nội dung bên trong reply-container
                                let item = _this.parents('.reply-container').find('.comment-item-reply')
                                if(item.length === 0){
                                    // console.log(123)
                                    $('.reply-container').empty()
                                }
                            }
                        }, 500);
    
                        alert(res.message);
                    },
                    // beforeSend: function(){
                    //     _this.parents('.comment-item-reply').find('.error').html('')
                    // },
                    error: function(jqXHR, textStatus, errorThrown){
                        if(jqXHR.status === 422){
                            let errors = jqXHR.responseJSON.errors
                            // console.log(errors)
    
                            for(let field in errors){
                                let errorMessage = errors[field]
                                // console.log(errorMessage)
                                errorMessage.forEach(function(message){
                                    $('.'+field+'-error').html(message)
                                })
                            }
                        }
                        else if(jqXHR.status === 404){
                            alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                            location.reload();
                        }
                    }
                });
                // if (confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
                //     alert('Bình luận đã được xóa');
                // }
            }
        })
    }

    // function renderCommentReplyHtml(avatarUrl, commenterName, timeAgo, replyText) {
    //     let html = '';
    //     html += '<div class="row align-items-start">';
    //     html += '    <div class="col-auto">';
    //     html += '        <img src="' + avatarUrl + '" alt="Avatar" class="comment-avatar">';
    //     html += '    </div>';
    //     html += '    <div class="col">';
    //     html += '        <div class="comment-content">';
    //     html += '            <div class="comment-name">' + commenterName + '</div>';
    //     html += '            <div class="comment-time">' + timeAgo + '</div>';
    //     html += '            <div class="comment-text">';
    //     html += '                ' + replyText;
    //     html += '            </div>';
    //     html += '        </div>';
    //     html += '    </div>';
    //     html += '</div>';
    //     return html;
    // }
    
    $(document).ready(function(){
        HT.checkLoggedComment()
        HT.storeReply()
        HT.closeReply()
        HT.createReply()
        HT.showReply()
        HT.hiddenReply()

        HT.storeReplyN()
        HT.closeReplyN()
        HT.createReplyN()

        HT.initComments();

        HT.showCommentOptions();
        HT.actionEdit();
        HT.closeEditComment();
        HT.submitEdit();

        HT.showCommentOptionsN();
        HT.actionEditN();
        HT.closeEditCommentN();
        HT.submitEditN();

        HT.actionDelete();
        HT.actionDeleteN();
    })

})(jQuery)