<?php
echo '<pre>';
ini_set("display_errors","On");
error_reporting(E_ALL);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";


//region 数据区
//$path = GBKPath('米家电压力锅参数表V01.xlsx');//windows 下文件路径写法
$path = '/Users/cz/Desktop/a.xlsx';//mac 下文件路径写法
$XlsxHelper = new XlsxHelper($path);//读取文件
//$XlsxHelper = new XlsxHelper();//写文件
$PinyinHelper = new PinyinHelper();
$DBHelper = new DBHelper();
//endregion

//region 逻辑区
$XlsxHelper->loop();

//读取普通文件
//
//$txt = '/Users/cz/Desktop/a.txt';
//echo is_file($txt).'end<br>';
//$file = fopen($txt, "r") or die('打开文件失败');
//echo fgets($file);
//fclose($file);

//$dir = '/Users/cz/Desktop';
//echo is_dir('/Users/cz/Desktop');
//$list = scandir($dir);
//var_dump($list);
//endregion




