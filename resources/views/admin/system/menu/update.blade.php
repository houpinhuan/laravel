@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>菜单名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('name'))
                    <input type="text" class="input-text" name="name" value="{{old('name')}}">
                    <strong style="color: red;">{{$errors->first('name')}}</strong>
                @else
                    <input type="text" class="input-text" name="name" value="{{ $data->name }}">
                @endif
            </div>
        </div>

        @inject('menu', 'App\Services\MenuService')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">上一级：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="pid" size="1">
                        <option value="0">无上级菜单</option>
                        @foreach($menu->getParentList(Auth::guard('admin')->user()->rid) as $value)
                        <option value="{{ $value->id }}" {{old('pid') == $value->id ? 'selected="selected"' : ($data->pid == $value->id ? 'selected="selected"' : '') }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>链接：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('action'))
                    <input type="text" class="input-text" name="action" value="{{old('action')}}">
                    <strong style="color: red;">{{$errors->first('action')}}</strong>
                @else
                    <input type="text" class="input-text" name="action" value="{{ $data->action }}">
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>样式：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('class'))
                    <textarea name="describe" class="textarea">{{old('class')}}</textarea>
                    <strong style="color: red">{{$errors->first('class')}}</strong>
                @else
                    <textarea name="class" class="textarea">{{ $data->class }}</textarea>
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