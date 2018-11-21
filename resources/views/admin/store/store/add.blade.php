@extends('admin.layouts.content')

@section('css')
    <link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
@endsection

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商户编号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('id_no'))
                    <input type="text" class="input-text" name="id_no" value="{{old('id_no')}}">
                    <strong style="color: red;">{{$errors->first('id_no')}}</strong>
                @else
                    <input type="text" class="input-text" name="id_no">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">商户账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('username'))
                    <input type="text" class="input-text" name="username" value="{{old('username')}}">
                    <strong style="color: red;">{{$errors->first('username')}}</strong>
                @else
                    <input type="text" class="input-text" name="username">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">商户密码：</label>
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
            <label class="form-label col-xs-4 col-sm-3">商户手机号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('user_mobile'))
                    <input type="text" class="input-text" name="user_mobile" value="{{old('user_mobile')}}">
                    <strong style="color: red;">{{$errors->first('user_mobile')}}</strong>
                @else
                    <input type="text" class="input-text" name="user_mobile">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商户性别：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="gender" size="1">
                            <option value="1">男</option>
                            <option value="2">女</option>
                            <option value="3">人妖</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商户状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="user_status" type="radio" value="0" id="user_status-1" checked>
                    <label for="user_status-1">正常</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="user_status-2" value="-1" name="user_status">
                    <label for="user_status-2">禁止</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>真实姓名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('realname'))
                    <input type="text" class="input-text" name="realname" value="{{old('realname')}}">
                    <strong style="color: red;">{{$errors->first('realname')}}</strong>
                @else
                    <input type="text" class="input-text" name="realname">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('cardno'))
                    <input type="text" class="input-text" name="cardno" value="{{old('cardno')}}">
                    <strong style="color: red;">{{$errors->first('cardno')}}</strong>
                @else
                    <input type="text" class="input-text" name="cardno">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>营业证号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('licenseno'))
                    <input type="text" class="input-text" name="licenseno" value="{{old('licenseno')}}">
                    <strong style="color: red;">{{$errors->first('licenseno')}}</strong>
                @else
                    <input type="text" class="input-text" name="licenseno">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>门店名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('storename'))
                    <input type="text" class="input-text" name="storename" value="{{old('storename')}}">
                    <strong style="color: red;">{{$errors->first('storename')}}</strong>
                @else
                    <input type="text" class="input-text" name="storename">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系人：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('contact'))
                    <input type="text" class="input-text" name="contact" value="{{old('contact')}}">
                    <strong style="color: red;">{{$errors->first('contact')}}</strong>
                @else
                    <input type="text" class="input-text" name="contact">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系人手机号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('mobile'))
                    <input type="text" class="input-text" name="mobile" value="{{old('mobile')}}">
                    <strong style="color: red;">{{$errors->first('mobile')}}</strong>
                @else
                    <input type="text" class="input-text" name="mobile">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>备注：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('remark'))
                    <textarea name="remark" class="textarea">{{old('remark')}}</textarea>
                    <strong style="color: red">{{$errors->first('remark')}}</strong>
                @else
                    <textarea name="remark" class="textarea"></textarea>
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>门店状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" value="1" id="status-1" checked>
                    <label for="status-1">正常</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="status-2" value="0" name="status">
                    <label for="status-2">禁止</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>营业执照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="uploader-demo">
                    <div id="fileList" class="uploader-list">
                        <input type="hidden" name="attach1">
                    </div>
                    <div id="filePicker">选择图片</div>
                    @if($errors->has('attach1'))
                        <strong style="color: red;">{{$errors->first('attach1')}}</strong>
                    @endif
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>拥有者手持身份照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="uploader-demo">
                    <div id="fileList1" class="uploader-list">
                        <input type="hidden" name="attach2">
                    </div>
                    <div id="filePicker1">选择图片</div>
                    @if($errors->has('attach2'))
                        <strong style="color: red;">{{$errors->first('attach2')}}</strong>
                    @endif
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