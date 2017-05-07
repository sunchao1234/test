@extends('admin.layout')
@section('content')
<!-- PAGE CONTENT WRAPPER -->

<section>
    <div class="notfoundpanel">
        {{--<h1>{{$code}}</h1>--}}
        <h3><font style="color: @if($code >= 200) #00a8c6 @else red @endif">{{$msg}}</font></h3>
        <h4><span id="time_id">5</span>秒中后自动跳转...</h4>
        {{--<form action="index.html">--}}
            {{--<div class="input-group mb15">--}}
                {{--<input type="text" class="form-control" placeholder="Search here">--}}
                {{--<span class="input-group-btn">--}}
                  {{--<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-search"></i></button>--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<hr class="darken">--}}
        {{--<ul class="list-inline">--}}
            {{--<li><a href="notfound.html">Home</a></li>--}}
            {{--<li><a href="notfound.html">About</a></li>--}}
            {{--<li><a href="notfound.html">Privacy Policy</a></li>--}}
            {{--<li><a href="notfound.html">Terms of Use</a></li>--}}
            {{--<li><a href="notfound.html">Contact Us</a></li>--}}
            {{--<li class="pull-right">Quirk &copy; 2015. All Rights Reserved.</li>--}}
        {{--</ul>--}}
    </div>
</section>

{{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
        {{--<div class="error-container">--}}
            {{--<div class="error-code">{{$code}}</div>--}}
            {{--<div class="error-text"><font style="color: @if($code >= 200) #00a8c6 @else red @endif">{{$msg}}</font></div>--}}
            {{--<div class="error-subtext"> 5秒中后自动跳转...</div>--}}
            {{--<div class="error-actions">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '{{{url($action)}}}';">点击返回</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<script type='text/javascript' src="{{ asset('/assets/admin/themes/js/plugins/icheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
<!-- END PAGE CONTENT WRAPPER -->
<script>
    jQuery(document).ready(function() {
        var href = "{{url($action)}}" ;
        var time = 5;
        setInterval(function(){
            time --;
            $("#time_id").html(time);
            if(time == 0) window.location.href = href;
        },1000);
    });
</script>
@endsection
