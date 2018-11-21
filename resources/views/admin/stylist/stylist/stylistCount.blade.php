@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="height: 200px">
        <tr>
            <td>评分总量:</td>
            <td>{{$data[0]->scoreamount}}</td>
        </tr>
        <tr>
            <td>评分次数:</td>
            <td>{{$data[0]->scoretimes}}</td>
        </tr>
        <tr>
            <td>技能评分总量:</td>
            <td>{{$data[0]->skillmount}}</td>
        </tr>
        <tr>
            <td>技能评分总次数:</td>
            <td>{{$data[0]->skilltimes}}</td>
        </tr>
        <tr>
            <td>服务评分总量:</td>
            <td>{{$data[0]->servermount}}</td>
        </tr>
        <tr>
            <td width="120px">服务评分总次数:</td>
            <td>{{$data[0]->servertimes}}</td>
        </tr>
    </table>
</article>
@endsection
