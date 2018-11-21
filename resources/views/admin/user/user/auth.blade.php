@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    @if(empty($data[0]))
        <strong>该用户审核不通过或未审核</strong>
    @else
        <table style="height: 600px">
            <tr>
                <td>真实姓名:</td>
                <td>{{$data[0]->realname}}</td>
            </tr>
            <tr>
                <td>账号:</td>
                <td>{{$data[0]->user->username}}</td>
            </tr>
            <tr>
                <td>昵称:</td>
                <td>{{$data[0]->user->nickname}}</td>
            </tr>
            <tr>
                <td>手机号码:</td>
                <td>{{$data[0]->user->mobile}}</td>
            </tr>
            <tr>
                <td>性别:</td>
                <td>@if($data[0]->user->gender==1)男@elseif($data[0]->user->gender==2)女@else人妖@endif</td>
            </tr>
            <tr>
                <td>身份证号码:</td>
                <td>{{$data[0]->cardno}}</td>
            </tr>
            <tr>
                <td>角色:</td>
                <td>@if($data[0]->user->role==1)用户@elseif($data[0]->user->role==2)美发师@else商户@endif</td>
            </tr>
            <tr>
                <td>头像:</td>
                @if(!empty($attach[1]))
                    <td><img src="{{$attach[1]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>背景图:</td>
                @if(!empty($attach[2]))
                    <td><img src="{{$attach[2]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>身份证正面照:</td>
                @if(!empty($attach[3]))
                    <td><img src="{{$attach[3]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td>身份证背面照:</td>
                @if(!empty($attach[4]))
                    <td><img src="{{$attach[4]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
            <tr>
                <td width="130px">拥有者手持身份照:</td>
                @if(!empty($attach[5]))
                    <td><img src="{{$attach[5]}}" height="80px"></td>
                @else
                    <td>无</td> @endif
            </tr>
        </table>
    @endif
</article>
@endsection

