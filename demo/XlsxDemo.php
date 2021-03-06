<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
debug();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."XlsxHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."PinyinHelper.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";

class XlsxDemo{

    public function fnShowList(){
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
//xlsx 转为 json 格式
        $json = $XlsxHelper->toJson();
        echo $json;
//以 json 格式写入磁盘
        $path_json = path_app().'extract'.DIRECTORY_SEPARATOR.'json.json';
        $path_result = $XlsxHelper->toJsonToDisk($path_json);
        echo $path_result;
//        coordinatedArray
        $XlsxHelper = new XlsxHelper($path);//读取文件
        $arrays = $XlsxHelper->coordinatedArrays();
        printf_cz($arrays);
//endregion
    }

    //代码改动区
    public function exec(){
        echo 'from exec<br>';
        //上传路径
        $path_upload = env()['path_upload'];
        $path_extract = env()['path_extract'];
        $fileName = '盒子2.xlsx';
        $path = "$path_upload/$fileName";

        $XlsxHelper = new XlsxHelper($path);//读取文件
        //获取坐标命名的关联数组
        $arrays = $XlsxHelper->coordinatedArrays();
        //遍历产品列
        foreach ($arrays as $name=>$col){
            $path_dir = uPath("$path_extract/$name");
            mkdirs($path_dir);
            $path_file = uPath("$path_extract/$name/xlsx.json");
            file_put_contents($path_file,json($col));
            echo "数据位置：$path_file<hr/>";
        }

    }

}

$XlsxDemo = new XlsxDemo();
$XlsxDemo->exec();