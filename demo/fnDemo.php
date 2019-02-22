<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
debug();

$array =['第一个key'=>'第一个值','第二个key'=>'第二个值"'];
$json = json($array);
var_dump($json);

$array =[
    '第一组数据'=>['第一个key'=>'第一个值','第二个key'=>'第二个值'],
    '第二组数据'=>['第一个key'=>'第一个值','第二个key'=>'第二个值']
];
$json = json($array);
var_dump($json);
