<?php
$prefix = '/Volumes/APFS_LOCAL/xunsearch';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'fn.php';
require_once "$prefix/sdk/php/lib/XS.php";

debug();
$xs = new XS('demo');

//添加 doc
$doc = new XSDocument();
$doc->pid = 123;
$doc->subject = 'Hello, 测试 cz';
$doc->message = '第四个测试项目来自于 cz';
$xs->index->add($doc);

echo '添加完成';

//搜索 doc
$docs = $xs->search->search('内容');
var_dump($docs);

foreach ($docs as $doc){

    echo $doc->rank();
    // 迭代方式取所有字段值
    foreach($doc as $name => $value)
    {
        echo "$name: $value\n";
    }

}
?>