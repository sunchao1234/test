@extends('admin.layout')
@section('content')
    <style>
        .btn-scroll-to-top {
            display: none !important;
        }
    </style>
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
                                                            id="search_submit">搜索
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input name='_token' class='hide' id='token'
                                           value='<?php echo e(csrf_token()); ?>'>
                                    <div class="form-horizontal form-bordered" id="form_v" style="display: none">
                                        <form id="form1">
                                            <div class="form-group">
                                                <label class='control-label col-md-2'>登记证编号</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="number" class="form-control"
                                                           ng-model="data.registration.number"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车牌号码</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="license_plate" class="form-control"
                                                           ng-model="data.registration.license_plate" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">充装介质</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <select class="form-control" name="product"
                                                            ng-model="data.registration.product">
                                                        <option value="1">压缩天然气-CNG</option>
                                                        <option value="2">液化天然气-LNG</option>
                                                        <option value="3">液化石油气-LPG</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">使用单位</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="use_unit" class="form-control"
                                                           ng-model="data.registration.use_unit"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车 种</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="car_brand" class="form-control"
                                                           ng-model="data.registration.car_brand"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">安装单位</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="install_unit" class="form-control"
                                                           ng-model="data.registration.install_unit" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">日期</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="install_date" name="install_date"
                                                           class="form-control datepicker"
                                                           ng-model="data.registration.install_date" type="text"/>
                                                </div>
                                            </div>
                                        </form>


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
                                                        <button type="button" class="btn btn-primary" id="saveDetail">保存
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
                                                <td>操作</td>
                                            </tr>
                                            </thead>
                                            <tbody id='detail_body'>
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
                                                                id="saveDriverInfo">确定
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
                                                <td>编辑</td>
                                            </tr>
                                            </thead>
                                            <tbody id="driver_info_t">

                                            </tbody>
                                        </table>

                                        <button class="btn btn-primary pull-right" id="saveData">保存</button>


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

        $('.datepicker').datepicker(
                {
                    format: 'yyyy-mm-dd',
                    autoclose: true
                }
        );

        $(".made_date").datepicker(
                {
                    format: 'yyyy-mm',
                    autoclose: true
                }
        );

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

        //        $("#search_submit").on("click", getSearchData(callFun));

        var detail;
        var driver_info;
        function callFun1(data) {
            $("#form_v").show();
            var registration = data.data.registration;
            for (var i in registration) {
                $("[name='" + i + "']").val(registration[i]);
            }

            detail = data.data.detail;
            setDriveData(detail);

            driver_info = data.data.driver_info;
            setDetailData(driver_info);
        }

        var setDetailData = function (driver_info) {
            $("#driver_info_t").html('');
            for (var i = 0; i < driver_info.length; i++) {
                var tr = "<tr>";
                tr += "<td>" + i + "</td>";
                tr += "<td>" + driver_info[i].name + "</td>";
                tr += "<td>" + driver_info[i].id_card + "</td>";
                tr += "<td>" + driver_info[i].remark + "</td>";
                tr += "<td><a>删除</a></td>";
                $("#driver_info_t").append(tr);
            }
        }
        var setDriveData = function (detail) {
            $("#detail_body").html('');
            for (var i = 0; i < detail.length; i++) {
                var tr = "<tr>";
                tr += "<td>" + i + "</td>";
                tr += "<td>" + detail[i].device_number + "</td>";
                tr += "<td>" + detail[i].made_unit + "</td>";
                tr += "<td>" + detail[i].made_date + "</td>";
                tr += "<td>" + detail[i].product_number + "</td>";
                tr += "<td>" + detail[i].volume + "</td>";
                tr += "<td>" + detail[i].next_time_check_date + "</td>";
                tr += "<td><a>删除</a></td></tr>";
                $("#detail_body").append(tr);
            }
        }

        $("#search_submit").on("click", function () {
            getSearchData(callFun1);
        })

        $("#search_submit").click();

        $("#saveDetail").on('click', function () {
            var data = serializeObject($('#regDetData'));
            detail.push(data);
            setDriveData(detail);
            $("#myModal").modal('hide');
            swal('', '成功', 'success');
        });

        $("#saveDriverInfo").on('click', function () {
            var data = serializeObject($('#driverData'));
            driver_info.push(data);
            setDetailData(driver_info);
            $("#myModal_1").modal('hide');
            swal('', '成功', 'success');
        })

        $("#saveData").on('click', function () {
            console.log(serializeForm($("#form1").serializeArray()));
            var saveData = serializeForm($("#form1").serializeArray());
            saveData.reg_det_data = detail;
            saveData.driver_data = driver_info;

            saveData._token = $("#token").val();
            $.ajax({
                url:"../../admin/registration/newfillpermit1",
                type:'post',
                data:saveData,
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

        })

        function serializeForm(data) {
            var o = {};
            $.each(data, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        }
    </script>

@endsection
