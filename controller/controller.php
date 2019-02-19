<?php
require_once  dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";

debug();

//获取 请求行为类型
$action = $_POST['action'];

switch ($action){

    case '':
        ;
    break;

    case 'upload' :
//        echo 'upload';
        printf_cz($_FILES);
        uploadCheck($_FILES);
    break;
    default:
        echo "没有任何 action ";

}
