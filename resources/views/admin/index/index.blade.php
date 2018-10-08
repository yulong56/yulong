@extends('admin.layouts.app')

@section('content')

    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl"><a class="logo navbar-logo f-l mr-10 hidden-xs"
                                               href="">中移和采</a>
                <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="#"></a>
                <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.4</span>
                <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        @if($admin['role']==1)
                            <li>根级管理员</li>
                        @elseif($admin['role']==0)
                            <li>运营人员</li>
                        @elseif($admin['role']==2 || $admin['role']==4)
                            <li>【{{$admin['merchant_name']}}】管理员</li>
                        @endif
                        {{--<li>超级管理员</li>--}}
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A">{{$admin['name']}}<i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" onClick="mysqlf_edit('修改个人信息','{{ route('editMySelf') }}')">个人信息</a>
                                </li>
                                {{--<li><a href="#">切换账户</a></li>--}}
                                <li><a href="{{ URL::asset('/admin/loginout') }}">退出</a></li>
                            </ul>
                        </li>
                        {{--<li id="Hui-msg">--}}
                        {{--<a href="#" title="消息">--}}
                        {{--<span class="badge badge-danger">1</span>--}}
                        {{--<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        <li id="Hui-skin" class="dropDown right dropDown_hover">
                            <a href="javascript:;" class="dropDown_A" title="换肤">
                                <i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i>
                            </a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                                <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                                <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            @if($admin['role']<=1)
                <dl id="menu-article">
                    <dt><i class="icon iconfont">&#xe696;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">
                            &#xe6d5;</i>
                    </dt>
                    <dd>
                        <ul>
                            <li><a data-href="{{ URL::asset('/admin/admin/index') }}" data-title="管理员管理"
                                   href="javascript:void(0)">管理员管理</a></li>
                        </ul>
                    </dd>
                </dl>
                <dl id="menu-product">
                    <dt><i class="icon iconfont">&#xe66b;</i>用户管理<i
                                class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                    </dt>
                    <dd>
                        <ul>
                            <li><a data-href="{{ URL::asset('/admin/user/index') }}" data-title="用户管理"
                                   href="javascript:void(0)">用户管理</a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            @endif
            @if($admin['role']<=1 || $admin['role']==2)
            <dl id="menu-product">
                <dt><i class="icon iconfont">&#xe643;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/zx/zx/index')}}" data-title="资讯管理"
                               href="javascript:void(0)">资讯管理</a>
                        </li>
                        @if($admin['role']<=1)
                            <li><a data-href="{{ URL::asset('/admin/zx/zxType/index') }}?pay_status=2"
                                   data-title="咨询分类管理"
                                   href="javascript:void(0)">资讯类型管理<span
                                            class="label label-danger radius ml-10">!</span></a>
                            </li>
                        @endif
                    </ul>
                </dd>
            </dl>
            @endif
            @if($admin['role']<=1)
                <dl id="menu-product">
                    <dt><i class="icon iconfont">&#xe629;</i>农场管理<i
                                class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                    </dt>
                    <dd>
                        <ul>
                            <li><a data-href="{{ URL::asset('/admin/farm/farm/index') }}" data-title="农场管理"
                                   href="javascript:void(0)">农场管理</a>
                            </li>
                            <li><a data-href="{{ URL::asset('/admin/farm/goods/index') }}" data-title="农产品管理"
                                   href="javascript:void(0)">农产品管理<span
                                            class="label label-danger radius ml-10">!</span></a>
                            </li>
                            <li><a data-href="{{ URL::asset('/admin/farm/goodsType/index') }}" data-title="农产品类型管理"
                                   href="javascript:void(0)">农产品类别管理<span
                                            class="label label-danger radius ml-10">!</span></a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            @elseif($admin['role']==4)
                    <dl id="menu-product">
                        <dt><i class="icon iconfont">&#xe629;</i>农场管理<i
                                    class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                        </dt>
                        <dd>
                            <ul>
                                <li><a data-href="{{ URL::asset('/admin/farm/greenHouse/index')}}?farm_id={{$admin->merchant_id}}" data-title="农场管理"
                                       href="javascript:void(0)">农场管理</a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
            @endif
            @if($admin['role']<=1 || $admin['role']==2)
            <dl id="menu-product">
                <dt><i class="icon iconfont">&#xe643;</i> 精选商品<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/goods/index') }}" data-title="商品管理"
                               href="javascript:void(0)">商品管理</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            @endif
            <dl id="menu-product">
                <dt><i class="icon iconfont">&#xe65d;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/order/index') }}" data-title="订单管理"
                               href="javascript:void(0)">订单管理</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            @if($admin['role']<=1)
                <dl id="menu-product">
                    <dt><i class="icon iconfont">&#xe710;</i> 合作企业<i
                                class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                    </dt>
                    <dd>
                        <ul>
                            <li><a data-href="{{ URL::asset('/admin/enterprise/index') }}?pay_status=2"
                                   data-title="合作企业管理"
                                   href="javascript:void(0)">合作企业管理</a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            @elseif($admin['role']==\App\Consts\AdminRole::ENTERPRISE_ADMIN)
                    <dl id="menu-product">
                        <dt><i class="icon iconfont">&#xe710;</i> 企业管理<i
                                    class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                        </dt>
                        <dd>
                            <ul>
                                <li><a data-href="{{ URL::asset('/admin/enterprise/zx/index') }}?enterprise_id={{$admin->merchant_id}}"
                                       data-title="企业资讯管理"
                                       href="javascript:void(0)">企业资讯管理</a>
                                </li>
                                <li><a data-href="{{ URL::asset('/admin/enterprise/goods/index') }}?enterprise_id={{$admin->merchant_id}}"
                                       data-title="企业商品管理"
                                       href="javascript:void(0)">企业商品管理</a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
            @endif
            {{--<dl id="menu-product">--}}
            {{--<dt><i class="icon iconfont">&#xe606;</i> 配置管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>--}}
            {{--</dt>--}}
            {{--<dd>--}}
            {{--<ul>--}}

            {{--</ul>--}}
            {{--</dd>--}}
            {{--</dl>--}}
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
    </div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    @if($admin['role']<=1)
                        <li class="active">
                            <span title="业务概览" data-href="welcome.html">业务概览</span>
                            <em></em>
                        </li>
                    @elseif($admin['role']==2)
                        <li class="active">
                            <span title="资讯管理" data-href="welcome.html">资讯管理</span>
                            <em></em>
                        </li>
                    @elseif($admin['role']==4)
                        <li class="active">
                            <span title="农场管理" data-href="welcome.html">农场管理</span>
                            <em></em>
                        </li>
                    @else
                        <li class="active">
                            <span title="资讯管理" data-href="welcome.html">资讯管理</span>
                            <em></em>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"
                                                      href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a
                        id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i
                            class="Hui-iconfont">
                        &#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            @if($admin['role']<=1)
                <div class="show_iframe">
                    <div style="display:none" class="loading"></div>
                    <iframe scrolling="yes" frameborder="0" src="{{URL::asset('/admin/stmt/index')}}"></iframe>
                </div>
            @elseif($admin['role']==2)
                <div class="show_iframe">
                    <div style="display:none" class="loading"></div>
                    <iframe scrolling="yes" frameborder="0" src="{{URL::asset('/admin/zx/zx/index')}}"></iframe>
                </div>
            @elseif($admin['role']==4)
                <div class="show_iframe">
                    <div style="display:none" class="loading"></div>
                    <iframe scrolling="yes" frameborder="0" src="{{URL::asset('/admin/farm/greenHouse/index')}}?farm_id={{$admin->merchant_id}}"></iframe>
                </div>
            @else
                <div class="show_iframe">
                    <div style="display:none" class="loading"></div>
                    <iframe scrolling="yes" frameborder="0" src="{{URL::asset('/admin/farm/greenHouse/index')}}"></iframe>
                </div>
            @endif
        </div>
    </section>
    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前</li>
            <li id="closeall">关闭全部</li>
        </ul>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

        });

        /*个人信息-修改*/
        function mysqlf_edit(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

    </script>
@endsection