@extends('admin.layouts.content')

@section('css')
<link href="/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="/admin/public/check" method="post">
      {{csrf_field()}}
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input name="username" type="text" placeholder="账户" class="input-text size-L" value="@if(!empty($_COOKIE['username'])) {{$_COOKIE['username']}} @endif">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input name="password" type="password" placeholder="密码" class="input-text size-L" value="@if(!empty($_COOKIE['password'])) {{$_COOKIE['password']}} @endif">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe63f;</i></label>
        <div class="formControls col-xs-8">
          <input name="captcha" class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="" style="width:150px;">
          <img src="{{captcha_src()}}"> <a id="kanbuq" href="javascript:;">看不清，换一张</a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="1" @if(!empty($_COOKIE['username'])) checked="checked" @endif>
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
@endsection

@section('script')
<script type="text/javascript">
  //jQuery的载入事件
  $(function(){
    //给kanbuq绑定点击事件
    //获取验证码的地址
    var src = $('img').attr('src');
    $('#kanbuq').click(function(){
      //切换图片，为了避免缓存，添加随机数
      $('img').attr('src',src + '&_=' + Math.random());
    });


    @if (count($errors) > 0)
        //以javascript弹窗形式输出错误的内容
        var allError = '';
        @foreach ($errors->all() as $error)
            allError +="{{$error}}<br/>";
        @endforeach
        layer.alert(allError,{title:'错误信息',icon:'5'});
    @endif
  });
</script>
@endsection