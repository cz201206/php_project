<?php
//连接数据库
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DBHelper.php";

class Dao{
    private $conn;
    function __construct(){
        $this->conn =  getConn();
    }

    //增删改
    function execute($SQL, $params_types, $params){

        //准备语句
        $stmt = mysqli_prepare($this->conn,$SQL);

        //反射调用函数参数准备
        $arr_add[] = $stmt;
        $arr_add[] = $params_types;
        //处理参数：转化为地址类型引用传递
        foreach ($params as &$param) {
            $arr_add[] = &$param;
        }

        //反射调用绑定参数
        call_user_func_array("mysqli_stmt_bind_param",$arr_add);

        //获取结果集
        $result_exeute = mysqli_stmt_execute($stmt);

        return $result_exeute;
    }

    function query_toArray($SQL, $params_types, $params){

        //准备语句
        $stmt = mysqli_prepare($this->conn,$SQL);
        if(null!=$params_types){
            //反射调用函数参数准备
            $arr_add[] = $stmt;
            $arr_add[] = $params_types;
            //处理参数：转化为地址类型引用传递

            foreach ($params as &$param) {
                $arr_add[] = &$param;
            }

            //反射调用绑定参数
            call_user_func_array("mysqli_stmt_bind_param",$arr_add);
        }
        //获取结果集
        $result_execute = mysqli_stmt_execute($stmt);

        $meta = $stmt->result_metadata();
        $index = 0;
        while ($field = $meta->fetch_field())
        {
            $params_[] = &$row[$field->name];
            $index++;
        }

        call_user_func_array(array($stmt, 'bind_result'), $params_);

        while ($stmt->fetch()) {
            foreach($row as $key => $val)
            {
                $c[$key] = $val;
            }
            $result[] = $c;
        }
        /* mysqlnl 使用以下代码
        $result = $stmt->get_result();
        $rows = array();
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $rows[] = $row;
        }*/

        return $rows = $result;
    }
    function queryByID($SQL, $params_types, $params){

        //准备语句
        $stmt = mysqli_prepare($this->conn,$SQL);
        if(null!=$params_types){
            //反射调用函数参数准备
            $arr_add[] = $stmt;
            $arr_add[] = $params_types;
            //处理参数：转化为地址类型引用传递

            foreach ($params as &$param) {
                $arr_add[] = &$param;
            }

            //反射调用绑定参数
            call_user_func_array("mysqli_stmt_bind_param",$arr_add);
        }
        //获取结果集
        $result_execute = mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $row;
    }

    function query_toArray_urlencode($SQL, $params_types, $params){

        //准备语句
        $stmt = mysqli_prepare($this->conn,$SQL);
        if(null!=$params_types){
            //反射调用函数参数准备
            $arr_add[] = $stmt;
            $arr_add[] = $params_types;
            //处理参数：转化为地址类型引用传递

            foreach ($params as &$param) {
                $arr_add[] = &$param;
            }

            //反射调用绑定参数
            call_user_func_array("mysqli_stmt_bind_param",$arr_add);
        }
        //获取结果集
        $result_execute = mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        $rows = array();
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            foreach ($row as $key=>$value){
                $row[$key] = urlencode($value);
            }
            $rows[] = $row;
        }

        return $rows;
    }

    function query_toJSON($SQL, $params_types, $params){
        $rows = $this->query_toArray($SQL, $params_types, $params);
        return json_encode($rows);
    }
    function query_toJSON_compatible($SQL, $params_types, $params){
        $rows = $this->query_toArray($SQL, $params_types, $params);
        foreach ($rows as $rowNum=>$row) {
            foreach ($row as $key=>$value) {
                $row[$key]  = urlencode($value);
            }
            $rows[$rowNum] = $row;
        }
        return urldecode(json_encode($rows));
    }

    function __destruct()
    {
        mysqli_close($this->conn);
    }
    function  mysqliObj($activityType){
        //连接信息
        $mysql_conf = array(
            'host' => 'localhost',
            'db' => 'db_as_ssh',
            'db_user' => 'root',
            'db_pwd' => 'fx123321',
        );

//连接
        $mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
        $mysqli->set_charset('utf8');
        if ($mysqli->connect_errno) {
            die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
        }
//设置编码
        $mysqli->query("set names 'utf8';");//编码转化

//选择数据库
        $select_db = $mysqli->select_db($mysql_conf['db']);
        if (!$select_db) {
            die("could not connect to the db:\n" . $mysqli->error);
        }

// SQL
//$sql = "SELECT * FROM `t_GiftDetails` where activityType = '米家折叠婴儿推车赠送专用前扶手';";
        $sql = "SELECT * FROM `t_GiftDetails` where activityType = ?;";
//$activityType = '米家折叠婴儿推车赠送专用前扶手';

//预处理
        $stmt=$mysqli->prepare($sql);
//第一个参数表明变量类型，有i(int),d(double),s(string),b(blob)
        $stmt->bind_param('s',$activityType);

//执行预处理语句
        $stmt->execute();

//结果
        $c = [];
        $row = [];
        $result =[];
        $meta = $stmt->result_metadata();
        $index = 0;
        while ($field = $meta->fetch_field())
        {
            $params_[] = &$row[$field->name];
            $index++;
        }

        call_user_func_array(array($stmt, 'bind_result'), $params_);

        while ($stmt->fetch()) {
            foreach($row as $key => $val)
            {
                $c[$key] = $val;
            }
            $result[] = $c;
        }


        $mysqli->close();
        return $result;
    }
}


//region 测试区
//testQuery();
//增
function testInsert()
{

    $dao = new Dao();
// SQL 语句
    $SQL_insert = "INSERT INTO `dao` (`id`, `name`, `title`) VALUES (NULL, ?, ?);";
//指定绑定参数和参数类型
    $params_types = "ss";
    $params = array("nn4", "tt4");
//执行插入数据
    echo $dao->execute($SQL_insert, $params_types, $params);
}

//删
function testDelete($dao)
{
    $SQL_delete = "DELETE FROM `dao` WHERE `dao`.`id` = ?;";
    $params_types = "i";
    $params = array(5);
    $dao->delete($SQL_delete, $params_types, $params);
}

//改
//查
function testQuery(){
    $dao = new Dao();
    $SQL = "SELECT * FROM `dao`";
    $params_types = null;
    $params = null;
    $rows = $dao->query_toArray($SQL,$params_types,$params);
    $rows_json = $dao->query_toJSON($SQL,$params_types,$params);
    $rows_json_compatible = $dao->query_toJSON_compatible($SQL,$params_types,$params);
    printf_cz($rows);
    printf_cz($rows_json);
    printf_cz($rows_json_compatible);
}
//endregion

