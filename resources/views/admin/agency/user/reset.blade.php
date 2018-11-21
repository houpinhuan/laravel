@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form method="post" action="">
        {{csrf_field()}}
        <table style="height: 200px">
            <tr>
                <td width="80px">编号:</td>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <td>昵称:</td>
                <td>{{ $data->nickname }}</td>
            </tr>
            <tr>
                <td>手机号码:</td>
                <td>{{ $data->mobile }}</td>
            </tr>
            <tr>
                <td style="color: red">是否重置:</td>
                <td>
                    <div>
                        <input type="radio" id="status" name="status" value="1">
                        <label for="status-1">重置</label>
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