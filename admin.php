<?php
/**
 * BY:云猫
 * CC的小窝
 * */
include 'version.php';
session_start();
if (!isset($_SESSION['loggedin']) ||$_SESSION['loggedin'] !== true) {
header("Location: login.php");
    exit;
}

    ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>小猫咪发件程序</title>
  <meta name="keywords" content="小猫咪发件">
  <meta name="description" content="小猫咪发件">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <LINK rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- 引入layui框架 -->
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <link rel="stylesheet" href="layui/css/admin.css">
<script>
$(document).ready(function(){
    // 获取已有邮箱列表
    $.ajax({
        url: "api/get_mailboxes.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var list = $("#mailboxesList");
            list.empty();
            $.each(response, function(key, value) {
                list.append($('<li></li>').text(value));
            });
        }
    });
});
</script>
</head>
<body>
<div class="demo-login-container">
            <div class="login-header">
        <a href="index.php"> 小猫咪工单系统 </a>
      </div>
      <div class="login-header"><a href="add.php">添加邮箱</a>&nbsp;&nbsp;&nbsp; <a href="delete_mailbox.php">删除邮箱</a> &nbsp;&nbsp;&nbsp; <a href="set.php">基本设置</a> &nbsp;&nbsp;&nbsp; <a href="change.php">修改密码</a></div>
            <div class="layui-form-item">
                 <center>
                        
<?php
$url = "https://lwcat.cn/email/update.php"; 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status_code == 200) {
    $json = json_decode($response, true);
        if ($json['version'] == $version) {
            echo "当前版本".$version."<br>最新版本：".$json['version']."<br>当前已是最新版本";
        } else{
            echo "当前版本：".$version."<br>最新版本：".$json['version']."<br>有新版本哦，请参考更新内容来考虑是否更新<br>本次更新内容：<br>".$json['new']."<br><a class='btn btn-primary' href='".$json['url']."'>下载最新版本</a>";
    }
} else {
    echo "请求服务器失败，请联系作者";
}
?>
                        
                    </center>
<h3>已有邮箱列表</h3>
<ul id="mailboxesList"></ul>
</div></div>
</body>
</html>