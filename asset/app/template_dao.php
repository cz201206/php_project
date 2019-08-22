<?php

date_default_timezone_set("PRC");
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');
$name_current_module = $conf['name_current_module'];
$time = date("Y-m-d H:i:s",time());

?>
< ?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."DaoHelper.php";
class <?=$name_current_module?>Dao extends DaoHelper
{
    //插入新数据
    public function insert($data){
        $SQL="";
        $params_types = "is";
        $params = array();
        return $this->execute($SQL, $params_types, $params);
    }
    //删除
    public function delete($ID, $pwd){
        $SQL = "";
        $params_types = "si";
        $params = array($pwd, $ID);
        return $this->execute($SQL, $params_types, $params);
    }
    //修改
    public function update($ID, $pwd){
        $SQL = "";
        $params_types = "si";
        $params = array($pwd, $ID);
        return $this->execute($SQL, $params_types, $params);
    }
    //查找
    public function find($id){
        $SQL="";
        $params_types = "s";
        $params = array($id);
        return $this->getData($SQL, $params_types, $params);
    }

    //查找
    public function list(){
        $SQL="";
        $params_types = "s";
        $params = array($id);
        return $this->getData($SQL, $params_types, $params);
    }


    //执行其他 SQL
    public function execute_($SQL){
        $params_types = null;
        $params = null;
        return $this->getData($SQL, $params_types, $params);
    }
}