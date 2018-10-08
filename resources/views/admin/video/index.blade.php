@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品视频源管理 <span
                class="c-gray en">&gt;</span> 商品视频源列表 <a class="btn btn-success radius r btn-refresh"
                                                         style="line-height:1.6em;margin-top:3px"
                                                         href="javascript:location.replace(location.href);"
                                                         title="刷新"
                                                         onclick="location.replace('{{URL::asset('/admin/video/index')}}?f_table=goods&f_id={{$goods->id}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="panel panel-primary">
            <div class="panel-header">商品信息</div>
            <div class="panel-body">

                <table class="table table-border table-bordered radius">
                    <tbody>
                    <tr>
                        <td rowspan="4" style="text-align: center;">
                            <img src="{{ $goods->image ? $goods->image : URL::asset('/img/upload.png')}}"
                                 style="width: 120px;height: 80px;">
                        </td>
                        <td>名称</td>
                        <td>{{isset($goods->name)?$goods->name:'--'}}</td>
                        <td>原价</td>
                        <td>{{isset($goods->original_price)?$goods->original_price:'--'}}</td>
                        <td>现价</td>
                        <td>{{isset($goods->price)?$goods->price:'--'}}</td>
                        <td>添加时间</td>
                        <td>{{$goods->created_at}}</td>
                    </tr>
                    <tr>
                        <td>描述</td>
                        <td colspan="5">{{isset($goods->desc)?$goods->desc:'--'}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;"
                    onclick="goods_video_add('添加视频源','{{URL::asset('/admin/video/edit')}}?f_table=goods&f_id={{$goods->id}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加商品视频源
                 </a>
            </span>
            {{--<span class="r">共有数据：<strong>{{$datas->count()}}</strong> 条</span>--}}
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="4">视频列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    <th width="40">ID</th>
                    <th width="150">名称</th>
                    <th width="150">视频源</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        {{--<td><input type="checkbox" value="1" name=""></td>--}}
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->video}}</td>
                        <td class="td-manage">
                            <a title="删除" href="javascript:;" onclick="goods_video_del(this,'{{$data->id}}')"
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

        //添加商品视频源
        function goods_video_add(title, url, id) {
            console.log("goods_video_add url:" + url);
            var index = layer.open({
                type: 2,
                area: ['600px', '300px'],
                fixed: false,
                maxmin: true,
                title: title,
                content: url
            });
        }

        //删除商品视频源
        function goods_video_del(obj, id) {
            layer.confirm('确认要删除吗？', function (index) {
                //进行后台删除
                var param = {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
                delVideo('{{URL::asset('')}}', param, function (ret) {
                    if (ret.result == true) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除', {icon: 1, time: 1000});
                        window.location.reload();
                        setTimeout(function () {
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.$('.btn-refresh').click();
                            parent.layer.close(index);
                        }, 500)
                    } else {
                        layer.msg('删除失败', {icon: 2, time: 1000})
                    }
                })
            });
        }


    </script>
@endsection