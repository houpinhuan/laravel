@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <strong style="color: #000000">基本信息</strong>
    <table style="height: 200px">
        @if($category)
        <tr>
            <td>服务类目:</td>
            <td>
                @foreach($category as $val)
                    {{$val['name']}}
                @endforeach
            </td>
        </tr>
        @endif
        <tr>
            <td>工位:</td>
            <td>{{$data[0]->station}}</td>
        </tr>
        <tr>
            <td>营业日:</td>
            <td>{{$data[0]->workday}}</td>
        </tr>
        <tr>
            <td width="110px">营业开始时间:</td>
            <td>{{$data[0]->starttime}}</td>
        </tr>
        <tr>
            <td>营业结束时间:</td>
            <td>{{$data[0]->endtime}}</td>
        </tr>
        <tr>
            <td>所在位置:</td>
            <td>{{$str}}</td>
        </tr>
    </table>
    <strong style="color: #000000">评分信息</strong>
    <table style="height: 200px">
        <tr>
            <td>评分总数:</td>
            <td>{{$count[0]->scoreamount}}</td>
        </tr>
        <tr>
            <td>评分次数:</td>
            <td>{{$count[0]->scoretimes}}</td>
        </tr>
        <tr>
            <td>环境评分总量:</td>
            <td>{{$count[0]->environmentmount}}</td>
        </tr>
        <tr>
            <td width="130px">环境评分总次数:</td>
            <td>{{$count[0]->environmenttimes}}</td>
        </tr>
        <tr>
            <td>服务评分总数:</td>
            <td>{{$count[0]->servermount}}</td>
        </tr>
        <tr>
            <td>服务评分总次数:</td>
            <td>{{$count[0]->servertimes}}</td>
        </tr>
    </table>
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