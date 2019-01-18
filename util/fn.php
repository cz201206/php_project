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