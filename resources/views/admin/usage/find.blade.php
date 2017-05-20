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
        <div class="vertical-box-column" ng-app="app">
            <div class="vertical-box" ng-controller="findController">
                <div class="vertical-box-row">
                    <div class="vertical-box-cell">
                        <div class="vertical-box-inner-cell">
                            <div data-scrollbar="true" data-height="100%" class="wrapper" style="background:#FFF;">
                                <div class="panel panel-default" data-sortable-id="ui-widget-1">

                                    <form id="uploadForm" style="display: none">
                                        <input name='_token' class='hide' id='token'
                                               value='<?php echo e(csrf_token()); ?>'>
                                        <input type="hidden" name="type" value='1'/>
                                        <input type="file" multiple="multiple" id='uploadFile' name='img[]'>
                                    </form>

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

                                    <div ng-if="data && data.length == 0">
                                        不存在
                                    </div>

                                    <div ng-if="data.registration.number" style="bottom: 0px;">
                                        <div style="margin: 10px 5px">
                                            <span class="label_font">登记证编号:</span><span
                                                    class="write_font">@{{ data.registration.number }}</span>
                                        </div>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="label_font">车牌号码</td>
                                                <td class="write_font">@{{ data.registration.license_plate }}</td>
                                                <td class="label_font">充装介质</td>
                                                <td class="write_font">@{{getSelect(data.registration.product) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">使用单位</td>
                                                <td colspan="3"
                                                    class="write_font">@{{ data.registration.use_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">车种</td>
                                                <td colspan="3"
                                                    class="write_font">@{{ data.registration.car_brand }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装单位</td>
                                                <td colspan="3"
                                                    class="write_font">@{{ data.registration.install_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装日期</td>
                                                <td colspan="3"
                                                    class="write_font">@{{ data.registration.install_date }}</td>
                                            </tr>
                                        </table>


                                        <table class="table table-bordered" style="background-color:#fff">
                                            <thead>
                                            <tr>
                                                <td>序号</td>
                                                <td>设备代码</td>
                                                <td>制造单位</td>
                                                <td>制造日期</td>
                                                <td>产品编号</td>
                                                <td>容积(L)</td>
                                                <td>下次检测日期</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in data.detail track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{ item.device_number }}</td>
                                                <td>@{{ item.made_unit}}</td>
                                                <td>@{{ item.made_date }}</td>
                                                <td>@{{ item.product_number }}</td>
                                                <td>@{{ item.volume }}</td>
                                                <td>@{{ item.next_time_check_date }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-bordered" style="background-color:#fff">
                                            <thead>
                                            <tr>
                                                <td>序号</td>
                                                <td>姓名</td>
                                                <td>身份证号</td>
                                                <td>备注</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in data.driver_info track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{item.name}}</td>
                                                <td>@{{ item.id_card }}</td>
                                                <td>@{{ item.remark }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                          <div id="validate" role="form" name="create_form"
                                                class="form-horizontal form-bordered">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class='control-label col-md-2'>新一期气瓶检测报告</label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <div>
                                                            <a ng-repeat="item in imgs[8]"
                                                               style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" class='btn  btn-info'
                                                                ng-click="upload(8)">上传
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class='control-label col-md-2'>汽车行驶证</label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <div>
                                                            <a ng-repeat="item in imgs[5]"
                                                               style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" class='btn  btn-info'
                                                                ng-click="upload(5)">上传
                                                        </button>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        驾驶证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <div>
                                                            <a ng-repeat="item in imgs[7]" style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" ng-click="upload(7)" class='btn btn-info'>上传
                                                        </button>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        (旧)气瓶登记使用证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <div>
                                                            <a ng-repeat="item in imgs[9]" style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" ng-click="upload(9)" class='btn btn-info'>上传
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        运营证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <label for="isPerson" style='float:left'>是否为个人名字</label>
                                                        <input type='checkbox' ng-model="data.is_personal"/>

                                                        <div ng-model="data.is_personal">
                                                            <a ng-repeat="item in imgs[6]" style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" ng-click="upload(6)" ng-if="data.is_personal"
                                                                class='btn btn-info'>上传
                                                        </button>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>


                                        <div class="panel-footer text-right">

                                            <button class="btn btn-success pull-right" id="print2">打印反面</button>
                                            <button class="btn pull-right btn-success" id="print1">打印正面</button>
                                            <button class="btn btn-primary pull-right" type="submit" ng-click="save()">保存</button>

                                        </div>


                                    </div>

                                </div>


                                <style>
                                    #printContent1, #printContent2 {
                                        display: none;
                                        margin-top: 10px;
                                    }
                                </style>

                                <div id="printContent1" style="border: 1px solid #000;">
                                    <h1 style="padding: 180px  0px;font-weight:bolder;text-align: center">
                                        车用气瓶使用登记证</h1>
                                    <style>
                                        .label_font {
                                            font-size: 15px;
                                            font-weight: bolder;
                                        }

                                        .write_font {
                                            font-size: 16px;
                                        }
                                    </style>
                                    <div style="bottom: 0px;">
                                        <div style="margin: 10px 5px">
                                            <span class="label_font">登记证编号:</span><span
                                                    class="write_font">@{{ data.registration.number }}</span>
                                        </div>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="label_font">车牌号码</td>
                                                <td class="write_font">@{{ data.registration.license_plate }}</td>
                                                <td class="label_font">充装介质</td>
                                                <td class="write_font">@{{getSelect(data.registration.product) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">使用单位</td>
                                                <td colspan="3" class="write_font">@{{ data.registration.use_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">车种</td>
                                                <td colspan="3" class="write_font">@{{ data.registration.car_brand }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装单位</td>
                                                <td colspan="3" class="write_font">@{{ data.registration.install_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装日期</td>
                                                <td colspan="3" class="write_font">@{{ DateShow(data.registration.install_date) }}</td>
                                            </tr>
                                        </table>

                                        <div class="write_font" style="text-align: right;margin-top: 70px">
                                            <p style="margin: 70px 10px">登记机关:(加盖公章):杭州市质量技术监督局</p>

                                            <p style="margin: 80px 10px">发证日期:@{{ getToday() }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="printContent2" style="">
                                    <style>
                                        #printContent2 table thead {
                                            font-size: 14px;
                                        }

                                        #printContent2 tbody {
                                            font-size: 13px;
                                        }

                                        .print_span {
                                            font-size: 14px;
                                        }

                                        .print_span span {
                                            display: inherit;
                                        }

                                        .header_p {
                                            font-weight: bolder;
                                            text-align: center;
                                            margin: 0px;
                                        }
                                    </style>
                                    <h2 style="margin: 20px  0px;font-weight:bolder;text-align: center">
                                        车用气瓶使用登记证</h2>
                                    <div style="border: 1px solid #000">

                                        <table class="table table-bordered" style="background-color:#fff">
                                            <thead>
                                            <tr>
                                                <td>序号</td>
                                                <td>设备代码</td>
                                                <td>制造单位</td>
                                                <td>制造日期</td>
                                                <td>产品编号</td>
                                                <td>容积(L)</td>
                                                <td>下次检测日期</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in data.detail track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{ item.device_number }}</td>
                                                <td>@{{ item.made_unit}}</td>
                                                <td>@{{ DateShow1(item.made_date) }}</td>
                                                <td>@{{ item.product_number }}</td>
                                                <td>@{{ item.volume }}</td>
                                                <td>@{{ DateShow1(item.next_time_check_date) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <h3 style="text-align: center">驾驶人员信息</h3>

                                        <table class="table table-bordered" style="background-color:#fff">
                                            <thead>
                                            <tr>
                                                <td>序号</td>
                                                <td>姓名</td>
                                                <td>身份证号</td>
                                                <td>备注</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in data.driver_info track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{item.name}}</td>
                                                <td>@{{ item.id_card }}</td>
                                                <td>@{{ item.remark }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="print_span">
                                            <p class="header_p">气瓶使用注意事项</p>

                                            <p class="header_p">气瓶应当按照安全技术规范的规定，在安全检验合格的有效期内使用</p>
                                            <span>1.严格按照使用说明书的要求使用气瓶</span>
                                            <span>2.充装前后应当对气瓶及附件进行安全状况检查</span>
                                            <span>3.禁止与油脂、化学品、硬件等物质接触，严禁划伤、磕碰、腐蚀和挤压</span>
                                            <span>4.严禁无资格单位对气瓶进行改装、维修、拆装检验等，不得对气瓶进行挖补、焊接修理</span>
                                            <span>5.严禁用热源对气瓶加热</span>
                                            <span>6.严禁超压充装，瓶内天然气不得用尽，需留0.1MPa以上余压</span>
                                            <span>7.不得擅自更改气瓶的钢印和颜色标记</span>
                                            <span>8.发生交通事故后，应对气瓶、瓶阀及其他附件进行检查或者检验，合格后方可重新使用</span>
                                            <span>9.应当经常对气瓶及安全附件进行检查和日常维护，做到清洁、紧固、无漏、正常工作</span>
                                            <span>10.不得充装不合格燃气</span>
                                            <span>11.气瓶应当按时送检，不得使用超期未检气瓶。</span>

                                            <p class="header_p" style="margin: 10px 0px">
                                                本证件不得转让、涂改，如有遗失、损坏，须向发证机关申请补发</p>
                                        </div>
                                    </div>

                                    <div>
                                        <p>《特种设备安全法》第三十三条规定：“特种设备使用单位应当在特种设
                                            备投入使用前或者投入使用后三十日内，向负责特种设备安全监督的部门办理使用
                                            登记，取得使用登记证书。登记标志应当置于该特种设备的显著位置。”
                                        </p>
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
        $('body').on("click",'#print1',function(){
            $("#printContent1").printArea();
        })
        $('body').on("click",'#print2',function(){
            $("#printContent2").printArea();
        })
        var imgType;
        var uploadFile = function () {
            var formData = new FormData($("#uploadForm")[0]);
            $.ajax({
                url: '../../admin/registration/upload',  //server script to process data
                type: 'POST',
                //Ajax事件
                success: function (data) {
                    if (data.code == 0) {
                        var type = imgType;
                        addImg(data.data.imgs, type);
                        console.log(imgType);
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


        var app = angular.module('app', []);
        app.controller('findController', function ($scope,$filter) {

            $scope.getToday =function(){
                return $filter("date")(new Date().getTime(), "yyyy年MM月dd日");
            }
            $scope.DateShow = function(str){
                if(!str) return
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月dd日");
            }


            $scope.DateShow1 = function(str){
                if(!str) return;
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月");
            }
            $("#license_plate").select2({
                placeholder: "请输入车牌号码",
                allowClear: true,
                ajax:{
                    url:function(params){
                        console.log(params);
                        return '../../admin/registration/name?license_plate='+params.term
                    },
                    processResults:function(data){
                        var dataArray=[];
                        if(data){
                            for(var i = 0 ;i < data.data.length;i++){
                                dataArray.push({id:data.data[i].license_plate,text:data.data[i].license_plate});
                            }
                        }
                        return {
                            results:dataArray
                        }

                    }
                }
            });

            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key - 1];
            };


            $scope.upload = function (action) {
                imgType = action;
                $("#uploadFile").click();
            };
            $("#uploadFile").on("change", function (e) {
                uploadFile();
            });
            $scope.imgs ={};
            addImg = function (data, type) {
                $scope.$apply(function () {
                    $scope.imgs[type] = data;
                })
            }



            $scope.save = function(){
                var data = {};
                data.number = $scope.data.registration.number;
                data.images = $scope.imgs;
                data._token = $("#token").val();
                $.ajax({
                    url:"../../admin/registration/replacement",
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
            }

            $scope.search = function () {
                var license_plate = $("#license_plate").val();
                if (!license_plate) return
                $.ajax({
                    url: "../../admin/registration/index",
                    type: 'get',
                    data: {license_plate: license_plate},
                    success: function (data) {
                        $scope.$apply(function () {
                            $scope.data = data.data;
                            console.log($scope.data);
                        })
                    }
                })
            }
        });

    </script>

@endsection
