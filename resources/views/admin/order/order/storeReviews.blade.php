@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="height: 400px">
        <tr>
            <td width="80px">附加图片:</td>
            @if(!empty($attach[0]))
            <td>
                @foreach($attach as $val)
                <img src="{{$val->path}}" height="80px">
                @endforeach
            </td>
            @else<td>无</td>
            @endif
        </tr>
        <tr>
            <td>门店评价:</td>
            <td>@if($data[0]->starlevel==1)一星
                @elseif($data[0]->starlevel==2)二星
                @elseif($data[0]->starlevel==3)三星
                @elseif($data[0]->starlevel==4)四星
                @else五星@endif</td>
        </tr>
        <tr>
            <td>服务环境:</td>
            <td>@if($data[0]->environment==1)一星
                @elseif($data[0]->environment==2)二星
                @elseif($data[0]->environment==3)三星
                @elseif($data[0]->environment==4)四星
                @else五星@endif</td>
        </tr>
        <tr>
            <td>服务态度:</td>
            <td>@if($data[0]->attitude==1)一星
                @elseif($data[0]->attitude==2)二星
                @elseif($data[0]->attitude==3)三星
                @elseif($data[0]->attitude==4)四星
                @else五星@endif</td>
        </tr>
        <tr>
            <td>评论描述:</td>
            <td>{{$data[0]->describe}}</td>
        </tr>
        <tr>
            <td>回复评论:</td>
            <td>{{$data[0]->reply}}</td>
        </tr>
        <tr>
            <td>创建时间:</td>
            <td>{{$data[0]->createtime}}</td>
        </tr>
    </table>
</article>
@endsection
