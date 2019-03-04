<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'fn.php';
//文件夹
$path_project = dirname(__DIR__);
$path_upload = $path_project.uPath('/upload');
$path_data = $path_project.uPath('/data/v2');

//文件
$path_index_html = $path_project.uPath('/asset/html/index.html');
$path_nav2_json = $path_data.uPath('/nav.json');
$path_dts2_json = $path_data.uPath('/dts.json');
return array(
    'path_nav2_json'=>$path_nav2_json,
    'path_dts2_json'=>$path_dts2_json,
    'path_project'=>$path_project,
    'path_data'=>$path_data,
    'path_upload'=>$path_upload,
    'path_index_html'=>$path_index_html
);