<?php
/**
 * BY:云猫
 * CC的小窝
 * */
    session_start();
if (!isset($_SESSION['loggedin']) ||$_SESSION['loggedin'] !== true) {
    $xiaocat = array(
    'code' => 0,
    'result' => "当前未登录"
);
echo json_encode($xiaocat);
    exit;
    } else {
        $data = array(
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'keyword' => $_POST['keyword'],
            'foot' => $_POST['foot']
        );
        file_put_contents('../data/data.json', json_encode($data));
        $data = json_decode(file_get_contents('../data/data.json'), true);
        $xiaocat = array(
    'code' => 1,
    'result' => "修改成功"
);
echo json_encode($xiaocat);
        exit();
    }