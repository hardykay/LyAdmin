<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    @yield('style')
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">{{ env('APP_NAME') }} 后台管理</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="{{ route('/') }}">控制台</a></li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域 -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                @foreach($share_menus as $share_menu)
                    @if(empty($share_menu->sons->count()) && !empty($share_menu->href))
                        <li class="layui-nav-item"><a href="">{{ $share_menu->title }}</a></li>
                    @else
                        <li class="layui-nav-item layui-nav-itemed">
                            <a class="" href="javascript:;">{{ $share_menu->title }}</a>
                            <dl class="layui-nav-child">
                                @foreach($share_menu->sons as $share_menu_son)
                                    <li class="layui-nav-item"><a href="">{{ $share_menu_son->title }}</a></li>
                                @endforeach
                            </dl>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            @yield('content')
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © LyAdmin - 底部固定区域
    </div>
</div>
<script src="{{ asset('layui/layui.js') }}"></script>
<script>
    //JavaScript代码区域
    layui.config({
        base: '/layui/mymod/'
    }).extend({
        lyajax: 'lyajax'
    });
    layui.use('element', function(){
        var element = layui.element;

    });
</script>
@yield('script')
</body>
</html>