<?php
/**
 * BY:云猫
 * CC的小窝
 * */
error_reporting(0);

// 读取发送次数统计文件
$mailStats = include('mail_stats.php');

// 返回发送次数统计信息
echo json_encode($mailStats);
?>