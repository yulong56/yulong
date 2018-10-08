@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 农场管理 <span
                class="c-gray en">&gt;</span> 大棚列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace(location.href);"
                                                      title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/farm/greenHouse/index')}}?farm_id={{$farm_id}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;" class="btn btn-primary radius">
                     农场信息
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <tbody>
                <tr>
                    <td rowspan="3">
                        <img src="{{ $farm->img ? $farm->img.'?imageView2/1/w/120/h/80/interlace/1/q/75|imageslim' : URL::asset('/img/upload.png')}}"
                             style="">
                    </td>
                    <td>农场名称</td>
                    <td>{{ $farm->name }}</td>
                    <td>所在省份</td>
                    <td>{{ $farm->province }}</td>
                    <td>所在城市</td>
                    <td>{{ $farm->city }}</td>
                    <td>农场地址</td>
                    <td>{{ $farm->address }}</td>
                    <td>联系电话</td>
                    <td>{{ $farm->phonenum }}</td>
                </tr>
                <tr>
                    <td>经度</td>
                    <td>{{ $farm->lon }}</td>
                    <td>纬度</td>
                    <td>{{ $farm->lat }}</td>
                    <td>农场级别</td>
                    <td>{{ $farm->level }}</td>
                    <td>农场拥有者人数</td>
                    <td>{{ $farm->owner_num }}</td>
                    <td>展示次数</td>
                    <td>{{ $farm->show_num }}</td>
                </tr>
                <tr>
                    <td>平均售价</td>
                    <td>{{ $farm->ave_price }}</td>
                    <td>评论次数</td>
                    <td>{{ $farm->comm_num }}</td>
                    <td>农场视频源</td>
                    <td colspan="5">{{ $farm->video }}</td>
                </tr>
                <tr>
                    <td>农场描述</td>
                    <td colspan="9">{{ $farm->desc }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="greenHouse_add('添加大棚','{{URL::asset('/admin/farm/greenHouse/edit')}}?farm_id={{$farm_id}}',{{$farm_id}}"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加大棚
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="18">大棚列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    {{--<th width="40">ID</th>--}}
                    <th width="50">大棚名称</th>
                    <th width="150">大棚图片</th>
                    <th width="50">大棚视频源链接</th>
                    <th width="50">农场名称</th>
                    <th width="50">销售状态</th>
                    <th width="90">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        {{--<td><input type="checkbox" value="1" name=""></td>--}}
                        <td>{{$data->name}}</td>
                        <td>
                            <img src="{{ $data->img ? $data->img.'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                                 class="img-rect-30">
                        </td>
                        <td>{{$data->video}}</td>
                        <td>{{isset($data->farm)?$data->farm->name:'--'}}</td>
                        <td class="">
                            @if($data->sale_status=="0")
                                <span class="label label-success radius">即将销售</span>
                            @elseif($data->sale_status=="1")
                                <span class="label label-success radius">正在销售 </span>
                            @elseif($data->sale_status=="2")
                                <span class="label label-default radius">结束销售</span>
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
                                <a style="text-decoration:none" onClick="greenHouse_stop(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="停用">
                                    {{--<i class="Hui-iconfont">&#xe631;</i>--}}
                                    <i class="Hui-iconfont">&#xe631;</i>
                                </a>
                            @else
                                <a style="text-decoration:none" onClick="greenHouse_start(this,'{{$data->id}}')"
                                   href="javascript:;"
                                   title="启用">
                                    {{--<i class="Hui-iconfont">&#xe615;</i>--}}
                                    <i class="Hui-iconfont">&#xe615;</i>
                                </a>
                            @endif
                            <a title="编辑" href="javascript:;"
                               onclick="greenHouse_edit('大棚编辑','{{URL::asset('/admin/farm/greenHouse/edit')}}?id={{$data->id}}&farm_id={{$farm_id}}',{{$data->id}},{{$farm_id}}"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a title="查看大棚下的地" href="javascript:;"
                               onclick="houseLand_edit('查看大棚下的地','{{URL::asset('/admin/farm/houseLand/index')}}?green_house_id={{$data->id}})',{{$data->id}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="icon iconfont">&#xe607;</i>
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
                {{ $datas->appends(['farm_id' => $farm_id])->links() }}
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
        /*农场下的大棚-增加*/
        function greenHouse_add(title, url) {
            console.log("greenHouse_add:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


        /*农场下大棚-编辑*/
        function greenHouse_edit(title, url, id, farm_id) {
            console.log("greenHouse_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*大棚下的地-编辑*/
        function houseLand_edit(title, url, id) {
            console.log("houseLand_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*大棚-停用*/
        function greenHouse_stop(obj, id) {
            console.log("farm_stop id:" + id);
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setGreenHouse('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="greenHouse_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已停用', {icon: 5, time: 1000});
            });
        }

        /*大棚-启用*/
        function greenHouse_start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置农产品状态
                setGreenHouse('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="greenHouse_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 6, time: 1000});
            });
        }

    </script>
@endsection