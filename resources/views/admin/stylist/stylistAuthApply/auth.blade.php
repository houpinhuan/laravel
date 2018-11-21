@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form method="post" action="">
        {{csrf_field()}}
        <table style="height: 600px">
            <tr>
                <td>账号:</td>
                <td>{{$data->stylist->user->username}}</td>
            </tr>
            <tr>
                <td>昵称:</td>
                <td>{{$data->stylist->user->nickname}}</td>
            </tr>
            <tr>
                <td>真实姓名:</td>
                <td>{{$data->realname}}</td>
            </tr>
            <tr>
                <td>手机号码:</td>
                <td>{{$data->stylist->user->mobile}}</td>
            </tr>
            <tr>
                <td>性别:</td>
                <td>@if($data->stylist->user->gender==1)男@elseif($data->stylist->user->gender==2)女@else人妖@endif</td>
            </tr>
            <tr>
                <td>身份证号:</td>
                <td>{{$data->cardno}}</td>
            </tr>
            <tr>
                <td>备注:</td>
                <td>{{$data->remark}}</td>
            </tr>
            <tr>
                <td>身份证正面照:</td>
                @if(!empty($attach[1]))
                    <td><img src="{{$attach[1]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>身份证背面照:</td>
                @if(!empty($attach[2]))
                    <td><img src="{{$attach[2]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td width="130px">拥有者手持身份照:</td>
                @if(!empty($attach[3]))
                    <td><img src="{{$attach[3]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>技师封面:</td>
                @if(!empty($attach[4]))
                    <td><img src="{{$attach[4]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>技师背景照:</td>
                @if(!empty($attach[5]))
                    <td><img src="{{$attach[5]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>资质照:</td>
                @if(!empty($intelligence))
                    <td>
                        @foreach($intelligence as $val)
                        <img src="{{$val}}" height="80px">
                        @endforeach
                    </td>
                @else
                    <td>无</td> @endif
            </tr>
            @if($data->status != 0)
                <tr>
                    <td style="color: red">审核状态:</td>
                    <td>
                        @if($data->status == 1) 通过
                        @else驳回
                        @endif</td>
                </tr>
            @else
                <tr>
                    <td style="color: red">审核状态:</td>
                    <td>
                        <div class="radio-box">
                            <input name="status" value="1" type="radio" id="status-1">
                            <label for="status-1">通过</label>
                        </div>
                        <div class="radio-box">
                            <input type="radio" id="status-2" name="status" value="-1">
                            <label for="status-2">驳回</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;"></td>
                </tr>
            @endif
        </table>
    </form>
</article>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
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