@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-user-update" method="post" action="">
        {{csrf_field()}}

        @inject('area', 'App\Services\AreaService')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>省：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="provinceId" id="province" size="1">
                        <option value="">------- 请选择 --------</option>
                        @foreach($area->getProvinceList() as $value)
                        <option value="{{ $value->id }}" {{old('provinceId') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
                @if($errors->has('provinceId'))
                <strong style="color: red;">{{$errors->first('provinceId')}}</strong>
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>市：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="cityId" id="city" size="1">
                        <option value="">------- 请选择 --------</option>
                        @foreach($area->getCityList(0) as $value)
                        <option value="{{ $value->id }}" {{old('cityId') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>区县：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="districtId" id="district" size="1">
                        <option value="">------- 请选择 --------</option>
                        @foreach($area->getDistrictList(0) as $value)
                        <option value="{{ $value->id }}" {{old('districtId') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>代理用户编号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select class="select" name="agencyuserId" id="agencyuserId" size="1">
                        <option value="">------- 请选择 --------</option>
                        @foreach($data as $value)
                            <option value="{{ $value->id }}">{{ $value->id }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="radio-box">
                <input name="status" value="0" type="radio" id="status-1">
                <label for="status-1">删除</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="status-2" name="status" value="1">
                <label for="status-2">正常</label>
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
    var area = new Array();

    $(function(){
        if ("{{session('status')}}" != ""){
            layer.msg("{{ session('status') }}", {icon: 1, time: 2000}, function () {
                var index = parent.layer.getFrameIndex(window.name);
                // 刷新
                parent.window.location = parent.window.location;
                parent.layer.close(index);
            });
        }

        areaInit();

        $("#province").change(function (){
            resetCity($(this).val());
            resetDistrict("");
        });

        $("#city").change(function (){
            resetDistrict($(this).val());
        });

    });

    function areaInit() {
        @foreach($area->getList() as $value)
        area.push({id: "{{$value->id}}", name: "{{$value->name}}", parentId: "{{$value->parentId}}"});
        @endforeach
    }

    function resetCity(provinceId) {
        $("#city").empty();
        $("#city").append("<option value=\"\">------- 请选择 --------</option>");
        $.each(area, function (key, val) {
            if (provinceId == val.parentId)
            {
                $("#city").append("<option value=\"" + val.id + "\">" + val.name + "</option>");
            }
        });
    }

    function resetDistrict(cityId) {
        $("#district").empty();
        $("#district").append("<option value=\"\">------- 请选择 --------</option>");
        $.each(area, function (key, val) {
            if (cityId == val.parentId)
            {
                $("#district").append("<option value=\"" + val.id + "\">" + val.name + "</option>");
            }
        });
    }

</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection