<?php
/**
 * BY:云猫
 * CC的小窝
 * */
session_start(); // 开始会话

// 检查用户是否已登录
if (!isset($_SESSION['loggedin']) ||$_SESSION['loggedin'] !== true) {
    $xiaocat = array(
    'code' => 0,
    'result' => "当前未登录"
);
echo json_encode($xiaocat);
    exit;
}

// 如果表单已提交，处理密码修改
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword =$_POST['current_password'] ?? '';
    $newPassword =$_POST['new_password'] ?? '';
    $confirmPassword =$_POST['confirm_password'] ?? '';

    // 读取密码文件
    $passwords = include('password.php');

    // 获取当前用户名
    $username =$_SESSION['username'];

    // 验证当前密码
    if (isset($passwords[$username]) && $passwords[$username] === $currentPassword) {
        // 验证新密码和确认密码是否一致
        if ($newPassword ===$confirmPassword) {
            // 更新密码
            $passwords[$username] = $newPassword;
            file_put_contents('password.php', '<?php return ' . var_export($passwords, true) . ';?>');
            $xiaocat = array(
    'code' => 1,
    'result' => "密码修改成功"
);
echo json_encode($xiaocat);
        } else {
            $xiaocat = array(
    'code' => 0,
    'result' => "密码不一致"
);
echo json_encode($xiaocat);
        }
    } else {
        $xiaocat = array(
    'code' => 0,
    'result' => "密码错误"
);
echo json_encode($xiaocat);
    }
}
?>