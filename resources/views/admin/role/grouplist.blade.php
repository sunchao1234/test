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
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase">部门管理</span>
                <span class="caption-helper"></span>
            </div>
            <div class="actions">
                <a href="{{url('admin/role/creategroup')}}" class="btn btn-circle red-sunglo btn-sm">
                    <i class="fa fa-plus"></i> 创建部门 </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="user_list_form mb5" name="user_list_form" action="{{action('Admin\RoleController@getGrouplist')}}" method="get">
                <div class="panel-body" style="padding:0px;padding-bottom:15px;">
                 
                    <div class="col-md-2" style="padding-left: 0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
                            <input type="text" id="role_name" name="role_name" class="form-control" placeholder="部门名称">
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-left: 0px;">
                        <button class="btn btn-info" id="search_submit">搜索</button>
                    </div>
                </div>
            </form>
            <div class="panel-body" style=" padding-top: 0px;padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">部门名称</th>
                            <th class="text-center">角色组数量</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center"  weight="80px"  >操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['list_data'] as $key => $value) { ?>
                            <tr class="user_id_<?php echo $value['id']; ?>"> <!-- class="info" -->
                                <td class="text-center"><?php echo $value['role_group_id']; ?></td>
                                <td class="text-center"><?php echo $value['role_name']; ?></td>
                                <td class="text-center"><?php echo $value['role_number']; ?></td>
                                <td class="text-center"><?php echo date('Y-m-d H:i:s', $value['create_time']); ?></td>
                                <td class="text-center"  width="380px" >

                                    <div class="btn-group">
                                        <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            操作 <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="min-width: auto;">
                                            <li>
                                                <a href="/admin/role/groupedit/<?php echo $value['role_group_id']; ?>" >编辑</a>
                                            </li>
                                            <li>
                                                <a href="/admin/role/createrole/<?php echo $value['role_group_id']; ?>" > 添加角色</a>
                                            </li>
                                            <li>
                                                <a href="/admin/role/grouprole/<?php echo $value['role_group_id']; ?>"  > 角色列表</a>
                                            </li>
                                        </ul>
                                    </div>



                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-body" style=" padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <div class="btn-group pull-left">
                </div>
                <div class="btn-group pull-right">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable1_paginate">
                        {!! $data['list_obj']->appends($data['appends'])->render() !!}
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
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/jquery.noty.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/center.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/topCenter.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/themes/default.js') }}'></script>
@endsection
