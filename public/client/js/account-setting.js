document.getElementById('image').addEventListener('change', function(event) {
    var files = event.target.files;
    var last = (files.length - 1) < 0 ? 0 : (files.length - 1);
    var file = files[last];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewImage = document.getElementById('previewImage');
            previewImage.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

function checkDate(e) {
    let value = e.value.replace(/[^0-9]/g, '');
    if (value.length > 2) {
        value = value.slice(0, 2) + '-' + value.slice(2);
    }
    if (value.length > 5) {
        value = value.slice(0, 5) + '-' + value.slice(5);
    }
    e.value = value;
}

function reformatPhone(e) {
    let value = e.value.replace(/[^0-9]/g, '');
    for (let i = 3; i <= value.length; i += 4) {
        if (value.length > i) {
            console.log(i);
            console.log(value);
            value = value.slice(0, i) + ' ' + value.slice(i);
        }
    }
    e.value = value;
}
document.getElementById('info-form').addEventListener('submit', function(e){
    let phone = document.getElementById('cus_phone');
    phone.value = phone.value.replace(/\D/g, '');
});