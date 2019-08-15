<?php

date_default_timezone_set("PRC");
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');
$name_current_module = $conf['name_current_module'];
$time = date("Y-m-d H:i:s",time());

?>


< ?php
session_start();
if($_SESSION['user']){

}else{
echo '未登录';
header('HTTP/1.1 404 Not Found');
exit();
}
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."<?=$name_current_module?>Service.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";

//debug();

$service = new DataService();

$action = @$_POST['action'];