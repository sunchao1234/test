var upload = function(url,form,callback){
    $.ajax({
        url: url,  //server script to process data
        type: 'POST',
        //Ajax事件
        success: function (data) {
            if (data.code == 0) {
               callback(data);
            }
        },
        error: function () {

        },
        // Form数据
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};