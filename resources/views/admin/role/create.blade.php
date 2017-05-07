@extends('admin.layout')
@section('content')
<div class="vertical-box">
    <div class="vertical-box-column width-200">
        <div class="vertical-box">
            <div class="wrapper"  style="background:#D9DEE4;color:#000;font-size: 14px;">
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
                                                <a href="{{url($menu_value->url)}}" >{{$menu_value->mod_name}}</a>
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

                                <div class="panel-heading"  style="background: #ffffff;">
                                    <div class="panel-heading-btn">
                                        <a href="{{url('admin/role/create')}}" class="btn  btn-sm  btn-success"><i class="fa fa-plus"></i> 创建用户 </a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    </div>
                                    <h4 class="panel-title">
                                        @foreach ($menu as $value)
                                            @if(!isset($value->menu))
                                                @if(ucwords($value->controller_name).'Controller' == $controller_name) {{$value->mod_name}} @endif 
                                            @else
                                            @if(ucwords($value->controller_name).'Controller' == $controller_name) {{$value->mod_name}} @endif
                                            @endif
                                        @endforeach
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <form id="validate" role="form" name="create_form" class="form-horizontal form-bordered" action="@if(!$user_list){{action('Admin\RoleController@postCreate')}}@else{{action('Admin\RoleController@postEdit')}}@endif" method="post"  enctype="multipart/form-data">
        <div class="form-body">
                <!-- 默认开启了 csrf验证 非POST请求token必须加  -->
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label class='control-label col-md-2'>用户名</label>
                        <div class="col-md-6 col-xs-12 p_top2">


                            <input id="user_name" name="user_name"  class="form-control"  @if($user_list) {{'disabled'}}  @endif
                                   value="{{$user_list['user_name']}}" type="text"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-2">邮箱</label>
                        <div class="col-md-6 col-xs-12 p_top2">
                            <input id="email" name="email" type="text" value="{{$user_list['email']}}"
                                     class="form-control"/>
                            {{--value="{{$user_list['email']}}"--}}

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">密码</label>
                        <div class="col-md-6 col-xs-12 p_top2">
                            <input id='password' name='password' type="password"  value=""  class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">用户昵称</label>
                        <div class="col-md-6 col-xs-12 p_top2">
                            <input id="nick_name" name="nick_name" value="{{$user_list['nick_name']}}" type="text" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">手机号</label>
                        <div class="col-md-6 col-xs-12 p_top2">
                            <input id="phone" name="phone" type="text" value="{{$user_list['phone']}}"   class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">性别</label>
                        <div class="col-md-6 col-xs-12 p_top10">
                          <label class="rdiobox rdiobox-primary">
                            <input type="radio" name="sex"  value="1" <?php if($user_list['sex'] == 1){ ?>  checked="checked" <?php } ?> >
                            <span>男</span>
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2"></label>
                        <div class="col-md-6 col-xs-12 p_top2">
                          <label class="rdiobox rdiobox-primary">
                            <input type="radio" name="sex"  value="2" <?php if($user_list['sex'] == 2){ ?>  checked="checked" <?php } ?>>
                            <span>女</span>
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">权限</label>
                        <div class="col-md-4 col-xs-12 p_top2">
                            <select    name='role_id'  class="form-control select2">
                                @foreach($group_data as $value)
                                <option <?php if($user_list['group_id'] == $value['role_group_id']){?> selected="selected" <?php } ?> value="{{$value['role_group_id']}}">{{$value['role_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="form-group" id='hide_role_id' @if(!$role_data) style=" display: none;" @endif >--}}
                        {{--<label class="control-label col-md-2"> </label>--}}
                        {{--<div class="col-md-4 col-xs-12 p_top2">--}}
                            {{--<select  id='role_id'  name='role_id' class="form-control">--}}
                             {{----}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group ">
                        <label class="control-label col-md-2">备注</label>
                        <div class="col-md-6 col-xs-12  p_top5">
                            <textarea id='des' name='des' class="form-control" rows="5">{{$user_list['des']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">头像</label>
                        <div class="col-md-6 col-xs-12  p_top3">
                            <input type="file" class="fileinput btn-primary"  name="icon_file" id="icon_file" title="选择图片"/>
                            @if($role_data)
                                <span class="file-input-name">{{$user_list['avatar_name']}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">状态</label>
                        <div class="col-md-6 col-xs-12  p_top10">
                          <label class="ckbox ckbox-primary">
                            <input type="checkbox" @if($user_list['status'] == 0) checked="checked" @endif value="0" ><span>是否启用</span>
                          </label>
                        </div>
                    </div>

            <input type="hidden" name="id" value="{{$user_list['id']}}" readonly="readonly" />

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



        <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>
        

        <script type="text/javascript">

            {{--$('#group_id').change(function(){--}}
                {{--$("#role_id").empty();--}}
                {{--$("#role_id").append("<option value=''>选择角色</option>");--}}
                {{--var  group_id = $("#group_id").val();--}}
                {{--if(!group_id){ $("#hide_role_id").hide(); return false; }--}}
                {{--var parame = {--}}
                    {{--url:"{{url('admin/role/create/')}}/"+group_id,--}}
                    {{--type:'get',--}}
                    {{--dataType:"json",--}}
                {{--};--}}
                {{--$.ajax(parame).done(function(data){--}}
                    {{--$("#hide_role_id").show();--}}
                    {{--for(var i=0; i<data.length;i++) {--}}
                        {{--$("#role_id").append("<option value='"+data[i].role_group_id+"'>"+data[i].role_name+"</option>");--}}
                    {{--}--}}
{{--//                    $('#role_id').selectpicker('refresh');--}}
                {{--});--}}
            {{--});--}}
            // 判断中文字符
            jQuery.validator.addMethod("isChinese", function(value, element) {
                 return this.optional(element) || /^[\u0391-\uFFE5]+$/.test(value);
            }, "只能纯中文字符。");
            // 手机号码验证
            jQuery.validator.addMethod("isMobile", function(value, element) {
              var length = value.length;
              return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
            }, "请正确填写您的手机号码。");

            var validate = $("#validate").validate({
                ignore: [],
                submitHandler: function(form){//表单提交句柄,为一回调函数，带一个参数：form = this
                    form.submit();//提交表单
                },
                rules: {
                        user_name:{
                            required:true,
                            minlength:1
                        },
                        nick_name: {
                                required: true,
                                isChinese:true,
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

                        phone:{
                            required: true,
                            isMobile:true
                        },

                        email: {
                                required: true,
                                email: true
                        },
                        @if(!$user_list)
                            icon_file:{
                                required: true,
                                filetype: ["gif", "jpg", "jpeg"]
                            }
                        @endif
                    }
                });


        </script>

@endsection
