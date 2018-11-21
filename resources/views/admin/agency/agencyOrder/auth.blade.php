@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form method="post" action="">
        {{csrf_field()}}
        <table style="height: 200px">
            <tr>
                <td width="80px">地址名称:</td>
                <td>{{$data->area->name}}</td>
            </tr>
            <tr>
                <td>联系人:</td>
                <td>{{$data->contact}}</td>
            </tr>
            <tr>
                <td>手机号码:</td>
                <td>{{$data->mobile}}</td>
            </tr>
            <tr>
                <td style="color: red">审核状态:</td>
                <td>
                    <div class="radio-box">
                        <input name="status" value="9" type="radio" id="status-1">
                        <label for="status-1">通过</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="status-2" name="status" value="0">
                        <label for="status-2">删除</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;"></td>
            </tr>
        </table>
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