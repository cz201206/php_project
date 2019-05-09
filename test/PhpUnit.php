<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR."XlsxHelper.php";
use PHPUnit\Framework\TestCase;
/**
 * Array测试用例
 * Class ArraysTest
 */
class ArraysTest extends TestCase
{
    public function testGet()
    {
        $json = XlsxHelper::sheetToJson('../upload/词条.xlsx',0);

        echo $json;
        $this->assertEquals('cqh', "cqh");
    }
    //测试随机数
    public function testRand()
    {
        $list = [];
        for($i=0; $i<10; $i++){
            $list[] = rand(0,100);
        }

        echo json($list);
    }

    //测试排序
    public function testSort(){
        $arr = [45,43,35,100,26,43,21,21,11,60];
        for($j=0;$j<count($arr)-1;$j++){
            for($i=0;$i<count($arr)-1-$j;$i++){
                if($arr[$i] < $arr[$i+1]){
                    $arr[$i+1] = $arr[$i]+$arr[$i+1];
                    $arr[$i] = $arr[$i+1]-$arr[$i];
                    $arr[$i+1] = $arr[$i+1]-$arr[$i];
                }
            }
        }

        echo json($arr);

    }

    public function testhe(){

    }
}