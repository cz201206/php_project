<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>tipDemo</title>
    <link rel="stylesheet" href="/public/lib/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/lib/bootstrap/4.1.3/js/popper.min.js" crossorigin="anonymous">
    <style>

        td{
            cursor: pointer;
        }

        #div_tip{
            width: 500px;
            color: grey;
            font-size: 12px;
            position: absolute;
            z-index: 10;
            background: #fff;
            padding:15px;
        }

    </style>
</head>
<body>

<!--内容-->
<div>

    <table>
        <tr>
            <td>相机</td>
            <td>1</td>
        </tr>
        <tr>
            <td>镜像</td>
            <td>2</td>
        </tr>
        <tr>
            <td>分辨率</td>
            <td>3</td>
        </tr>
        <tr>
            <td>摄像头</td>
            <td>4</td>
        </tr>
    </table>

</div>

<!--提示框-->
<div id="div_tip" class="shadow">
    主频也叫时钟频率，单位是MHz，用来表示CPU的运算速度。CPU的工作频率（主频）包括两部分：外频与倍频，两者的乘积就是主频。倍频的全称为倍频系数。CPU的主频与外频之间存在着一个比值关系，这个比值就是倍频系数，简称倍频。倍频可以从... 查看详情>>
    <a href="/product_param/index154.html" target="_blank">查看详情&gt;&gt;</a>
</div>


<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script class="元素开始"></script>
<script>

</script>
<script class="元素结束"></script>

<script class="变量开始"></script>
<script>
var enties = {"相机":["相机解释\n相机解释2\n相机解释3\"","http:\/\/aa.com"],"镜像":["镜像解释","http:\/\/aa.com"],"分辨率":["分辨率解释","http:\/\/aa.com"]};
</script>
<script class="变量结束"></script>

<script class="函数开始"></script>
<script>

</script>
<script class="函数结束"></script>

<script class="初始化开始"></script>
<script>

</script>
<script class="初始化结束"></script>

<script class="注册开始"></script>
<script>
//注册td hover事件
$("td").hover(function(){

    var top = $(this).offset().top;
    var left = $(this).offset().left;
    var height  = $(this).height();
    //设置 left
    $('#div_tip').css('left',left+'px');
    //设置 top
    $('#div_tip').css('top',(top+height)+'px');
    //显示
    $('#div_tip').show();

    //切换词条内容
    var text = $(this).text();
    var explaination = enties[text][0];
    $("#div_tip").html(explaination);
    console.log($(this).height());
},function(){
    $('#div_tip').hide();
});

$("#div_tip").hover(function(){
    $(this).show();
},function(){
    $(this).hide();
});
</script>
<script class="注册结束"></script>


<script class="调试开始"></script>
<script>

    //选择词条所在单元格
    $("tr td:first-child").each(
        function () {
            //词条文件
            var text = $(this).text();
            if(enties[text]){
                //词条转化为链接
                $(this).html('<a href="'+enties[text][1]+'">'+text+'</a>');

            }
        }
    );
console.log(enties);

</script>
<script class="调试结束"></script>

</body>
</html>