@extends('admin.layouts.app')

@section('content')

    <div class="page-container">
        <form class="form form-horizontal" id="form-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>企业资讯id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data->id) ? $data->id : '' }}" placeholder="企业资讯id">
                </div>
            </div>
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>企业id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="enterprise_id" name="enterprise_id" type="text" class="input-text"
                           value="{{ isset($enterprise->id) ? $enterprise->id : '' }}" placeholder="企业id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>企业名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="enterprise_name" name="enterprise_name" type="text" class="input-text"
                           value="{{ isset($enterprise->name) ? $enterprise->name : '' }}" placeholder="企业名称" disabled>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关联资讯：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 250px;">
                    <select id="zx_id" name="zx_id" class="select" size="1">
                        @foreach($zxs as $zx)
                            <option value="{{$zx->id}}" {{$zx->id == $data->zx_id ? 'selected':''}}>{{$zx->title}}</option>
                        @endforeach
                    </select>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>展示顺序：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="seq" name="seq" type="number" class="input-text" style="width: 250px;"
                           value="{{ isset($data->seq) ? $data->seq : '0' }}" placeholder="值越大越靠前">
                    <span class="ml-15 c-999">值越大越靠前</span>
                </div>
            </div>
            <div class="row cl mt-20">
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
            $("#form-edit").validate({
                rules: {},
                onkeyup: false,
                focusCleanup: true,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/enterprise/zx/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg('保存成功', {icon: 1, time: 1000});
                                setTimeout(function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    parent.layer.close(index);
                                }, 500)
                            } else {
                                layer.msg(ret.message, {icon: 2, time: 1000});
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            layer.msg('保存失败', {icon: 2, time: 1000});
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