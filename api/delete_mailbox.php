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
    exit;
}

// 读取配置文件
$config = include('config.php');

// 获取请求数据
$email =$_POST['email'];

// 删除邮箱
if (isset($config['mailboxes'][$email])) {
    unset($config['mailboxes'][$email]);

    // 保存配置文件
    file_put_contents('config.php', '<?php return ' . var_export($config, true) . ';');

    $xiaocat = array(
    'code' => 1,
    'result' => "添加成功"
);
echo json_encode($xiaocat);
} else {
    $xiaocat = array(
    'code' => 0,
    'result' => "该邮箱不存在"
);
echo json_encode($xiaocat);
}
?>
