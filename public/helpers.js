window.getFormData = function($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
};

window.resetForm = function($form) {
    $form[0].reset();
    $form.find('select').val(null).trigger('change');
    $form.find('img').attr('src', '');
    $form.find('input[type="file"]').val('');
};

window.NotifiError = function(res) {
    if(res.response.status == 425) {
        toastr.error(res.response.data.message);
    } else {
        if(res.response && res.response.data && res.response.data.errors) {
            $.each(res.response.data.errors, function(key, value) {
                toastr.error(value[0]);
            });
        } else {
            toastr.error('Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
};


window.NotifiSuccess = function(res, callback = null) {
    if(res.data.status == 1){
        toastr.success(res.data.messages);
    } else if(res.data.status == 0) {
        toastr.error(res.data.messages);
    } else {
        toastr.warning(res.data.messages);
    }
    if (typeof callback === 'function') {
        setTimeout(callback, 200); // Delay 1s trước khi thực hiện callback
    }
};
