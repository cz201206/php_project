<?php
date_default_timezone_set("PRC");
function debug(){
    echo '<pre>';

    ini_set('date.timezone','Asia/Shanghai');
    ini_set("display_errors","On");
    error_reporting(E_ALL);

    var_dump($_GET);
    var_dump($_POST);
    var_dump($_FILES);
}


function nodebug(){
    ini_set('date.timezone','Asia/Shanghai');
    ini_set("display_errors", 0);

    error_reporting(E_ALL ^ E_NOTICE);

    error_reporting(E_ALL ^ E_WARNING);


}

function date_formated(){
    return date("Y-m-d H:i",time());
}

function cz_date_diff($start_date, $end_date){
    $datetime_start = new DateTime($start_date);
    $datetime_end = new DateTime($end_date);
    $days = $datetime_start->diff($datetime_end)->days;
    return $days;
}

//将 xlsx 文件数据 转换为 json 格式
function toDisk($path,$json){
    $result_write = file_put_contents($path,$json);//写入磁盘
    if(!$result_write){
        echo '<br/>写入 json 失败！<br/>';
    }
    return $path;
}

function appendToFile($path, $data){
    $time = date_formated();
    $data = "$time $data".PHP_EOL;
    $result_write = file_put_contents($path, $data, FILE_APPEND);//写入磁盘
    if(!$result_write){
        return false;
    }else{
        return $path;
    }
}

//获取 project 物理路径
function getProjctRealPath_(){
    $path = dirname(__DIR__).DIRECTORY_SEPARATOR;
    return $path;
}
function upload($file,$uploadDir){
    $type =$file["file"]["type"];
    $size = $file["file"]["size"];
    $name = $file["file"]["name"];
    $uploadDir = uPath("$uploadDir/$name");

    if (
        ($type == "image/png"
            || $type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            || $type == "application/pdf"
            || $type == "application/x-zip-compressed"
            //|| $type == "application/octet-stream"
            || $type == "application/zip")
        && $size < 53000000
    )
    {
        if ($file["file"]["error"] > 0)
        {
            echo "Return Code: " . $file["file"]["error"] . "<br />";
        } else{


            move_uploaded_file($file["file"]["tmp_name"],$uploadDir);
            return $uploadDir;
        }
    }else{
        echo "无效文件 类型 ：$type 大小： $size B";
        return 0;
    }
}

function uPath ($path){
    $upath = str_replace('/',DIRECTORY_SEPARATOR,$path);

    $uname = php_uname('s');
    if('Windows NT'==$uname){
        $upath = GBKPath($upath);
    }
    return $upath;
}

function env(){
    return require(path_app().uPath('config/env.php'));
}

function basename_zh($filename,$suffix=null){
    $basename = preg_replace('/^.+[\\\\\\/]/', '', $filename);
    if($suffix){
        $basename = str_replace($suffix,'',$basename);
    }
    return $basename;
}
function isWin(){
    $uname = php_uname('s');
    if('Windows NT'==$uname){
        return true;
    }
    return false;
}
function GBKPath($path){
    return iconv('utf-8','GBK',$path);
}
