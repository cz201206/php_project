<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'fn.php';
//文件夹
$path_project = dirname(__DIR__);//工程目录
$path_upload = $path_project.uPath('/upload');//上传目录
$path_extract = $path_project.uPath('/extract');//提取数据目录

//文件
$path_index_html = $path_project.uPath('/asset/html/index.html');
return array(
    'path_project'=>$path_project,
    'path_upload'=>$path_upload,
    'path_extract'=>$path_extract
);