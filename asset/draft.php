<?php
function rangeToArray(){
    $worksheet = null;
    $spreadsheet = null;
    $maxCol = $worksheet->getHighestColumn();
    $maxRow = $worksheet->getHighestRow();
//        $array = $worksheet->namedRangeToArray('A1:' . $maxCol . $maxRow);
    $dataArray = $spreadsheet->getActiveSheet()
        ->rangeToArray(
            "A1:$maxCol$maxRow",     // The worksheet range that we want to retrieve
            NULL,        // Value that should be returned for empty cells
            TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
            TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
            TRUE         // Should the array be indexed by cell row and cell column
        );
//        $array = $worksheet->namedRangeToArray('A1:C3');
    var_dump($dataArray);
}
