<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
require_once __DIR__.DIRECTORY_SEPARATOR."fn.php";
require_once __DIR__.DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
class XlsxHelper{

    public $ChinesePinyin;
    public $worksheet;
    public $spreadsheet;
    function __construct($path=null,$sheetIndex=0)
    {
        $this->ChinesePinyin = new ChinesePinyin();
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        //如果有路径则为读取一个文件
        if($path)
            $this->spreadsheet = $reader->load($path);
        //没有传入路径，则创建一个文件
        else
            $this->spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        //如果传入 sheet 标，则读取该sheet 页
        if($sheetIndex)
            $this->worksheet = $this->spreadsheet->getSheet($sheetIndex);
        //如果没有传入 sheet 标，则默认读取第一个 sheet 页
        else
            $this->worksheet = $this->spreadsheet->getActiveSheet();

    }

//region 读取信息
    //可提示对象
    public function tip(){
        $cell = $this->worksheet->getCell('A1');
        $cell->getRow();
        $cell->getColumn();
        $cell->getCalculatedValue();
        $cell->getCoordinate();
        $cell->getValue();
        $cell->hasValidValue();
    }
    //遍历
    public function loop(){

        echo '<table>' . PHP_EOL;
        foreach ($this->worksheet->getRowIterator() as $row) {
            echo '<tr>' . PHP_EOL;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $cell) {
                echo '<td>' .
                    $cell->getValue() .
                    '</td>' . PHP_EOL;
            }
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;
    }
    public function loop_array(){
        $array = $this->worksheet->rangeToArray(
            'B1:C5',     // The worksheet range that we want to retrieve
            NULL,        // Value that should be returned for empty cells
            TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
            TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
            TRUE         // Should the array be indexed by cell row and cell column
        );
//        $array = $this->worksheet->toArray();
        return $array;
    }
    public function cellByCoordinate($coordinate='A1'){
        return $this->worksheet->getCell($coordinate)->getCalculatedValue();
    }
    public function cellByRowColumn($rowIndex=1,$columnIndex=1){
        return $this->worksheet->getCellByColumnAndRow($rowIndex, $columnIndex)->getCalculatedValue();
    }
    public function row($rowIndex){
        $rowVal = [];
        $RowIterator = $this->worksheet->getRowIterator($rowIndex,$rowIndex);
        foreach($RowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $cell) {
                $cellVal = $cell->getValue();
                $rowVal[] = $cellVal;
            }
        }
        return $rowVal;
    }
    public function column($columnIndex){
        $columnVal = [];
        $RowIterator = $this->worksheet->getColumnIterator($columnIndex,$columnIndex);
        foreach($RowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $cell) {
                $cellVal = $cell->getValue();
                $columnVal[] = $cellVal;
            }
        }
        return $columnVal;
    }
    public function range($coordinateRange='A1:B2'){
        $dataArray = $this->worksheet
            ->rangeToArray(
                $coordinateRange,     // The worksheet range that we want to retrieve
                NULL,        // Value that should be returned for empty cells
                TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                TRUE         // Should the array be indexed by cell row and cell column
            );
        return $dataArray;
    }
    public function sheet(){

    }
    public function info(){
        //获取最右边列标 //获取最下边行标
        return $this->worksheet->getHighestRowAndColumn();

    }
    //将 xlsx 文件数据 转换为 json 格式
    public function toJson(){
        //数据容器
        $array = [];
        foreach ($this->worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true); // This loops through all cells,

            foreach ($cellIterator as $cell) {
                $val = $cell->getValue();
                $cell->getRow();
                $cell->getColumn();
                $cell->getCalculatedValue();
                $corrdinate = $cell->getCoordinate();
                $isValid = $cell->hasValidValue();

                if(''==$val){

                }else{
                    //数据格式处理

                    //添加数据
                    $array[$corrdinate] = $val;
                }

            }
        }
        //转换为 json 格式
        $json = json($array);

        return $json;
    }
    //将 xlsx 文件数据 转换为 json 格式， 包含多列
    public function coordinatedArrays(){
        $returnVal = [];//返回数据
        $cols_A = [];//第一列数据
        $cols_B = [];//第二列数据
        $cols_n = [];//第 n 列数据
        //以列为单位进行遍历
        //A B 两列做为公开数据记录
        //其他列效单独记录
        //合并数据 A+B+n 并装入返回 named 数据容器

        foreach ($this->worksheet->getColumnIterator() as $col) {
            $cellIterator = $col->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true); // This loops through all cells,
            $colCorr = '';
            foreach ($cellIterator as $cell) {
                $val = $cell->getValue();
                $rowCorr = $cell->getRow();
                $colCorr = $cell->getColumn();
                $cell->getCalculatedValue();
                $corrdinate = $cell->getCoordinate();
                $isValid = $cell->hasValidValue();

                if(''==$val){

                }else if('A'==$colCorr){//记录 A 列数据
                    $cols_A[$corrdinate] = $val;
                }else if('B'==$colCorr){//记录 B 列数据
                    $cols_B[$corrdinate] = $val;
                }else{//其他列数据
                    $cols_n[$corrdinate] = $val;
                }
            }//一列完成
            if($colCorr!='A' && $colCorr!='B' ){//如果是其他列则合并数据，并记录

                if(!$cols_n)break;
                $title = current($cols_n);
                $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
                $data = array_merge($cols_A,$cols_B,$cols_n);
                $returnVal[$name] = $data;
                $cols_n = array();
            }
        }


        return $returnVal;
    }
    //将 xlsx 文件数据 转换为 json 格式
    public function toJsonToDisk($path){
        $json = $this->toJson();
        $result_write = file_put_contents($path,$json);//写入磁盘
        if(!$result_write){
            echo '<br/>写入 json 失败！<br/>';
        }
        return $path;
    }
