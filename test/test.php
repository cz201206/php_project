<?php
echo '<pre>';
ini_set("display_errors","On");
error_reporting(E_ALL);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";


$path = getProjctRealPath_().'upload'.DIRECTORY_SEPARATOR;
var_dump(scandir($path));
var_dump(glob($path.'*'));




