@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 农场管理 <span
                class="c-gray en">&gt;</span> 大棚下的地列表 <a class="btn btn-success radius r btn-refresh"
                                                         style="line-height:1.6em;margin-top:3px"
                                                         href="javascript:location.replace(location.href);"
                                                         title="刷新"
                                                         onclick="location.replace('{{URL::asset('/admin/farm/houseLand/index')}}?green_house_id={{$green_house_id}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;" class="btn btn-primary radius">
                     大棚信息
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <tbody>
                <tr>
                    <td rowspan="2">
                        <img src="{{ $greenHouse->img ? $greenHouse->img.'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/upload.png')}}"
                             style="width: 80px;height: 80px;">
                    </td>
                    <td>大棚名称</td>
                    <td>{{ $greenHouse->name }}</td>
                    <td>大棚视频源</td>
                    <td>{{ $greenHouse->video }}</td>
                </tr>
                <tr>
                    <td>状态</td>
                    <td>
                        @if($greenHouse->status=="1")
                            <span class="label label-success radius">已启用</span>
                        @else
                            <span class="label label-default radius">已禁用</span>
                        @endif
                    </td>
                    <td>销售状态</td>
                    <td>@if($greenHouse->sale_status=="0")
                            <span class="label label-success radius">开始销售</span>
                        @elseif($greenHouse->sale_status=="1")
                            <span class="label label-success radius">正在销售 </span>
                        @else
                            <span class="label label-default radius">结束销售</span>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="houseLand_add('添加大棚下的地','{{URL::asset('/admin/farm/houseLand/edit')}}?green_house_id={{$green_house_id}}',{{$green_house_id}}"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加大棚下的地
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="18">大棚下的地列表</th>
                </tr>
                <tr class="text-c">
                    <th width="50">ID</th>
                    <th width="50">土地编号</th>
                    <th width="50">大棚名称</th>
                    <th width="50">销售价格（元）</th>
                    <th width="50">销售状态</th>
                    <th width="50">状态</th>
                    <th width="50">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{isset($data->greenHouse)?$data->greenHouse->name:'--'}}</td>
                        <td>{{$data->price}}</td>
                        <td class="">
                            @if($data->sale_status=="0")
                                <span class="label label-success radius">销售中</span>
                            @else
                                <span class="label label-default radius">已销售</span>
                            @endif
                        </td>
                        <td class="td-status">
                            @if($data->status=="1")
                                <span class="label label-success radius">已启用</span>
                            @else
                                <span class="label label-default radius">已禁用</span>
                            @endif
                        </td>
                        <td class="td-manage">
                            @if($data->status=="1")
                                <a style="text-decoration:none" onClick="houseLand_stop(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="houseLand_start(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="houseLand_edit('编辑大棚下的地','{{URL::asset('/admin/farm/houseLand/edit')}}?id={{$data->id}})&green_house_id={{$green_house_id}}',{{$data->id}},{{$green_house_id}}"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            {{--<a title="删除" href="javascript:;" onclick="farmGoods_del(this,'{{$data->id}}')"--}}
                            {{--class="ml-5"--}}
                            {{--style="text-decoration:none">--}}
                            {{--<i class="Hui-iconfont">&#xe6e2;</i>--}}
                            {{--</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-20">
                {{ $datas->appends(['green_house_id' => $green_house_id])->links() }}
                {{--{!! $datas->render() !!}--}}
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
        /*大棚下的地-增加*/
        function houseLand_add(title, url) {
            console.log("greenHouse_add:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


        /*大棚下的地-编辑*/
        function houseLand_edit(title, url, id) {
            console.log("greenHouse_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


        /*大棚下的地-停用*/
        function houseLand_stop(obj, id) {
            console.log("farm_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setHouseLand('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="houseLand_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已停用', {icon: 5, time: 1000});
            });
        }

        /*大棚下的地-启用*/
        function houseLand_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setHouseLand('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="houseLand_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 6, time: 1000});
            });
        }

    </script>
@endsection