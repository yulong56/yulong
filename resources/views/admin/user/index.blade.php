@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span
                class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r btn-refresh"
                                                      style="line-height:1.6em;margin-top:3px"
                                                      href="javascript:location.replace('{{URL::asset('/admin/user/index')}}');"
                                                      title="刷新"
                                                      onclick="location.replace('{{URL::asset('/admin/user/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form action="{{URL::asset('/admin/user/index')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <input id="search_word" name="search_word" type="text" class="input-text" style="width:450px"
                       placeholder="用户名称\手机号码">
                <button type="submit" class="btn btn-success" id="" name="">
                    <i class="Hui-iconfont">&#xe665;</i> 搜索
                </button>
            </form>
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-sort">
                <thead>
                <tr>
                    <th scope="col" colspan="9">用户列表</th>
                </tr>
                <tr class="text-c">
                    {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                    <th width="40">ID</th>
                    <th width="50">头像</th>
                    <th width="80">昵称</th>
                    <th width="80">姓名</th>
                    <th width="120">手机</th>
                    <th width="140">邮箱</th>
                    <th width="130">加入时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        {{--<td><input type="checkbox" value="1" name=""></td>--}}
                        <td>{{$data->id}}</td>
                        <td>
                            <img src="{{ $data->avatar ? $data->avatar.'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                                 class="img-rect-30 radius-5">
                        </td>
                        <td>{{isset($data->nick_name)?$data->nick_name:'--'}}</td>
                        <td>{{isset($data->real_name)?$data->real_name:'--'}}</td>
                        <td>{{isset($data->phonenum)?$data->phonenum:'--'}}</td>
                        <td>{{isset($data->email)?$data->email:'--'}}</td>
                        <td>{{isset($data->created_at)?$data->created_at:'--'}}</td>
                        <td class="td-status">
                            <a title="查看详情" href="javascript:;"
                               {{--/ad/edit--}}
                               onclick="order_edit('查看详情','{{URL::asset('/admin/user/userDetails')}}?id={{$data['id']}}',{{$data['id']}})"
                               class="" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe681;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="margin-top-10">
                {{ $datas->links() }}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">


        $(function () {

        });

        /*查看订单详情*/
        function order_edit(title, url, id) {
            // console.log("comment_edit url:" + url);
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

    </script>
@endsection