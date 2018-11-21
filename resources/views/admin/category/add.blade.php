@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类目名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('name'))
                    <input type="text" class="input-text" name="name" value="{{old('name')}}">
                    <strong style="color: red;">{{$errors->first('name')}}</strong>
                @else
                    <input type="text" class="input-text" name="name">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>套餐1是否可选：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="package1" type="radio" value="1" id="package1-1">
                    <label for="package1-1">是</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="package1-2" value="0" name="package1" checked>
                    <label for="package1-2">否</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>套餐2是否可选：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="package2" type="radio" value="1" id="package2-1">
                    <label for="package2-1">是</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="package2-2" value="0" name="package2" checked>
                    <label for="package2-2">否</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类目描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($errors->has('describe'))
                    <textarea name="describe" class="textarea">{{old('describe')}}</textarea>
                    <strong style="color: red">{{$errors->first('describe')}}</strong>
                @else
                    <textarea name="describe" class="textarea"></textarea>
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