//endregion

//region 写文件
    public function writeToDisk($path){
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, "Xlsx");
        $writer->save($path);
        return $path;
    }
    public function writeToOutput($name){
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $name );
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, "Xlsx");
        $writer->save('php://output');
    }
//endregion

//region 静态方法

//提取图片
    public static function imagesToDisk($path_xlsx,$path_img){
//    $path_extract = getProjctRealPath_()."extract".DIRECTORY_SEPARATOR;
        $path_extract = $path_img;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path_xlsx);
        $title = $spreadsheet->getActiveSheet()->getTitle();
        $i = 0;
        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(),'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader,1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }
            /*
            $myFileName = '00_Image_'.++$i.'.'.$extension;
            $path_img = $path_extract.$myFileName;
            */
            $result_write = file_put_contents($path_img,$imageContents);
            if($result_write){
                return $path_img;
            }else{
                echo '图片导出失败！';
            }

        }
    }
    public static function importSpecDatas($worksheet, $product_category_ID, $ChinesePinyin, $ProductSpecDao)
    {
        $count = 0;//列计数
        $rankPartner = 1000; //排序伴侣，逆序
        $pojos_spec = [];
        foreach ($worksheet->getColumnIterator() as $column) {
            $specs = [];
            //提取列的列号
            $ColumnIndex = $column->getColumnIndex();
            //去除两个参数项列
            if ('A' === $ColumnIndex || 'B' === $ColumnIndex) continue;
            $count++;
            //打印提取数据列号
            echo "$ColumnIndex ";
            //机型单元格坐标
            $coordinate_model = $ColumnIndex . '1';
            //提取列数据
            $pojo = new SpecPojo();
            //$pojo->$ID;
            $pojo->product_category_ID = $product_category_ID;
            $pojo->rank = $count;
            $pojo->title = $worksheet->getCell($coordinate_model)->getValue();
            $pojo->name = $ChinesePinyin->TransformWithoutTonedeleteCode($pojo->title);
            $cellIterator = $column->getCellIterator();
            foreach ($cellIterator as $cell) {
                $cellValue = trim($cell->getValue());
                //单元格相关信息
                $cellColumn = $cell->getColumn();
                $cellRow = $cell->getRow();

                //将单元格值包装为对象
                $coordinate_spec = "B$cellRow";
                $specTitle = $worksheet->getCell($coordinate_spec)->getValue();

                if('产品图'!=$specTitle && '外观'!=$specTitle){
                    $specName = $ChinesePinyin->TransformWithoutTonedeleteCode($specTitle);
                    //特殊处理
                    if('详细参数'==$specTitle || '参数项'==$specTitle)$specName = $ChinesePinyin->TransformWithoutTonedeleteCode('机型');
                    //将单元格内的换行替换为 <br/>
                    $cellValue = str_replace(array("\r\n", "\r", "\n"), '<br/>', $cellValue);

                    //将 name 和 参数值 包装为关联数组，并存入 $specs 中
                    $specs["$specName"] = $cellValue;

                    //只提取两行数据
                    //if(2===$cellRow)break;
                }else{

                }




            }
            //最终单元格的数据库格式
            $pojo->spec = json($specs);
            //数据中添加新元素
            $pojos_spec[] = $pojo;

            //导入到数据库中
            $ProductSpecDao->insert($pojo->name, $pojo->title, $pojo->rank, $pojo->product_category_ID, $pojo->spec);

            //先提取两列数据做为测试
            //if( 'D' === $ColumnIndex)break;
        }
//var_dump($pojos_spec);
        echo "<p>总计：$count<p/>";
    }
    public static function showSpectItem($worksheet)
    {
        $level1Title = "";$level1ID = 0;
        //多行数据
        foreach ($worksheet->getRowIterator() as $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,

            //一行数据
            foreach ($cellIterator as $cell) {
                $cellColumn = $cell->getColumn();
                $cellRow = $cell->getRow();
                $cellValue = $cell->getValue();
                // A 列处理区
                if ('A' === $cellColumn) {
                    //新一级出现时处理区
                    if (NULL !== $cellValue) {
                        $level1Title = $cellValue;
                    } else {

                    }
                    // B 列处理区
                } elseif ('B' === $cellColumn) {
                    echo "$level1Title:$cellValue<br/>";
                }
            }

        }
    }
    public static function pojos_specItem($worksheet, $product_category_ID){
        global $ChinesePinyin;
        $level1s = array();
        $level1 = null;
        //$product_category_ID 为产品分类 ID 手机为1，电视为2，盒子为3
        $level1Title = "";$level1ID = $product_category_ID*100;
        $level2Title = "";$level2ID = $product_category_ID*1000;
        //多行数据
        foreach ($worksheet->getRowIteratqt7or() as $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,

            //一行数据
            foreach ($cellIterator as $cell) {
                $cellColumn = $cell->getColumn();
                $cellRow = $cell->getRow();
                $cellValue = $cell->getValue();
                // A 列处理区
                if ('A' === $cellColumn) {
                    //新一级出现时处理区
                    if (NULL !== $cellValue&&'参数项'!=$cellValue) {
                        $level1Title = $cellValue;$level1ID++;
                        $level1 = new ProductSpecItemPojo();

                        $level1->ID = $level1ID;
                        $level1->title = $cellValue;
                        $level1->rank = $level1ID;
                        $level1->name = $ChinesePinyin->TransformWithoutTonedeleteCode($cellValue);
                        $level1->product_category_ID = $product_category_ID;//1为手机分类
                        $level1->parent_ID = 0;//一级节点没有父节点
                        $level1->level = 1;//一级节点没有父节点
                        $level1->children = [];

                        //保存当前一级节点
                        $level1s[] = $level1;
                    } else {

                    }
                    // B 列处理区
                } elseif ('B' === $cellColumn) {
                    //除去多余项
                    if('产品图'!=$cellValue&&'产品卖点'!=$cellValue){
                        $level2Title = $cellValue;
                        $level2ID++;
                        $level2 = new ProductSpecItemPojo();

                        $level2->ID = $level2ID;
                        $level2->title = $cellValue;
                        $level2->rank = $level2ID;
                        $level2->name = $ChinesePinyin->TransformWithoutTonedeleteCode($cellValue);
                        $level2->product_category_ID = $product_category_ID;//1为手机分类
                        $level2->parent_ID = $level1ID;
                        $level2->level = 2;
                        $level2->children = null;
                        $level1->children[] = $level2;
                    }else{

                    }

                }
            }

        }
        return $level1s;
    }
    public static function importSpectItemToDB($product_category_ID){
        global $worksheet,$SpecItemDAO;
        $pojos = pojos_specItem($worksheet,$product_category_ID);
        foreach($pojos as $pojo){
            $SpecItemDAO->insert_import($pojo->ID,$pojo->product_category_ID,$pojo->level,$pojo->parent_ID,$pojo->rank,$pojo->title,$pojo->name);
            echo "<pre>";
            echo "导入1：$pojo->title<br/>";
            foreach($pojo->children as $pojo2){
                $SpecItemDAO->insert_import($pojo2->ID,$pojo2->product_category_ID,$pojo2->level,$pojo2->parent_ID,$pojo2->rank,$pojo2->title,$pojo2->name);
                echo "导入：$pojo2->title<br/>";
            }
        }
    }

//endregion

}
