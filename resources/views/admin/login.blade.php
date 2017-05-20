<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>杭州市车用气瓶注册登记信息查询登陆</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">-->
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="/assets/img/IMG_0091.JPG" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> 杭州市车用气瓶注册登记信息查询系统</h4>
                    <p>
                        {{--快抢车 Pay 管理后台 由杭州快抢车网络科技 技术支持.--}}
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> 登陆中心
                        {{--<small>车 用 气 瓶 管 理 后 台</small>--}}
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
 
                <div class="login-content">

                    <form action="/admin/login/submit" id="login-form" method="POST" class="margin-bottom-0">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group m-b-15 " for="user_name">
                            <input type="text" class="form-control input-lg" id="user_name" name="user_name" placeholder="邮箱 / 手机号" />
                        </div>

                        <div class="form-group m-b-15">
                            <input type="password" class="form-control input-lg"  id="password" name="password" placeholder="密码"/>
                        </div>

                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" name="remember" value="1" /> 记住账号
                            </label>
                        </div>

                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">登 录</button>
                        </div>

                        <div class="m-t-20 m-b-10 p-b-10">
                            忘记密码请联系管理员
                            
                        </div>

                        <div class="alert alert-info in_info" id="name-success" style="display: none;" ><h4><i class="fa fa-info-circle"></i> 提示</h4>
                            <p class="submit_success"></p>
                        </div>

                        <div class="alert alert-danger  in_error" id="name-error" style="display: none;" ><h4><i class="fa fa-info-circle"></i> 提示</h4>
                            <p class="submit_error"></p>
                        </div>

                        <div class="alert alert-warning in_warning" id="name-warning" style="display: none;" ><h4><i class="fa fa-info-circle"></i> 提示</h4>
                            <p class="submit_warning">加载中...</p>
                        </div>

                        <hr />

                        <p class="text-center text-inverse">
                            &copy;ERP All Right Reserved 2017
                        </p>

                    </form>

                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/jquery-validate/jquery.validate.js"></script>
    <script src="/assets/plugins/jquery-validate/localization/messages_zh.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();

            var Login = function() {
                var handleLogin = function() {
                    var form1    = $('#login-form');
                    var error1   = $('.in_error');
                    var success1 = $('.in_info');
                    var warning  = $('.in_warning')
                    $('#login-form').validate({
                        errorElement: 'span',
                        errorClass:   'help-block help-block-error',
                        focusInvalid: false,
                        ignore: "",
                        rules: {
                            user_name: {
                                required: true,
                                rangelength:[1, 64]
                            },
                            password:{
                                required:true,
                                rangelength:[1, 16]
                            }
                        },

                        invalidHandler: function (event, validator) {},

                        highlight: function (element) { // hightlight error inputs
                            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                        },

                        unhighlight: function (element) { // revert the change done by hightlight
                            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                        },

                        success: function (label) {
                            $('.submit_error').html('');
                            error1.hide();
                            warning.hide();
                        },

                        submitHandler: function (form) {
                            error1.hide();
                            var param = $("#login-form").serialize();
                            var url   = $('#login-form').attr('action');
                            success1.hide();
                            error1.hide();
                            warning.show();
                            $.ajax({
                                url: url,
                                type: "post",
                                dataType: "json",
                                data:param,
                                success : function(result) {
                                    if(result.code == 200){
                                        error1.hide();
                                        warning.hide();
                                        $('.submit_success').html('验证成功 等待进入！');
                                        success1.show();
                                        setTimeout(function(){
                                            location.href = "/admin";},
                                        2000);
                                    }else{
                                        $('.submit_error').html(result.msg);
                                        error1.show();
                                        success1.hide();
                                        warning.hide();
                                    }
                                    return false;
                                },
                            });
                            return false;
                        }
                    });

                    $('#login-form input').keypress(function(e) {
                        if (e.which == 13) {
                            if ($('#login-form').validate().form()) {
                                $('#login-form').submit();
                            }
                            return false;
                        }
                    });
                };

                return {
                    init: function() {
                        handleLogin();
                    }
                };
            }();
            Login.init();
		});
	</script>
</body>
</html>
