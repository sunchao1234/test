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
        <div class="vertical-box-column">
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


                                    <div id="validate" role="form" name="create_form" style="display: none"
                                         class="form-horizontal form-bordered">
                                        <div class="form-body">
                                            <!-- 默认开启了 csrf验证 非POST请求token必须加  -->
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    合格证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">

                                                    <button type="button" class='btn  btn-info' id="upload1">上传
                                                    </button>
                                                    <div>
                                                        <a style="margin: 5px;float:left" id="upload1-container">

                                                        </a>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    监督检验证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <button type="button" class='btn  btn-info' id="upload2">上传
                                                    </button>
                                                    <div>
                                                        <a id="upload2-container" style="margin: 5px;float:left">

                                                        </a>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    检验质量证明书证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">

                                                    <button type="button" id="upload3" class='btn btn-info'>上传
                                                    </button>

                                                    <div>
                                                        <a id='upload3-container' style="margin: 5px;float:left">

                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    特种设备监督检验证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <button type="button" id='upload4' class='btn btn-info'>上传
                                                    </button>
                                                    <div>
                                                        <a id='upload4-container' style="margin: 5px;float:left">
                                                        </a>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    汽车行驶证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">

                                                    <button type="button" id="upload5" class='btn btn-info'>上传
                                                    </button>
                                                    <div>
                                                        <a id='upload5-container' style="margin: 5px;float:left">

                                                        </a>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    驾驶证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">

                                                    <button type="button" id="upload7" class='btn btn-info'>上传
                                                    </button>
                                                    <div>
                                                        <a id='upload5-container7' style="margin: 5px;float:left">

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
                                                    <input type='checkbox' id="isPerson" name="isPerson"/>


                                                    <button type="button" id="upload6"
                                                            class='btn btn-info'>
                                                        上传
                                                    </button>

                                                    <div >
                                                        <a id='upload5-container7' style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel-footer text-right">
                                            <button class="btn btn-primary pull-right" type="submit" id="save">
                                                保存
                                            </button>

                                            <a class="btn btn-primary pull-right"  id="hrefClick">
                                                修改基础信息
                                            </a>
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



        window.onload = function(){



            var saveData =[];
            var number;
            var license_plate;

            var token =  "{{csrf_token()}}";

            var init = function(){
                uploadImg('upload1',$("#upload1-container"),1,token,saveData,function(data){
                    $("#upload1-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
                });
                uploadImg('upload2',$("#upload2-container"),2,token,saveData,function(data){
                    $("#upload2-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
                });
                uploadImg('upload3',$("#upload3-container"),3,token,saveData,function(data){
                    $("#upload3-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">');
                });
                uploadImg('upload4',$("#upload4-container"),4,token,saveData,function(data){
                    $("#upload4-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">')
                });
                uploadImg('upload5',$("#upload5-container"),5,token,saveData,function(data){
                    $("#upload5-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">')
                });

                uploadImg('upload6',$("#upload6-container"),6,token,saveData,function(data){
                    $("#upload6-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">')
                });


            };



            $("#upload6").hide();
            $("#isPerson").on("change",function(){
                if(this.checked){
                    $("#upload6").show();
                    uploadImg('upload7',$("#upload7-container"),7,token,saveData,function(data){
                        $("#upload7-container").append('<img width="50px" height="50px" src="/'+data.data.imgs[0] +'">')
                    });
                }else{
                    $("#upload6").hide();
                }
            });


            var clearImgContianer = function(){
                $(".form-group a").html('');
            }

            $("#search_submit").on("click",function(){
                saveData = [];
                clearImgContianer();
                getSearchData(function(data){
                   if(data.code == 0){
                       number = data.data.registration.number;
                       license_plate = data.data.registration.license_plate;
                       $("#validate").show();
                       init();
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

        }



    </script>

@endsection
