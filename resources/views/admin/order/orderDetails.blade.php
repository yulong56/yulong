·@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span
                class="c-gray en">&gt;</span>订单详情列表 <a class="btn btn-success radius r btn-refresh"
                                                       style="line-height:1.6em;margin-top:3px"
                                                       href="javascript:location.replace(location.href);" title="刷新"
                                                       onclick="location.replace('{{URL::asset('/admin/order/orderDetails')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    {{--/{{$datas->type_id}}--}}
    <div class="page-container">
        <table class="table table-border table-bordered table-bg mt-20">
            {{--用户基本信息--}}
            <thead>
            <tr>
                <th colspan="4" scope="col">用户基本信息</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>用户姓名</td>
                    <td>{{isset($data->user->real_name)?$data->user->real_name:'--'}}</td>
                    <td>昵称</td>
                    <td>{{isset($data->user->nick_name)?$data->user->nick_name:'--'}}</td>
                </tr>
                <tr>
                    <td>头像图片</td>
                    <td>
                        <img src="{{ $data['user']['avatar'] ? $data['user']['avatar'].'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                             class="img-rect-30 radius-5">
                    </td>
                    <td>联系人电话</td>
                    <td>{{isset($data->user->phonenum)?$data->user->phonenum:'--'}}</td>
                </tr>
                <tr>
                    <td>用户性别</td>
                    @if($data->gender=='1')
                        <td>男性</td>
                    @elseif($data->gender=='2')
                        <td>女性</td>
                    @else
                        <td>保密</td>
                    @endif
                    <td>省份</td>
                    <td>{{isset($data->user->province)?$data->user->province:'--'}}</td>
                </tr>
                <tr>
                    <td>城市</td>
                    <td>{{isset($data->user->city)?$data->user->city:'--'}}</td>
                    <td>创建时间</td>
                    <td>{{isset($data->user->created_at)?$data->user->created_at:'--'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-border table-bordered table-bg mt-20">
            {{--用户喜好--}}
            @foreach($userFavors as $userFavor)
            <thead>
            <tr>
                <th colspan="4" scope="col">用户喜好信息</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>喜好商品名称</td>
                    <td>{{isset($userFavor->favorGoods)?$userFavor->favorGoods->name:'--'}}</td>
                    <td>喜好商品图片</td>
                    <td>
                        <img src="{{ $userFavor['favorGoods']['img'] ? $userFavor['favorGoods']['img'].'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                             class="img-rect-30 radius-5">
                    </td>
                </tr>
                <tr>
                    <td>是否喜欢</td>
                    @if($userFavor->status=="1")
                        <td>喜欢</td>
                    @else
                        <td>不喜欢</td>
                    @endif
                    <td>--</td>
                    <td>--</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-border table-bordered table-bg mt-20">
            {{--订单详情--}}
            <thead>
            <tr>
                <th colspan="4" scope="col">订单详情信息</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>订单号</td>
                    <td>{{isset($data->trade_no)?$data->trade_no:'--'}}</td>
                    <td>订单金额</td>
                    <td>{{isset($data->total_fee)?$data->total_fee:'--'}}</td>
                </tr>
                <tr>
                    <td>订单描述</td>
                    <td>{{isset($data->content)?$data->content:'--'}}</td>
                    <td>订单备注</td>
                    <td>{{isset($data->remark)?$data->remark:'--'}}</td>
                </tr>
                <tr>
                    <td>订单状态</td>
                    @if($data->status=='0')
                        <td>待支付</td>
                    @elseif($data->status=='1')
                        <td>支付成功</td>
                    @elseif($data->status=='2')
                        <td>已关闭</td>
                    @elseif($data->status=='3')
                        <td>退款中</td>
                    @elseif($data->status=='4')
                        <td>退款成功</td>
                    @elseif($data->status=='5')
                        <td>退款失败</td>
                    @else
                        <td>未知状态</td>
                    @endif
                    <td>支付时间</td>
                    <td>{{isset($data->pay_at)?$data->pay_at:'--'}}</td>
                </tr>
                <tr>
                    <td>农场名称</td>
                    <td>{{isset($data->farm)?$data->farm->name:'--'}}</td>
                    <td>大棚名称</td>
                    <td>{{isset($data->green_house)?$data->green_house->name:'--'}}</td>
                </tr>
                <tr>
                    <td>土地编号</td>
                    <td>{{isset($data->house_land)?$data->house_land->name:'--'}}</td>
                    <td>收货人姓名</td>
                    <td>{{isset($data->userName)?$data->userName:'--'}}</td>
                </tr>
                <tr>
                    <td>收货人邮编</td>
                    <td>{{isset($data->postalCode)?$data->postalCode:'--'}}</td>
                    <td>地址：省</td>
                    <td>{{isset($data->provinceName)?$data->provinceName:'--'}}</td>
                </tr>
                <tr>
                    <td>地址：市</td>
                    <td>{{isset($data->cityName)?$data->cityName:'--'}}</td>
                    <td>地址：区</td>
                    <td>{{isset($data->countyName)?$data->countyName:'--'}}</td>
                </tr>
                <tr>
                    <td>详细地址</td>
                    <td>{{isset($data->detailInfo)?$data->detailInfo:'--'}}</td>
                    <td>收货人电话</td>
                    <td>{{isset($data->telNumber)?$data->telNumber:'--'}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div style="text-align: center;margin-top: 3rem;margin-bottom: 4rem;">
            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">


        $(function () {

        });


    </script>
@endsection