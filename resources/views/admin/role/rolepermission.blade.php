@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light form-fit">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-calendar"></i>
                    <span class="caption-subject  bold uppercase"> 编辑权限</span>
                    <label style="font-size: 14px;font-style: normal;"><i>全选</i> &nbsp;<input onclick="checkAll()" style="margin-top: 5px" type="checkbox" id="checkall"></label>
                    <span class="caption-helper"> class...</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="validate" role="form" name="edit_permission_form" class="form-horizontal" action="{{ action('Admin\RoleController@postRolepermission')}}" method="post"  enctype="multipart/form-data">
                    <div class="form-body">
                        <!-- 默认开启了 csrf验证 非POST请求token必须加  -->
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group-separated" style="padding-left: 10px;padding-top: 10px;">

                            <div class="row">

                                @foreach($mod_data as $key => $value)
                                @if($key == 0 && $value['parent_id'] == 0)
                                <div class="col-lg-12" id="mod_{{$value['mod_id']}}">
                                    <h4 class="page-header"><label >
                                        <div class="md-checkbox">
                                            <input type="checkbox" checked  id="checkbox{{$value['mod_id']}}" name="mod_id[]"  value="{{$value['mod_id']}}"  class="md-check">
                                            <label for="checkbox{{$value['mod_id']}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            {{$value['mod_name']}} </label>
                                        </div></label></h4>
                                    <p>
                                        @elseif($key != 0 && $value['parent_id'] == 0)
                                    </p>
                                </div>
                                <div class="col-lg-12 pmod2" id="mod_{{$value['mod_id']}}">
                                    <h4 class="page-header"><label >
                                        <div class="md-checkbox">
                                            <input type="checkbox" @if(in_array($value['mod_id'], $role_mod_data)) checked @endif id="checkbox{{$value['mod_id']}}" name="mod_id[]"  value="{{$value['mod_id']}}"  class="md-check pmod22">
                                            <label for="checkbox{{$value['mod_id']}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            {{$value['mod_name']}} </label>
                                        </div>
                                    </label></h4>
                                    <p>
                                        @else
                                    </p>
                                        <a class="col-lg-2"><label  style="color: #000;">
                                            <div class="md-checkbox">
                                                <input type="checkbox" @if(in_array($value['mod_id'], $role_mod_data)) checked @endif id="checkbox{{$value['mod_id']}}" name="mod_id[]"  value="{{$value['mod_id']}}"  class="child_mod md-check">
                                                <label for="checkbox{{$value['mod_id']}}">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                {{$value['mod_name']}} </label>
                                            </div></label></a>
                                        @endif
                                        @endforeach
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="role_id" value="{{$role_id}}" readonly="readonly" />
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
    var validate = $("#validate").validate({
        ignore: [],
        submitHandler: function(form){//表单提交句柄,为一回调函数，带一个参数：form = this
            form.submit();//提交表单
        },
        rules: {
        }
    });
    //全选设置
    function checkAll(){
        var checkall = document.getElementById('checkall');
        var form_mod_id  = document.forms['edit_permission_form'].elements['mod_id[]'];
        var len   = form_mod_id.length;
        if(checkall.checked == true){
            for(var i =0; i<len; i++){
                form_mod_id[i].checked = true;
            }
        }else{
            for(var i =0; i<len; i++){
                form_mod_id[i].checked = false;
            }
        }
    }

    function checkPart(Obj){
        // var div_input = Obj.getElementsByTagName('input');
        // console.log(div_input);
        // var len       = div_input.length;
        // console.log(div_input);
        // if(div_input[0].checked == true){
        //     for(var i=1; i<len; i++){
        //         div_input[i].checked = "true";
        //         div_input[i].style.cssText = "background-position:-114px -260px";
        //
        //
        //     }
        // }else{
        //     for(var i=1; i<len; i++){
        //         div_input[i].checked = false;
        //         div_input[i].style.cssText = "background-position:0;";
        //     }
        // }
    }

    function checkPart22(){

    }
    $(function(){
        $(".child_mod").on('click',function(){
            if ($(this).parents('.pmod2').find('.pmod22').prop('checked')) {
            }else{
                $(this).parents('.pmod2').find('.pmod22').attr("checked", true);
            }
        });
    });

</script>

@endsection
