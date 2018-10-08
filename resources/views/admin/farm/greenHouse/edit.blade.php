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
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>农场id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="farm_id" name="farm_id" type="text" class="input-text"
                           value="{{ isset($farms['id']) ? $farms['id'] : '' }}" placeholder="农场id">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>农场名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 250px;">
					    <div id="farm_id" name="farm_id" size="1">
                            <div value="{{$farms->id}}" {{$farms->id == $farms->id ? 'selected':''}}>{{$farms->name}}</div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text"
                           value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入大棚名称">
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
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚图片：</label>
                <div id="container" class="formControls col-xs-8 col-sm-9">
                    <input id="img" name="img" type="text" class="input-text" style="width: 250px" readonly
                           value="{{ isset($data->img) ? $data->img : '' }}" placeholder="请选择大棚图片">
                    <span id="pickfiles" class="btn btn-primary radius upload-btn"><i
                                class="Hui-iconfont"></i> 上传图片</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div>
                        <img id="img_img"
                             {{--src="{{URL::asset('/img/upload.png')}}"--}}
                             src="{{ $data->img ? $data->img.'?imageView2/1/w/300/h/180/interlace/1/q/75|imageslim' : URL::asset('/img/upload.png')}}"
                             style="width: 300px;height: 180px;">
                    </div>
                    <div style="font-size: 12px;margin-top: 10px;" class="text-gray">*请上传650*350尺寸图片
                    </div>
                </div>
            </div>
            {{--<div class="row cl">--}}
            {{--<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>农场名称：</label>--}}
            {{--<div class="formControls col-xs-8 col-sm-9">--}}
            {{--<span class="select-box" style="width: 250px;">--}}
            {{--<select id="farm_id" name="farm_id" class="select" size="1">--}}
            {{--@foreach($farm as $farm)--}}
            {{--<option value="{{$farm->id}}" {{$farm->id == $data->farm_id ? 'selected':''}}>{{$farm->name}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>销售状态：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <select id="sale_status" name="sale_status" class="select" style="width: 250px;">
                        <option value="0" {{$data->sale_status == "0"? "selected":""}}>即将销售</option>
                        <option value="1" {{$data->sale_status == "1"? "selected":""}}>正在销售</option>
                        <option value="2" {{$data->sale_status == "2"? "selected":""}}>结束销售</option>
                    </select>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>大棚视频源：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="video" name="video" type="text" class="input-text"
                           value="{{ isset($data['video']) ? $data['video'] : '' }}" placeholder="请输入大棚视频源">
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

            //获取七牛token
            initQNUploader();
            $("#form-organization-edit").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    img: {
                        required: true,
                    },
                    video: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/farm/greenHouse/edit')}}",
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

        //初始化七牛上传模块
        function initQNUploader() {
            var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'pickfiles',         // 上传选择的点选按钮，必需
                container: 'container',//上传按钮的上级元素ID
                // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
                // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
                //    // do something
                //    return uptoken;
                // },
                get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                // downtoken_url: '/downtoken',
                // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                domain: 'http://twst.isart.me/',     // bucket域名，下载资源时用到，必需
                max_file_size: '100mb',             // 最大文件体积限制
                flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                max_retries: 3,                     // 上传失败最大重试次数
                dragdrop: true,                     // 开启可拖曳上传
                drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb',                  // 分块上传时，每块的体积
                auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                //x_vars : {
                //    查看自定义变量
                //    'time' : function(up,file) {
                //        var time = (new Date()).getTime();
                // do something with 'time'
                //        return time;
                //    },
                //    'size' : function(up,file) {
                //        var size = file.size;
                // do something with 'size'
                //        return size;
                //    }
                //},
                init: {
                    'FilesAdded': function (up, files) {
                        plupload.each(files, function (file) {
                            // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                        });
                    },
                    'BeforeUpload': function (up, file) {
                        // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                    },
                    'UploadProgress': function (up, file) {
                        // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                    },
                    'FileUploaded': function (up, file, info) {
                        // 每个文件上传成功后，处理相关的事情
                        // 其中info是文件上传成功后，服务端返回的json，形式如：
                        // {
                        //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                        //    "key": "gogopher.jpg"
                        //  }
                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#img").val(sourceLink);
                        $("#img_img").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
//                        console.log($("#pickfiles").attr('src'));
                    },
                    'Error': function (up, err, errTip) {
                        //上传出错时，处理相关的事情
                        console.log(err + errTip);
                    },
                    'UploadComplete': function () {
                        //队列文件处理完毕后，处理相关的事情
                    },
                    'Key': function (up, file) {
                        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                        // 该配置必须要在unique_names: false，save_key: false时才生效

                        var key = "";
                        // do something with key here
                        return key
                    }
                }
            });
        }


    </script>
@endsection