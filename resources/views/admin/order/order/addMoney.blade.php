@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="height: 200px">
        <tr>
            <td>加价的金额:</td>
            <td>{{$data[0]->addmoney}}</td>
        </tr>
        <tr>
            <td width="100px">附加服务说明:</td>
            <td>{{$data[0]->adddesc}}</td>
        </tr>
        <tr>
            <td>描述:</td>
            <td>{{$data[0]->description}}</td>
        </tr>
        <tr>
            <td>创建时间:</td>
            <td>{{$data[0]->createtime}}</td>
        </tr>
    </table>
</article>
@endsection
