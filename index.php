<?php 
/**
 * BY:云猫
 * CC的小窝
 * */
$data = json_decode(file_get_contents('data/data.json'), true);?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title><?php echo $data['title']; ?></title>
  <meta name="keywords" content="<?php echo $data['keyword']; ?>">
  <meta name="description" content="<?php echo $data['description']; ?>">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <LINK rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <link rel="stylesheet" href="layui/css/admin.css">
</head>
<body>
            <form class="layui-form" id="loginForm">
        <div class="demo-login-container">
            <div class="login-header">
        <a href="index.php"><?php echo $data['title']; ?></a>
      </div>
      <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-col-md6">
<select name="mailbox" id="mailboxes"></select>
</div>
                </div>
            </div>
                        <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <input type="email" name="to" value="" lay-verify="required" placeholder="收件地址" lay-reqtext="收件地址" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                                    <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <input type="sendname" name="sendname" value="" lay-verify="required" placeholder="发件人名称" lay-reqtext="发件人名称" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
                        <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <input type="subject" name="subject" value="" lay-verify="required" placeholder="主题" lay-reqtext="主题" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <textarea name="body" lay-verify="required" placeholder="内容" class="layui-textarea" lay-affix="clear"></textarea>
                </div>
            </div>
            
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="send">发送邮件</button>
            </div>
        </div>
    </form>
 <center>
  <?php echo $data['foot']; ?>
  </center>
<script src="layui/layui.js"></script>
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(send)', function(data){
                var loadIndex = layer.load(2);
            $.ajax({
                url: 'api/send_email.php', 
                type: 'POST',
                data: data.field, 
                success: function(res){
                    var obj = JSON.parse(res); 
                    if(obj.code === 1){
                        layer.close(loadIndex);
                        layer.msg("发送成功", {icon: 1});

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
    layui.use(['form'], function(){
    var form = layui.form;

    $.ajax({
        url: "api/get_mailboxes.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var select = $("#mailboxes");
            $.each(response, function(key, value) {
                select.append($('<option></option>').attr('value', key).text(value));
            });
            form.render('select');
        }
    });
});
</script>
</body>
</html>