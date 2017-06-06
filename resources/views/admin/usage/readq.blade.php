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
                                                <input type="text" class="form-control" id="license_plate" ng-model="searchData.license_plate"/>
                                            </div>

                                            <div class="btn-group  col-md-2" style="padding-left: 0px;">
                                                <label class="control-label m-r-10  m-t-10"> 产品编号</label>
                                                <input type="text" class="form-control" id="number" ng-model="searchData.product_number"/>
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

                                    <style>
                                        #printContent1, #printContent2 {
                                            margin-top: 10px;
                                        }
                                    </style>



                                    <div id="printContent1" ng-if="data.registration.number && !data.registration.device_varieties"
                                         style="border: 1px solid #000;">
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

                                            <div class="write_font" style="text-align: right;margin-top: 70px">
                                                <p style="margin: 70px 10px">登记机关:(加盖公章):杭州市质量技术监督局</p>

                                                <p style="margin: 80px 10px">发证日期: @{{ getToday() }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="printContent2" ng-if="data.registration.number  &&!data.registration.device_varieties" style="">
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





                                    <div id="printContent1"  ng-if="data.registration.number && data.registration.device_varieties !=''" style="border: 1px solid #000;">
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
                                        <p style="text-align: center;font-size: 24px">编号:@{{ data.registration.number }}</p>

                                        <p style="text-indent:50px;font-size: 30px;padding: 50px 0px;line-height: 50px">
                                            按照《中华人民共和国特种设备安全法》的规定，依据特种设备安全技术规范要求，
                                            予以使用登记。</p>

                                        <table cellPadding=10 style="width: 100%;margin-top: 20px">
                                            <tr>
                                                <td colspan="2">
                                                    <span class='letter6'>使用单位名称</span>
                                                    <span>:</span>
                                                    <span>@{{data.registration.use_unit}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <span class='letter6'>设备使用地点</span>
                                                    <span>:</span>
                                                    <span>@{{ data.registration.use_unit_address }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 种 类</span>
                                                    <span>:</span>
                                                    <span>@{{ data.registration.device_type }}</span>
                                                </td>
                                                <td>
                                                    <span class='letter4'>设 备 类 别</span>
                                                    <span>:</span>

                                                    <span>@{{ data.registration.device_category }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 品 种</span>
                                                    <span>:</span>

                                                    <span>@{{ data.registration.device_varieties }}</span>
                                                </td>
                                                <td>
                                                    <span class='letter5'>单位内编号</span>
                                                    <span>:</span>

                                                    <span>@{{ data.detail[0].in_unit_number }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class='letter4'>设 备 代 码</span>
                                                    <span>:</span>

                                                    <span>@{{ data.detail[0].device_number }}</span>
                                                </td>
                                                <td>
                                                    <span class='letter4'>产 品 编 号</span>
                                                    <span>:</span>

                                                    <span>@{{ data.detail[0].product_number }}</span>
                                                </td>
                                            </tr>
                                        </table>


                                        <div>
                                            <img width="150px" height="110px" src="/assets/img/timg.jpg"/>
                                        </div>

                                        <div class="write_font"
                                             style="text-align: right;margin-top: 0px;font-size:21px">
                                            <p style="margin: 10px 10px">登记机关:(名称与公章)</p>

                                            <p style="margin: 20px 10px">发证日期:@{{curentDate()}}</p>
                                        </div>

                                        <p style="text-indent:50px;font-size: 18px">
                                            依据安全技术规范的要求，应当在定期检验确定的有效期和技术参数范围内使用
                                        </p>
                                    </div>


                                    <div id="printContent2"  ng-if="data.registration.number && data.registration.device_varieties != ''" style="">
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
                                                    <td rowspan="@{{ 6 +  data.detail.length }}" colspan='2'>设备基础情况</td>
                                                    <td colspan="4">设备品种</td>
                                                    <td colspan="4">@{{ data.registration.device_varieties }}</td>
                                                    <td colspan="4">产品名称</td>
                                                    <td colspan="4">@{{ data.registration.product_name }}</td>
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
                                                    <td colspan="4">@{{ data.registration.qp_count }}</td>
                                                    <td colspan="4">充装介质</td>
                                                    <td colspan="4">@{{ getSelect(data.registration.product) }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">气瓶公称工作压力</td>
                                                    <td colspan="4">
                                                        <span>@{{ data.registration.qp_pressure }}</span>
                                                        <span>Mpa</span>
                                                    </td>
                                                    <td colspan="4">气瓶容积</td>
                                                    <td colspan="4">
                                                        <span>@{{ data.detail[0].volume }}</span>
                                                        <span>L</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="7">制造单位名称</td>
                                                    <td colspan="3">制造日期</td>
                                                    <td colspan="3">产品编号</td>
                                                    <td colspan="3">单位内编号</td>
                                                </tr>
                                                <tr  ng-repeat="item in data.detail track by $index">
                                                    <td  colspan='7'>@{{ item.made_unit }}</td>
                                                    <td colspan="3">@{{ item.made_date }}</td>
                                                    <td colspan="3">@{{ item.product_number }}</td>
                                                    <td colspan="3">@{{ item.in_unit_number }}</td>
                                                </tr>
                                                {{--<tr>--}}
                                                {{--<td colspan="7">&nbsp</td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                {{--<td colspan="7">&nbsp</td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                {{--<td colspan="7">&nbsp</td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                {{--<td colspan="7">&nbsp</td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--<td colspan="3"></td>--}}
                                                {{--</tr>--}}
                                                <tr>
                                                    <td colspan="4">施工单位名称</td>
                                                    <td colspan='12'>@{{ data.reg_det_data[0].install_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">监督检验机构名称</td>
                                                    <td colspan='12'>@{{ data.registration.inspection_unit }}</td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="6" colspan='2'>设备基础情况</td>
                                                    <td colspan="4">使用单位名称</td>
                                                    <td colspan='12'>@{{ data.registration.use_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">使用单位地址</td>
                                                    <td colspan='12'>@{{ data.registration.use_unit_address }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">使用单位统一社会信用代码</td>
                                                    <td colspan='5'>@{{ data.registration.credit_code }}</td>
                                                    <td colspan='3'>邮政编码</td>
                                                    <td colspan='4'>@{{ data.registration.postal_number }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">车牌号</td>
                                                    <td colspan='5'>@{{ data.registration.license_plate }}</td>
                                                    <td colspan='3'>车辆VIM码</td>
                                                    <td colspan='4'>@{{ data.registration.car_vin }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">投入使用日期</td>
                                                    <td colspan='5'>@{{ DateShow(data.registration.use_date) }}</td>
                                                    <td colspan='3'>单位固定电话</td>
                                                    <td colspan='4'>@{{ data.registration.unit_phone }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">安全管理员</td>
                                                    <td colspan='5'>@{{ data.registration.security_admin }}</td>
                                                    <td colspan='3'>移动电话</td>
                                                    <td colspan='4'>@{{ data.registration.mobile }}</td>
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

                                                            <p>@{{ curentDate() }}</p>
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

                                                            <p>@{{ curentDate() }}</p>
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


                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#myModal_1">
                                        查看图片资料
                                    </button>

                                    <style>
                                        #myModal_1 li {
                                            display: inline-block;
                                            width: 100px;
                                            height: 100px;
                                        }
                                    </style>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <ul>
                                                        <li ng-repeat="imgObj in data.imgs">
                                                            <div>
                                                                <a href="/@{{ imgObj.pic_url}}" target="_blank">
                                                                    <img src="/@{{ imgObj.pic_url}}" width="100px"
                                                                         height="100px"
                                                                         alt="@{{ getTypeName(imgObj.type) }}"/>
                                                                </a>
                                                                <span>@{{ getTypeName(imgObj.type) }}</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">关闭
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
        app.controller('findController', function ($scope, $filter) {
            $scope.getToday = function () {
                return $filter("date")(new Date().getTime(), "yyyy年MM月dd日");
            }

            $scope.DateShow = function (str) {
                if (!str) return;
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月dd日");
            }

            $scope.curentDate = function(){
                return $filter("date")(new Date().getTime(), "yyyy年MM月dd日");
            }

            $scope.DateShow1 = function (str) {
                if (!str) return;
                return $filter("date")(new Date(str).getTime(), "yyyy年MM月");
            }


            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key - 1];
            };


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

                    },
                    error: function (data) {

                    }
                })
            }
            var types = "安装合格证,安装监督检验证书,质量证明书,特种设备制造监督检验证书,行驶证," +
                    "运营证,驾驶证,气瓶检测报告,(旧)气瓶登记使用,证经办人身份证,丢失证明";
            types = types.split(',');

            $scope.getTypeName = function (type) {
                return types[type - 1];
            }

            $scope.searchData = {
                license_plate: "",
                product_number: ""
            }

            $scope.search = function () {
                $.ajax({
                    url: "../../admin/registration/query",
                    type: 'get',
                    data: $scope.searchData,
                    success: function (data) {
                        $scope.$apply(function () {
                            $scope.data = data.data;
                        })
                    }
                })
            }
        });

    </script>

@endsection
