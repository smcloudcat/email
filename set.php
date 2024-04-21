<?php
/**
 * BY:云猫
 * CC的小窝
 * */
session_start();
    $data = json_decode(file_get_contents('data/data.json'), true);
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
    <link rel="stylesheet" href="../layui/css/layui.css">
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <link rel="stylesheet" href="../layui/css/admin.css">
</head>
<body>
            <form class="layui-form" id="loginForm">
        <div class="demo-login-container">
            <div class="login-header">
        <a href="index.php"> 小猫咪发件程序 </a>
      </div>
     <div class="login-header"><a href="add.php">添加邮箱</a>&nbsp;&nbsp;&nbsp; <a href="delete_mailbox.php">删除邮箱</a> &nbsp;&nbsp;&nbsp; <a href="admin.php">后台首页</a> &nbsp;&nbsp;&nbsp; <a href="change.php">修改密码</a> </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-edit"></i>
                    </div>
                    <input type="text" name="title"  lay-verify="required" placeholder="网站标题" lay-reqtext="网站标题" autocomplete="off" class="layui-input" lay-affix="clear" value="<?php echo $data['title']; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-edit"></i>
                    </div>
                    <textarea type="text" name="description"  lay-verify="required" placeholder="网站描述" lay-reqtext="网站描述" autocomplete="off" class="layui-input" lay-affix="clear"><?php echo $data['description']; ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-edit"></i>
                    </div>
                    <input type="text" name="keyword" lay-verify="required" placeholder="网站关键词" lay-reqtext="请填写新账号" autocomplete="off" class="layui-input" lay-affix="clear" value="<?php echo $data['keyword']; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-edit"></i>
                    </div>
                    <input type="text" name="foot" lay-verify="required" placeholder="底部信息" lay-reqtext="底部信息" autocomplete="off" class="layui-input" lay-affix="clear" value="<?php echo $data['foot']; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">修改</button>
            </div>
        </div>
    </form>

<script src="../layui/layui.js"></script>
<script>

    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(login)', function(data){
                var loadIndex = layer.load(2);
            $.ajax({
                url: 'api/set.php', 
                type: 'POST',
                data: data.field, 
                success: function(res){
                    var obj = JSON.parse(res); 
                    if(obj.code === 1){
                        layer.close(loadIndex);
                        layer.msg("修改成功", {icon: 1});
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