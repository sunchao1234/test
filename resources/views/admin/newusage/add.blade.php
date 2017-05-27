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
                                        <h1 style="padding: 50px  0px;text-align: center;font-size: 38px">
                                            特种设备使用登记证
                                        </h1>
                                        <style>
                                            #printContent1 {
                                                padding: 20px;
                                                font-family: '黑体';
                                            }

                                            .label_font {
                                                font-size: 15px;
                                                font-weight: bolder;
                                            }

                                            .write_font {
                                                font-size: 16px;
                                            }

                                            #printContent1 table {
                                                font-size: 24px;
                                            }

                                            #printContent1 table td {
                                                padding: 10px 0px;
                                            }

                                            .letter4 {
                                                letter-spacing: 2px;
                                            }

                                            .letter5 {
                                                letter-spacing: 4.5px;
                                            }

                                            .letter6 {
                                                letter-spacing: 1px;
                                            }
                                        </style>
                                        <p style="text-align: center;font-size: 24px">编号:</p>

                                        <p style="text-indent:50px;font-size: 30px;padding: 50px 0px;line-height: 50px">
                                            按照《中华人民共和国特种设备安全法》的规定，依据特种设备安全技术规范要求，
                                            予以使用登记。</p>

                                        <table cellPadding=10 style="width: 100%;margin-top: 20px">
                                            <tr>
                                                <td colspan="2">
                                                    <span class='letter6'>使用单位名称</span>
                                                    <span>:</span>
                                                    <span>122</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <span class='letter6'>设备使用地点</span>
                                                    <span>:</span>
                                                    <span>122</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 种 类</span>
                                                    <span>:</span>
                                                    <span>122</span>
                                                </td>
                                                <td>
                                                    <span class='letter4'>设 备 类 别</span>
                                                    <span>:</span>

                                                    <span>122</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 品 种</span>
                                                    <span>:</span>

                                                    <span>122</span>
                                                </td>
                                                <td>
                                                    <span class='letter5'>单位内编号</span>
                                                    <span>:</span>

                                                    <span>122</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 代 码</span>
                                                    <span>:</span>

                                                    <span>122</span>
                                                </td>
                                                <td>
                                                    <span class='letter4'>产 品 编 号</span>
                                                    <span>:</span>

                                                    <span>122</span>
                                                </td>
                                            </tr>
                                        </table>


                                        <div>
                                            <img width="150px" height="110px" src="/assets/img/timg.jpg"/>
                                        </div>

                                        <div class="write_font"
                                             style="text-align: right;margin-top: 0px;font-size:21px">
                                            <p style="margin: 10px 10px">登记机关:(名称与公章)</p>

                                            <p style="margin: 20px 10px">发证日期:2017年4月1日 </p>
                                        </div>

                                        <p style="text-indent:50px;font-size: 18px">
                                            依据安全技术规范的要求，应当在定期检验确定的有效期和技术参数范围内使用
                                        </p>
                                    </div>


                                    <div id="printContent2" style="">
                                        <style>
                                            #printContent2 {
                                                font-family: '黑体';
                                            }

                                            #printContent2 table {
                                                font-size: 18px;
                                                border-collapse: collapse;
                                                border: 1px solid #ccc;
                                            }

                                            #printContent2 table td {
                                                text-align: center;
                                                border: 1px solid #ccc;
                                                width: 5.55%;
                                                padding: 5px;
                                            }


                                        </style>
                                        {{--<h2 style="margin: 20px  0px;font-size: 38px;text-align: center">--}}
                                        {{--特种设备使用登记表</h2>--}}

                                        <div>

                                            <table style="width:100%">

                                                <tr>
                                                    <td rowspan="10" colspan='2'>设备基础情况</td>
                                                    <td colspan="4">设备品种</td>
                                                    <td colspan="4"></td>
                                                    <td colspan="4">产品名称</td>
                                                    <td colspan="4"></td>
                                                </tr>
                                                <tr style="display: none">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">气瓶数量</td>
                                                    <td colspan="4"></td>
                                                    <td colspan="4">充装介质</td>
                                                    <td colspan="4"></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">气瓶公称工作压力</td>
                                                    <td colspan="4">
                                                        <span></span>
                                                        <span>Mpa</span>
                                                    </td>
                                                    <td colspan="4">气瓶容积</td>
                                                    <td colspan="4">
                                                        <span></span>
                                                        <span>L</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="7">制造单位名称</td>
                                                    <td colspan="3">制造日期</td>
                                                    <td colspan="3">产品编号</td>
                                                    <td colspan="3">单位内编号</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">&nbsp</td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">&nbsp</td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">&nbsp</td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">&nbsp</td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">施工单位名称</td>
                                                    <td colspan='12'></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">监督检验机构名称</td>
                                                    <td colspan='12'></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="6" colspan='2'>设备基础情况</td>
                                                    <td colspan="4">使用单位名称</td>
                                                    <td colspan='12'></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">使用单位名称</td>
                                                    <td colspan='12'></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">使用单位统一社会信用代码</td>
                                                    <td colspan='5'></td>
                                                    <td colspan='3'>邮政编码</td>
                                                    <td colspan='4'></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">车牌号</td>
                                                    <td colspan='5'></td>
                                                    <td colspan='3'>车辆VIM码</td>
                                                    <td colspan='4'></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">投入使用日期</td>
                                                    <td colspan='5'></td>
                                                    <td colspan='3'>单位固定电话</td>
                                                    <td colspan='4'></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">安全管理员</td>
                                                    <td colspan='5'></td>
                                                    <td colspan='3'>移动电话</td>
                                                    <td colspan='4'></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="18" style="position: relative">
                                                        <p style="text-align: left;text-indent:50px;">
                                                            在此申明：所申报的内容真实；在使用过程中，将严格执行《中国人
                                                            民共和国特种设备安全法》及相关规定，
                                                            并且接受特种设备安全监督管理部门的监督管理。</p>

                                                        <div style="height: 20px;margin: 30px 0px">
                                                            <p style="width: 50%;float:left">使用单位填表人员</p>

                                                            <p style="width: 50%;float:left;text-align: left">日期:</p>
                                                        </div>
                                                        <div>
                                                            <p style="width: 50%;float:left">使用单位安全管理人员</p>

                                                            <p style="width: 50%;float:left;text-align: left">日期:</p>
                                                        </div>
                                                        <div style="position: absolute;bottom:0px;right:10px">
                                                            <p>(使用单位公章)</p>

                                                            <p>2017年 12月 01日</p>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="18" style="position: relative">
                                                        <p style="text-align: left">说明:</p>

                                                        <div style="height: 20px;margin: 30px 0px">
                                                            <p style="width: 50%;float:left">登记机关登记人员</p>

                                                            <p style="width: 50%;float:left;text-align: left">日期:</p>
                                                        </div>

                                                        <div>
                                                            <p style="width: 50%;float:left">使用登记证编号</p>
                                                        </div>

                                                        <div style="position: absolute;bottom:0px;right:10px">
                                                            <p>(登记机关专用章)</p>

                                                            <p>2017年 12月 01日</p>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        {{--<div>--}}
                                        {{--<p>《特种设备安全法》第三十三条规定：“特种设备使用单位应当在特种设--}}
                                        {{--备投入使用前或者投入使用后三十日内，向负责特种设备安全监督的部门办理使用--}}
                                        {{--登记，取得使用登记证书。登记标志应当置于该特种设备的显著位置。”--}}
                                        {{--</p>--}}
                                        {{--</div>--}}
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
                                                           ng-model="data.license_plate" type="text"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备类别</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.license_plate" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备种类</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.license_plate" type="text"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">设备代码</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.license_plate" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">产品名称</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control"
                                                           ng-model="data.license_plate" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">气瓶数量</label>

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
                                                <label class="control-label col-md-2">气瓶公称工作压力</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.use_unit"
                                                           type="text"/>Mpa
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">气瓶容积</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">施工单位名称</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">监督检验机构名称</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                           type="text"/>
                                                </div>
                                            </div>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">
                                                添加
                                            </button>

                                            <table style="width: 100%">
                                                <tr>
                                                    <td>制造单位名称</td>
                                                    <td>制造日期</td>
                                                    <td>产品编号</td>
                                                    <td>单位内编号</td>
                                                </tr>
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
                                                                    <label for="">制造单位名称</label>
                                                                    <input type="text" class="form-control"
                                                                           name="made_unit">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name">制造日期</label>
                                                                    <input type="text" class="form-control"
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
                                                                           name="product_number">
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
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用单位地址</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用率单位统一社会信用代码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">邮政编码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车牌号</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车辆VIN码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">投入使用日期</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control datepicker" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">单位固定电话</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">安全管理员</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">移动电话</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
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
