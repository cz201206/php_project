<?php
date_default_timezone_set("PRC");
//载入配置文件
$conf = require_once(__DIR__.DIRECTORY_SEPARATOR.'conf.php');


function pri_shell_exect($template, $filename){
    if(file_exists($filename)){
        echo "文件已存在无需生成：$filename".PHP_EOL;
    }else{
        shell_exec("php $template >$filename");
        echo "尝试生成文件,请查看：$filename".PHP_EOL;;
    }
}
function pri_mk_dirs($dir){
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
//新建目录结构
function dirs($conf){
    //获取配置信息-根路径、一级目录
    $path_app = $conf['path_app'];
    $dirs = $conf['dirs_level1'];

    //如果不存在则创建
    foreach ($dirs as $dir){
        $dir = $path_app.DIRECTORY_SEPARATOR.$dir;
        pri_mk_dirs($dir);

    }

    // layout 相关路径
    $layout_client = "$path_app".DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."client";
    $layout_admin = "$path_app".DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."admin";
    $layout_public = "$path_app".DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."public";
    pri_mk_dirs($layout_client);
    pri_mk_dirs($layout_admin);
    pri_mk_dirs($layout_public);

}

/**
 * @param $dir_des
 * @param $dir_src
 */
function pri_copy_files($dir_des, $dir_src)
{
    $pattern_des = $dir_des . DIRECTORY_SEPARATOR . "*.*";
    $files_des = glob($pattern_des);
    $count = sizeof($files_des);
    if ($files_des) {
        echo "已经复制过了：$count" . PHP_EOL;
    } else {
        $pattern_src = $dir_src . DIRECTORY_SEPARATOR . "*.*";
        $files_src = glob($pattern_src);
        $count = sizeof($files_src);
        foreach ($files_src as $file) {
            $bname = basename($file);

            $source = $file;
            $dest = $dir_des . DIRECTORY_SEPARATOR . $bname;
            if (file_exists($dest)) {
                echo "文件已存在无需复制：$dest" . PHP_EOL;
            } else {

                $resutl = copy($source, $dest);
                if ($resutl)
                    echo "文件复制成功：$dest" . PHP_EOL;
                else
                    echo "复制失败！：$dest" . PHP_EOL;

            }

        }
        echo "成功复制文件数量：$count" . PHP_EOL;
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
    pri_shell_exect($template_controller, $filename);
    //service
    $filename = $path_app.DIRECTORY_SEPARATOR.'service'.DIRECTORY_SEPARATOR.$name_current_module."Service.php";
    pri_shell_exect($template_service, $filename);
    //dao
    $filename = $path_app.DIRECTORY_SEPARATOR.'dao'.DIRECTORY_SEPARATOR.$name_current_module."Dao.php";
    pri_shell_exect($template_dao, $filename);

}

function layout_public($conf){
    $path_app = $conf['path_app'];

    $dir_src = __DIR__.DIRECTORY_SEPARATOR."public";
    $dir_des = $path_app.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."public";

    pri_copy_files($dir_des, $dir_src);


}


function asset($conf){
    $path_app = $conf['path_app'];

    $dir_src = __DIR__.DIRECTORY_SEPARATOR."asset";
    $dir_des = $path_app.DIRECTORY_SEPARATOR."asset";

    pri_copy_files($dir_des, $dir_src);


}



function layouts($conf){
    //完整路径1 ：应用根目录/[client|admin]/moduleName.php
    //完整路径2 ：应用根目录/layout/[client|admin]/moduleName/name.php
    //获取 app 根目录
    $path_app = $conf['path_app'];
    $is_client = $conf['is_client'];
    //获取本模块名
    $name_current_module = $conf['name_current_module'];
    $dir = '';
    if($is_client){
        $dir='client';
    }else{
        $dir='admin';
    }

    $filename_path_view = $path_app.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$name_current_module.".php";
    $template_view = __DIR__.DIRECTORY_SEPARATOR."template_view.php";
    pri_shell_exect($template_view, $filename_path_view);//生成 view

    $dir_module = $path_app.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$name_current_module;
    pri_mk_dirs($dir_module);// 新建模块文件夹

    //生成 layout 中各部分文件
    // html
    $template_html = __DIR__.DIRECTORY_SEPARATOR."template_html.php";
    $filename_html = $dir_module.DIRECTORY_SEPARATOR."html.php";
    pri_shell_exect($template_html, $filename_html);
    // left
    $template_left = __DIR__.DIRECTORY_SEPARATOR."template_left.php";
    $filename_left = $dir_module.DIRECTORY_SEPARATOR."left.php";
    pri_shell_exect($template_left, $filename_left);
    // middle
    $template_middle = __DIR__.DIRECTORY_SEPARATOR."template_middle.php";
    $filename_middle = $dir_module.DIRECTORY_SEPARATOR."middle.php";
    pri_shell_exect($template_middle, $filename_middle);
    // right
    $template_right = __DIR__.DIRECTORY_SEPARATOR."template_right.php";
    $filename_right = $dir_module.DIRECTORY_SEPARATOR."right.php";
    pri_shell_exect($template_right, $filename_right);
    // script
    $template_script = __DIR__.DIRECTORY_SEPARATOR."template_script.php";
    $filename_script = $dir_module.DIRECTORY_SEPARATOR."script.php";
    pri_shell_exect($template_script, $filename_script);
    // style
    $template_style = __DIR__.DIRECTORY_SEPARATOR."template_style.php";
    $filename_style = $dir_module.DIRECTORY_SEPARATOR."style.php";
    pri_shell_exect($template_style, $filename_style);
}
/*执行*/
dirs($conf);//新建目录结构
components($conf);
layouts($conf);
layout_public($conf);
asset($conf);