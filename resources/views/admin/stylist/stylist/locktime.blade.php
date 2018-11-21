@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table>
        <tr>
            <td width="80px">锁定时间:</td>
            <td>{{$data}}</td>
        </tr>
    </table>
</article>
@endsection

