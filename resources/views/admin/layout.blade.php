<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh">
<!--<![endif]-->
<style>
	.width-200{
		display: none !important;
	}
</style>
<head>
	<meta charset="utf-8" />
	<title>杭州市车用气瓶注册登记信息查询系统</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />


	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->

	<script src="/assets/plugins/pace/pace.min.js"></script>
	<script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>

	<script src="/assets/plugins/angular/angular.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<style>
	.slimScrollDiv .centent_list{
		display: none;
	}
	.modal-backdrop{
		display: none;
	}
</style>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-content-full-height ">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header" style="background: #2d353c;">
					<a href="index.html" class="navbar-brand" style="background-color: #2d353c;width: auto"><span class="navbar-logo"></span>  杭州市车用气瓶注册登记信息查询系统</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group" style="display: none">
								<input type="text" class="form-control" placeholder="订单ID" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="/assets/img/user-13.jpg" alt="" /> 
							<span class="hidden-xs">{{$admin_info['info']['nick_name']}}</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="/admin/role/edit/{{$admin_info['info']['id']}}">个人设置</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('/admin/logout') }}">退出</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar ">
			
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				
				
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				
				<ul class="nav">
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					@foreach ($menu as $value)
                      	@if(!isset($value->menu))
							<li class="has-sub @if(ucwords($value->controller_name).'Controller' == $controller_name) active @endif ">
								<a href="{{ url("$value->url") }}">
									<i class="{{$value->fa_class}}"></i> 
									<span>{{$value->mod_name}}</span>
								</a>
							</li>
                      	@else
					  	<li class="has-sub @if(ucwords($value->controller_name).'Controller' == $controller_name) active @endif">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								@if ($value->fa_class)<i class="{{$value->fa_class}}"></i> @endif
								<span>{{$value->mod_name}}</span>
							</a>
							<ul class="sub-menu">
								@foreach ($value->menu as $menu_value)
									<li @if(strtolower($menu_value->url) == strtolower($ca_name) || strtolower($menu_value->url).'/index' == strtolower($ca_name)) class="active" @endif >
										<a href="{{url($menu_value->url)}}">{{$menu_value->mod_name}}</a>
									</li>
								@endforeach
							</ul>
						</li>
                    	@endif
                  	@endforeach

			        <!-- begin sidebar minify button 
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content  content-full-width">
			<!-- begin breadcrumb -->
			
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			
			<!--
			<h1 class="page-header">@foreach ($menu as $value) @foreach ($value->menu as $menu_value)@if(strtolower($menu_value->url) == strtolower($ca_name) || strtolower($menu_value->url).'/index' == strtolower($ca_name)) {{$menu_value->mod_name}} @endif @endforeach @endforeach</h1>
			-->
			<!-- ================== BEGIN BASE JS ================== -->
			<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
			<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
			<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
			<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="/assets/plugins/select2/dist/js/select2.full.min.js"></script>
			<script src="/assets/plugins/plupload/moxie.js"></script>
			<script src="/assets/plugins/plupload/plupload.dev.js"></script>

			<!--[if lt IE 9]>
				<script src="/assets/crossbrowserjs/html5shiv.js"></script>
				<script src="/assets/crossbrowserjs/respond.min.js"></script>
				<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
			<![endif]-->
			<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
			<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<!-- ================== END BASE JS ================== -->
			
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->

			<script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
			<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>

			<script src="/assets/js/apps.min.js"></script>
			<script src="/assets/app/common.js"></script>

			<!-- ================== END PAGE LEVEL JS ================== -->
			
			<script>
				$(document).ready(function() {
					App.init();
					
				});
			</script>
			<!-- end row -->
			@yield('content')
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	
</body>
</html>
