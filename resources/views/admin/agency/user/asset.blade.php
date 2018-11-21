@extends('admin.layouts.content')

@section('content')
    <article class="page-container">
        <table style="height: 150px">
            <tr>
                <td>余额:</td>
                <td>{{$data->balance}}</td>
            </tr>
            <tr>
                <td width="100px">余额（冻结）:</td>
                <td>{{$data->freezebalance}}</td>
            </tr>
            <tr>
                <td>是否锁定:</td>
                <td>@if($data->lock==0)否@else是@endif</td>
            </tr>
        </table>
    </article>
@endsection
