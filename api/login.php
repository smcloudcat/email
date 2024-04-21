<?php
/**
 * BY:云猫
 * CC的小窝
 * */
session_start(); // 开始会话

// 读取密码文件
$passwords = include('password.php');

// 获取POST数据
$username =$_POST['username'] ?? '';
$password =$_POST['password'] ?? '';

// 验证用户名和密码
if (isset($passwords[$username]) && $passwords[$username] === $password) {
    // 登录成功，设置会话变量
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] =$username;
    $xiaocat = array(
    'code' => 1,
    'result' => "登录成功"
);
echo json_encode($xiaocat);
    exit;
} else {
    // 登录失败
    $xiaocat = array(
    'code' => 0,
    'result' => "密码错误"
);
echo json_encode($xiaocat);
}
?>