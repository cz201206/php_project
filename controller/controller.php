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
        $dirDir = dirname(__DIR__).DIRECTORY_SEPARATOR."upload";
        $dirName = $_POST['dirName'];

        $dir = $dirDir.DIRECTORY_SEPARATOR.$dirName;
        if(''===$dirName)$dir = $dirDir;
        $pattern = "*.*";

        echo "扫描路径：$dir<br/>";
        echo "表达式：$pattern <br/>";

        $FilePojos = filesInfo($dirDir.DIRECTORY_SEPARATOR.$dirName,$pattern);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."result".DIRECTORY_SEPARATOR."filesInfo".DIRECTORY_SEPARATOR."list.php";
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
