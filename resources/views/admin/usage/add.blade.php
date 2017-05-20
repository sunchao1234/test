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
                                    <style>
                                        #printContent1, #printContent2 {
                                            display: none;
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
                                                        class="write_font">@{{ data.number }}</span>
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td class="label_font">车牌号码</td>
                                                    <td class="write_font">@{{ data.license_plate }}</td>
                                                    <td class="label_font">充装介质</td>
                                                    <td class="write_font">@{{ getSelect(data.product) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label_font">使用单位</td>
                                                    <td colspan="3" class="write_font">@{{ data.use_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label_font">车种</td>
                                                    <td colspan="3" class="write_font">@{{ data.car_brand }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label_font">安装单位</td>
                                                    <td colspan="3" class="write_font">@{{ data.install_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label_font">安装日期</td>
                                                    <td colspan="3"
                                                        class="write_font">@{{ DateShow(data.install_date) }}</td>
                                                </tr>
                                            </table>

                                            <div class="write_font" style="text-align: right;margin-top: 70px">
                                                <p style="margin: 70px 10px">登记机关:(加盖公章):杭州市质量技术监督局</p>

                                                <p style="margin: 80px 10px">发证日期: @{{ getToday() }}</p>
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
                                                <tr ng-repeat="item in data.reg_det_data track by $index">
                                                    <td>@{{ $index+1 }}</td>
                                                    <td>@{{ item.device_number }}</td>
                                                    <td>@{{ item.made_unit}}</td>
                                                    <td>@{{ DateShow1(item.made_date)}}</td>
                                                    <td>@{{ item.product_number }}</td>
                                                    <td>@{{ item.volume }}</td>
                                                    <td>@{{ DateShow1(item.next_time_check_date)}}</td>

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
                                                <tr ng-repeat="item in data.driver_data track by $index">
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

                                    <form id="uploadForm" style="display: none">
                                        <input name='_token' class='hide' id='token'
                                               value='<?php echo e(csrf_token()); ?>'>
                                        <input type="hidden" name="type" id='img_type' value='1'/>
                                        <input type="file" multiple="multiple" id='uploadFile' name='img[]'>
                                    </form>

                                    <div id="validate" role="form" name="create_form"
                                         class="form-horizontal form-bordered">
                                        <div class="form-body">
                                            <!-- 默认开启了 csrf验证 非POST请求token必须加  -->

                                            <div class="form-group">
                                                <label class='control-label col-md-2'>登记证编号</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.number"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车牌号码</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.license_plate" type="text"/>
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
                                                <label class="control-label col-md-2">使用单位</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.use_unit"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车 种</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">安装单位</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.install_unit" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">日期</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="install_date" name="" class="form-control datepicker"
                                                           ng-model="data.install_date" type="text"/>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal">
                                            添加
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="regDetData">
                                                            <div class="form-group">
                                                                <label for="">设备编号</label>
                                                                <input type="text" class="form-control"
                                                                       name="device_number">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name">制造单位</label>
                                                                <input type="text" class="form-control"
                                                                       name="made_unit">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name">制造日期</label>
                                                                <input class='form-control made_date' readonly
                                                                       name="made_date"/>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label>产品编号</label>
                                                                <input class="form-control"
                                                                       name="product_number">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>容积</label>
                                                                <input class='form-control' name="volume"/>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name">下次检测日期</label>
                                                                <input class='form-control made_date'
                                                                       name="next_time_check_date"/>
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
                                            <tr ng-repeat="item in data.reg_det_data track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{ item.device_number }}</td>
                                                <td>@{{ item.made_unit}}</td>
                                                <td>@{{ item.made_date }}</td>
                                                <td>@{{ item.product_number }}</td>
                                                <td>@{{ item.volume }}</td>
                                                <td>@{{item.next_time_check_date }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal_1">
                                            添加
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">驾驶人员信息</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="driverData">
                                                            <div class="form-group">
                                                                <label for="recipient-name">姓名</label>
                                                                <input type="text" class="form-control" name="name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name">身份证号</label>
                                                                <input type="text" class="form-control" name='id_card'>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name">备注</label>
                                                                <input class='form-control' name='remark'/>
                                                            </div>
                                                        </form>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">关闭
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                                ng-click="saveDriverData()">确定
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


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
                                            <tr ng-repeat="item in data.driver_data track by $index">
                                                <td>@{{ $index+1 }}</td>
                                                <td>@{{item.name}}</td>
                                                <td>@{{ item.id_card }}</td>
                                                <td>@{{ item.remark }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

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
                    startView: 'year',
                    maxView: 'year'
                }
        ).on("changeMonth", function (ev) {
            console.log(ev);
        });

        var imgType;
        var uploadFile = function () {

            $("#img_type").val(imgType);
            var formData = new FormData($("#uploadForm")[0]);
            $.ajax({
                url: '../../admin/registration/upload',  //server script to process data
                type: 'POST',
                //Ajax事件
                success: function (data) {
                    if (data.code == 0) {
                        var type = imgType;
                        addImg(data.data.imgs, data.data.type);
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

        var app = angular.module('add', []);
        app.controller('addController', function ($scope, $filter) {
            $scope.domain = document.domain;
            $scope.data = {
                number: '',
                license_plate: "",
                product: "1",
                use_unit: "",
                car_brand: "",
                install_unit: "",
                install_date: "",
                is_personal: true,//1
                reg_det_data: [],
                driver_data: []
            };

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

            $scope.upload = function (action) {
                imgType = action;
                $("#uploadFile").click();
            }


            addImg = function (data, type) {
                $scope.$apply(function () {
                    $scope.imgs[type] = data;
                })
            }

            $("#uploadFile").on("change", function (e) {
                uploadFile();
            });

            $scope.saveDriverData = function () {
                var data = serializeObject($('#driverData'));
                $scope.data.driver_data.push(data);
                $("#myModal_1").modal('hide');
                swal('', '成功', 'success');
            };

            $scope.saveRegDet = function () {
                var data = serializeObject($('#regDetData'))
                $scope.data.reg_det_data.push(data);
                $("#myModal").modal('hide');
                swal('', '成功', 'success');
            }
            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key];
            };

            $('#install_date').on("change", function () {
                var self = this;
                $scope.$apply(function () {
                    $scope.data.install_date = $(self).val();
                })
            })

            $scope.save = function () {
                var data = $scope.data;
                data.images = $scope.imgs;
                data._token = $("#token").val();
                $.ajax({
                    url: "../../admin/registration/register",
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

        });


    </script>

@endsection
