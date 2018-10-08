@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 企业资讯管理 <span
                class="c-gray en">&gt;</span> 企业资讯列表 <a class="btn btn-success radius r btn-refresh"
                                                        style="line-height:1.6em;margin-top:3px"
                                                        href="javascript:location.replace(location.href);"
                                                        title="刷新"
                                                        onclick="location.replace('{{URL::asset('/admin/enterprise/zx/index')}}?enterprise_id={{$enterprise->id}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="panel panel-primary">
            <div class="panel-header">企业信息</div>
            <div class="panel-body">

                <table class="table table-border table-bordered radius">
                    <tbody>
                    <tr>
                        <td rowspan="4" style="text-align: center;">
                            <img src="{{ $enterprise->img ? $enterprise->img : URL::asset('/img/upload.png')}}"
                                 style="width: 120px;height: 80px;">
                        </td>
                        <td>名称</td>
                        <td>{{isset($enterprise->name)?$enterprise->name:'--'}}</td>
                        <td>电话</td>
                        <td>{{isset($enterprise->phonenum)?$enterprise->phonenum:'--'}}</td>
                        <td>地址</td>
                        <td>{{isset($enterprise->address)?$enterprise->address:'--'}}</td>
                        <td>添加时间</td>
                        <td>{{$enterprise->created_at}}</td>
                    </tr>
                    <tr>
                        <td>省份</td>
                        <td>{{isset($enterprise->province)?$enterprise->province:'--'}}</td>
                        <td>城市</td>
                        <td>{{isset($enterprise->city)?$enterprise->city:'--'}}</td>
                        <td>经度</td>
                        <td>{{isset($enterprise->lon)?$enterprise->lon:'--'}}</td>
                        <td>维度</td>
                        <td>{{isset($enterprise->lat)?$enterprise->lat:'--'}}</td>

                    </tr>
                    <tr>
                        <td>视频源</td>
                        <td colspan="5">{{isset($enterprise->video)?$enterprise->video:'--'}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="enterprise_zx_add('关联资讯','{{URL::asset('/admin/enterprise/zx/edit')}}?enterprise_id={{$enterprise->id}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加企业资讯
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="9">资讯列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    <th width="40">ID</th>
                    <th width="150">封面</th>
                    <th width="150">标题</th>
                    <th width="50">类型</th>
                    <th width="50">发布机构</th>
                    <th width="50">排序</th>
                    <th width="90">创建时间</th>
                    <th width="50">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        {{--<td><input type="checkbox" value="1" name=""></td>--}}
                        <td>{{$data->zx->id}}</td>
                        <td>
                            <img src="{{ $data->zx->img ? $data->zx->img.'?imageView2/1/w/120/h/70/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                                 class="">
                        </td>
                        <td>{{$data->zx->title}}</td>
                        <td>{{$data->zx->zxType->name}}</td>
                        <td>{{$data->zx->author}}</td>
                        <td>{{$data->seq}}</td>
                        <td>{{$data->created_at}}</td>
                        <td class="td-status">
                            @if($data->zx->status=="1")
                                <span class="label label-success radius">已启用</span>
                            @else
                                <span class="label label-default radius">已禁用</span>
                            @endif
                        </td>
                        <td class="td-manage">
                            @if($data->zx->status=="1")
                                <a style="text-decoration:none" onClick="zx_stop(this,'{{$data->zx->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="zx_start(this,'{{$data->zx->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="enterprise_zx_edit('企业编辑','{{URL::asset('/admin/enterprise/zx/edit')}}?id={{$data->id}}&enterprise_id={{$enterprise->id}}',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="enterprise_zx_del(this,'{{$data->id}}')"
                               class="ml-5"
                               style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">


        $(function () {

        });

        //添加企业资讯
        function enterprise_zx_add(title, url, id) {
            console.log("enterprise_zx_add url:" + url);
            var index = layer.open({
                type: 2,
                area: ['600px', '300px'],
                fixed: false,
                maxmin: true,
                title: title,
                content: url
            });
        }

        //编辑企业资讯
        function enterprise_zx_edit(title, url, id) {
            console.log("enterprise_zx_edit url:" + url);
            var index = layer.open({
                type: 2,
                area: ['600px', '300px'],
                fixed: false,
                maxmin: true,
                title: title,
                content: url
            });
        }

        /*企业资讯-停用*/
        function zx_stop(obj, id) {
            console.log("zx_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置企业资讯状态
                setZXStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="zx_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已停用', {icon: 5, time: 1000});
            });
        }

        /*企业资讯-启用*/
        function zx_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置企业资讯状态
                setZXStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="zx_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 6, time: 1000});
            });
        }

        //删除关联关系
        function enterprise_zx_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //进行后台删除
                var param = {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
                delEnterpriseZX('{{URL::asset('')}}', param, function (ret) {
                    if (ret.result == true) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除', {icon: 1, time: 1000});
                        window.location.reload();
//                        setTimeout(function () {
//                            var index = parent.layer.getFrameIndex(window.name);
//                            parent.$('.btn-refresh').click();
//                            parent.layer.close(index);
//                        }, 500)
                    } else {
                        layer.msg('删除失败', {icon: 2, time: 1000})
                    }
                })
            });
        }

    </script>
@endsection