@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>优惠券类型：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="type" type="radio" value="1" id="type-1" @if($data[0]->type==1)checked @endif>
                    <label for="type-1">满减</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="type-2" value="2" name="type" @if($data[0]->type==2)checked @endif>
                    <label for="type-2">折扣</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>领取限制方式：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="limited" size="1">
                            <option value="0" @if($data[0]->limited==0)selected @endif>数量</option>
                            <option value="1" @if($data[0]->limited==1)selected @endif>日</option>
                            <option value="2" @if($data[0]->limited==2)selected @endif>周</option>
                            <option value="3" @if($data[0]->limited==3)selected @endif>月</option>
                            <option value="4" @if($data[0]->limited==4)selected @endif>年</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>满足使用的金额：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="amount" value="{{$data[0]->amount}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>抵扣金额或者折扣：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="deduction" value="{{$data[0]->deduction}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>发放数量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="quantity" value="{{$data[0]->quantity}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效期开始：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="validstart" id="validstart" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d',maxDate:'#F{$dp.$D(\'validend\')}'})" class="input-text Wdate" style="width:170px;" value="{{$data[0]->validstart}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效期结束：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="validend" id="validend" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'validstart\')}'})" class="input-text Wdate" style="width:170px;" value="{{$data[0]->validend}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>可使用时间开始：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="usestart" id="usestart" onfocus="WdatePicker({dateFmt:'HH:mm'})" class="input-text Wdate" style="width:120px;" value="{{$data[0]->usestart}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>可使用时间结束：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="useend" id="useend" onfocus="WdatePicker({dateFmt:'HH:mm'})" class="input-text Wdate" style="width:120px;" value="{{$data[0]->useend}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>领取时间开始：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="receivestart" id="receivestart" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-%d',maxDate:'#F{$dp.$D(\'receiveend\')}'})" class="input-text Wdate" style="width:170px;" value="{{$data[0]->receivestart}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>领取时间结束：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="receiveend" id="receiveend" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'receivestart\')}'})" class="input-text Wdate" style="width:170px;" value="{{$data[0]->receiveend}}" required>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" value="1" id="status-1" @if($data[0]->status==1)checked @endif>
                    <label for="status-1">上架</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="status-2" value="0" name="status" @if($data[0]->status==0)checked @endif>
                    <label for="status-2">下架</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){
        //jQuery控制“可使用时间”表单项的动态显示和隐藏
        //给优惠券类型绑定切换事件
        //初始状态
        var val = $("input[name=type]:checked").val();
        if (val == 2) {
            $('#usestart,#useend').parents('.row').show();
        }else{
            $('#usestart,#useend').parents('.row').hide();
        }
        //改变单选框值
        $('input[name=type]').change(function(){
            var _val = $(this).val();
            if (_val == 2) {
                $('#usestart,#useend').val('');
                $('#usestart,#useend').parents('.row').show(500);
            }else{
                $('#usestart,#useend').val('');
                $('#usestart,#useend').parents('.row').hide(500);
            }
        });

        if ("{{session('status')}}" != ""){
            layer.msg("{{ session('status') }}", {icon: 1, time: 2000}, function () {
                var index = parent.layer.getFrameIndex(window.name);
                // 刷新
                parent.window.location = parent.window.location;
                parent.layer.close(index);
            });
        }
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection