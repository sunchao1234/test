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
                                                <label class="control-label col-md-2">
                                                    合格证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <div>
                                                        <a ng-repeat="item in imgs[1]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" id="upload1" class='btn btn-info'>上传
                                                    </button>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    监督检验证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <div>
                                                        <a ng-repeat="item in imgs[2]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" class='btn  btn-info' ng-click="upload(2)">上传
                                                    </button>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    检验质量证明书证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <div>
                                                        <a ng-repeat="item in imgs[3]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" ng-click="upload(3)" class='btn btn-info'>上传
                                                    </button>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    特种设备监督检验证书
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <div>
                                                        <a ng-repeat="item in imgs[4]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" ng-click="upload(4)" class='btn btn-info'>上传
                                                    </button>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    汽车行驶证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <div>
                                                        <a ng-repeat="item in imgs[5]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" ng-click="upload(5)" class='btn btn-info'>上传
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
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" ng-click="upload(7)" class='btn btn-info'>上传
                                                    </button>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    运营证
                                                </label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <label for="isPerson" style='float:left'>是否为个人名字</label>
                                                    <input type='checkbox' ng-model="data.is_personal" name="isPerson"/>

                                                    <div ng-model="data.is_personal">
                                                        <a ng-repeat="item in imgs[6]" style="margin: 5px;float:left">
                                                            <img width="100px" ;height="100px">
                                                        </a>
                                                    </div>
                                                    <button type="button" ng-click="upload(6)" ng-if="data.is_personal"
                                                            class='btn btn-info'>
                                                        上传
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel-footer text-right">
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

    <script type="text/javascript" src="/assets/app/common.js"></script>

    <script type="text/javascript">

        //        $("#uploadFile").on('change',function(){
        //            console.log('sss');
        //        });
        var uploader = new plupload.Uploader({
            // General settings
            browse_button: 'upload1',
            url: "/admin/registration/upload",
            chunk_size : '1mb',


//         url: "/admin/registration/upload",
            flash_swf_url : '/assets/plugins/plupload/Moxie.swf',
            silverlight_xap_url : '/assets/plugins/plupload/Moxie.xap',
            // PreInit events, bound before the internal events
            multipart_params: {  //附加参数
            _token: "{{csrf_token()}}",
            type: 1
            },

            // Post init events, bound after the internal events
            init : {
                PostInit: function() {
                    // Called after initialization is finished and internal event handlers bound
                    log('[PostInit]');

//                    document.getElementById('uploadfiles').onclick = function() {
//                        uploader.start();
//                        return false;
//                    };
                },

                Browse: function(up) {
                    // Called when file picker is clicked
                    log('[Browse]');
                },

                Refresh: function(up) {
                    // Called when the position or dimensions of the picker change
                    log('[Refresh]');
                },

                StateChanged: function(up) {
                    // Called when the state of the queue is changed
                    log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
                },

                QueueChanged: function(up) {
                    // Called when queue is changed by adding or removing files
                    log('[QueueChanged]');
                },

                OptionChanged: function(up, name, value, oldValue) {
                    // Called when one of the configuration options is changed
                    log('[OptionChanged]', 'Option Name: ', name, 'Value: ', value, 'Old Value: ', oldValue);
                },

                BeforeUpload: function(up, file) {
                    // Called right before the upload for a given file starts, can be used to cancel it if required
                    log('[BeforeUpload]', 'File: ', file);
                },

                UploadProgress: function(up, file) {
                    // Called while file is being uploaded
                    log('[UploadProgress]', 'File:', file, "Total:", up.total);
                },

                FileFiltered: function(up, file) {
                    // Called when file successfully files all the filters
                    log('[FileFiltered]', 'File:', file);
                },

                FilesAdded: function(up, files) {
                    // Called when files are added to queue
                    log('[FilesAdded]');
                    uploader.start();
                    plupload.each(files, function(file) {
                        log('  File:', file);
                    });
                },

                FilesRemoved: function(up, files) {
                    // Called when files are removed from queue
                    log('[FilesRemoved]');

                    plupload.each(files, function(file) {
                        log('  File:', file);
                    });
                },

                FileUploaded: function(up, file, info) {
                    // Called when file has finished uploading
                    var data = JSON.parse(info.response);
//                    console.log(info.response);
                    log('[FileUploaded] File:', file, "Info:", info);
                },

                ChunkUploaded: function(up, file, info) {
                    // Called when file chunk has finished uploading
                    log('[ChunkUploaded] File:', file, "Info:", info);
                },

                UploadComplete: function(up, files) {
                    // Called when all files are either uploaded or failed
                    log('[UploadComplete]');
                },

                Destroy: function(up) {
                    // Called when uploader is destroyed
                    log('[Destroy] ');
                },

                Error: function(up, args) {
                    // Called when error occurs
                    log('[Error] ', args);
                }
            }
        });
        uploader.init();

        function log(){
            console.log('11');
        }

        {{--var uploader = new plupload.Uploader({--}}
            {{--browse_button: 'upload1',--}}
            {{--url: "/admin/registration/upload",--}}
            {{--flash_swf_url : '/assets/plugins/plupload/Moxie.swf',--}}
            {{--silverlight_xap_url : '/assets/plugins/plupload/Moxie.xap',--}}
            {{--filters: {--}}
{{--//                mime_types : [ //只允许上传图片--}}
{{--//                    { title : 'Image files', extensions : 'jpg,jpeg,png' }--}}
{{--//                ],--}}
{{--//                max_file_size:''--}}
            {{--},--}}
            {{--multipart_params: {  //附加参数--}}
                {{--_token: "{{csrf_token()}}",--}}
                {{--type: 1--}}
            {{--},--}}
            {{--unique_names: true,--}}
            {{--multi_selection: true--}}
        {{--});--}}

        {{--uploader.init();--}}
        {{--uploader.bind('FilesAdded', function (uploader, files) {--}}
            {{--uploader.start(); //开始上传--}}
        {{--});--}}

        {{--uploader.bind('UploadComplete', function(uploader, files){--}}
{{--//            $('#logo').html(uploaded_html);--}}
{{--//            uploaded_html = '';--}}
{{--//            $('#path').val(path);--}}
            {{--console.log('2222222');--}}
            {{--console.log('-------3333-------');--}}
            {{--console.log(files);--}}
            {{--uploader.files.length = 0;  //清空上传队列--}}
        {{--});--}}


        {{--uploader.bind('FileUploaded', function(uploader, file, res){--}}
            {{--console.log('---22-');--}}
            {{--var r = JSON.parse(res.response);--}}
            {{--var path = r.code;--}}
            {{--console.log(path);--}}
{{--//            uploaded_html = '<img width="100px;" src="/data/attachment/brand/' +  path + '" />';--}}
        {{--});--}}

        {{--uploader.bind('Error',function(){--}}
            {{--console.log('111111');--}}
        {{--});--}}


        {{--function fileUpdate(type) {--}}
            {{--$("#uploadFile").click();--}}
        {{--}--}}

    </script>

@endsection
