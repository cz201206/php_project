<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";
debug();

class XlsxDemo{

    public function fn(){
        //$path = GBKPath('米家电压力锅参数表V01.xlsx');// win版
        $path = '/Library/WebServer/Documents/php_project/upload/主力热点机型参数表相机部分整合.xlsx';// mac 版
        $XlsxHelper = new XlsxHelper($path);//读取文件
//        $XlsxHelper = new XlsxHelper();//写文件
        $PinyinHelper = new PinyinHelper();
        $DBHelper = new DBHelper();

        //region ChinesePinyin
        $Pinyin = new ChinesePinyin();

        $words = '小米mix3（豪华版）(1234)';
        echo '<h2>'.$words.'</h2>';



        echo '<p>转成带有声调的汉语拼音<br/>';
        $result = $Pinyin->TransformWithTone($words);
        echo $result,'</p>';



        echo '<p>转成带无声调的汉语拼音<br/>';
        $result = $Pinyin->TransformWithoutTonedeleteCode($words,' ');
        echo($result),'</p>';



        echo '<p>转成汉语拼音首字母<br/>';
        $result = $Pinyin->TransformUcwords($words);
        echo($result),'</p>';
//endregion

//region XlsxHelper

//预览文件
        $XlsxHelper->loop();

//根据坐标获取一个值
        $cellVal = $XlsxHelper->cellByCoordinate('A1');
        printf_cz($cellVal);

//根据行，列获取一个值
        $cellVal = $XlsxHelper->cellByRowColumn(1,1);
        printf_cz($cellVal);

//获取一行数据
        $rowVal = $XlsxHelper->row(3);
        printf_cz($rowVal);

//获取一列数据
        $columnVal = $XlsxHelper->column('C');
        printf_cz($columnVal);

//获取一段范围内数据
        $rangeVal = $XlsxHelper->range('A1:C3');
        printf_cz($rangeVal);


//定入磁盘
        $XlsxHelper->worksheet->setCellValue('A1','程序写入');
        $xlsx = $XlsxHelper->writeToDisk(GBKPath('程序生成.xlsx'));
        printf_cz($xlsx);
//显示信息
        $info = $XlsxHelper->info();
        var_dump($info);
//提取图片
        $path = '/Library/WebServer/Documents/php_project/upload/小米小爱触屏音箱参数表V01.xlsx';// mac 版
        imagesToDisk($path);
//endregion
    }

    public function exec(){
        $path = '/Library/WebServer/Documents/php_project/upload/小米小爱触屏音箱参数表V01.xlsx';// mac 版
        $XlsxHelper = new XlsxHelper($path);//读取文件
        $XlsxHelper->json();
    }

}

$XlsxDemo = new XlsxDemo();
$XlsxDemo->exec();