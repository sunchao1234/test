@extends('admin.layout')
@section('content')
<div class="vertical-box">

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
                                    <div class="panel-toolbar" style="border-bottom:1px solid #fff;padding: 10px 0px;">
                                        <form id="user_list_form mb5" name="user_list_form" action="{{action('Admin\RoleController@getIndex')}}" method="get">

                                            <div class="btn-group  col-md-2"  style="padding-left: 0px;">
                                                <label class="control-label m-r-10  m-t-10"> 设置分页</label>
                                                <select class="form-control" id="page_number" name="page_number" >
                                                    {{--<option value=""   >每页展示数</option>--}}
                                                    <?php foreach([10,20,50,100] as $key => $value){ ?>
                                                        <option value="{{$value}}" @if($data['appends']['page_number'] == $value)  selected="selected" @endif>{{$value}}</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="btn-group col-md-2  m-t-10" style="padding-left: 0px;">
                                                <label class="control-label"> 昵称</label>
                                                <input type="text" id="nick_name" name="nick_name" class="form-control" placeholder="">
                                            </div>
                                            {{--<div class="btn-group col-md-2 m-t-10" style="padding-left: 0px;">--}}
                                                {{--<label class="control-label"> 开始时间</label>--}}
                                                {{--<select class="form-control select" id='group_id' name="group_id">--}}
                                                    {{--<option value="-1">部门</option>--}}
                                                    {{--@foreach($data['group_data'] as $value)--}}
                                                        {{--@if($data['appends']['group_id'] && $data['appends']['group_id'] +0 == $value['role_group_id'])--}}
                                                            {{--<option selected value="{{$value['role_group_id']}}">{{$value['role_name']}}</option>--}}
                                                        {{--@else--}}
                                                            {{--<option value="{{$value['role_group_id']}}">{{$value['role_name']}}</option>--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{----}}
                                            {{--<div class="btn-group col-md-2 m-t-10" style="padding-left: 0px;">--}}
                                                {{--<label class="control-label"> 开始时间</label>--}}
                                                {{--<select class="form-control select" id='role_id' name="role_id">--}}
                                                    {{--@if($data['role_data'])--}}
                                                        {{--<option value="" id="role_data">选择角色</option>--}}
                                                        {{--@foreach($data['role_data'] as $val)--}}
                                                                {{--<option @if($data['appends']['role_id'] == $val['role_group_id']) selected @endif value="{{$val['role_group_id']}}">{{$val['role_name']}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            

                                            <div class="btn-group  col-md-2  m-t-10"  style="padding-left: 0px;">
                                                <div class="checkbox m-r-10 ">
                                                    <button class="btn btn-default m-r-5 m-b-5 m-t-10 btn-group" id="search_submit">搜索</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-bordered" style="background-color:#fff">
                                        <thead>
                                            <tr>
                                                <th class="text-center">账号</th>
                                                <th class="text-center">昵称</th>
                                                <th class="text-center">权限</th>
                                                <th class="text-center">账号状态</th>
                                                <th class="text-center">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['user_list_data'] as $key => $user_data) { ?>
                                                    <tr class="user_id_<?php echo $user_data['id']; ?>"> <!-- class="info" -->
                                                        <td class="text-center"><?php echo $user_data['user_name']; ?></td>
                                                        <td class="text-center"><?php echo $user_data['nick_name']; ?></td>
                                                        <td class="text-center">
                                                          <?php echo $user_data['hasRole']['role_name']; ?></td>
                                                    
                                                        <td class="text-center">
                                                            <?php if ($user_data['status']) { ?>
                                                                <span class="label label-danger">禁用</span>
                                                            <?php } else { ?>
                                                                <span class="label label-primary">正常</span>
                                                            <?php } ?>
                                                        </td>   
                                                        <td class="text-center">
                                                            <?php
                                                                if ($user_data['status']) {
                                                                    $status_class = 'btn btn-sm btn-warning btn-rounded';
                                                                    $status_name = '开启';
                                                                } else {
                                                                    $status_class = 'btn btn-sm btn-danger btn-rounded';
                                                                    $status_name = '禁用';
                                                                }
                                                            ?>
                                                            <a href="/admin/role/edit/<?php echo $user_data['id']; ?>" class="btn btn-sm btn-info btn-rounded"> <i class="fa fa-pencil"></i> 编辑</a>&nbsp;
                                                            <a href="javascript:;" onclick="disableUser(this)" id="<?php echo $user_data['id']; ?>" class="<?php echo $status_class; ?>"><i  class="fa fa-times"></i> <?php echo $status_name; ?> </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="panel-footer text-right">
                                        {!! $data['user_list_data']->appends($data['appends'])->render() !!}
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

<script>
    window.data = {!! json_encode($data,JSON_UNESCAPED_UNICODE) !!};
</script>

<script type='text/javascript' src='/assets/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='/assets/plugins/noty/layouts/center.js'></script>
<script type='text/javascript' src='/assets/plugins/noty/layouts/topCenter.js'></script>
<script type='text/javascript' src='/assets/plugins/noty/themes/default.js'></script>

<script>

    function disableUser(e){
        
        var submit_url = '/admin/role/disable/';
        var user_id    = $(e).attr('id');
        var url        = submit_url+user_id;
            noty({
            text: '确认是否提交操作？',
            layout: 'center',
            theme: 'defaultTheme',
            dismissQueue: true,
            modal: true,
            
            buttons: [
                    {addClass: 'btn btn-info mb-control', text: '提交', onClick: function($noty) {
                            $noty.close();
                            $.ajax({
                                type:'GET',
                                url:url,
                                dataType:"json",
                                success: function(data){
                                    if(data.code == 200){
                                        location.reload()
                                        if(data.status == 0)
                                            noty({text: '操作成功', layout: 'topCenter', type: 'success',timeout:2000});
                                        else
                                            noty({text: '操作成功', layout: 'topCenter', type: 'success',timeout:2000});
                                        return false;
                                    }else{
                                        if(data.status && data.status == 0)
                                            noty({text: '操作失败', layout: 'topCenter', type: 'error',timeout:2000});
                                        else
                                            noty({text: '操作失败', layout: 'topCenter', type: 'error',timeout:2000});
                                        return false;
                                    }
                                }
                            });
                        }
                    },
                    {addClass: 'btn btn-danger btn-clean', text: '取消', onClick: function($noty) {$noty.close();}}
                ]
        });
        return false;
    }
    if (jQuery) {
        jQuery(document).ready(function() {
            var Roles = function(){
                var UserList = function(){

                };
                
                var InitInput = function(){
                    var input = window.data['input'];
                    if(input['nick_name']){
                        $('#nick_name').val(input['nick_name']);
                    }
                    if(input['email']){
                        $('#email').val(input['email']);
                    }
                    if(input['sex']){
                        $('#sex').selectpicker('val',input['sex']);
                    }
                    if(input['status_time']){
                        $('#status_time').val(input['status_time']);
                    }
                    if(input['end_time']){
                        $('#end_time').val(input['end_time']);
                    }

                    return false;
                };
                var InitTime = function(){
                    $('#status_time').datepicker({format: 'yyyy-mm-dd',weekStart: 1,language: 'zh-CN',});
                    $('#end_time').datepicker({format: 'yyyy-mm-dd',weekStart: 1,language: 'zh-CN',});
                };
                var InitRoleData = function (){
                    //$("#hide_role_id").hide();
                    $('#group_id').change(function(){
                        $("#role_id").empty();
                        $("#role_id").append("<option value=''>选择角色</option>");
                        if(!$("#group_id").val()){
                            $("#hide_role_id").hide();
                            return false;
                        }
                        var parame = {
                            url:"/admin/role/create/"+$("#group_id").val(),
                            type:'get',
                            dataType:"json",
                        };
                        $.ajax(parame).done(function(data){
                            $("#hide_role_id").show();
                            var input = window.data['input'];
                            for(var i=0; i<data.length;i++) {
                                var selected = '';
                                $("#role_id").append("<option value='"+data[i].role_group_id+"'>"+data[i].role_name+"</option>");
                            }
                            
                        });
                    });
                };
                return {
                    init:function(){

                        $("#id_all").click(function(){
                            if(this.checked){
                                $("input[name='user_id[]']").each(function(){
                                    $('.user_id_'+$(this).val()).addClass("info");
                                    this.checked = true;
                                });
                            }else{
                                $("input[name='user_id[]']").each(function(){
                                    $('.user_id_'+$(this).val()).removeClass("info");
                                    this.checked = false;
                                });
                            }
                        });
                        $(".check_list").click(function(){
                            if(this.checked){
                                $(this).each(function(){
                                    $('.user_id_'+$(this).val()).addClass("info");
                                    this.checked = true;
                                });
                            }else{
                                $(this).each(function(){
                                    $('.user_id_'+$(this).val()).removeClass("info");
                                    this.checked = false;
                                });
                            }
                        });
                        InitRoleData();
                        InitInput();
                        InitTime();
                        UserList();
                    }
                }
            }();


            function var_dump(data){
                console.log(data);
            }
            Roles.init();
        });
    }
</script>
@endsection

