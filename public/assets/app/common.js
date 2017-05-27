Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1,                 //月份
        "d+": this.getDate(),                    //日
        "h+": this.getHours(),                   //小时
        "m+": this.getMinutes(),                 //分
        "s+": this.getSeconds(),                 //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds()             //毫秒
    };
    if (/(y+)/.test(fmt))
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

var uploadFile = function (callBack, imgType) {
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
        },
        // Form数据
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};

var obj = ['压缩天然气', '液化天然气', '液化石油气'];

var getSelect = function (key) {
    return obj[key - 1];
}


var uploadImg = function (id, node, type, token,data, callBack) {
    var uploader = new plupload.Uploader({
        // General settings
        browse_button: id,
        url: "/admin/registration/singleupload",
        chunk_size: '1mb',
        flash_swf_url: '/assets/plugins/plupload/Moxie.swf',
        silverlight_xap_url: '/assets/plugins/plupload/Moxie.xap',
        // PreInit events, bound before the internal events
        multipart_params: {  //附加参数
            _token: token,
            type: type
        },
        init: {
            FilesAdded: function (up, files) {
                saveData[type] = [];
                node.html("");
                uploader.start();
            },
            FileUploaded: function (up, file, info) {
                var resdata = JSON.parse(info.response);
                saveData[type].push(resdata.data.imgs[0]);
                callBack(resdata);
            },

            Destroy: function (up) {
            },

            Error: function (up, args) {
                log('[Error] ', args);
            }
        }
    });
    uploader.init();
}

var saveImageUrl = function(data){
    $.ajax({
        url:"../../admin/registration/newfillpermit",
        type:'post',
        data:data,
        success:function(data){
            if(data.code == 0){
                swal('','成功','success');
            }else{
                swal('',data.msg,'error');
            }
        },
        error:function(data){

        }
    })
};

var searchSelect2 = function () {


    var license_plate = getQueryString("license_plate");
    if(license_plate){
        $("#license_plate").select2({
            placeholder: "请输入车牌号码",
            allowClear: true,
            initSelection:function(ele,callBack){
                var license_plate = getQueryString("license_plate");
                console.log(license_plate);
                if(license_plate){
                    callBack({label:license_plate,value:license_plate,id:license_plate,text:license_plate});
                }
            },
            ajax: {
                url: function (params) {
                    return '../../admin/registration/name?license_plate=' + params.term
                },
                processResults: function (data) {
                    var dataArray = [];
                    if (data) {
                        for (var i = 0; i < data.data.length; i++) {
                            dataArray.push({id: data.data[i].license_plate, text: data.data[i].license_plate});
                        }
                    }
                    return {
                        results: dataArray
                    }
                }
            }
        });
    }else{
        $("#license_plate").select2({
            placeholder: "请输入车牌号码",
            allowClear: true,
            ajax: {
                url: function (params) {
                    return '../../admin/registration/name?license_plate=' + params.term
                },
                processResults: function (data) {
                    var dataArray = [];
                    if (data) {
                        for (var i = 0; i < data.data.length; i++) {
                            dataArray.push({id: data.data[i].license_plate, text: data.data[i].license_plate});
                        }
                    }
                    return {
                        results: dataArray
                    }
                }
            }
        });
    }


};

var getSearchData = function (callBack) {
    var license_plate = $("#license_plate").val();
    if(!license_plate){
        license_plate =getQueryString("license_plate");
    }

    if (!license_plate) return;
    $.ajax({
        url: "../../admin/registration/index",
        type: 'get',
        data: {license_plate: license_plate},
        success: function (data) {
            if (data.code == 0){
                callBack(data);
            }
        }
    })
}

function getQueryString(key){
    var reg = new RegExp("(^|&)"+key+"=([^&]*)(&|$)");
    var result = window.location.search.substr(1).match(reg);
    return result?decodeURIComponent(result[2]):null;
}



