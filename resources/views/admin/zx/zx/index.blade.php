@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span
                class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace(location.href);"
                                                      title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/zx/zx/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form action="{{URL::asset('/admin/zx/zx/index')}}" method="get" class="form-horizontal">
                {{csrf_field()}}
                <div class="Huiform text-r">
                    <input id="title" name="title" type="text" class="input-text" style="width:250px"
                           placeholder="请输入资讯标题" value="{{isset($con_arr['title'])?$con_arr['title']:''}}">
                    <span class="select-box" style="width:150px">
                        <select class="select" name="zx_type_id" id="zx_type_id" size="1">
                            <option value="" {{$con_arr['zx_type_id'] == null?'selected':''}}>全部分类</option>
                            @foreach($zxTypes as $zxType)
                                <option value="{{$zxType->id}}" {{$zxType->id == $con_arr['zx_type_id'] ? 'selected':''}}>{{$zxType->name}}</option>
                            @endforeach
                        </select>
                    </span>
                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索
                    </button>
                </div>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="zx_add('添加资讯','{{URL::asset('/admin/zx/zx/add')}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加资讯
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
                        <td>{{$data->id}}</td>
                        <td>
                            <img src="{{ $data->img ? $data->img.'?imageView2/1/w/120/h/70/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                                 class="">
                        </td>
                        <td>{{$data->title}}</td>
                        <td>{{$data->zxType->name}}</td>
                        <td>{{$data->author}}</td>
                        <td>{{$data->seq}}</td>
                        <td>{{$data->created_at}}</td>
                        <td class="td-status">
                            @if($data->status=="1")
                                <span class="label label-success radius">已启用</span>
                            @else
                                <span class="label label-default radius">已禁用</span>
                            @endif
                        </td>
                        <td class="td-manage">
                            @if($data->status=="1")
                                <a style="text-decoration:none" onClick="zx_stop(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="zx_start(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="zx_edit('资讯编辑','{{URL::asset('/admin/zx/zx/edit')}}?id={{$data->id}})',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="zx_del(this,'{{$data->id}}')"
                               class="ml-5"
                               style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                            <a title="资讯二维码" href="javascript:;"
                               onclick="zixun_show_ewm('{{$data->title}}小程序码','{{URL::asset('/admin/zx/zx/ewm')}}?id={{$data->id}}',{{$data->id}})"
                               class="ml-5"
                               style="text-decoration:none">
                                <i class="icon iconfont icon-erweima"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-20">
                {!! $datas->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">


        $(function () {

        });

        /*
         参数解释：
         title	标题
         url		请求的url
         id		需要操作的数据id
         w		弹出层宽度（缺省调默认值）
         h		弹出层高度（缺省调默认值）
         */
        /*资讯-增加*/
        function zx_add(title, url) {
            console.log("url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*资讯-编辑*/
        function zx_edit(title, url, id) {
            console.log("zx_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*资讯-停用*/
        function zx_stop(obj, id) {
            console.log("zx_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置资讯状态
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

        /*资讯-启用*/
        function zx_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置资讯状态
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

        /*资讯-删除*/
        function zx_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //进行后台删除
                var param = {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
                delZX('{{URL::asset('')}}', param, function (ret) {
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

        /*
         *
         * 展示资讯二维码
         *
         * By TerryQi
         *
         * 2018-03-29
         */
        function zixun_show_ewm(title, url) {
            console.log("url:" + url);
            var index = layer.open({
                type: 2,
                area: ['520px', '520px'],
                fixed: false,
                maxmin: true,
                title: title,
                content: url
            });
        }

    </script>
@endsection