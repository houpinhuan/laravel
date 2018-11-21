@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    @if(empty($auth[0]))
        <strong>该门店审核不通过或未审核</strong>
    @else
    <table style="height: 600px">
        <tr>
            <td>真实姓名:</td>
            <td>{{$auth[0]->realname}}</td>
        </tr>
        <tr>
            <td>门店名称:</td>
            <td>{{$data[0]->storename}}</td>
        </tr>
        <tr>
            <td>身份证号码:</td>
            <td>{{$auth[0]->cardno}}</td>
        </tr>
        <tr>
            <td>联系人:</td>
            <td>{{$data[0]->contact}}</td>
        </tr>
        <tr>
            <td>联系人手机号码:</td>
            <td>{{$data[0]->mobile}}</td>
        </tr>
        <tr>
            <td>营业证号码:</td>
            <td>{{$auth[0]->licenseno}}</td>
        </tr>
        <tr>
            <td>门店照片:</td>
            @if(!empty($attach[1]))
            <td><img src="{{$attach[1]}}" height="80px"></td>
            @else
            <td>无</td> @endif
        </tr>
        <tr>
            <td>营业执照:</td>
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
            <td>门店封面:</td>
            @if(!empty($attach[4]))
            <td><img src="{{$attach[4]}}" height="80px"></td>
            @else
            <td>无</td> @endif
        </tr>
        <tr>
            <td>门店环背景:</td>
            @if(!empty($attach[5]))
            <td><img src="{{$attach[5]}}" height="80px"></td>
            @else
            <td>无</td> @endif
        </tr>
    </table>
    @endif
</article>
@endsection
