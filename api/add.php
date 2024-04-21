<?php
/**
 * BY:云猫
 * CC的小窝
 * */
error_reporting(0);
    session_start();
if (!isset($_SESSION['loggedin']) ||$_SESSION['loggedin'] !== true) {
    $xiaocat = array(
    'code' => 0,
    'result' => "当前未登录"
);
echo json_encode($xiaocat);
    exit;}

// 读取配置文件
$config = include('config.php');

// 获取请求数据
$email =$_POST['email'];
$smtp =$_POST['smtp'];
$port =$_POST['port'];
$secu =$_POST['secu'];
$username =$_POST['username'];
$password =$_POST['password'];

// 添加邮箱到配置
$config['mailboxes'][$email] = [
    'smtp' => $smtp,
    'port' => $port,
    'secu' => $secu,
    'username' => $username,
    'password' => $password
];

// 保存配置文件
file_put_contents('config.php', '<?php return ' . var_export($config, true) . ';');

$xiaocat = array(
    'code' => 1,
    'result' => "添加成功"
);
echo json_encode($xiaocat);
?>