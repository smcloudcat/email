<?php
/**
 * BY:云猫
 * CC的小窝
 * QQ3522934828
 * 博lwcat.cn
 * */
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// 读取配置文件
$config = include('config.php');

// 获取请求数据
$to =$_POST['to'];
$subject =$_POST['subject'];
$body =$_POST['body'];
$mailbox =$_POST['mailbox'];
$sendname =$_POST['sendname'];

// 初始化PHPMailer
$mail = new PHPMailer(true);

try {
    // 配置SMTP服务器
    $mail->SMTPDebug = 0; // 关闭调试输出
    $mail->isSMTP();
    $mail->Host =$config['mailboxes'][$mailbox]['smtp'];
    $mail->SMTPAuth = true;
    $mail->Username =$config['mailboxes'][$mailbox]['username'];
    $mail->Password =$config['mailboxes'][$mailbox]['password'];
    $mail->From =$config['mailboxes'][$mailbox]['username'];
    $mail->SMTPSecure = $config['mailboxes'][$mailbox]['secu'];
    $mail->Port =$config['mailboxes'][$mailbox]['port'];
    $mail->FromName = $sendname;
    $mail->setLanguage('zh_cn');

    // 设置发件人和收件人
    $mail->setFrom($config['mailboxes'][$mailbox]['username']);
    $mail->addAddress($to);

    // 设置邮件内容
    $mail->isHTML(true);
    $mail->Subject =$subject;
    $mail->Body    =$body;

    // 发送邮件
    $mail->send();
// 读取发送次数统计文件
$mailStats = include('mail_stats.php');

// 获取当前邮箱的发送次数
$currentCount = isset($mailStats[$mailbox]) ?$mailStats[$mailbox] : 0;

// 更新发送次数
$mailStats[$mailbox] = $currentCount + 1;

// 将更新后的发送次数写回文件
file_put_contents('mail_stats.php', '<?php return ' . var_export($mailStats, true) . ';');
    $xiaocat = array(
    'code' => 1,
    'result' => "发送成功"
);
} catch (Exception $e) {
$xiaocat = array(
    'code' => 0,
    'result' => $mail->ErrorInfo
);
}
echo json_encode($xiaocat);

?>