Date.prototype.Format = function(fmt)
{
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
}

var uploadFile = function (callBack,imgType) {
    var formData = new FormData($("#uploadForm")[0]);
    $.ajax({
        url: '../../admin/registration/upload',  //server script to process data
        type: 'POST',
        //Ajax事件
        success: function (data) {
            if (data.code == 0) {
                var type = imgType;
                addImg(data.data.imgs, type);
            }
        },
        error: function () {
            console.log('error');
        },
        // Form数据
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};

var obj = ['压缩天然气', '液化天然气', '液化石油气'];

var getSelect = function(key){
    return obj[key - 1];
}

