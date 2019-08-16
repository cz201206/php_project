<?php
//连接数据库
function getConn(){
    $con = mysqli_connect("localhost","loolsite","fx123321");
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($con,"SET NAMES 'UTF8'");
    mysqli_query($con,"SET CHARACTER SET UTF8");
    mysqli_query($con,"SET CHARACTER_SET_RESULTS=UTF8");
    mysqli_select_db($con,"db_tmall");
    return $con;
}

class DaoHelper
{
    private $conn;

    function __construct()
    {
        $this->conn = getConn();
    }


    //增删改
    function execute($SQL, $params_types, $params)
    {

        //准备语句
        $stmt = $this->prepare($SQL, $params_types, $params);
        //执行语句
        $result = mysqli_stmt_execute($stmt);

        return $result;
    }

    function getData($SQL, $params_types, $params)
    {

        //准备语句
        $stmt = $this->prepare($SQL, $params_types, $params);
        //执行语句
        mysqli_stmt_execute($stmt);
        //结果集处理
        $result = $this->dealWithResult($stmt);

        return $result;
    }

    //准备语句
    private function prepare($SQL, $params_types, $params){

        $stmt = mysqli_prepare($this->conn, $SQL);

        if (null != $params_types && null != $params) {
            //反射调用函数参数准备
            $arr_add[] = $stmt;
            $arr_add[] = $params_types;
            //处理参数：转化为地址类型引用传递
            foreach ($params as &$param) {
                $arr_add[] = &$param;
            }
            //反射调用绑定参数
            call_user_func_array("mysqli_stmt_bind_param", $arr_add);
        }

        if(!$stmt){
            throw new Exception("检查 SQL 语句，参数类型个数 ，参数个数 ");
        }
        return $stmt;
    }

    //处理结果集
    private function dealWithResult($stmt){

        $meta = $stmt->result_metadata();
        $index = 0;

        while ($field = $meta->fetch_field()) {
            $params_[] = &$row[$field->name];
            $index++;
        }

        call_user_func_array(array($stmt, 'bind_result'), $params_);

        while ($stmt->fetch()) {
            foreach ($row as $key => $val) {
                $c[$key] = $val;
            }
            $result[] = $c;
        }

        return $result;
    }


    function __destruct()
    {
        mysqli_close($this->conn);
    }

}

