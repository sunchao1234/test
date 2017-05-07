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
<div class="row">
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase">用户管理</span>
                <span class="caption-helper"></span>
            </div>
            <div class="actions">
                <a href="#" id="addMod" data-toggle="modal" data-target="#myModalMod" data-type="add" class="btn btn-circle red-sunglo btn-sm">
                    <i class="fa fa-plus"></i> 添加模块 </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body form"> 
            <div class="panel-body" style=" padding-top: 0px;padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>模块名称</th>
                            <th>控制器</th>
                            <th>方法</th>
                            <th>url</th>
                            <th>排序</th>
                            <th>fa_class</th>
                            <th>创建时间</th>
                            <th>是否导航</th>
                            <th class="text-center"  weight="80px"  >操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['mod_data'] as $value)
                        <tr id="trow_1">
                            <td class="text-center" >{{$value['mod_id']}}</td>
                            <td><strong>{{$value['html']}}├{{$value['mod_name']}}</strong></td>
                            <td id="I_controller_name">{{$value['controller_name']}}</td>
                            <td id="I_action_name">{{$value['action_name']}}</td>
                            <td id="I_url">{{$value['url']}}</td>
                            <td id="I">{{$value['menu_sort']}}</td>
                            <td>{{$value['fa_class']}}</td>
                            <td>{{date('Y-m-d H:i:s',$value['create_time'])}}</td>
                            <td id="I_is_show_menu">
                                @if($value['is_show_menu'] == 1)
                                <span class="label label-success">
                                    是
                                </span>
                                @else
                                <span class="label label-warning">
                                    否
                                </span>
                                @endif
                            </td>
                            <td width="110">
                                <button class="btn btn-default btn-rounded btn-sm updateMod" data-toggle="modal" data-target="#myModalMod" id="updateMod" value="{{$value['mod_id']}}" data-value="{{$value}}">
                                    <span class="fa fa-pencil"></span>
                                </button>

                                <button class="btn btn-danger btn-rounded btn-sm delMod"  onClick="deleteMod(this)" value="{{$value['mod_id']}}">
                                    <span class="fa fa-times"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-body" style=" padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <div class="btn-group pull-left"></div>
                <div class="btn-group pull-right">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable1_paginate">
                        {!! $data['mod_data']->appends($data['appends'])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalMod" tabindex="-1" role="dialog"
     aria-labelledby="myModalMod" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalModel">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="user_level_id" id="lab_user_level_id">模块名称</label>(必填)
                    <input type="text" class="form-control" name="mod_name" id="mod_name" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="new_user_level" id="lab_new_user_level">PARENT ID</label>(必填)
                    <input type="text" class="form-control" name="parent_id" id="parent_id" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="manually_note" id="lab_manually_note">控制器名称</label>(必填)
                    <input type="text" class="form-control" name="controller_name" id="controller_name" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="manually_note" id="lab_manually_note">方法名称</label>
                    <input type="text" class="form-control" name="action_name" id="action_name" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="manually_note" id="lab_manually_note">url</label>
                    <input type="text" class="form-control" name="url" id="url" value=""><br/>
                </div>
                <input type="hidden" name="mod_id" id="mod_id" value="">
                <div class="form-group">
                    <label for="manually_note" id="lab_manually_note">排序</label>
                    <input type="text" class="form-control" name="menu_sort" id="menu_sort" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="manually_note" id="lab_manually_note">fa_class</label>
                    <input type="text" class="form-control" name="fa_class" id="fa_class" value=""><br/>
                </div>
                <div class="form-group">
                    <label for="manually_note"  >是否导航</label>
                    <input type="radio" value="1" id="is_show_menu_0" name="is_show_menu">是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="0" id="is_show_menu_1" name="is_show_menu" checked>否
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="set_mod">提交</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.data = {!! json_encode($mod_data,JSON_UNESCAPED_UNICODE) !!};
    function clear_frm() {
        $("#mod_id") .val("");
        $("#mod_name").val("");
        $("#parent_id").val("");
        $("#controller_name").val("");
        $("#action_name").val("");
        $("#url").val("");
        $("#menu_sort").val("");
        $("#fa_class").val("");
    }

    function updatemod(mod_id){
        var mod_name = $("#mod_name").val();
        var parent_id = $("#parent_id").val();
        var controller_name = $("#controller_name").val();
        var action_name = $("#action_name").val();
        var url = $("#url").val();
        var menu_sort = $("#menu_sort").val();
        var fa_class = $("#fa_class").val();
        var is_show_menu_obj = document.getElementsByName("is_show_menu");
        var str_is_show_menu;
        for(var i=0; i<is_show_menu_obj.length; i++){
            if(is_show_menu_obj[i].checked)
                str_is_show_menu = is_show_menu_obj[i].value;
        }
        var is_show_menu = str_is_show_menu;
        if(mod_name == ''){
            noty({text: '请输入模块名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        if(parent_id == ''){
            noty({text: '请输入parent_id', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        if(controller_name == ''){
            noty({text: '请输入控制器名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        //                    if(action_name == ''){
        //                        noty({text: '请输入方法名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
        //                        return;
        //                    }
        //                    if(url == ''){
        //                        noty({text: '请输入url', layout: 'center', type: 'error', timeout: 2000, killer: true});
        //                        return;
        //                    }
        $.ajax({
            url: '/admin/role/modify',
            type: 'POST',
            dataType: 'json',
            data: {
                'mod_name': mod_name,
                'parent_id': parent_id,
                'controller_name': controller_name,
                'action_name': action_name,
                'url': url,
                'menu_sort': menu_sort,
                'fa_class' : fa_class,
                'is_show_menu': is_show_menu,
                'mod_id': mod_id
            },
            success: function (data) {
                if(data.code == 200){
                    noty({text: data.msg, layout: 'topCenter', type: 'success', timeout: 2000,killer:true});
                    window.location.href = window.location.href;
                }else{
                    noty({text: data.msg, layout: 'topCenter', type: 'error', timeout: 2000, killer: true});
                    window.location.href = window.location.href;
                }
            },
            error: function (data) {
                noty({text: '网络错误', layout: 'topCenter', type: 'error', timeout: 2000, killer: true});
                window.location.href = window.location.href;
            }
        });
    }

    function addmod(){
        var mod_name = $("#mod_name").val();
        var parent_id = $("#parent_id").val();
        var controller_name = $("#controller_name").val();
        var action_name = $("#action_name").val();
        var url = $("#url").val();
        var menu_sort = $("#menu_sort").val();
        var fa_class = $("#fa_class").val();
        var is_show_menu_obj = document.getElementsByName("is_show_menu");
        var str_is_show_menu;
        for(var i=0; i<is_show_menu_obj.length; i++){
            if(is_show_menu_obj[i].checked)
                str_is_show_menu = is_show_menu_obj[i].value;
        }
        var is_show_menu = str_is_show_menu;
        if(mod_name == ''){
            noty({text: '请输入模块名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        if(parent_id == ''){
            noty({text: '请输入parent_id', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        if(controller_name == ''){
            noty({text: '请输入控制器名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
            return;
        }
        //                    if(action_name == ''){
        //                        noty({text: '请输入方法名称', layout: 'center', type: 'error', timeout: 2000, killer: true});
        //                        return;
        //                    }
        //                    if(url == ''){
        //                        noty({text: '请输入url', layout: 'center', type: 'error', timeout: 2000, killer: true});
        //                        return;
        //                    }
        $.ajax({
            url: '/admin/role/addmod',
            type: 'POST',
            dataType: 'json',
            data: {
                'mod_name': mod_name,
                'parent_id': parent_id,
                'controller_name': controller_name,
                'action_name': action_name,
                'url': url,
                'menu_sort': menu_sort,
                'fa_class' : fa_class,
                'is_show_menu': is_show_menu,
            },
            success: function (data) {
                if(data.code == 200){
                    noty({text: data.msg, layout: 'topCenter', type: 'success', timeout: 2000,killer:true});
                    window.location.href = window.location.href;
                }else{
                    noty({text: data.msg, layout: 'topCenter', type: 'error', timeout: 2000, killer: true});
                    window.location.href = window.location.href;
                }
            },
            error: function (data) {
                noty({text: '网络错误', layout: 'topCenter', type: 'error', timeout: 2000, killer: true});
                window.location.href = window.location.href;
            }
        });
    }

    $(document).ready(function() {
        //添加权限
        $("#addMod").click(function() {
            clear_frm()
            $("#set_mod").click(function() {
                addmod();
            });
        });
        $(".updateMod").click(function() {
            mod_id = $(this).val();
            $("#mod_id").val(mod_id);
            var oInput = window.data[mod_id];
            $("#mod_id").val(oInput['mod_id']);
            $("#mod_name").val(oInput['mod_name']);
            $("#parent_id").val(oInput['parent_id']);
            $("#controller_name").val(oInput['controller_name']);
            $("#action_name").val(oInput['action_name']);
            $("#url").val(oInput['url']);
            $("#menu_sort").val(oInput['menu_sort']);
            $("#fa_class").val(oInput['fa_class']);
            var is_show_menu_obj = document.getElementsByName("is_show_menu");
            for(var i=0; i<is_show_menu_obj.length; i++){
                if(is_show_menu_obj[i].value == oInput['is_show_menu'])
                    is_show_menu_obj[i].checked = true;
            }

            $("#set_mod").click(function() {
                updatemod(mod_id);
            });
        });


    });

    function deleteMod(e){
        var mod_id = $(e).val();
        noty({
            text: '确定要删除吗?',
            layout: 'center',
            buttons: [
                {
                    addClass: 'btn btn-info mb-control', text: '确定', onClick: function ($noty) {
                        $noty.close();
                        $.ajax({
                            type: 'POST',
                            url: '/admin/role/del',
                            data: {'mod_id':mod_id},
                            dataType: "json",
                            success: function (data) {
                                if(data.code == 200){
                                    noty({text: data.msg,layout: 'topCenter', type: 'success', timeout:2000});
                                    window.location.href=window.location.href;
                                }else{
                                    noty({text: data.msg, layout: 'topCenter', type: 'error',timeout:2000});
                                    window.location.href=window.location.href;
                                }
                            },
                            error: function (data) {
                                noty({text: '网络错误', layout: 'topCenter', type: 'error', timerout:2000});
                                window.location.href=window.location.href;
                            }
                        });
                    }
                },
                {addClass: 'btn btn-danger btn-clean', text: '取消', onClick: function ($noty) {$noty.close();}}
            ]
        });
        return false;
    }

</script>

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src="{{asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker-language.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/jquery.noty.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/center.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/topCenter.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/themes/default.js') }}'></script>
<!-- END THIS PAGE PLUGINS-->

@endsection
