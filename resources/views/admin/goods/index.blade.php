@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span
                class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace(location.href);" title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/goods/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">

        <div class="text-c">
            <form action="{{URL::asset('/admin/goods/index')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <div class="Huiform text-r">
                    <input id="search_word" name="search_word" type="text" class="input-text" style="width:250px"
                           placeholder="根据商品名称检索，支持模糊查询" value="{{$con_arr['search_word']}}">
                    <span class="select-box" style="width:150px">
                        <select class="select" name="status" id="status" size="1">
                            <option value="" {{$con_arr['status']==null?'selected':''}}>全部状态</option>
                            <option value="1" {{$con_arr['status']=='1'?'selected':''}}>生效状态</option>
                            <option value="0" {{$con_arr['status']=='0'?'selected':''}}>失效状态</option>
                        </select>
                    </span>
                    <button type="submit" class="btn btn-success" id="" name="">
                        <i class="Hui-iconfont">&#xe665;</i> 搜索
                    </button>
                </div>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                 <a href="javascript:;" onclick="goods_ad('添加商品','{{URL::asset('/admin/goods/edit')}}')"
                    class="btn btn-primary radius">
                     <i class="Hui-iconfont">&#xe600;</i> 添加商品
                 </a>
            </span>
        </div>
        <table class="table table-border table-bordered table-bg table-sort mt-20">
            <thead>
            <tr>
                <th scope="col" colspan="10">商品列表</th>
            </tr>
            <tr class="text-c">
                <th width="40">商品ID</th>
                <th width="50">商品图片</th>
                <th width="120">商品名称</th>
                <th width="50">商品原价（元）</th>
                <th width="50">商品现价（元）</th>
                <th width="90">商品状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr class="text-c">
                    <td>{{$data->id}}</td>
                    <td>
                        <img src="{{$data->image ? $data->image.'?imageView2/1/w/200/h/100/interlace/1/q/75|imageslim' : URL::asset('/img/upload.png')}}"
                             class="" style="width: 80px;height: 40px">
                    </td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->original_price}}</td>
                    <td>{{$data->price}}</td>
                    <td class="td-status">
                        @if($data->status=="1")
                            <span class="label label-success radius span_status">显示</span>
                        @else
                            <span class="label label-default radius span_status">隐藏</span>
                        @endif
                        @if($data->is_superior==1)
                            <span class="label label-success radius span_superior">精品</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        @if($data->status=="1")
                            <a class="a_status" style="text-decoration:none" onClick="goods_stop(this,'{{$data->id}}')"
                               href="javascript:;"
                               title="隐藏">
                                <i class="Hui-iconfont">&#xe631;</i>
                            </a>
                        @else
                            <a class="a_status" style="text-decoration:none" onClick="goods_start(this,'{{$data->id}}')"
                               href="javascript:;"
                               title="显示">
                                <i class="Hui-iconfont">&#xe615;</i>
                            </a>
                        @endif
                        @if($data->is_superior==1)
                            <a class="a_superior" style="text-decoration:none" onClick="goods_superior(this,'{{$data->id}}', 0)"
                                href="javascript:;"
                                title="取消">
                            <i class="Hui-iconfont">&#xe6c1;</i>
                            </a>
                        @else
                            <a class="a_superior" style="text-decoration:none" onClick="goods_superior(this,'{{$data->id}}', 1)"
                                href="javascript:;"
                                title="精品">
                                <i class="Hui-iconfont">&#xe6c1;</i>
                            </a>
                        @endif
                        <a title="编辑" href="javascript:;"
                           {{--/ad/edit--}}
                           onclick="goods_edit('商品编辑','{{URL::asset('/admin/goods/edit')}}?id={{$data->id}})',{{$data->id}})"
                           class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="编辑视频源" href="javascript:;"
                           onclick="goods_editVideo('编辑视频源','{{URL::asset('/admin/video/index')}}?f_id={{$data->id}}&f_table=goods',{{$data->id}})"
                           class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe613;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="goods_del(this,'{{$data->id}}')"
                           class="ml-5"
                           style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
                        <a title="商品二维码" href="javascript:;"
                           onclick="goods_show_ewm('{{$data->name}}小程序码','{{URL::asset('/admin/goods/ewm')}}?id={{$data->id}}',{{$data->id}})"
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
            {{ $datas->links() }}
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
        /*商品-增加*/
        function goods_ad(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*商品-删除*/
        function goods_del(obj, id) {
            layer.msg('不允许删除商品，请联系管理员', {icon: 2, time: 1000});
        }


        /*商品-编辑*/
        function goods_edit(title, url, id) {
            console.log("ad_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            console.log(index);
            layer.full(index);
        }


        /*商品-编辑视频源*/
        function goods_editVideo(title, url, id) {
            console.log("goods_editVideo url:" + url);
            // var index = layer.open({
            //     type: 2,
            //     title: title,
            //     content: url
            // });
            // console.log(index);
            // layer.full(index);
            creatIframe(url, '编辑视频源')
        }


        /*商品-隐藏*/
        function goods_stop(obj, id) {
            console.log("ad_stop id:" + id);
            layer.confirm('确认要隐藏吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置活动状态
                setGoodsStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {
                        layer.msg('成功隐藏', {icon: 1, time: 1000});
                    }
                })
//                <i class="Hui-iconfont">&#xe631;</i>
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="goods_start(this,' + id + ')" href="javascript:;" title="显示" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".span_status").replaceWith('<span class="label label-default radius span_status">隐藏</span>');
                $(obj).remove();
                layer.msg('已隐藏', {icon: 5, time: 1000});
            });
        }

        /*商品-显示*/
        function goods_start(obj, id) {
            layer.confirm('确认要显示吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置活动状态
                setGoodsStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {
                        layer.msg('成功显示', {icon: 1, time: 1000});
                    }
                })

                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="goods_stop(this,' + id + ')" href="javascript:;" title="隐藏" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".span_status").replaceWith('<span class="label label-success radius span_status">显示</span>');
                $(obj).remove();
                layer.msg('已显示', {icon: 6, time: 1000});
            });
        }

        /*商品-精品*/
        function goods_superior(obj, id, status) {
            var msg = '确认要设置为精品吗？'
            if (!status) {
                msg = '确认要取消精品吗？'
            }
            layer.confirm(msg, function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                let param = {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置活动状态
                setGoodsSuperior('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {
                        layer.msg('成功显示', {icon: 1, time: 1000});
                    }
                })
                // 精品标签
                let span_superior_html = '<span class="label label-success radius span_superior">精品</span>'
                let status_span = $(obj).parents("tr").find(".span_status")
                if (status) {
                    status_span.after(span_superior_html)
                } else {
                    $(obj).parents("tr").find(".span_superior").remove()
                }
                // 点击事件
                let click_str = "goods_superior(this,'{{$data->id}}', " + !status + ")"
                $(obj).parents("tr").find(".a_superior").attr("onClick", click_str)
                let tip = status ? "已设置为精品" : "已取消精品"
                layer.msg(tip, {icon: 6, time: 1000});
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
        function goods_show_ewm(title, url) {
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