<?php

//region 文件信息相关
class FilePojo{
    public $mtime;
    public $basename;
    public $name;
    public $mtime_format;
}

//排序函数
function filePojoSorter($a, $b){
//    return strcmp($a->mtime, $b->mtime);
    return strcmp($b->mtime, $a->mtime);
}

//endregion
//处理特殊字符
function jsonReplace($val){
    //换行符替换内容
    $rn = '<br/>';//<br/>
    //替换换行符
    $val = str_replace(array("\r\n", "\r", "\n"), $rn, $val);
    //转义 "
    $val = str_replace('"','\"',$val);
    return $val;
}
///将数组转换为 json
function json_back($array){
    //结果容器
    $arr = [];
    //换行符替换内容
    $rn = '<br/>';//<br/>
    foreach ( $array as $key => $value ) {
        $key = urlencode($key);
        if(is_array($value)){
            foreach ( $value as $key2 => $value2 ) {
                $key2 = urlencode($key2);
                if(is_array($value2)){
                    foreach ($value2 as $key3=>$value3){
                        $value3 = jsonReplace($value3);
                        $key3 = urlencode($key3);
                        $arr[$key][$key2][$key3] = urlencode ( $value3 );

                    }
                }else{
                    //字符替换换行符，转义冒号
                    $value2 = jsonReplace($value2);

                    $arr[$key][$key2] = urlencode ( $value2 );
                }
            }
        }else{
            //替换换行符
            $value = jsonReplace($value);
            $arr[$key] = urlencode ( $value );
        }
    }
    $json = urldecode(json_encode($arr));

    return $json;
}

function json($array){
    return json_encode($array,JSON_UNESCAPED_UNICODE);
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

    ini_set('date.timezone','Asia/Shanghai');
    ini_set("display_errors","On");
    error_reporting(E_ALL);

    var_dump($_GET);
    var_dump($_POST);
    var_dump($_FILES);
}

function uploadCheck($files){

    $filePath = dirname(__DIR__).DIRECTORY_SEPARATOR."upload/". $files["file"]["name"];

    if ((($files["file"]["type"] == "image/gif")
            || ($files["file"]["type"] == "image/jpeg")
            || ($files["file"]["type"] == "image/pjpeg")
            || ($files["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
            || ($files["file"]["type"] == "text/plain"))
        && ($files["file"]["size"] < 2000000))
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

//查看某个目录下所有文件详情（不包含其他目录）
function filesInfo($dir,$pattern){
    //结果集容器
    $filePojos = [];
    //所有文件夹及文件
//    $files = scandir($dir);
    //指定类型的文件
    $files = glob($dir.$pattern);
    foreach($files as $file){
        $pojo = new FilePojo();
        $pojo->name = $file;
        $pojo->basename = basename($file);
        $pojo->mtime = filemtime($file);
        $pojo->mtime_format = date("Y-m-d H:i:s",$pojo->mtime);
        $filePojos[] = $pojo;
    }

    //排序 根据文件修改时间
    usort($filePojos,'filePojoSorter');
    return $filePojos;
}

//获取 project 物理路径
function getProjctRealPath_(){
    $path = dirname(__DIR__).DIRECTORY_SEPARATOR;
    return $path;
}

function uPath ($path){
    $upath = str_replace('/',DIRECTORY_SEPARATOR,$path);

    $uname = php_uname('s');
    if('Windows NT'==$uname){
        $upath = GBKPath($upath);
    }
    return $upath;
}

function isWin(){
    $uname = php_uname('s');
    if('Windows NT'==$uname){
        return true;
    }
    return false;
}

function env(){
    return require(path_app().uPath('config/env.php'));
}

function mkdirs($dir){
    if(!file_exists($dir)){
        mkdir($dir,0777,true);
    }
}

function get_utf8_string($content) {    //  将一些字符转化成utf8格式
    $encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
    return  mb_convert_encoding($content, 'utf-8', $encoding);
}


//将 xlsx 文件数据 转换为 json 格式
function toDisk($path,$json){
    $result_write = file_put_contents($path,$json);//写入磁盘
    if(!$result_write){
        echo '<br/>写入 json 失败！<br/>';
    }
    return $path;
}

function extractNum($strs){
    $patterns = "/\d+/"; //第一种
    //$patterns = "/\d/";  //第二种
    preg_match($patterns,$strs,$arr);
    return $arr[0];
}

function allImages(){
    //遍历某个文件夹下所有文件，包括子目录
    $pattern_dir = '/Library/WebServer/Documents/project/specs/data/img/*/*.png';
    $namedFiles = [];
    $arr = glob($pattern_dir);
    foreach ($arr as $file){
        $basename = basename($file,'.png');
        $namedFiles[$basename] = $file;
    }
    return $namedFiles;
}

function basename_zh($filename,$suffix=null){
    $basename = preg_replace('/^.+[\\\\\\/]/', '', $filename);
    if($suffix){
        $basename = str_replace($suffix,'',$basename);
    }
    return $basename;
}

function nodebug(){
    ini_set('date.timezone','Asia/Shanghai');
    ini_set("display_errors", 0);

    error_reporting(E_ALL ^ E_NOTICE);

    error_reporting(E_ALL ^ E_WARNING);


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

function currentTime(){
    $dateTime = date('Y-m-d H:i:s', time());
    return $dateTime;
}

function date_formated(){
    return date("Y-m-d H:i",time());
}

function cz_date_diff($start_date, $end_date){
    $datetime_start = new DateTime($start_date);
    $datetime_end = new DateTime($end_date);
    $days = $datetime_start->diff($datetime_end)->days;
    return $days;
}



function appendToFile($path, $data){
    $time = date_formated();
    $data = "$time $data".PHP_EOL;
    $result_write = file_put_contents($path, $data, FILE_APPEND);//写入磁盘
    if(!$result_write){
        return false;
    }else{
        return $path;
    }
}