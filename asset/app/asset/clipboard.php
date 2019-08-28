<?php
echo '更新失败';
header('HTTP/1.1 404 Not Found');
exit();
?>
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

<script type="text/javascript">//函数定义

    //获取导出开始日期和结束日期
    function time_export_get() {
        var json = {};
        var array = $('#form_export').serializeArray();
        $.each(array, function() {
            json[this.name] = this.value;
        });

        var time_start = parseInt(json.time_start);
        var time_end = parseInt(json.time_end);
        var difference = time_end - time_start;
        if(isNaN(time_start)){
            div_log('请选择起始时间!','warning');return;
        }
        if(isNaN(time_end)){
            div_log('请选择结束时间!','warning');return;
        }
        if(difference < 0 ){
            div_log('结束日期比开始日期小。请重新选择！','danger');return;
        }else{
            return json;
        }
    }
    //中间一块区域记录操作日志
    function div_log(content, class_level) {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds()>10?date.getSeconds():'0'+date.getSeconds();
        //danger primary warning
        var alert_ =''+
            '<div class="alert alert-'+class_level+'" role="alert">' +
            hours+':'+minutes+':'+seconds+'\t'+
            content +
            '</div>';
        $('#div_log').prepend(alert_);
    }

    //提交数据
    function export_by_action(action) {
        var json = time_export_get();
        if(json){
            json.action = action;
            var time_start = parseInt(json.time_start);
            var time_end = parseInt(json.time_end);
            var innerHtml_data = "导出数据("+time_start+"-"+time_end+")";
            var innerHtml_count = "导出员工提交量("+time_start+"-"+time_end+")";
            var a_export_data = '<a class="link_export" href="/project/tmall/controller/adminController.php?action=data&time_start='+time_start+'&time_end='+time_end+'">'+innerHtml_data+'</a>';
            var a_export_count = '<a class="link_export" href="/project/tmall/controller/adminController.php?action=count&time_start='+time_start+'&time_end='+time_end+'">'+innerHtml_count+'</a>';
            div_log(a_export_data,'primary');
            div_log(a_export_count,'primary');
            $('.link_export').click(
                function () {
                    div_log('正在导出数据，请稍等...','primary');
                }
            );
            /*
            //提交数据
            $.ajax({
                type: "POST",
                //dataType: "json",//服务器返回类型，不指定会自动判断，指定后不一致也会执行 error 里的代码
                url: '/project/tmall/controller/adminController.php',
                data: json,
                success: function (result) {
                    div_log(result,'primary');
                },
                error: function(data) {
                    div_log(data.responseText,'danger');
                }
            });
            */
        }
    }

</script>

<script type="text/javascript">// 初始化 datatables
    var language =  {
        'emptyTable': '没有数据',
        'loadingRecords': '加载中...',
        'processing': '查询中...',
        'search': '搜索',
        'lengthMenu': '每页 _MENU_ 件',
        'zeroRecords': '没有数据',
        'paginate': {
            'first':      '第一页',
            'last':       '最后一页',
            'next':       '下一页',
            'previous':   '上一页'                       },
        'info': '',
        'infoEmpty': '',
        'infoFiltered': '',
    };
    var columns = [
        {},
        {},
        {},
        {"width":"30%"},
        {"width":"30%"},
        {"width":"1%"},
        {},
        {}
    ];
    var table = $('#myTable').DataTable({
        language:language,
        "pageLength": 5,
        "columns": columns,
        "columnDefs": [{ "orderable": false, "targets": 7 }]
    });

</script>