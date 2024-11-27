(function($){

    var $document = $(document)
    
    var HT={};
    var _token=$('meta[name="csrf-token"]').attr('content');

    HT.switchery=()=>{
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small' });
        })
    }
    
    HT.select2=()=>{
        if($('.setupSelect2').length){
            $('.setupSelect2').select2();
        }
    }

    HT.checkAll=()=>{
        if($('#checkAll').length){
            $(document).on('change', '#checkAll', function(){
                let isChecked=$(this).prop('checked')
                $('.checkBoxItem').prop('checked', isChecked);
                $('.checkBoxItem').each(function(){
                    let _this=$(this)
                    if(_this.prop('checked')){
                        _this.closest('tr').addClass('active-bg')
                    }else{
                        _this.closest('tr').removeClass('active-bg')
                    }
                })
            })
        }
    }

    HT.checkBoxItem=()=>{
        if($('.checkBoxItem').length){
            $(document).on('change','.checkBoxItem', function(){
                let _this=$(this)
                let isChecked=_this.prop('checked')
                if(isChecked){
                    _this.closest('tr').addClass('active-bg')
                }else{
                    _this.closest('tr').removeClass('active-bg')
                }
                HT.allChecked()
            })
        }
    }

    HT.allChecked=()=>{
        let allChecked=$('.checkBoxItem:checked').length===$('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }

    HT.changeStatus = () => {
        if ($('.status').length) {
            $(document).on('change', '.status', function(){
                let _this=$(this);
                let currentValue = _this.val(); 
                let option={
                    'value': currentValue,
                    'modelId': _this.attr('data-modelId'),
                    'model': _this.attr('data-model'),
                    'field': _this.attr('data-field'),
                    '_token': _token
                }
                // console.log(option)
                if(option.modelId == 1 && option.model == 'UserCatalogue' || option.modelId == 1 && option.model == 'User'){
                    alert('Đây là nhóm quản trị viên không thể thay đổi tình trạng!')
                    let cssActive1='background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                    let cssActive2='left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                    let cssUnActive1='background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;';
                    let cssUnActive2='left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                    if(option.value==2){
                        $('.js-switch-'+option.modelId).find('span.switchery').attr('style',cssActive1).find('small').attr('style', cssActive2)
                        
                    }else if(option.value==1){
                        $('.js-switch-'+option.modelId).find('span.switchery').attr('style',cssUnActive1).find('small').attr('style', cssUnActive2)
                    }   
                    
                    return
                }
                $.ajax({
                    url: getStatusUrl,
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        currentValue = currentValue == 1 ? 2 : 1;
                        _this.val(currentValue);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        if(jqXHR.status === 404){
                            alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                            location.reload();
                        }
                    }
                });
            })  
        }
    }

    HT.changeStatusAll=()=>{
        if($('.changeStatusAll').length){
            $(document).on('click', '.changeStatusAll', function(e){
                e.preventDefault();
                let _this=$(this);
                let id=[];
                $('.checkBoxItem').each(function(){
                    let checkBox=$(this)
                    if(checkBox.prop('checked')){
                        id.push(checkBox.val())
                    }
                })
                if (id.includes('1')) {
                    alert('Đây là nhóm quản trị viên không thể thay đổi tình trạng!');
                    return;
                }
                // console.log(id);
                // return false;
                let option={
                    'value': _this.attr('data-value'),
                    'model': _this.attr('data-model'),
                    'field': _this.attr('data-field'),
                    'id': id,
                    '_token': _token
                }
                //console.log(option)
                //return false;
                $.ajax({
                    url: getChangeStatusAll,
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        if(res.flag==true){
                            let cssActive1='background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                            let cssActive2='left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                            let cssUnActive1='background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;';
                            let cssUnActive2='left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                            for(let i =0;i<id.length;i++){
                                if(option.value==2){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style',cssActive1).find('small').attr('style', cssActive2)
                                    
                                }else if(option.value==1){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style',cssUnActive1).find('small').attr('style', cssUnActive2)
                                }   
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        if(jqXHR.status === 404){
                            alert('Dữ liệu này đã không còn tồn tại! Chúng tôi sẽ tải lại trang để cập nhật dữ liệu mới nhất.');
                            location.reload();
                        }
                    }
                });
            })
        }
    }

    HT.setupDatePicker = () => {
        $('.datepicker input').datetimepicker({
            timepicker: true,
            format: 'd/m/Y',
            // value: new Date(),
            maxDate: new Date(),
        });
    
        $('.span-icon-calendar').on('click', function() {
            $(this).closest('.datepicker').find('input').focus();
        });
    };
    

    $document.ready(function(){
        HT.select2();
        HT.checkAll();
        HT.checkBoxItem();
        HT.setupDatePicker();
        HT.switchery();
        HT.changeStatus();
        HT.changeStatusAll();
        console.log(123)
    })

})(jQuery)