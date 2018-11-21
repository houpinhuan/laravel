@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">美发师账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('username'))
                    <input type="text" class="input-text" value="{{old('username')}}" name="username">
                    <strong style="color: red">{{$errors -> first('username')}}</strong>
                @else
                    <input type="text" class="input-text" value="{{$data[0]->username}}" name="username">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">美发师密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('password'))
                    <input type="password" class="input-text"  name="password" value="{{old('password')}}">
                    <strong style="color: red">{{$errors -> first('password')}}</strong>
                @else
                    <input type="password" class="input-text"  name="password">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">确认密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('password_confirmation'))
                    <input type="password" class="input-text"  name="password_confirmation" value="{{old('password_confirmation')}}">
                    <strong style="color: red">{{$errors -> first('password_confirmation')}}</strong>
                @else
                    <input type="password" class="input-text"  name="password_confirmation">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">美发师手机号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('mobile'))
                    <input type="text" class="input-text" value="{{old('mobile')}}" name="mobile">
                    <strong style="color: red">{{$errors -> first('mobile')}}</strong>
                @else
                    <input type="text" class="input-text" value="{{$data[0]->mobile}}" name="mobile">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">个人介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="selfIntroduction" class="textarea">{{$data[0]->selfIntroduction}}</textarea>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>美发师状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" value="0" id="status-1" @if($data[0]->status==0) checked @endif>
                    <label for="status-1">正常</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="status-2" value="-1" name="status" @if($data[0]->status==-1) checked @endif>
                    <label for="status-2">禁止</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>美发师职位：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('position'))
                    <input type="text" class="input-text" value="{{old('position')}}" name="position">
                    <strong style="color: red">{{$errors -> first('position')}}</strong>
                @else
                    <input type="text" class="input-text" value="{{$position}}" name="position">
                @endif
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){
        if ("{{session('status')}}" != ""){
            layer.msg("{{ session('status') }}", {icon: 1, time: 2000}, function () {
                var index = parent.layer.getFrameIndex(window.name);
                // 刷新
                parent.window.location = parent.window.location;
                parent.layer.close(index);
            });
        }
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection