<?php

function json($post){
    foreach ( $post as $key => $value ) {
        if(is_array($value)){
            foreach ( $value as $key2 => $value2 ) {
                $post[$key][$key2] = urlencode ( $value2 );
            }
        }else{
            $post[$key] = urlencode ( $value );
        }
    }
    $post = urldecode(json_encode($post));

    return $post;
}

function printf_cz($content){
    echo "<pre/>";
    var_dump($content);
}

function publish($dir,$name,$json){
    if (!file_exists($dir)){
        mkdir ($dir,0777,true);
    }
    $path = $dir.DIRECTORY_SEPARATOR.$name;
    file_put_contents($path,$json);
    echo "<a href='file://$path'>$path</a><br>";
}

function jsonForObjs($objs){
    $objs_tmp = [];
    foreach ($objs as $obj){
        $obj_tmp = [];
        foreach($obj as $key=>$val){
            $key_tmp = urlencode ( $key );
            $obj_tmp[$key_tmp] = urlencode ( $val );
        }
        $objs_tmp[] = $obj_tmp;
    }
    return urldecode(json_encode($objs_tmp));
}

function GBKPath($path){
    return iconv('utf-8','GBK',$path);
}

function debug(){
    echo '<pre>';
    ini_set("display_errors","On");
    error_reporting(E_ALL);
}

function uploadCheck($files){

    $filePath = dirname(__DIR__).DIRECTORY_SEPARATOR."upload/". $files["file"]["name"];

    if ((($files["file"]["type"] == "image/gif")
            || ($files["file"]["type"] == "image/jpeg")
            || ($files["file"]["type"] == "image/pjpeg")
            || ($files["file"]["type"] == "text/plain"))
        && ($files["file"]["size"] < 20000))
    {
        if ($files["file"]["error"] > 0)
        {
            echo "Return Code: " . $files["file"]["error"] . "<br />";
        }
        else
        {
            echo "Upload: " . $files["file"]["name"] . "<br />";
            echo "Type: " . $files["file"]["type"] . "<br />";
            echo "Size: " . ($files["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $files["file"]["tmp_name"] . "<br />";

            if (file_exists($filePath))
            {
                echo $files["file"]["name"] . " already exists. ";
            }
            else
            {
                move_uploaded_file($files["file"]["tmp_name"],$filePath);
                echo "Stored in: " . $filePath;
            }
        }
    }
    else
    {
        echo "Invalid file";
        
    }
}