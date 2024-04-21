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
           <div class="login-header"><a href="add.php">添加邮箱</a>&nbsp;&nbsp;&nbsp; <a href="delete_mailbox.php">删除邮箱</a> &nbsp;&nbsp;&nbsp; <a href="set.php">基本设置</a> &nbsp;&nbsp;&nbsp; <a href="admin.php">后台首页</a></div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    
                    <input type="text" name="current_password" value="" lay-verify="required" placeholder="旧密码" lay-reqtext="旧密码" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <input type="text" name="new_password" value="" lay-verify="required" placeholder="新密码" lay-reqtext="请填写新密码" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                     <div class="layui-form-item">
                <div class="layui-input-wrap">
                   
                    <input type="text" name="confirm_password" value="" lay-verify="required" placeholder="重复新密码" lay-reqtext="重复新密码" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">修改</button>
            </div>
        </div>
    </form>

<script src="layui/layui.js"></script>
<script>

    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(login)', function(data){
            
            $.ajax({
                url: 'api/change_password.php', 
                type: 'POST',
                data: data.field, 
                success: function(res){
                    var obj = JSON.parse(res); 
                    if(obj.code === 1){
                        // 登录成功
                        layer.msg("修改成功", {icon: 1});
                    } else {
                         layer.msg(obj.result, {icon: 2});
                        
                    }
                },
                error: function(){
                    layer.msg('An error occurred while processing your request.', {icon: 2});
                }
            });
            return false; 
        });
    });
</script>
</body>
</html>