<?php
//采取异步上传
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>filesInfo</title>
    <style>

    body{
        /*background-color: #5bc0de;*/
    }

    </style>
</head>
<body>


<div>

    <form id="form_filesInfo" action="../controller/controller.php" method="post">
        <input type="hidden" name="action" value="filesInfo"/>

        <select name="dirName">
            <option value="" selected>upload</option>
            <option value="img" selected>img</option>
        </select>
        <button id="btn_submit">提交</button> <span id="result_upload"></span>

    </form>

</div>


<script type="text/javascript" src="/public/lib/jquery/3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/public/lib/jquery/jquery.form.js"></script>
<script type="text/javascript">

</script>

<script>
    //ajax上传文件
    $(function(){
        var options = {
            beforeSubmit:  showRequest,  //提交前处理
            success:       showResponse,  //处理完成
            resetForm: false,
            target:    $("#result_upload")
        };

        $('#form_filesInfo').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function showRequest(formData, jqForm, options) {
        //2.显示处理界面
        $("#result_upload").html("上传中，请稍候...");
        //alert("comment ready!");
    }
    function showResponse(responseText, statusText)  {
        //alert("Thank you for your comment!"+responseText);
    }
</script>

</body>
</html>