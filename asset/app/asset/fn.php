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