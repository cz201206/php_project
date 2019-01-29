<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";

$path = GBKPath('米家电压力锅参数表V01.xlsx');
//$XlsxHelper = new XlsxHelper($path);//读取文件
$XlsxHelper = new XlsxHelper();//写文件
$PinyinHelper = new PinyinHelper();
$DBHelper = new DBHelper();


//region XlsxHelper


//定入磁盘
$XlsxHelper->worksheet->setCellValue('A1','程序写入2');
$xlsx = $XlsxHelper->writeToOutput(GBKPath('程序生成并下载.xlsx'));


//endregion

//region PinyinHelper
//endregion

//region DBHelper
//endregion

//region
//endregion
