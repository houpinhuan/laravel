@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账户：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('username'))
                    <input type="text" class="input-text" name="username" value="{{old('username')}}">
                    <strong style="color: red;">{{$errors->first('username')}}</strong>
                @else
                    <input type="text" class="input-text" name="username" value="{{ $data->username }}">
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('password'))
                    <input type="text" class="input-text" name="password" value="{{old('password')}}">
                    <strong style="color: red;">{{$errors->first('password')}}</strong>
                @else
                    <input type="text" class="input-text" name="password" value="">
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>真实名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('realname'))
                    <input type="text" class="input-text" name="realname" value="{{old('realname')}}">
                    <strong style="color: red;">{{$errors->first('realname')}}</strong>
                @else
                    <input type="text" class="input-text" name="realname" value="{{ $data->realname }}">
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('mobile'))
                    <input type="text" class="input-text" name="mobile" value="{{old('mobile')}}">
                    <strong style="color: red;">{{$errors->first('mobile')}}</strong>
                @else
                    <input type="text" class="input-text" name="mobile" value="{{ $data->mobile }}">
                @endif
            </div>
        </div>

        @inject('role', 'App\Services\RoleService')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('rid'))
                <span class="select-box">
                    <select class="select" name="rid" size="1">
                        <option value="">请选择</option>
                        @foreach($role->getList(Auth::guard('admin')->user()->rid) as $value)
                        <option value="{{ $value->id }}" {{old('rid') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
                <strong style="color: red;">{{$errors->first('rid')}}</strong>
                @else
                <span class="select-box">
                    <select class="select" name="rid" size="1">
                        <option value="">请选择</option>
                        @foreach($role->getList(Auth::guard('admin')->user()->rid) as $value)
                        <option value="{{ $value->id }}" {{$data->rid == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
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