<?php
//采取异步上传
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>



    </style>
</head>
<body>


<div>
    <form id="form_fileUpload" action="../controller/controller.php" enctype="multipart/form-data" method="post">

        <input type="hidden" name="action" value="upload"/>
        选择文件<input name="file" type="file"/>
        <button id="btn_submit" type="submit">提交</button> `<span id="result_upload"></span>

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

        $('#form_fileUpload').submit(function() {
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