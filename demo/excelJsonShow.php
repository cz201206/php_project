<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>excelJsonShow.php</title>
    <link rel="stylesheet" href="/public/lib/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        .l1_title{
            color: grey;
        }

        .A{
            /*border:red solid 1px;*/
            margin-bottom:25px;
            color:grey;
        }
        .B{
            /*border-top:blue solid 1px;*/
            color:black;
        }

        .cz_table{
            border:1px solid red;
        }

        /*所有 td 样式*/
        .cz_table tr td{
            border: 1px solid #007BFF;
            width: 350px;
        }
        /*每个表格第一行样式 加粗*/
        .cz_table tr:nth-child(1){ border-top:5px solid #007BFF;}
        /*参数项 <td> 样式*/
        .cz_table td:nth-child(1){
            text-align: right;
            padding-right: 5px;
        }
        /*参数项<td> 样式*/
        .cz_table td:nth-child(2){
            padding-left: 5px;
        }

        #figure{
            width: 700px;
            display: -webkit-flex;
            -webkit-justify-content: center;
            -webkit-align-items: center;
        }

        #title{
            font-size: x-large;
            background-color: #007bff !important;
            color:white;

        }



    </style>
</head>
<body>


<div id="result">

    <div id="figure">
        <div class="media">
            <figure class="figure">
                <img src="/php_project/extract/00_Image_1.png" class="figure-img img-fluid rounded">
                <figcaption class="figure-caption" id="title"></figcaption>
            </figure>
            <div class="media-body">
                <a href="#" style="display: none"> 360度视图 </a>
            </div>
        </div>
    </div>

</div>

<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var data = {'name':'a'};
    //获取 json 文件
    $.ajax({
        async: false,//方便修改全局变量
        type : "GET",
        url : "/php_project/extract/json.json",
        dataType : "json",//跨域请求jsonp
        success : function (data) {
            window.data = data;
        }
    });
    console.log(data);

    //解析
    //设置产品标题
    $('#title').html(data.C1);
    //根据 A 列创建等量的 div 容器
    var column_l1 = 1;
    for(var property in data){
        //当前列标
        var column_current = property.substring(1);

        //A 列正则
        var pattern_l1 = /A\d/;
        if(pattern_l1.test(property)){
            // 一级 <div>
            // var div_l1 = '<div id="'+property+'" class="A" data-title="'+data[property]+'">'+data[property]+'</div>';
            var div_l1 = '<table  id="'+property+'" class="A cz_table" data-title="'+data[property]+'"><div class="l1_title">'+data[property]+'</div></table >';
            //挂载一级
            $("#result").append($(div_l1));
            //更换一级容器列标
            column_l1 = column_current;
        }

        //B 列正则
        var pattern_l2 = /B\d/;
        if(pattern_l2.test(property)){
            // 二级
            // var div_l2 = '<div id="'+property+'" class="B" data-title="'+data[property]+'">'+data[property]+'</div>';
            var div_l2 = '<tr id="'+property+'" class="B" data-title="'+data[property]+'"><td>'+data[property]+'</td><td id="val_'+column_current+'"></td></tr>';
            //挂载二级
            $("#A"+column_l1).append(div_l2);
        }

        //C 列正则
        var pattern_l3 = /C\d/;
        if(pattern_l3.test(property)){
            // 三级
           var val = data[property];
           //填充数据
            $("#val_"+column_current).html(val);
        }

    }
 </script>