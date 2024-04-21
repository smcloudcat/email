<?php
/**
 * BY:云猫
 * CC的小窝
 * */
error_reporting(0);

// 读取配置文件
$config = include('config.php');

// 构造邮箱列表
$mailboxes = [];
foreach ($config['mailboxes'] as$email => $details) {
    $mailboxes[$email] = $details['username']; // 假设您想显示用户名
}

// 返回邮箱列表
echo json_encode($mailboxes);
?>