@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light form-fit">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-calendar"></i>
                    <span class="caption-subject  bold uppercase">@if(!$group_data_one) 创建部门 @else 编辑部门 @endif</span>
                    <span class="caption-helper"> class...</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="validate" role="form" name="create_form" class="form-horizontal form-bordered" action="@if($group_data_one->role_group_id){{ action('Admin\RoleController@postGroupedit')}}@else{{ action('Admin\RoleController@postCreategroup')}}@endif" method="post"  enctype="multipart/form-data">
                    <div class="form-body">
                            <!-- 默认开启了 csrf验证 非POST请求token必须加  -->
                                @if($group_data_one->role_group_id)
                                <input type="hidden" name="role_group_id" value="{{$group_data_one->role_group_id}}">
                                @endif
                                <div class="form-group">
                                    <label class="control-label col-md-2">部门名称</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input id='role_name' name='role_name' type="text"  value="@if($group_data_one->role_group_id){{$group_data_one->role_name}}@endif"  class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-md-2">部门描述</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea id='role_description' name='role_description' class="form-control" rows="5">@if($group_data_one->role_group_id){{$group_data_one->role_description}}@endif</textarea>
                                    </div>
                                </div>
                        <hr>
                        <div class="panel-footer" style= "height:80px;background-color:#fff;">
                            <button class="btn btn-primary pull-right" type="submit">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/validationengine/jquery.validationEngine.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/validationengine/languages/jquery.validationEngine-zh_CN.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/jquery-validation/jquery.validate.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/jquery-validation/localization/messages_zh.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/maskedinput/jquery.maskedinput.min.js') }}'></script>

<script type="text/javascript">

    // 判断中文字符
    jQuery.validator.addMethod("isChinese", function(value, element) {
        return this.optional(element) || /^[\u0391-\uFFE5]+$/.test(value);
    }, "只能纯中文字符。");


    var validate = $("#validate").validate({
        ignore: [],
        submitHandler: function(form){//表单提交句柄,为一回调函数，带一个参数：form = this
            form.submit();//提交表单
        },
        rules: {
            role_name: {
                required: true,
                isChinese:true,
            },
        }
    });

</script>

@endsection
