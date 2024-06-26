<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>小猫咪发件程序</title>
    <!-- 引入layui框架 -->
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <link rel="stylesheet" href="layui/css/admin.css">
</head>
<body>
            <form class="layui-form" id="loginForm">
        <div class="demo-login-container">
            <div class="login-header">
        <a href="index.php"> 小猫咪发件程序 </a>
      </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-username"></i>
                    </div>
                    <input type="text" name="username" value="" lay-verify="required" placeholder="用户名" lay-reqtext="请填写用户名" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-password"></i>
                    </div>
                    <input type="password" name="password" value="" lay-verify="required" placeholder="密码" lay-reqtext="请填写密码" autocomplete="off" class="layui-input" lay-affix="eye">
                </div>
            </div>
            <div class="layui-form-item">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">登录</button>
                

                
            </div>
        </div>
    </form>

<script src="layui/layui.js"></script>
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(login)', function(data){
                var loadIndex = layer.load(2);
            $.ajax({
                url: 'api/login.php', 
                type: 'POST',
                data: data.field, 
                success: function(res){
                    var obj = JSON.parse(res); 
                    if(obj.code === 1){
                        layer.close(loadIndex);
                        layer.msg("登录成功", {icon: 1});
setTimeout(function() {
                    window.location.href = "admin.php";
                    }, 1500);
                    } else {
                        layer.close(loadIndex);
                        layer.msg(obj.result, {icon: 2});
                    }
                },
                error: function(){
                    layer.close(loadIndex);

                    layer.msg('An error occurred while processing your request.', {icon: 2});
                }
            });
            return false; 
        });
    });
</script>
</body>
</html>