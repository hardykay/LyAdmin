<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }} - 后台登录</title>
    <meta name="author" content="DeathGhost"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('login_bg/css/style.css') }}"
          tppabs="{{ asset('login_bg/css/style.css') }}"/>
    <style>
        body {
            height: 100%;
            background: #16a085;
            overflow: hidden;
        }

        .captcha_icon:before{
            content: "c";
        }

        canvas {
            z-index: -1;
            position: absolute;
        }
    </style>
    <script src="{{ asset('login_bg/js/jquery.js') }}"></script>
    <script src="{{ asset('login_bg/js/verificationNumbers.js') }}" tppabs="js/verificationNumbers.js"></script>
    <script src="{{ asset('login_bg/js/Particleground.js') }}" tppabs="js/Particleground.js"></script>
    <script>
        $(document).ready(function () {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });
    </script>
</head>
<body>
<dl class="admin_login" style="width: 400px;">
    <dt>
        <strong style="font-size: 30px;color: #9dfbe9;">{{ env('APP_NAME') }}后台管理系统</strong>
        <em style="color: #ffffff;">{{ session('fail') }}</em>
    </dt>
    <form class="form form-horizontal" action="{{ route('dologin') }}" method="post">
        {{ csrf_field() }}
        <dd class="user_icon">
            <input type="text" placeholder="账号" class="login_txtbx" name="username" value="{{ session('username') }}" autocomplete="off"/>
        </dd>
        <dd class="pwd_icon">
            <input type="password" placeholder="密码" class="login_txtbx" name="password" autocomplete="off"/>
        </dd>
        <dd style="margin-top: 15px;height: 20px;">
            <input type="checkbox" name="remember" value="1"> <span style="color: #ffffff">使我保持登录状态</span>
        </dd>
        <dd>
            <input type="submit" value="立即登陆" class="submit_btn"/>
        </dd>
    </form>
    <dd>
        <p>Copyright {{ env('APP_NAME') }} by LyAdmin</p>
    </dd>
</dl>
</body>
</html>