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

                                    <form id="validate" role="form" name="create_form"
                                          class="form-horizontal form-bordered"
                                          action=""
                                          method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <!-- 默认开启了 csrf验证 非POST请求token必须加  -->

                                            <div class="form-group">
                                                <label class='control-label col-md-2'>登记证编号</label>

                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车牌号码</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">充装介质</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                   <select class="form-control">
                                                       <option>压缩天然气</option>
                                                       <option>液化天然气</option>
                                                       <option>液化石油气</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">使用单位</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">车 种</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">安装单位</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control" type="text"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2">安装单位</label>
                                                <div class="col-md-6 col-xs-12 p_top2">
                                                    <input id="" name="" class="form-control datepicker" type="text"/>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="panel-footer text-right">
                                            <button class="btn btn-primary pull-right" type="submit">保存</button>
                                        </div>
                                    </form>
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

    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>


    <script type="text/javascript">
        $('.datepicker').datepicker(
                {format:'yyyy-mm-dd'}
        );
        jQuery.validator.addMethod("isChinese", function (value, element) {
            return this.optional(element) || /^[\u0391-\uFFE5]+$/.test(value);
        }, "只能纯中文字符。");
        // 手机号码验证
        jQuery.validator.addMethod("isMobile", function (value, element) {
            var length = value.length;
            return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
        }, "请正确填写您的手机号码。");

        var validate = $("#validate").validate({
            ignore: [],
            submitHandler: function (form) {//表单提交句柄,为一回调函数，带一个参数：form = this
                form.submit();//提交表单
            },
            rules: {
                user_name: {
                    required: true,
                    minlength: 1
                },
                nick_name: {
                    required: true,
                    isChinese: true,
                    minlength: 2,
                    maxlength: 8
                },
                @if(!$user_list)
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 10
                },
                @endif

                phone: {
                    required: true,
                    isMobile: true
                },

                email: {
                    required: true,
                    email: true
                },
                @if(!$user_list)
                    icon_file: {
                    required: true,
                    filetype: ["gif", "jpg", "jpeg"]
                }
                @endif

            }
        });


    </script>

@endsection
