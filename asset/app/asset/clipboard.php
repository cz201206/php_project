<li class="fa fa-pencil"></li>

<?php foreach($data as $key=>$value){ ?>

<?php }?>

<?php if ($expression == true): ?>
    This will show if the expression is true.
<?php else: ?>
    Otherwise this will show.
<?php endif; ?>

<script>
    //监听链接或者按钮 ajax 提交数据
    $(".ajax").click(
        function () {
            var url = $(this).data('url');
            var data = $(this).data();
            $("#content").load(url,data);
            return false;
        }
    );
</script>

<script>
    //form - inputs
    function addProcess() {
        var showRequest = function(formData, jqForm, options) {
            $("#content_add").html("处理中，请稍候...");
        };
        var showResponse = function(responseText, statusText)  {

        };
        var options = {
            beforeSubmit:  showRequest,  //提交前处理
            success:       showResponse,  //处理完成
            resetForm: true,
            target:    $("#content_add")
        };

        $('#form_add').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    }
</script>

<script>
    //form - inputs
    $(function() {
        $('#submit').click(function() {
            var d = {};
            var t = $('form').serializeArray();
            $.each(t, function() {
                d[this.name] = this.value;
            });
            alert(JSON.stringify(d));
        });
    });

</script>

<script>
    //功能最全
    $.ajax({
        type: "POST",
        //dataType: "json",//服务器返回类型，不指定会自动判断，指定后不一致也会执行 error 里的代码
        url: '',
        data: $('#formAddHandlingFee').serialize(),
        success: function (result) {
            var strresult=result;
            $("#spanMaxAmount").html(strresult);
        },
        error: function(data) {
            alert("error:"+data.responseText);
        }

    });

</script>

<script>
    function dataFromAnchor(a) {
        var data = {};
        var args = a.substr(a.indexOf('?')+1).split("&");
        for(var i = 0; i<args.length;i++){
            var key_val = args[i].split("=");
            data[key_val[0]] = key_val[1];
        }
        return data;
    }
</script>
