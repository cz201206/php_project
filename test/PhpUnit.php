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
}