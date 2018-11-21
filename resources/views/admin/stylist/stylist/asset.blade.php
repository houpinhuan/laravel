@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="height: 150px">
        <tr>
            <td>余额:</td>
            <td>{{$data[0]->balance}}</td>
        </tr>
        <tr>
            <td>余额（冻结）:</td>
            <td>{{$data[0]->freezebalance}}</td>
        </tr>
        <tr>
            <td>虚拟余额:</td>
            <td>{{$data[0]->virtual}}</td>
        </tr>
        <tr>
            <td width="130px">虚拟余额（冻结）:</td>
            <td>{{$data[0]->freezevirtual}}</td>
        </tr>
        <tr>
            <td>是否锁定:</td>
            <td>@if($data[0]->lock==0)否@else是@endif</td>
        </tr>
    </table>
</article>
@endsection
