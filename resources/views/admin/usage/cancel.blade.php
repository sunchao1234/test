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
                                            license_plate
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
                                                            <a ng-repeat="item in imgs[7]"
                                                               style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" ng-click="upload(7)" class='btn btn-info'>
                                                            上传
                                                        </button>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">
                                                        (旧)气瓶登记使用证
                                                    </label>

                                                    <div class="col-md-6 col-xs-12 p_top2">
                                                        <div>
                                                            <a ng-repeat="item in imgs[9]"
                                                               style="margin: 5px;float:left">
                                                                <img src="/@{{ item }}" width="100px" ;height="100px">
                                                            </a>
                                                        </div>
                                                        <button type="button" ng-click="upload(9)" class='btn btn-info'>
                                                            上传
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

                                            <div class="panel-footer text-right">


                                                <button class="btn btn-primary pull-right" type="submit"
                                                        ng-click="save()">注销
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
        app.controller('findController', function ($scope) {
            $("#license_plate").select2({
                placeholder: "请输入车牌号码",
                allowClear: true,
                ajax: {
                    url: function (params) {
                        console.log(params);
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


            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key -1 ];
            };


            $scope.upload = function (action) {
                imgType = action;
                $("#uploadFile").click();
            };
            $("#uploadFile").on("change", function (e) {
                uploadFile();
            });
            $scope.imgs = {};
            addImg = function (data, type) {
                $scope.$apply(function () {
                    $scope.imgs[type] = data;
                })
            }

            $scope.save = function () {
                var data = {};
                data.number = $scope.data.registration.number;
                data.images = $scope.imgs;
                data._token = $("#token").val();
                $.ajax({
                    url: "../../admin/registration/cancellation",
                    type: 'post',
                    data: data,
                    success: function (data) {
                        if(data.code == 0){
                            swal('','成功','success');
                        }else{
                            swal('',data.msg,'error');
                        }
                    },
                    error: function (data) {

                    }
                })
            }

            $scope.search = function () {
                var license_plate = $("#license_plate").val();
                if (!license_plate) return;
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
