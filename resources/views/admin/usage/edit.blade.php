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
        <div class="vertical-box-column" ng-app="app">
            <div class="vertical-box" ng-controller="findController">
                <div class="vertical-box-row">
                    <div class="vertical-box-cell">
                        <div class="vertical-box-inner-cell">
                            <div data-scrollbar="true" data-height="100%" class="wrapper" style="background:#FFF;">
                                <div class="panel panel-default" data-sortable-id="ui-widget-1">

                                    <form id="uploadForm" style="display: none">
                                        <input name='_token' class='hide' id='token'
                                               value='<?php echo e(csrf_token()); ?>'>
                                        <input type="hidden" name="type" value='1'/>
                                        <input type="file" multiple="multiple" id='uploadFile' name='img[]'>
                                    </form>

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

                                    <div  class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class='control-label col-md-2'>登记证编号</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.number"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车牌号码</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control"
                                                       ng-model="data.license_plate" type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">充装介质</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <select class="form-control" ng-model="data.product">
                                                    <option value="0">压缩天然气</option>
                                                    <option value="1">液化天然气</option>
                                                    <option value="2">液化石油气</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">使用单位</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.use_unit"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">车 种</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control" ng-model="data.car_brand"
                                                       type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">安装单位</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="" name="" class="form-control"
                                                       ng-model="data.install_unit" type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">日期</label>

                                            <div class="col-md-6 col-xs-12 p_top2">
                                                <input id="install_date" name="" class="form-control datepicker"
                                                       ng-model="data.install_date" type="text"/>
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
    </div>
    </div>
    <script type="text/javascript" src="/assets/plugins/printArea/jquery.PrintArea.js"></script>
    <link href="/assets/plugins/printArea/printArea.css" rel="stylesheet"/>


    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src='/assets/plugins/jquery-validate/jquery.validate.js'></script>


    <script type="text/javascript">
        $('body').on("click",'#print1',function(){
            $("#printContent1").printArea();
        })
        $('body').on("click",'#print2',function(){
            $("#printContent2").printArea();
        })


        var imgType;
        var uploadFile = function () {
            var formData = new FormData($("#uploadForm")[0]);
            $.ajax({
                url: '../../admin/registration/upload',  //server script to process data
                type: 'POST',
                //Ajax事件
                success: function (data) {
                    if (data.code == 0) {
                        var type = imgType;
                        addImg(data.data.imgs, type);
                        console.log(imgType);
                    }
                },
                error: function () {
                    console.log('error');
                },
                // Form数据
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            });
        };


        var app = angular.module('app', []);
        app.controller('findController', function ($scope) {
            $("#license_plate").select2({
                placeholder: "请输入车牌号码超找",
                allowClear: true,
                ajax:{
                    url:function(params){
                        console.log(params);
                        return '../../admin/registration/name?license_plate='+params.term
                    },
                    processResults:function(data){
                        var dataArray=[];
                        if(data){
                            for(var i = 0 ;i < data.data.length;i++){
                                dataArray.push({id:data.data[i].license_plate,text:data.data[i].license_plate});
                            }
                        }
                        return {
                            results:dataArray
                        }

                    }
                }
            });

            var obj = ['压缩天然气', '液化天然气', '液化石油气'];
            $scope.getSelect = function (key) {

                return obj[key];
            };


            $scope.upload = function (action) {
                imgType = action;
                $("#uploadFile").click();
            };
            $("#uploadFile").on("change", function (e) {
                uploadFile();
            });
            $scope.imgs ={};
            addImg = function (data, type) {
                $scope.$apply(function () {
                    $scope.imgs[type] = data;
                })
            }

            $scope.search = function () {
                var license_plate =$("#license_plate").val();
                if (!license_plate) return
                $.ajax({
                    url: "../../admin/registration/index",
                    type: 'get',
                    data: {license_plate: license_plate},
                    success: function (data) {
                        $scope.$apply(function () {
                            $scope.data = data.data;
                            console.log($scope.data);
                        })
                    }
                })
            }


            $scope.save = function(){
                var data = {};
                data.number = $scope.data.registration.number;
                data.images = $scope.imgs;
                data._token = $("#token").val();
                $.ajax({
                    url:"../../admin/registration/newfillpermit",
                    type:'post',
                    data:data,
                    success:function(data){

                    },
                    error:function(data){

                    }
                })
            }
        });

    </script>

@endsection
