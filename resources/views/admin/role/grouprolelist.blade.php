@extends('admin.layout')
@section('content')


<div class="row">
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject bold uppercase">用户管理</span>
                <span class="caption-helper"></span>
            </div>
            <div class="actions">
                <a href="{{url('admin/role/creategroup')}}" class="btn btn-circle red-sunglo btn-sm">
                    <i class="fa fa-plus"></i> 创建角色组 </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="user_list_form mb5" name="user_list_form" action="{{action('Admin\RoleController@getGrouprole')}}" method="get">
                <div class="panel-body" style="padding:0px;padding-bottom:15px;">
                    <div class="col-md-1">
                        <div class="form-group ">
                            <select class="form-control select" id="page_number" name="page_number"  style="display: none;">
                                <option value=""   >每页展示数</option>
                                <option value="10" >每页10条</option>
                                <option value="20" >每页20条</option>
                                <option value="50" >每页50条</option>
                                <option value="100">每页100条</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
                            <input type="text" id="role_name" name="role_name" class="form-control" placeholder="角色组名称">
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
                            <th class="text-center">角色组名</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">角色人数</th>
                            <th class="text-center"  weight="80px"  >操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data['list_data'] as $key => $value) { ?>
                            <tr class="user_id_<?php echo $value['id']; ?>"> <!-- class="info" -->
                                <td class="text-center"><?php echo $value['role_group_id']; ?></td>
                                <td class="text-center"><?php echo $value['role_name']; ?></td>
                                <td class="text-center"><?php echo date('Y-m-d H:i:s', $value['create_time']); ?></td>
                                <td class="text-center"><?php echo $value['user_number']; ?></td>
                                <td class="text-center"  width="380px" >
                                    <a href="/admin/role/grouproleedit/<?php echo $value['role_group_id']; ?>" class="btn btn-primary btn-rounded"><i class="fa fa-search"></i> 编辑</a>&nbsp;
                                    <a href="/admin/role/rolepermission/<?php echo $value['role_group_id']; ?>" class="btn btn-info btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 编辑权限</a>&nbsp;
                                    <a href="/admin/role/?group_id=<?php echo $value['role_parent_id']; ?>&role_id=<?php echo $value['role_group_id']; ?>" class="btn btn-danger btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 用户列表</a>
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
<script>
    window.data = {!! json_encode($data,JSON_UNESCAPED_UNICODE) !!};
</script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/jquery.noty.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/center.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/topCenter.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/themes/default.js') }}'></script>

<script type="text/javascript" src="{{ asset('/back/js/page/group.js') }}"></script>
<!--<script>
    if (jQuery) {
        jQuery(document).ready(function() {
            CLASS.init();
        });
    }
</script>-->
@endsection