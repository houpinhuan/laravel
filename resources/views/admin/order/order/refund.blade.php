@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="margin-top:10px;height: 100px">
        <tr>
            <td width="80px">备注信息:</td>
            <td>{{$data[0]->remark}}</td>
        </tr>
        @if(!empty($handlingfee))
            <tr>
                <td>违约金:</td>
                <td>{{$handlingfee}}</td>
            </tr>
        @endif
        <tr>
            <td>退款额度:</td>
            <td>{{$data[0]->refundamount}}</td>
        </tr>
        @if(!empty($canceltime))
        <tr>
            <td width="110px">订单取消时间:</td>
            <td>{{$canceltime}}</td>
        </tr>
        @endif
        @if(!empty($refundtime))
        <tr>
            <td width="110px">订单退款时间:</td>
            <td>{{$refundtime}}</td>
        </tr>
        @endif
    </table>
</article>
@endsection
