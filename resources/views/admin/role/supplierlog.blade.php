@extends('admin.layout')
@section('content')
<!-- PAGE CONTENT WRAPPER -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-settings font-green-haze"></i>
                    <span class="caption-subject bold uppercase">供应商日志</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <form id="layoutmod_list_form mb5" name="layoutmod_list_form" action="{{action('Admin\RoleController@getSupplierlog')}}" method="get">
                <div class="panel-body" style="padding:0px;padding-bottom:15px;">
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control select" id='type' name="type">
                                <option value="">日志类型</option>
                                <!--
                                <?php foreach($log_type_arr as $kt=>$vt):?>
                                <option value="<?php echo $kt;?>" ><?php echo $vt;?></option>
                                <?php endforeach;?>
                                -->
                                <?php foreach($log_type_arr as $kt=>$vt):?>
                                <?php if($vt['child_name']){?>
                                    <optgroup label="<?php echo $vt['menu_name'];?>">
                                        <?php foreach($vt['child_name'] as $ck=>$cv):?>
                                            <option value="<?php echo $ck;?>" <?php echo ($input['type'] == $ck) ? 'selected' : '';?>><?php echo $cv;?></option>
                                        <?php endforeach;?>
                                    </optgroup>
                                <?php }else{?>
                                    <option value="<?php echo $kt;?>" <?php echo ($input['type'] == $ck) ? 'selected' : '';?>><?php echo $vt['menu_name'];?></option>
                                <?php }?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
                            <input type="text" id='keywords' name="keywords" value="<?php echo !empty($input['keywords']) ? $input['keywords'] : '';?>" class="form-control" placeholder="关键字" />
                        </div>
                    </div>
                    <div style="padding-left: 0px;">
                        <span style="float: left;background-color: #fff; border-color:none;border-radius:0px;color:#000;padding: 4px 15px;line-height: 20px; font-weight:400;font-size: 14px;margin-left: 14px;">时间:</span>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px; margin-left:14px;">
                        <input id="start_time" name="start_time" class="form-control" placeholder="请输开始入时间" type="text" value="{{$params['start_time']}}" />
                    </div>
                    <div style="padding: 0px;">
                        <span style="float: left;background-color: #fff; border-color:none;border-radius:0px;color:#000;padding: 5px 10px 5px 0px;line-height: 20px; font-weight:400;font-size: 14px;">-</span>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px; ">
                        <input id="end_time" name="end_time" class="form-control" placeholder="请输入结束时间" type="text" value="{{$params['end_time']}}" />
                    </div>
                    <div class="col-md-1" style="padding-left: 0px;margin-right: 5px;">
                        <button class="btn btn-primary pull-left" id="search_submit"><i class="fa fa-search"></i>搜索</button>
                    </div>  
                </div>
            </form>
            <div class="panel-body" style=" padding-top: 0px;padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">操作人</th>
                            <th class="text-center">操作记录</th>
                            <th class="text-center">操作时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($log_list as $key => $value) { ?>
                            <tr class="onePurchase_list_form_id_<?php echo $value->id; ?>"> <!-- class="info" -->
                                <td class="text-center"><?php echo $value->id; ?></td>
                                <td class="text-center"><?php echo $value->email; ?></td>
                                <td class="text-center"><?php echo $value->log; ?></td>
                                <td class="text-center"><?php echo date('Y-m-d H:i:s', $value->create_time); ?></td>
                                <td class="text-center">
                                    <a target="_blank" href="/admin/role/logdetail/<?php echo $value->id; ?>/supplierlog" class="btn btn-info btn-rounded"> <i class="fa fa-pencil"></i> 查看</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-body" style=" padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
                <div class="btn-group pull-left"></div>
                <div class="btn-group pull-right">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable1_paginate">
                        {!! $log_list->appends($input)->render()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

    <link rel="stylesheet" href="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/icheck/icheck.min.js') }}'></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- END THIS PAGE PLUGINS-->
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/jquery.noty.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/center.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/layouts/topCenter.js') }}'></script>
<script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/noty/themes/default.js') }}'></script>
<script>
jQuery(document).ready(function() {
    jQuery("#start_time").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',weekStart: 1,language: 'zh-CN'});
    jQuery("#end_time").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',weekStart: 1,language: 'zh-CN'});
});
</script>
@endsection
