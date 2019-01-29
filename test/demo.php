<?php

include 'ChinesePinyin.class.php';


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

//endregion