@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-organization-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="编号">
                </div>
            </div>


            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="green_house_id" name="green_house_id" type="text" class="input-text"
                           value="{{ isset($greenHouse['id']) ? $greenHouse['id'] : '' }}" placeholder="大棚id">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>土地编号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text"
                           value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入土地编号"
                           style="width: 250px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>排序：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="seq" name="seq" type="text" class="input-text"
                           value="{{ isset($data['seq']) ? $data['seq'] : '' }}" placeholder="请输入排序"
                           style="width: 250px;">
                    <span class="ml-10 c-999">排序，排序默认值为0，值越大越靠前</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>销售价格（元）：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="price" name="price" type="number" class="input-text"
                           value="{{ isset($data['price']) ? $data['price'] : '' }}" placeholder="请输入销售价格"
                           style="width: 250px;">
                </div>
            </div>
            {{--<div class="row cl">--}}
            {{--<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚名称：</label>--}}
            {{--<div class="formControls col-xs-8 col-sm-9">--}}
            {{--<span class="select-box" style="width: 250px;">--}}
            {{--<select id="green_house_id" name="green_house_id" class="select" size="1">--}}
            {{--@foreach($greenHouse as $greenHouse)--}}
            {{--<option value="{{$greenHouse->id}}" {{$greenHouse->id == $data->green_house_id ? 'selected':''}}>{{$greenHouse->name}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 250px;">
					    <div id="green_house_id" name="green_house_id" size="1">
                            <div value="{{$greenHouse->id}}" {{$greenHouse->id == $greenHouse->id ? 'selected':''}}>{{$greenHouse->name}}</div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>销售状态：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select id="sale_status" name="sale_status" class="select" style="width: 250px;">
                        <option value="0" {{$data->sale_status == "0"? "selected":""}}>销售中</option>
                        <option value="1" {{$data->sale_status == "1"? "selected":""}}>已销售</option>
                    </select>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存
                    </button>
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {


            $("#form-organization-edit").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/farm/houseLand/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                                setTimeout(function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    // parent.layer.close(index);
                                }, 1000)
                            } else {
                                layer.msg(ret.msg, {icon: 2, time: 2000});
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            layer.msg('保存失败', {icon: 2, time: 2000});
                            console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                            console.log("textStatus:" + textStatus);
                            console.log("errorThrown:" + errorThrown);
                        }
                    });
                }

            });
        });


    </script>
@endsection