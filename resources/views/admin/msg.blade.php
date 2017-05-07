<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- {if $url} -->
<meta http-equiv="refresh" content="{$time}; URL={$url}" />
<!-- {/if} -->
<title>{$home}{if $ur_here} - {$msg} {/if}</title>
<meta name="Copyright" content="Douco Design." />
<link href="/admin_assets/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/images/jquery.min.js"></script>
<script type="text/javascript" src="/images/global.js"></script>

<script type="text/javascript">
function go()
{
    window.history.go(-1);
}

setTimeout("go()",3000);

</script>

</head>
<body>

<div id="outMsg">
 <h2>{{$text}}</h2>
 <dl>
  <dt>{{$cue}}</dt>
  <dd>
      <a href="@if($url) {{$url}} @else javascript:history.go(-1); @endif">返回上一页</a>
  </dd>
 </dl>
</div>

</body>
</html>