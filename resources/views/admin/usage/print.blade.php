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
                                <div id="printContent1" style="border: 1px solid #000;display: none">
                                    <h1 style="padding: 180px  0px;font-weight:bolder;text-align: center">车用气瓶使用登记证</h1>
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
                                                    class="write_font">QP-100-000001</span>
                                        </div>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="label_font">车牌号码</td>
                                                <td class="write_font">浙A·T·0104</td>
                                                <td class="label_font">充装介质</td>
                                                <td class="write_font">压缩天然气</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">使用单位</td>
                                                <td colspan="3" class="write_font">杭州八达客运旅游有限公司</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">车种</td>
                                                <td colspan="3" class="write_font">北京现代</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装单位</td>
                                                <td colspan="3" class="write_font">北京现代汽车有限公司</td>
                                            </tr>
                                            <tr>
                                                <td class="label_font">安装日期</td>
                                                <td colspan="3" class="write_font">2014年11月29日</td>
                                            </tr>
                                        </table>

                                        <div class="write_font" style="text-align: right;margin-top: 70px">
                                            <p style="margin: 70px 10px">登记机关:(加盖公章):杭州市质量技术监督局</p>

                                            <p style="margin: 80px 10px">发证日期: 2016 年 05 月 06 日</p>
                                        </div>
                                    </div>
                                </div>



                                <div id="printContent2" style="display: block">
                                    <style>
                                        #printContent2 table thead{
                                            font-size: 14px;
                                        }
                                        #printContent2 tbody{
                                            font-size: 13px;
                                        }
                                        .print_span{
                                            font-size: 14px;
                                        }
                                        .print_span span{
                                            display: inherit;
                                        }
                                        .header_p{
                                            font-weight: bolder;
                                            text-align: center;
                                            margin: 0px;
                                        }
                                    </style>
                                   <div style="border: 1px solid #000">
                                       <h2 style="margin: 20px  0px;font-weight:bolder;text-align: center">车用气瓶使用登记证</h2>
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
                                           <tr>
                                               <td>1</td>
                                               <td>5-33-100-000001</td>
                                               <td>北京天海工业有限公司</td>
                                               <td>2014年9月</td>
                                               <td>40413132</td>
                                               <td>87</td>
                                               <td>2016年9月</td>
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
                                           <tr>
                                               <td>1</td>
                                               <td>付贞飞</td>
                                               <td>362323197712213917</td>
                                               <td></td>
                                           </tr>
                                           <tr>
                                               <td>1</td>
                                               <td>付贞飞</td>
                                               <td>362323197712213917</td>
                                               <td></td>
                                           </tr>
                                           <tr>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                           </tr>
                                           </tbody>
                                       </table>

                                       <div class="print_span">
                                           <p class="header_p">气瓶使用注意事项</p>
                                           <p  class="header_p">气瓶应当按照安全技术规范的规定，在安全检验合格的有效期内使用</p>
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
                                           <p  class="header_p" style="margin: 10px 0px">本证件不得转让、涂改，如有遗失、损坏，须向发证机关申请补发</p>
                                       </div>
                                   </div>

                                    <div >
                                        <p>《特种设备安全法》第三十三条规定：“特种设备使用单位应当在特种设
                                            备投入使用前或者投入使用后三十日内，向负责特种设备安全监督的部门办理使用
                                            登记，取得使用登记证书。登记标志应当置于该特种设备的显著位置。”
                                        </p>
                                    </div>
                                </div>
                                <button class="btn" id="print1">打印正面</button>
                                <button class="btn" id="print2">打印反面</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>
    <script type="text/javascript" src="/assets/plugins/printArea/jquery.PrintArea.js"></script>
    <link href="/assets/plugins/printArea/printArea.css" rel="stylesheet"/>


    <script type="text/javascript">
        $("#print1").click(function () {

            $("#printContent1").printArea();
        })

        $("#print2").click(function () {
            $("#printContent2").printArea();
        })

    </script>

@endsection
