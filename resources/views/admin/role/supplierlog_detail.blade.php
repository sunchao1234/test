@extends('admin.layout')
@section('content')
    <style>
        /*属性分类*/

        #sku-color-tab-contents {
            background-color: #fff;
            border: 1px solid #d7d7d7;
        }

        #sku-color-tab-contents .color-list li {
            float: left;
            list-style: outside none none;
            padding-right: 22px;
        }

        .sku-style li {
            clear: none;
            margin: 0;
        }

        #sku-color-tab-contents .color-list li label {
            display: block;
        }

        .sku-style label {
            float: none;
            line-height: 1.5;
            padding: 0;
            text-align: left;
            width: auto;
        }

        element.style {
            background: rgb(255, 251, 240) none repeat scroll 0 0;
        }

        #sku-color-tab-contents .color-box {
            border: 1px solid #ddd;
            display: inline-block;
            height: 14px;
            margin: 0 3px;
            position: relative;
            top: 3px;
            width: 14px;
        }

        /*属性分类*/

        /*商品图片*/
        .multimage .multimage-wrapper {
            border: 1px solid #ececec;
        }

        .multimage-wrapper .multimage-tabs {
            background-color: #f8f8f8;
            padding: 10px 20px 0;
        }

        .multimage-wrapper .multimage-tabs .tab {
            border: 1px solid #ececec;
            cursor: pointer;
            display: inline-block;
            margin-right: 10px;
            padding: 8px 20px 5px;
        }

        .multimage-wrapper .multimage-tabs .actived {
            background-color: #fff;
            border-bottom: 1px solid #fff;
            border-top: 2px solid #e34724;
            margin-top: 1px;
        }

        .multimage-wrapper .multimage-panels {
            background-color: #fff;
        }

        .multimage-wrapper .multimage-panels .remote-panel {
            display: none;
            height: 205px;
            overflow: hidden;
            padding-top: 5px;
        }

        .multimage-wrapper .multimage-info {
            background-color: #f8f8f8;
            border: 2px solid #fff;
            padding: 10px;
            text-align: center;
        }

        .multimage-wrapper .info-wrapper {
            display: inline-block;
            text-align: left;
        }

        .msg::after, .msg24::after {
            clear: both;
            content: " ";
            display: block;
            height: 0;
        }

        .multimage-wrapper .multimage-info .msg {
            color: #aaa;
        }

        .multimage-wrapper .multimage-gallery {
            margin-top: 10px;
            overflow: hidden;
            position: relative;
        }

        .multimage-wrapper .multimage-gallery ul {
            font-size: 0;
        }

        .multimage-wrapper .multimage-gallery li {
            border: 1px solid #cdcdcd;
            display: inline-block;
            font-size: 0;
            margin-right: 10px;
            position: relative;
            vertical-align: top;
        }

        .multimage-wrapper .multimage-gallery .info {
            font-size: 12px;
            text-align: center;
            top: 30px;
            z-index: 3;
        }

        .multimage-wrapper .multimage-gallery .examp {
            overflow: hidden;
            z-index: 2;
        }

        .multimage-wrapper .multimage-gallery .examp .desc {
            bottom: 2px;
            color: #999;
            font-size: 12px;
            left: 0;
            position: absolute;
            text-align: center;
            width: 90px;
            z-index: 3;
        }

        .multimage-wrapper .multimage-info .bright {
            display: inline;
        }

        .bright {
            color: #f60;
        }

        .multimage-gallery .info {
            font-size: 12px;
            text-align: center;
            top: 30px;
            z-index: 3;
        }

        .botNav {
            border-top: 0 solid #f2f2f2;
            height: 150px;
            margin: auto;
            padding: 15px 30px 0 0;
            width: 100%;
            z-index: 1000;
        }

        .botNav li {
            color: #606060;
            float: left;
            font-size: 12px;
            line-height: 15px;
            width: 10%;
            margin: 0.5%;
            list-style: outside none none;
        }

        .botNav li img {
            color: #606060;
            float: left;
            font-size: 12px;
            line-height: 15px;
            list-style: outside none none;
            width: 100%;
        }

        /*默认佣金*/

        .sku-style {
            background: #fff;
        }

        .sku-style table {
            background-color: #fff;
            width: 100%;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .sku-style th {
            background-color: #ededed;
            border: 1px solid #d7d7d7;
            font-weight: 400;
            height: 25px;
            text-align: left;
            vertical-align: middle;
        }

        .sku-style td.tile {
            max-width: 300px;
            padding-left: 20px;
            text-align: left;
        }

        .sku-style td {
            border: 1px solid #d7d7d7;
            height: 25px;
            min-width: 60px;
            padding: 3px 5px;
            text-align: left;
            vertical-align: middle;
        }
        .sku-style a {
            color: red;
        }
    </style>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> 日志详情</span>
                        <span class="caption-helper"> log detail</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="">
                    <div class="panel">
                        <div class="panel-body" style="padding-left:0px;padding-right:0px;padding-top:5px;">
                            <div class=" form-group-separated"><!--属性分类s-->
                                <div class="form-group">
                                    <div style="  padding: 0px; border:none;" id="sku-color-tab-contents">

                                        <table width="100%" cellspacing="0" border="0" style="margin-top:10px;" class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr style="height:35px;">
                                                    <th style="text-indent:10px;" colspan="2"><b>日志信息</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left;display:block;min-width:150px;border-right: 0;border-bottom: 0;border-left: 0;" class="image">
                                                        <div class="img-btn">
                                                            <span style="float:left; margin-left:5px;"> 日志编号 </span>
                                                        </div>
                                                    </td>
                                                    <td class="image">{{$log_info->id}}</td>
                                                </tr>


                                                <tr style="">
                                                    <td style="text-align: left;display:block;min-width:150px;border-right: 0;border-bottom: 0;border-left: 0;" class="image">
                                                        <div class="img-btn">
                                                            <span style="float:left; margin-left:5px;"> 操作账号 </span>
                                                        </div>
                                                    </td>
                                                    <td class="image">{{$log_info->email}}</td>
                                                </tr>

                                                <tr style="">
                                                    <td style="text-align: left;display:block;min-width:150px;border-right: 0;border-bottom: 0;border-left: 0;" class="image">
                                                        <div class="img-btn">
                                                            <span style="float:left; margin-left:5px;"> 操作时间</span>
                                                        </div>
                                                    </td>
                                                    <td class="image">
                                                        {{date('Y-m-d H:i:s', $log_info->create_time)}}
                                                    </td>
                                                </tr>
                                                <tr style="">
                                                    <td style="text-align: left;display:block;min-width:150px;border-right: 0;border-bottom: 0;border-left: 0;" class="image">
                                                        <div class="img-btn">
                                                            <span style="float:left; margin-left:5px;"> 操作记录</span>
                                                        </div>
                                                    </td>
                                                    <td class="image">
                                                        <?php echo $log_info->log;?>
                                                    </td>
                                                </tr>
                                                <tr style="">
                                                    <td style="text-align: left;display:block;min-width:150px;border-right: 0;border-bottom: 0;border-left: 0;" class="image">
                                                        <div class="img-btn">
                                                            <span style="float:left; margin-left:5px;"> 数据内容</span>
                                                        </div>
                                                    </td>
                                                    <td class="image">
                                                        <?php
                                                            echo '<pre>';
                                                            print_r($log_info->input);
                                                            echo '</pre>';
                                                        ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <!--价格/一级处e-->
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="1" name="id">

                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    


    <!-- END PAGE CONTENT WRAPPER -->

    <!-- START THIS PAGE PLUGINS-->
    <script type='text/javascript'
            src='{{ asset('/assets/admin/themes/js/plugins/icheck/icheck.min.js') }}'></script>
    <script type="text/javascript"
            src="{{ asset('/assets/admin/themes/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>

    <!-- END THIS PAGE PLUGINS-->
    <!-- START THIS PAGE PLUGINS-->

    <script type='text/javascript' src="{{asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker-language.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <!-- END THIS PAGE PLUGINS-->
    <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/page/redpacket.js') }}"></script>
    <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/jquery.noty.js') }}'></script>
    <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/center.js') }}'></script>
    <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/topCenter.js') }}'></script>
    <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/themes/default.js') }}'></script>


@endsection
