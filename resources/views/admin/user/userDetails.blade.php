·@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span
                class="c-gray en">&gt;</span>用户详情列表 <a class="btn btn-success radius r btn-refresh"
                                                       style="line-height:1.6em;margin-top:3px"
                                                       href="javascript:location.replace(location.href);" title="刷新"
                                                       onclick="location.replace('{{URL::asset('/admin/user/userDetails')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    {{--/{{$datas->type_id}}--}}
    <div class="page-container">
        <table class="table table-border table-bordered table-bg mt-20">
            {{--用户详情--}}
            <thead>
            <tr>
                <th colspan="2" scope="col">用户详情信息</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userDetails as $userDetail)
                <tr>
                    <td>用户姓名</td>
                    <td>{{isset($userDetail->real_name)?$userDetail->real_name:'--'}}</td>
                </tr>
                <tr>
                    <td>昵称</td>
                    <td>{{isset($userDetail->nick_name)?$userDetail->nick_name:'--'}}</td>
                </tr>
                <tr>
                    <td>头像图片</td>
                    <td>
                        <img src="{{ $userDetail['avatar'] ? $userDetail['avatar'].'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                             class="img-rect-30 radius-5">
                    </td>
                </tr>
                <tr>
                    <td>联系人电话</td>
                    <td>{{isset($userDetail->phonenum)?$userDetail->phonenum:'--'}}</td>
                </tr>
                <tr>
                    <td>用户性别</td>
                    @if($userDetail->gender=='1')
                        <td>男性</td>
                    @elseif($userDetail->gender=='2')
                        <td>女性</td>
                    @else
                        <td>保密</td>
                    @endif
                </tr>
                <tr>
                    <td>省份</td>
                    <td>{{isset($userDetail->province)?$userDetail->province:'--'}}</td>
                </tr>
                <tr>
                    <td>城市</td>
                    <td>{{isset($userDetail->city)?$userDetail->city:'--'}}</td>
                </tr>
                <tr>
                    <td>创建时间</td>
                    <td>{{isset($userDetail->created_at)?$userDetail->created_at:'--'}}</td>
                </tr>
            @endforeach
            </tbody>
            {{--用户喜好--}}
            @foreach($datas as $data)
                <thead>
                <tr>
                    <th colspan="2" scope="col">用户喜好信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>商品名称</td>
                    <td>{{isset($data->favorGoods)?$data->favorGoods->name:'--'}}</td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td>
                        <img src="{{ $data['favorGoods']['img'] ? $data['favorGoods']['img'].'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                             class="img-rect-30 radius-5">
                    </td>
                </tr>
                <tr>
                    <td>是否喜欢</td>
                    @if($data->status=="1")
                        <td>喜欢</td>
                    @else
                        <td>不喜欢</td>
                    @endif
                </tr>
                @endforeach
                </tbody>
                {{--订单详情--}}
                @foreach($orders as $order)
                    <thead>
                    <tr>
                        <th colspan="2" scope="col">订单详情信息</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>订单号</td>
                        <td>{{isset($order->trade_no)?$order->trade_no:'--'}}</td>
                    </tr>
                    <tr>
                        <td>订单金额</td>
                        <td>{{isset($order->total_fee)?$order->total_fee:'--'}}</td>
                    </tr>
                    <tr>
                        <td>订单描述</td>
                        <td>{{isset($order->content)?$order->content:'--'}}</td>
                    </tr>
                    <tr>
                        <td>订单备注</td>
                        <td>{{isset($order->remark)?$order->remark:'--'}}</td>
                    </tr>
                    <tr>
                        <td>订单状态</td>
                        @if($order->status=='0')
                            <td>待支付</td>
                        @elseif($order->status=='1')
                            <td>支付成功</td>
                        @elseif($order->status=='2')
                            <td>已关闭</td>
                        @elseif($order->status=='3')
                            <td>退款中</td>
                        @elseif($order->status=='4')
                            <td>退款成功</td>
                        @elseif($order->status=='5')
                            <td>退款失败</td>
                        @else
                            <td>未知状态</td>
                        @endif
                    </tr>
                    <tr>
                        <td>支付时间</td>
                        <td>{{isset($order->pay_at)?$order->pay_at:'--'}}</td>
                    </tr>
                    <tr>
                        <td>农场名称</td>
                        <td>{{isset($order->farm)?$order->farm->name:'--'}}</td>
                    </tr>
                    <tr>
                        <td>大棚名称</td>
                        <td>{{isset($order->green_house)?$order->green_house->name:'--'}}</td>
                    </tr>
                    <tr>
                        <td>土地编号</td>
                        <td>{{isset($order->house_land)?$order->house_land->name:'--'}}</td>
                    </tr>
                    <tr>
                        <td>收货人姓名</td>
                        <td>{{isset($order->userName)?$order->userName:'--'}}</td>
                    </tr>
                    <tr>
                        <td>收货人邮编</td>
                        <td>{{isset($order->postalCode)?$order->postalCode:'--'}}</td>
                    </tr>
                    <tr>
                        <td>地址：省</td>
                        <td>{{isset($order->provinceName)?$order->provinceName:'--'}}</td>
                    </tr>
                    <tr>
                        <td>地址：市</td>
                        <td>{{isset($order->cityName)?$order->cityName:'--'}}</td>
                    </tr>
                    <tr>
                        <td>地址：区</td>
                        <td>{{isset($order->countyName)?$order->countyName:'--'}}</td>
                    </tr>
                    <tr>
                        <td>详细地址</td>
                        <td>{{isset($order->detailInfo)?$order->detailInfo:'--'}}</td>
                    </tr>
                    <tr>
                        <td>收货人电话</td>
                        <td>{{isset($order->telNumber)?$order->telNumber:'--'}}</td>
                    </tr>
                    </tbody>
                @endforeach
        </table>
        <div style="text-align: center;margin-top: 3rem;margin-bottom: 4rem;">
            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $('.table-sort').dataTable({
            "aaSorting": [[1, "desc"]],//默认第几个排序
            "bStateSave": true,//状态保存
            "pading": false,
            "searching": false, //去掉搜索框
            "bLengthChange": false,   //去掉每页显示多少条数据方法
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable": false, "aTargets": [0, 1, 5]}// 不参与排序的列
            ]
        });

        $(function () {

        });


    </script>
@endsection