@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>业务概览
        <span class="c-gray en">&gt;</span>综合统计 <a class="btn btn-success radius r btn-refresh"
                                                   style="line-height:1.6em;margin-top:3px"
                                                   href="javascript:location.replace(location.href);"
                                                   title="刷新"
                                                   onclick="location.replace('{{URL::asset('/admin/stmt/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    {{--/{{$top_invite_users->type_id}}--}}
    <div class="page-container">
        <div class="text-c">
            <form action="{{URL::asset('/admin/stmt/index')}}" method="get" class="form-horizontal">
                {{csrf_field()}}
                <div class="Huiform text-r">
                    <input id="start_time" name="start_time" type="date" class="input-text" style="width:150px"
                           value="{{$con_arr['start_time']==null?'':$con_arr['start_time']}}">
                    <input id="end_time" name="end_time" type="date" class="input-text" style="width:150px"
                           value="{{$con_arr['end_time']==null?'':$con_arr['end_time']}}">
                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索
                    </button>
                </div>
            </form>
        </div>

        <table class="table table-border table-bordered table-bg table-sort mt-20">
            <thead>
            <tr>
                <th>新增用户总量 {{$user_total_num}}户 (增长趋势图如下)</th>
            </tr>
            </thead>
            <tr>
                <td>
                    <div id="user_increase_trend_div" style="width: 100%;height: 200px;">

                    </div>
                </td>
            </tr>
        </table>


        <table class="table table-border table-bordered table-bg table-sort mt-20">
            <thead>
            <tr>
                <th>订单总数：{{$order_pay_num}}个</th>
            </tr>
            </thead>
            <tr>
                <td>
                    <div id="order_pay_increase_trend_div" style="width: 100%;height: 300px;">

                    </div>
                </td>
            </tr>
        </table>
    </div>

@endsection

@section('script')

    <script type="text/javascript">

        //趋势类数据
        var user_increase_trend = {!!$user_increase_trend!!};
        var order_pay_increase_trend = {!!$order_pay_increase_trend!!};

        //用户增长趋势
        function showUserIncreaseTrendBarChart() {
            var chart = echarts.init(document.getElementById('user_increase_trend_div'));
            var date_arr = [];
            var date_value_arr = [];
            for (var i = 0; i < user_increase_trend.length; i++) {
                date_arr.push(user_increase_trend[i].tjdate);
                date_value_arr.push(user_increase_trend[i].nums);
            }
            var option = {
                color: ['#3398DB'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                        type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        data: date_arr,
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: '',
                        type: 'bar',
                        barWidth: '40%',
                        data: date_value_arr
                    }
                ]
            };
            chart.setOption(option);
        }


        //邀请码趋势
        function showOrderPayIncreaseTrendLineChart() {
            var chart = echarts.init(document.getElementById('order_pay_increase_trend_div'));

            var date_arr = [];
            var order_pay_trend_arr = [];
            for (var i = 0; i < order_pay_increase_trend.length; i++) {
                date_arr.push(order_pay_increase_trend[i].tjdate);
                order_pay_trend_arr.push(order_pay_increase_trend[i].nums);
            }

            var option = {
                title: {},
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['订单数统计']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: date_arr
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name: '订单数',
                        type: 'line',
                        stack: '日生成量',
                        data: order_pay_trend_arr
                    }
                ]
            };
            chart.setOption(option);
        }


        $(function () {
            showUserIncreaseTrendBarChart();
            showOrderPayIncreaseTrendLineChart();
        });



    </script>
@endsection