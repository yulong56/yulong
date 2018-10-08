@extends('admin.layouts.app')

@section('content')

    <div class="page-container">
        <form class="form form-horizontal" id="form-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data->id) ? $data->id : '' }}" placeholder="管理员id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>管理员：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text"
                           value="{{ isset($data->name) ? $data->name : '' }}" placeholder="请输入管理员姓名">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="grey-font">新建管理员的默认密码为Aa123456</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系电话：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="phonenum" name="phonenum" type="text" class="input-text"
                           value="{{ isset($data->phonenum) ? $data->phonenum : '' }}" placeholder="请输入联系电话">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系邮箱：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="email" name="email" type="text" class="input-text"
                           value="{{ isset($data->email) ? $data->email : '' }}" placeholder="请输入联系邮箱">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>头像：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="avatar" name="avatar" type="text" class="input-text"
                           value="{{ isset($data->avatar) ? $data->avatar : '' }}" placeholder="请输入头像网络连接地址">
                    <div id="container" class="margin-top-10">
                        <img id="pickfiles"
                             src="{{ isset($data->avatar) ? $data->avatar : URL::asset('/img/default_headicon.png') }}"
                             style="width: 120px;height: 120px;border-radius: 50%;">
                    </div>
                    <div style="font-size: 12px;margin-top: 10px;" class="text-gray">*请上传200*200尺寸图片</div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 200px;">
                        <input id="input-role" name="role" type="hidden" class="input-role" value="{{$data->role}}">
                    <select id="role" name="role" class="select" enterprises='{$enterprises}' farms='{$farms}' onchange="change_role(this)">
                        <option value="1" {{$data->role == "1"? "selected":""}}>超级管理员</option>
                        <option value="0" {{$data->role == "0"? "selected":""}}>运营人员</option>
                        <option value="2" {{$data->role == "2"? "selected":""}}>企业管理员</option>
                        {{--<option value="3" {{$data->role == "0"? "selected":""}}>企业运营人员</option>--}}
                        <option value="4" {{$data->role == "4"? "selected":""}}>农场管理员</option>
                        {{--<option value="5" {{$data->role == "0"? "selected":""}}>农场运营人员</option>--}}
                    </select>
                    </span>
                </div>
            </div>
            <div class="row cl" id="merchant-div" {{$user->role != "2" && $user->role != "4"  ? "hidden" : ""}}>
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span><span id="merchant_label">{{$user->role == "2" ? "企业：" : "农场："}}</span></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 200px;">
                    <select id="merchant_id" name="merchant_id" class="select">
                        @if($user->role == 2)
                        @foreach($enterprises as $m)
                            <option value="{{$m->id}}" {{$user->merchant_id == $m->id ? "selected" : ""}}>{{$m->name}}</option>
                        @endforeach
                        @elseif($user->role == 4)
                            @foreach($farms as $m)
                                <option value="{{$m->id}}" {{$user->merchant_id == $m->id ? "selected" : ""}}>{{$m->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    </span>
                </div>
            </div>
            <div class="row cl mt-20">
                <label class="form-label col-xs-4 col-sm-2"></label>
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

        function change_role(e) {
            var enterprises = e.getAttribute("enterprises")
            var farms = e.getAttribute("farms")
            let value = $("#role").val();
            $("#input-role").val(value);
            $("#merchant_id").empty();
            document.getElementById("merchant-div").hidden = (value !== "2" && value !== "4")

            if (value === "2") {
                $("#merchant_label").text("企业：");
                getEnterprises();
            } else {
                $("#merchant_label").text("农场：");
                getFarms();
            }
        }

        //获取企业列表
        function getEnterprises()
        {
            $.getJSON('/api/enterprise/getListByCon', '', function(data) {
                let enterprises = data.ret.data
                for (let i = 0; i < enterprises.length; i++) {
                    var option = $("<option>").val(enterprises[i].id).text(enterprises[i].name);
                    $("#merchant_id").append(option);
                }
            })
        }
        //获取农场列表
        function getFarms()
        {
            $.getJSON('/api/farm/getListByCon', '', function(data) {
                let farms = data.ret
                for (let i = 0; i < farms.length; i++) {
                    var option = $("<option>").val(farms[i].id).text(farms[i].name);
                    $("#merchant_id").append(option);
                }
            })
        }

        $(function () {
            //获取七牛token
            initQNUploader();
            $("#form-edit").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    phonenum: {
                        required: true,
                        isPhone: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    avatar: {
                        required: true,
                    }
                },
                onkeyup: false,
                focusCleanup: true,
                success: "valid",
                submitHandler: function (form) {
                    console.log("form:" + $(form));
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/admin/edit')}}",
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
                            layer.msg('保存失败', {icon: 1, time: 1000});
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
//                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#avatar").val(sourceLink);
                        $("#pickfiles").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
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