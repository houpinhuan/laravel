@extends('admin.layouts.content')

@section('css')
     <!-- 引入webuploader的css文件 -->
    <link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
@endsection

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">用户账号：</label>
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
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户昵称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors -> has('nickname'))
                    <input type="text" class="input-text" value="{{old('nickname')}}" name="nickname">
                    <strong style="color: red">{{$errors -> first('nickname')}}</strong>
                @else
                    <input type="text" class="input-text" value="{{$data[0]->nickname}}" name="nickname">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">用户密码：</label>
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
            <label class="form-label col-xs-4 col-sm-3">手机号码：</label>
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
            <label class="form-label col-xs-4 col-sm-3">头像：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="uploader-demo">
                    <div id="fileList2" class="uploader-list">
                        <input type="hidden" name="attach3" value="{{$path}}">
                        <div id="WU_FILE_0" class="file-item thumbnail upload-state-done">
                            <img src="{{$path}}" style="height: 80px;">
                        </div>
                    </div>
                    <div id="filePicker2">选择图片</div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="role" size="1">
                            <option value="1" @if($data[0]->role == '1') selected='selected' @endif>用户</option>
                            <option value="2" @if($data[0]->role == '2') selected='selected' @endif>美发师</option>
                            <option value="3" @if($data[0]->role == '3') selected='selected' @endif>商户</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
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
<script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>
<script type="text/javascript" src="/statics/webuploader.js"></script>
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