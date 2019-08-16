<?php

date_default_timezone_set("PRC");
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');
$name_current_module = $conf['name_current_module'];
$time = date("Y-m-d H:i:s",time());

?>
< ?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."<?=$name_current_module?>Dao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";

class <?=$name_current_module?>Service
{
    public $dao;
    function __construct()
    {
        $this->dao = new <?=$name_current_module?>Dao();
    }

    //插入新数据
    public function insert($data){
        $result = $this->dao->insert($data);
        return $result;
    }
    //删除
    public function delete($ID, $pwd){
        $result = $this->dao->delete($ID, $pwd);
        return $result;
    }
    //修改
    public function update($ID, $pwd){
        $result = $this->dao->update($ID, $pwd);
        return $result;
    }
    //查找
    public function find($id){
        $result = $this->dao->find($id);
        return $result;
    }

    //执行其他 SQL
    public function execute_($SQL){
        $result = $this->dao->execute_($SQL);
        return $result;
    }

}