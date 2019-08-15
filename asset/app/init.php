<?php
date_default_timezone_set("PRC");
//载入配置文件
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');

//新建目录结构
function dirs($conf){
    //获取配置信息-根路径、一级目录
    $path_app = $conf['path_app'];
    $dirs = $conf['dirs_level1'];

    //如果不存在则创建
    foreach ($dirs as $dir){
        $dir = $path_app.DIRECTORY_SEPARATOR.$dir;
        if(!file_exists($dir)){
            $result  = mkdir($dir,0777,true);
            if($result)
                echo "创建成功:$dir".PHP_EOL;
            else
                echo "创建失败:$dir".PHP_EOL;
        }else{
            echo "该路径已存在，无需创建:$dir".PHP_EOL;
        }

    }

}

function components($conf){
    $path_app = $conf['path_app'];
    $name_current_module = $conf['name_current_module'];

    $template_controller = __DIR__.DIRECTORY_SEPARATOR."template_controller.php";
    $template_service = __DIR__.DIRECTORY_SEPARATOR."template_service.php";
    $template_dao = __DIR__.DIRECTORY_SEPARATOR."template_dao.php";
    //controller
    $filename = $path_app.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$name_current_module."Controller.php";
    if(file_exists($filename)){
        echo "文件已存在无需生成：$filename".PHP_EOL;
    }else{
        shell_exec("php $template_controller >$filename");
        echo "尝试生成文件,请查看：$filename".PHP_EOL;;
    }
    //service
    $filename = $path_app.DIRECTORY_SEPARATOR.'service'.DIRECTORY_SEPARATOR.$name_current_module."Service.php";
    if(file_exists($filename)){
        echo "文件已存在无需生成：$filename".PHP_EOL;
    }else{
        shell_exec("php $template_service >$filename");
        echo "尝试生成文件,请查看：$filename".PHP_EOL;;
    }
    //dao
    $filename = $path_app.DIRECTORY_SEPARATOR.'dao'.DIRECTORY_SEPARATOR.$name_current_module."Dao.php";
    if(file_exists($filename)){
        echo "文件已存在无需生成：$filename".PHP_EOL;
    }else{
        shell_exec("php $template_dao >$filename");
        echo "尝试生成文件,请查看：$filename".PHP_EOL;;
    }

}

/*执行*/
//dirs($conf);//新建目录结构
components($conf);
