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
        <div class="vertical-box-column" ng-app="add">
            <div class="vertical-box" ng-controller="addController">
                <div class="vertical-box-row">
                    <div class="vertical-box-cell">
                        <div class="vertical-box-inner-cell">
                            <div data-scrollbar="true" data-height="100%" class="wrapper" style="background:#FFF;">
                                <div class="panel panel-default" data-sortable-id="ui-widget-1">

                                    <form id="uploadForm" style="display: none">
                                        <input name='_token' class='hide' id='token'
                                               value='<?php echo e(csrf_token()); ?>'>
                                        <input type="hidden" name="type" id='img_type' value='1'/>
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

                                    <div id="validate" role="form" name="create_form"
                                         class="form-horizontal form-bordered">
                                        <div class="form-body">
                                            <!-- 默认开启了 csrf验证 非POST请求token必须加  -->
                                            <h1>设备基础情况</h1>

                                            <div class="form-group">
                                                <label class='control-label col-md-2'>登记类别</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备品种</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.device_varieties" type="text"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备类别</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.device_category" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备种类</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.device_type" type="text"/>
                                                </div>
                                            </div>


                                            {{--<div class="form-group">--}}
                                            {{--<label class="control-label col-md-2">设备代码</label>--}}
                                            {{--//缺--}}
                                            {{--<div class="col-md-6 col-xs-12 p_top2">--}}
                                            {{--<input id="" name="" class="form-control"--}}
                                            {{--ng-model="data." type="text"/>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="form-group">
                                                <label class="control-label col-md-2">产品名称</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.product_name" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">气瓶数量</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.qp_count" type="text"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">充装介质</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <select class="form-control" ng-model="data.product">
                                                        <option value="1">压缩天然气-CNG</option>
                                                        <option value="2">液化天然气-LNG</option>
                                                        <option value="3">液化石油气-LPG</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">气瓶公称工作压力</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.qp_pressure"
                                                           type="text"/>Mpa
                                                </div>
                                            </div>

                                            {{--<div class="form-group">--}}
                                            {{--<label class="control-label col-md-2">气瓶容积</label>--}}
                                            {{--//缺--}}
                                            {{--<div class="col-md-6 col-xs-12 p_top2">--}}
                                            {{--<input id="" name="" class="form-control" ng-model="data.car_brand"--}}
                                            {{--type="text"/>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="form-group">--}}
                                            {{--<label class="control-label col-md-2">施工单位名称</label>--}}
                                            {{--//缺--}}
                                            {{--<div class="col-md-6 col-xs-12 p_top2">--}}
                                            {{--<input id="" name="" class="form-control" ng-model="data.car_brand"--}}
                                            {{--type="text"/>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="form-group">
                                                <label class="control-label col-md-2">监督检验机构名称</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.inspection_unit"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">
                                                添加
                                            </button>

                                            <table style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <td>设备代码</td>
                                                    <td>施工单位名称</td>
                                                    <td>容积</td>
                                                    <td>制造单位名称</td>
                                                    <td>制造日期</td>
                                                    <td>产品编号</td>
                                                    <td>单位内编号</td>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr ng-repeat="item in data.reg_det_data track by $index">
                                                    <td>@{{ item.device_number }}</td>
                                                    <td>@{{ item.install_unit }}</td>
                                                    <td>@{{ item.volume }}</td>
                                                    <td>@{{ item.made_unit }}</td>
                                                    <td>@{{ item.made_date }}</td>
                                                    <td>@{{ item.product_number }}</td>
                                                    <td>@{{ item.in_unit_number }}</td>

                                                </tr>
                                                </tbody>
                                            </table>


                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id=""></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="regDetData">
                                                                <div class="form-group">
                                                                    <label for="">设备代码</label>
                                                                    <input type="text" class="form-control"
                                                                           name="device_number">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">施工单位名称</label>
                                                                    <input type="text" class="form-control"
                                                                           name="install_unit">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">气瓶容积</label>
                                                                    <input type="text" class="form-control"
                                                                           name="volume">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">制造单位名称</label>
                                                                    <input type="text" class="form-control"
                                                                           name="made_unit">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name">制造日期</label>
                                                                    <input type="text" class="form-control made_date"
                                                                           name="made_date">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name">产品编号</label>
                                                                    <input class='form-control '
                                                                           name="product_number"/>
                                                                </div>

                                                                <div class='form-group'>
                                                                    <label>单位内编号</label>
                                                                    <input class="form-control"
                                                                           name="in_unit_number">
                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">关闭
                                                            </button>
                                                            <button type="button" class="btn btn-primary"
                                                                    ng-click="saveRegDet()">保存
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <h1>设备使用情况</h1>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用单位名称</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.use_unit"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用单位地址</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control"
                                                       ng-model="data.use_unit_address"
                                                       type="text"/>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用率单位统一社会信用代码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.credit_code"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">邮政编码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.postal_number"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车牌号</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.license_plate"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车辆VIN码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_vin"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">投入使用日期</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control datepicker"
                                                       ng-model="data.use_date"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">单位固定电话</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.unit_phone"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">安全管理员</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.security_admin"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">移动电话</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.mobile"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="panel-footer text-right">

                                            <button class="btn btn-success pull-right" id="print2">打印反面</button>
                                            <button class="btn pull-right btn-success" id="print1">打印正面</button>
                                            <button class="btn btn-primary pull-right" type="submit" ng-click="save()">
                                                保存
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
    <script type="text/javascript" src="/assets/plugins/printArea/jquery.PrintArea.js"></script>
    <link href="/assets/plugins/printArea/printArea.css" rel="stylesheet"/>


    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>


    <script type="text/javascript">
        $("#print1").click(function () {
            $("#printContent1").printArea();
        })

        $("#print2").click(function () {
            $("#printContent2").printArea();
        })

        $('.datepicker').datepicker(
                {
                    format: 'yyyy-mm-dd',
                    autoclose: true
                }
        );

        $(".made_date").datepicker(
                {
                    format: 'yyyy-mm',
                    autoclose: true,
                }
        ).on("changeMonth", function (ev) {
            console.log(ev);
        });


        var serializeObject = function (form) {
            var o = {};
            $.each(form.serializeArray(), function (index) {
                if (o[this['name']]) {
                    o[this['name']] = o[this['name']] + "," + this['value'];
                } else {
                    o[this['name']] = this['value'];
                }
            });
            return o;
        };

        searchSelect2();

        var app = angular.module('add', []);
        app.controller('addController', function ($scope, $filter) {
            $scope.domain = document.domain;
            $scope.data = {
                device_varieties: '',
                device_category: '',
                device_type: '',
                product_name: '',
                qp_count: '',
                product: '',
                qp_pressure: '',
//施工单位名称
                inspection_unit: '',
                use_unit: '',
                use_unit_address: '',
                credit_code: '',
                postal_number: '',
                license_plate: '',
                postal_number: '',
                use_date: '',
                unit_phone: '',
                security_admin: '',
                mobile: "",
                reg_det_data: []

            };


            $scope.saveRegDet = function () {
                var data = serializeObject($('#regDetData'))
                $scope.data.reg_det_data.push(data);
//                $scope.reg_det_data
                $("#myModal").modal('hide');
                swal('', '成功', 'success');
            }


            $scope.getToday = function () {
                return $filter("date")(new Date().getTime(), "yyyy年MM月dd日");
            }

            $scope.file = '';

            $scope.imgs = {};

            $scope.DateShow = function (str) {
                if (!str) return
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月dd日");
            }

            $scope.DateShow1 = function (str) {
                if (!str) return;
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月");
            }


            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key];
            };


            $scope.save = function () {
                var data = $scope.data;
                data._token = $("#token").val();
                $.ajax({
                    url: "../../admin/registration/register2",
                    data: data,
                    type: 'post',
                    success: function (data) {
                        if (data.code == 0) {
                            swal('', '成功', 'success');
                        } else {
                            swal('', data.msg, 'error');
                        }

                        console.log(data);
                    }
                })
            }

            function callFun1(data) {
                $scope.$apply(function(){
                    $.extend($scope.data,data.data.registration);
                    $scope.data.product = $scope.data.product.toString();
                    $scope.data.reg_det_data = data.data.detail;
                })
            }

            $("#search_submit").on("click", function () {
                getSearchData(callFun1);
            })

        });


    </script>

@endsection
