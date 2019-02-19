<?php
require_once  dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
debug();

//获取 请求行为类型
$action = $_POST['action'];

switch ($action){

    case '':
        ;
    break;

    //读取某个目录下所有文件显示
    case 'filesInfo':
//        echo 'filesinfo';
        $dirName = $_POST['dirName'];
        $filePath = getProjctRealPath_()."$dirName";
        echo "扫描路径：$filePath<br/>";
        $files = filesInfo($filePath,'*.xlsx');
        $mtime = filemtime($files['0']);
        echo "修改时间：$mtime<br/>";
        $mtime_format = date("Y-m-d H:i:s",$mtime);
        echo "修改时间(格式化)：$mtime_format<br/>";
        ;
    break;

    //上传文件
    case 'upload' :
//        echo 'upload';
        printf_cz($_FILES);
        uploadCheck($_FILES);
    break;
    default:
        echo "没有任何 action ";

}
