@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 农场管理 <span
                class="c-gray en">&gt;</span> 农场列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace(location.href);"
                                                      title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/farm/farm/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="farm_add('添加农场','{{URL::asset('/admin/farm/farm/edit')}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加农场
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>


        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="15">农场列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    {{--<th width="40">ID</th>--}}
                    <th width="50">名称</th>
                    <th width="150">图片</th>
                    <th width="90">地址</th>
                    <th width="90">联系电话</th>
                    <th width="50">级别</th>
                    <th width="80">平均售价</th>
                    <th width="200">农场描述</th>
                    {{--<th width="50">农场视频源</th>--}}
                    <th width="50">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        {{--<td><input type="checkbox" value="1" name=""></td>--}}
                        <td>{{$data->name}}</td>
                        <td>
                            <img src="{{ $data->img ? $data->img.'?imageView2/1/w/120/h/80/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                                 class="">
                        </td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->phonenum}}</td>
                        <td>{{$data->level}}</td>
                        <td>{{$data->ave_price}}元/㎡</td>
                        <td>
                            <div class="text-fourline text-l">{{$data->desc}}</div>
                        </td>
                        {{--<td>{{$data->video}}</td>--}}
                        <td class="td-status">
                            @if($data->status=="1")
                                <span class="label label-success radius">已启用</span>
                            @else
                                <span class="label label-default radius">已禁用</span>
                            @endif
                        </td>
                        <td class="td-manage">
                            @if($data->status=="1")
                                <a style="text-decoration:none" onClick="farm_stop(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="farm_start(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="farm_edit('农场编辑','{{URL::asset('/admin/farm/farm/edit')}}?id={{$data->id}})',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="查看农场下的大棚" href="javascript:;"
                               onclick="greenHouse_edit('查看农场下的大棚','{{URL::asset('/admin/farm/greenHouse/index')}}?farm_id={{$data->id}})',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="icon iconfont">&#xe688;</i>
                            </a>
                            <a title="企业二维码" href="javascript:;"
                               onclick="farm_show_ewm('{{$data->name}}小程序码','{{URL::asset('/admin/farm/farm/ewm')}}?id={{$data->id}}',{{$data->id}})"
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
                {!! $datas->render() !!}
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
        /*农场-增加*/
        function farm_add(title, url) {
            console.log("farm_add:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*农场下的大棚列表*/
        function greenHouse_edit(title, url, id) {
            console.log("greenHouse_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*农场-编辑*/
        function farm_edit(title, url, id) {
            console.log("farm_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*农场-停用*/
        function farm_stop(obj, id) {
            console.log("farm_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setFarmStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="farm_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已停用', {icon: 5, time: 1000});
            });
        }

        /*农场-启用*/
        function farm_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setFarmStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="farm_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 6, time: 1000});
            });
        }

        /*
         *
         * 展示企业二维码
         *
         * By TerryQi
         *
         * 2018-03-29
         */
        function farm_show_ewm(title, url) {
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