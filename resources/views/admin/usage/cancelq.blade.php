@extends('admin.layout')
@section('content')
    <div class="vertical-box">
        <div class="vertical-box-column width-200">
            <div class="vertical-box">
                <div class="wrapper" style="background:#D9DEE4;color:#000;font-size: 14px;">
                    @foreach ($menu as $value)
                        @if(!isset($value->menu))
                            @if(ucwords($value->controller_name).'Controller' == $controller_name) {{$value->mod_name}} @endif
                        @else
                            @if(ucwords($value->controller_name).'Controller' == $controller_name) {{$value->mod_name}} @endif
                        @endif
                    @endforeach
                </div>
                <div class="vertical-box-row" style="background:#eaedf1">
                    <div class="vertical-box-cell">
                        <div class="vertical-box-inner-cell">
                            <div class="centent_list" data-scrollbar="true" data-height="100%" class="">
                                @foreach ($menu as $value)
                                    @if(isset($value->menu))
                                        @foreach ($value->menu as $menu_value)
                                            <div class=" @if(strtolower($menu_value->url) == strtolower($ca_name) || strtolower($menu_value->url).'/index' == strtolower($ca_name)|| strtolower($menu_value->url).'index' == strtolower($ca_name)) click @else on_click @endif">
                                                <a href="{{url($menu_value->url)}}">{{$menu_value->mod_name}}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="vertical-box-column" >
            <div class="vertical-box">
                <div class="vertical-box-row">
                    <div class="vertical-box-cell">
                        <div class="vertical-box-inner-cell">
                            <div data-scrollbar="true" data-height="100%" class="wrapper" style="background:#FFF;">
                                <div class="panel panel-default" data-sortable-id="ui-widget-1">


                                    <div class="panel-body">
                                        <div class="panel-toolbar"
                                             style="border-bottom:1px solid #fff;padding: 10px 0px;">

                                            <div class="btn-group  col-md-2" style="padding-left: 0px;">
                                                <label class="control-label m-r-10  m-t-10"> 车牌号码</label>
                                                <select type="text" class="form-control" id="license_plate"></select>
                                            </div>

                                            <div class="btn-group  col-md-2  m-t-10" style="padding-left: 0px;">
                                                <div class="checkbox m-r-10 ">
                                                    <button class="btn btn-default m-r-5 m-b-5 m-t-10 btn-group"
                                                            ng-click="search()" id="search_submit">搜索
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div style="bottom: 0px;">

                                        <div id="validate" role="form" name="create_form" style="display: none;"
                                             class="form-horizontal form-bordered">
                                            <div class="form-body">

                                                <div class="form-group">
                                                    <label class='control-label col-md-2'>汽车行驶证</label>

                                                    <div class="col-md-6 col-xs-12 p_top2">

                                                        <button type="button" class='btn  btn-info'
                                                               id="upload5">上传
                                                        </button>
                                                        <div>
                                                            <a id="upload5-container"
                                                                    style="margin: 5px;float:left">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        驾驶证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">

                                                        <button type="button" id="upload7" class='btn btn-info'>
                                                            上传
                                                        </button>
                                                        <div>
                                                            <a id="upload7-container"
                                                                    style="margin: 5px;float:left">
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        (旧)气瓶登记使用证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">

                                                        <button type="button" id="upload9" class='btn btn-info'>
                                                            上传
                                                        </button>
                                                        <div>
                                                            <a id="upload9-container"
                                                                    style="margin: 5px;float:left">

                                                            </a>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        运营证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <label for="isPerson" style='float:left'>是否为个人名字</label>

                                                        <input type='checkbox' id="isPerson"/>


                                                        <button type="button" id="upload6"
                                                                class='btn btn-info'>上传
                                                        </button>
                                                        <div >
                                                            <a id="upload6-container" style="margin: 5px;float:left">
                                                            </a>
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="panel-footer text-right">


                                                <button class="btn btn-primary pull-right" type="submit"
                                                       id="save">注销
                                                </button>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript" src="/assets/plugins/printArea/jquery.PrintArea.js"></script>
    <link href="/assets/plugins/printArea/printArea.css" rel="stylesheet"/>


    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>


    <script type="text/javascript">
        var saveData =[];
        var number;
        var license_plate;

        var token =  "{{csrf_token()}}";

        var init = function(){
            uploadImg('upload5',$("#upload5-container"),5,token,saveData,function(data){
                $("#upload5-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
            });
            uploadImg('upload7',$("#upload7-container"),7,token,saveData,function(data){
                $("#upload7-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
            });
            uploadImg('upload9',$("#upload9-container"),9,token,saveData,function(data){
                $("#upload9-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
            });



        };

        var clearImgContianer = function(){
            $(".form-group a").html('');
        }

        var flag = true;
        $("#search_submit").on("click",function(){
            saveData = [];
            clearImgContianer();
            getSearchData(function(data){
                if(data.code == 0){
                    number = data.data.registration.number;
                    license_plate = data.data.registration.license_plate;
                    $("#validate").show();
                    if(flag){
                        init();
                        flag = false;
                    }

                    var imgs = data.data.imgs;
                    for(var i = 0;i < imgs.length;i++){
                        if(imgs[i].pic_url){
                            var picUrlArray = imgs[i].pic_url.split(",");
                            saveData[imgs[i].type] = [];
                            for(var j = 0 ;j < picUrlArray.length; j++){
                                saveData[imgs[i].type].push(picUrlArray[i]);
                                $("#upload"+ imgs[i].type +"-container").append('<img width="50px" height="50px" src="/'+picUrlArray[j] +'">');
                            }
                        }

                    }
                }
            })
        });


        $("#upload6").hide();
        $("#isPerson").on("change", function () {
            if (this.checked) {
                $("#upload6").show();
                uploadImg('upload6',$("#upload6-container"),1,token,saveData,function(data){
                    $("#upload6-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
                });
            } else {
                $("#upload6").hide();
            }
        });

        searchSelect2();


        $("#save").on("click",function(){
            var data = {
                number:number,
                _token:token,
                images:saveData
            }
            saveImageUrl(data);
        })

        $("#hrefClick").on('click',function(){
            window.location.href =encodeURI( './editusage?license_plate='+license_plate);
        })


    </script>

@endsection
