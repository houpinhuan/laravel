@extends('admin.layouts.content')

@section('content')
    <article class="page-container">
        <form class="form form-horizontal" id="form-user-update" method="post" action="">
            {{csrf_field()}}

            @inject('area', 'App\Services\AreaService')
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">省：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="select-box" name="provinceId" value="@if(!empty($res[2])){{$res[2]}}@endif" disabled>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">市：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="select-box" name="cityId" value="@if(!empty($res[1])){{$res[1]}}@endif" disabled>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">区县：</label>
                <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="select-box" name="districtId" value="@if(!empty($res[1])){{$res[0]}}@endif" disabled>

                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>代理用户编号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="agencyuserId" id="agencyuserId" size="1">
                        <option value="">------- 请选择 --------</option>
                        @foreach($id as $value)
                            <option value="{{ $value->id }}" @if($data->agencyuserId==$value->id) selected @endif>{{ $value->id }}</option>
                        @endforeach
                    </select>
                </span>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
                <div class="radio-box">
                    <input name="status" value="0" type="radio" id="status-1" @if($data->status==0) checked @endif>
                    <label for="status-1">删除</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="status-2" name="status" value="1" @if($data->status==1) checked @endif>
                    <label for="status-2">正常</label>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否锁定：</label>
                <div class="radio-box">
                    <input name="lock" value="0" type="radio" id="lock-1" @if($data->lock==0) checked @endif>
                    <label for="lock-1">否</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="lock-2" name="lock" value="1" @if($data->lock==1) checked @endif>
                    <label for="lock-2">是</label>
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
        $(function() {
            if ("{{session('status')}}" != "") {
                layer.msg("{{ session('status') }}", {icon: 1, time: 2000}, function () {
                    var index = parent.layer.getFrameIndex(window.name);
                    // 刷新
                    parent.window.location = parent.window.location;
                    parent.layer.close(index);
                });
            }
        })
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
@endsection