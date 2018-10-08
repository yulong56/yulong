@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 企业管理 <span
                class="c-gray en">&gt;</span> 企业列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace(location.href);"
                                                      title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/enterprise/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="enterprise_add('添加企业','{{URL::asset('/admin/enterprise/edit')}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加企业
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>


        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="8">企业列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    <th width="40">ID</th>
                    <th width="150">名称</th>
                    <th width="150">企业地址</th>
                    <th width="100">联系电话</th>
                    <th width="80">排序</th>
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
                        <td>{{$data->name}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->phonenum}}</td>
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
                                <a style="text-decoration:none" onClick="enterprise_stop(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="enterprise_start(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="enterprise_edit('企业编辑','{{URL::asset('/admin/enterprise/edit')}}?id={{$data->id}})',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="企业资讯管理" href="javascript:;"
                               onclick="enterprise_zx_edit('企业资讯管理','{{URL::asset('/admin/enterprise/zx/index')}}?enterprise_id={{$data->id}}',{{$data->id}})"
                               class="ml-5"
                               style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe681;</i>
                            </a>
                            <a title="企业商品管理" href="javascript:;"
                               onclick="enterprise_goods_edit('企业商品管理','{{URL::asset('/admin/enterprise/goods/index')}}?enterprise_id={{$data->id}}',{{$data->id}})"
                               class="ml-5"
                               style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe620;</i>
                            </a>
                            <a title="企业二维码" href="javascript:;"
                               onclick="enterprise_show_ewm('{{$data->name}}小程序码','{{URL::asset('/admin/enterprise/ewm')}}?id={{$data->id}}',{{$data->id}})"
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
         * 
         * 展示企业二维码
         * 
         * By TerryQi
         * 
         * 2018-03-29
         */
        function enterprise_show_ewm(title, url) {
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


        /*
         参数解释：
         title	标题
         url		请求的url
         id		需要操作的数据id
         w		弹出层宽度（缺省调默认值）
         h		弹出层高度（缺省调默认值）
         */
        /*企业-增加*/
        function enterprise_add(title, url) {
            console.log("url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*企业-编辑*/
        function enterprise_edit(title, url, id) {
            console.log("enterprise_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*企业资讯-管理*/
        function enterprise_zx_edit(title, url, id) {
            console.log("enterprise_zx_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*企业商品-管理*/
        function enterprise_goods_edit(title, url, id) {
            console.log("enterprise_goods_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


        /*企业-停用*/
        function enterprise_stop(obj, id) {
            console.log("enterprise_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置企业状态
                setEnterpriseStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="enterprise_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已停用', {icon: 5, time: 1000});
            });
        }

        /*企业-启用*/
        function enterprise_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置企业状态
                setEnterpriseStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="enterprise_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 6, time: 1000});
            });
        }

    </script>
@endsection