<?php

class DBHelper{

    //获取数据库
    function getConn(){
        $user = "";
        $password = "";
        $dbName = "";
        $con = mysqli_connect("localhost",$user,$password);
        if (!$con)
        {
            die('Could not connect: ' . mysqli_error());
        }
        mysqli_query($con,"SET NAMES 'UTF8'");
        mysqli_query($con,"SET CHARACTER SET UTF8");
        mysqli_query($con,"SET CHARACTER_SET_RESULTS=UTF8'");

        mysqli_select_db($con,$dbName);
        return $con;
    }
}
