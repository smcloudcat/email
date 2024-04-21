<?php
/**
 * BY:云猫
 * CC的小窝
 * */
session_start();
if (!isset($_SESSION['loggedin']) ||$_SESSION['loggedin'] !== true) {
header("Location: login.php");
    exit;
}

    ?>
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
                      <div class="login-header"><a href="admin.php">后台首页</a>&nbsp;&nbsp;&nbsp; <a href="delete_mailbox.php">删除邮箱</a> &nbsp;&nbsp;&nbsp; <a href="set.php">基本设置</a> &nbsp;&nbsp;&nbsp; <a href="change.php">修改密码</a></div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <input type="email" name="email" value="" lay-verify="required" placeholder="邮箱地址" lay-reqtext="邮箱地址" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    
                    <input type="text" name="smtp" value="" lay-verify="required" placeholder="SMTP服务器" lay-reqtext="SMTP服务器" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
 
                    <input type="secu" name="secu" value="" lay-verify="required" placeholder="加密方式(如ssl)" lay-reqtext="加密方式(如ssl)" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                        <div class="layui-form-item">
                <div class="layui-input-wrap">

                    <input type="text" name="port" value="" lay-verify="required" placeholder="端口" lay-reqtext="端口" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                        <div class="layui-form-item">
                <div class="layui-input-wrap">
 
                    <input type="username" name="username" value="" lay-verify="required" placeholder="账号" lay-reqtext="账号" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                        <div class="layui-form-item">
                <div class="layui-input-wrap">

                    <input type="password" name="password" value="" lay-verify="required" placeholder="密码" lay-reqtext="密码" autocomplete="off" class="layui-input" lay-affix="eye">
                </div>
            </div>
                     
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">添加</button>
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
                url: 'api/add.php', 
                type: 'POST',
                data: data.field, 
                success: function(res){
                    var obj = JSON.parse(res); 
                    if(obj.code === 1){
                        layer.close(loadIndex);
                        layer.msg("添加成功", {icon: 1});
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