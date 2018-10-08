@extends('admin.layouts.app')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span
                class="c-gray en">&gt;</span>订单列表 <a class="btn btn-success radius btn-refresh r"
                                                     style="line-height:1.6em;margin-top:3px"
                                                     href="javascript:location.replace(location.href);"
                                                     onclick="location.replace('{{URL::asset('/admin/order/index')}}');"
                                                     title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form action="{{URL::asset('/admin/order/index')}}" method="get" class="form-horizontal">
                {{csrf_field()}}
                <input id="search_word" name="search_word" type="text" class="input-text" style="width:250px"
                       placeholder="订单号">
                <span class="select-box" style="width:200px;">
              <select class="select" size="1" name="status">
                <option value="" selected>全部</option>
                  <option value="0" {{$con_arr['status'] == '0'?'selected':''}}>待支付</option>
                  <option value="1" {{$con_arr['status'] == '1'?'selected':''}}>支付成功</option>
                  <option value="2" {{$con_arr['status'] == '2'?'selected':''}}>已关闭</option>
                  <option value="3" {{$con_arr['status'] == '3'?'selected':''}}>退款中</option>
                  <option value="4" {{$con_arr['status'] == '4'?'selected':''}}>退款成功</option>
                  <option value="5" {{$con_arr['status'] == '5'?'selected':''}}>退款失败</option>
              </select>
            </span>
                {{--<input id="search_word" name="search_word" type="text" class="input-text" style="width:250px" placeholder="订单号">--}}
                <button type="submit" class="btn btn-success" id="" name="">
                    <i class="Hui-iconfont">&#xe665;</i> 搜索
                </button>
            </form>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">单号</th>
                    <th>订单金额</th>
                    <th>收货人姓名</th>
                    <th>收货人电话</th>
                    <th>省市区</th>
                    <th>详细地址</th>
                    <th>邮编</th>
                    <th>订单状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        <td>{{$data->trade_no}}</td>
                        <td>{{$data->total_fee}}</td>
                        <td>{{$data->userName}}</td>
                        <td>{{$data->telNumber}}</td>
                        <td>{{isset($data->provinceName)?$data->provinceName:'--'}}{{isset($data->cityName)?$data->cityName:'--'}}{{isset($data->countyName)?$data->countyName:'--'}}</td>
                        <td>{{$data->detailInfo}}</td>
                        <td>{{isset($data->postalCode)?$data->postalCode:'--'}}</td>
                        <td class="c-primary">
                            @if($data->status=="0")
                                待支付
                            @endif
                            @if($data->status=="1")
                                支付成功
                            @endif
                            @if($data->status=="2")
                                已关闭
                            @endif
                            @if($data->status=="3")
                                退款中
                            @endif
                            @if($data->status=="4")
                                退款成功
                            @endif
                            @if($data->status=="5")
                                退款失败
                            @endif
                        </td>
                        <td class="td-manage">
                            <a title="查看详情" href="javascript:;"
                               onclick="order_edit('查看详情','{{URL::asset('/admin/order/orderDetails')}}?id={{$data['id']}}',{{$data['id']}})"
                               class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe695;</i>
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


        /*查看订单详情*/
        function order_edit(title, url, id) {
            console.log("member_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


    </script>
@endsection