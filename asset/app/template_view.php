<?php

date_default_timezone_set("PRC");
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');
$name_current_module = $conf['name_current_module'];
$time = date("Y-m-d H:i:s",time());

?>
< ?php
session_start();
$user = @$_SESSION['user'];
//var_dump($user);

if(0 === $user["id_group"]){ //'' == $user["id_group"] ||  || null== $user["id_group"]
    echo "账号异常,请联系管理员";
    exit();
}

$group = "";
if($user){
    $id_group = $user['id_group'];
    if(1 == $id_group)$group = '天猫';
    else $group = '京东';
}else{
    header('Location: /project/tmall/client/login.php');
    exit();
}
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."client".DIRECTORY_SEPARATOR."<?=$name_current_module?>".DIRECTORY_SEPARATOR."html.php";