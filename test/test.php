<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";

$path = GBKPath('米家电压力锅参数表V01.xlsx');
$XlsxHelper = new XlsxHelper($path);
$PinyinHelper = new PinyinHelper();
$DBHelper = new DBHelper();


//region XlsxHelper

//预览文件
$XlsxHelper->loop();
//endregion

//region PinyinHelper
//endregion

//region DBHelper
//endregion

//region
//endregion
