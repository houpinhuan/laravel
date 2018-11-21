@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="height: 150px">
        <tr>
            <td>描述:</td>
            <td>{{$description}}</td>
        </tr>
        <tr>
            <td width="80px">选项标题:</td>
            <td>@foreach($data as $value)
                {{$value['title']}}
                @endforeach</td>
        </tr>
        <tr>
            <td>选项内容:</td>
            <td>@foreach($data as $val)
                {{$val['content']}}
                @endforeach</td>
        </tr>
    </table>
</article>
@endsection
