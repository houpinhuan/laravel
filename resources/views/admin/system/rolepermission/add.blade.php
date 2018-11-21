@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}

        @inject('role', 'App\Services\RoleService')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="rid" size="1">
                        <option value="">请选择</option>
                        @foreach($role->getList(Auth::guard('admin')->user()->rid) as $value)
                        <option value="{{ $value->id }}" {{old('rid') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
                @if($errors->has('rid'))
                <strong style="color: red;">{{$errors->first('rid')}}</strong>
                @endif
            </div>
        </div>

        @inject('permission', 'App\Services\PermissionService')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="pid" size="1">
                        <option value="">请选择</option>
                        @foreach($permission->getList(Auth::guard('admin')->user()->rid) as $value)
                        <option value="{{ $value->id }}" {{old('pid') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
                @if($errors->has('pid'))
                <strong style="color: red;">{{$errors->first('pid')}}</strong>
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