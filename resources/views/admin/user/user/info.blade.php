@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <strong style="color: #000000">用户背景图</strong>
    <div style="margin: 10px 0px 10px 0px">
        @if($banner)<img src="{{$banner}}" height="100px">
        @else 无
        @endif
    </div>
    <strong style="color: #000000">基本信息</strong>
        <table style="margin-top: 10px;height: 200px">
            @if($user[0]->role==1)
                <tr>
                    <td>生日:</td>
                    <td>{{$user[0]->birthday}}</td>
                </tr>
                <tr>
                    <td>爱好:</td>
                    <td>{{$user[0]->hobby}}</td>
                </tr>
                <tr>
                    <td>职业:</td>
                    <td>{{$user[0]->job}}</td>
                </tr>
                <tr>
                    <td>发长:</td>
                    <td>{{$user[0]->hairstyle}}</td>
                </tr>
                <tr>
                    <td>脸型:</td>
                    <td>{{$user[0]->faceture}}</td>
                </tr>
            @endif
            @if($user[0]->role==2)
                <tr>
                    <td>生日:</td>
                    <td>{{$user[0]->birthday}}</td>
                </tr>
                <tr>
                    <td>个人介绍:</td>
                    <td>{{$user[0]->selfIntroduction}}</td>
                </tr>
            @endif
            <tr>
                <td width="70px">所在位置:</td>
                <td>@if(!empty($str)){{$str}}@endif</td>
            </tr>
    </table>
    <strong style="color: #000000">用户资产</strong>
    <table style="margin-top: 10px;">
            <tr>
                <td>余额:</td>
                <td>{{$asset[0]->balance}}</td>
            </tr>
            <tr>
                <td>余额（冻结）:</td>
                <td>{{$asset[0]->freezebalance}}</td>
            </tr>
            <tr>
                <td>虚拟余额:</td>
                <td>{{$asset[0]->virtual}}</td>
            </tr>
            <tr>
                <td width="130px">虚拟余额（冻结）:</td>
                <td>{{$asset[0]->freezevirtual}}</td>
            </tr>
            <tr>
                <td>是否锁定:</td>
                <td>@if($asset[0]->lock==0)否@else是@endif</td>
            </tr>
    </table>
    <strong style="color: #000000">邀请码</strong>
    <div style="margin: 10px 0px 10px 0px">{{$code}}</div>
</article>
@endsection

