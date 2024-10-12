(function($){

    var HT={};

   
    HT.getLocation=()=>{
        $(document).on('change', '.location', function(){
            let _this = $(this);
            let option = {
                'data': {
                    'location_id': _this.val(),
                },
                'target': _this.data('target')
            };
            console.log(option);
            HT.sendDataTogetLocation(option);
        });
        
    }

    HT.sendDataTogetLocation=(option)=>{
        $.ajax({
            url: getLocationUrl,
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function(res){
                $('.'+option.target).html(res.html);
                if(district_id!=''&& option.target=='DTdistricts'){
                    $('.DTdistricts').val(district_id).trigger('change')
                }
                if(ward_id!=''&& option.target=='DTwards'){
                    $('.DTwards').val(ward_id).trigger('change')
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('Lỗi: '+jqXHR);
                console.log('Lỗi request: '+ textStatus);
                console.log('Lỗi nội dung: '+ errorThrown);
            }
        });
    }

    HT.loadCity=()=>{
        if(province_id!=''){
            $('.provinces').val(province_id).trigger('change');
        }
    }

    $(document).ready(function(){
       
        HT.getLocation();
        HT.loadCity(); 
    })

})(jQuery)