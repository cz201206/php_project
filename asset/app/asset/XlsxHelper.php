<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
class XlsxHelper{

    public $spreadsheet; // xlsx 文件
    public $worksheet; // 当前工作表

    function __construct($path=null,$sheetIndex=0)
    {
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);

        //判断是否创建 xlsx 文件
        if($path)
            $this->spreadsheet = $reader->load($path);//如果有路径则为读取一个文件
        else
            $this->spreadsheet = new Spreadsheet();//没有传入路径，则创建一个文件

        //判断是否需要创建 worksheet
        if($sheetIndex)
            $this->worksheet = $this->spreadsheet->getSheet($sheetIndex);//如果传入 sheet 标，则读取该sheet 页
        else
            $this->worksheet = $this->spreadsheet->getActiveSheet();//如果没有传入 sheet 标，则默认读取第一个 sheet 页

    }

    //读取数据
    public function loop($start, $end){
        $list_associate = null;
        $highestColumn  = $this->worksheet->getHighestColumn();
        $highestRow = $this->worksheet->getHighestRow();
        for($i = $start ; $i<=$end; $i++){
            $pCoordinate_name = "A$i";
            $pCoordinate_level = "C$i";
            //echo "$pCoordinate_name : $pCoordinate_level";
            $name = $this->worksheet->getCell($pCoordinate_name)->getValue();
            $level = $this->worksheet->getCell($pCoordinate_level)->getValue();
            $list_associate[$name] = $level;
        }
        echo "列宽：$highestColumn 行长：$highestRow";
        return $list_associate;
    }

    //修改 worksheet 表内容
    public function setCellValue($coordinate, $val){
        $this->worksheet->setCellValue($coordinate, $val);
    }
    public function setCellValueByColumnAndRow($columnIndex, $row, $value){
        $this->worksheet->setCellValueByColumnAndRow($columnIndex, $row, $value);
    }

    //region 输出文件
    public function writeToDisk($path){
        $writer = IOFactory::createWriter($this->spreadsheet, "Xlsx");
        $writer->save($path);
        return $path;
    }
    public function writeToOutput($fname){

        ob_end_clean();//清除缓存以免乱码出现
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fname . '"');
        header('Cache-Control: max-age=0');
/*

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $fname );
        header('Cache-Control: max-age=0');
        */
        $writer = IOFactory::createWriter($this->spreadsheet, "Xlsx");
        $writer->save('php://output');

    }
    //endregion

}
