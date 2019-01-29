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
//$XlsxHelper->loop();

//根据坐标获取一个值
/*$cellVal = $XlsxHelper->cellByCoordinate('A1');
printf_cz($cellVal);*/

//根据行，列获取一个值
//$cellVal = $XlsxHelper->cellByRowColumn(1,1);
//printf_cz($cellVal);

//获取一行数据
/*$rowVal = $XlsxHelper->row(3);
printf_cz($rowVal);*/

//获取一列数据
/*$columnVal = $XlsxHelper->column('B');
printf_cz($columnVal);*/

//获取一段范围内数据
/*$rangeVal = $XlsxHelper->range('A1:C3');
printf_cz($rangeVal);*/

//endregion

//region PinyinHelper
//endregion

//region DBHelper
//endregion

//region
//endregion
