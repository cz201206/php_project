<script src="/public/lib/jquery/jquery.form.js"></script>
<script type="text/javascript">//对象获取，变量声明定义

</script>

<script type="text/javascript">//函数定义


</script>

<script type="text/javascript">//函数执行
    option = {"autohide":true,"delay":1000};
    $('.toast').toast(option);


</script>

<script type="text/javascript">//响应信息
    var customer = '';
    var level1 = '';
    var level2 = '';
    var note = '';

    var showRequest = function(formData, jqForm, options) {
        customer = formData[1].value;
        note = formData[4].value;

        //因变量
        level1_name = formData[5].value;
        level2_name = formData[6].value;

        // console.log(formData);
        level1 = $('#level1').find('option:selected').text();
        level2 = $('#level2').find('option:selected').text();

        //判断脚本是否正常获取到数据
        if(!level1_name){
            alert('浏览器不兼容此网页，请使用其他浏览器或升级此浏览器至最新版本！');
        }
        if(!level2_name){
            alert('浏览器不兼容此网页，请使用其他浏览器或升级此浏览器至最新版本！');
        }

        console.log(""+customer+":"+note+":"+level1+":"+level2);
    };
    var showResponse = function(responseText, statusText)  {
        if(note.length>15){
            note = note.substr(0,15)+"...";
        }
        var log = $(
            '    <div data-id="cz_tip"></div>' +
            '' +
            '    <div class="alert alert-primary alert-dismissible fade show" role="alert">' +
            '        <h5 class="alert-heading">' +
            '            <span data-id="span_customer">'+customer+'</span>' +
            '            <span data-id="span_time" class="float-right">'+getTime()+'</span>' +
            '        </h5>' +
            '        <p>' +
            '            <span data-id="span_level1">'+level1+'</span> |' +
            '            <span data-id="span_level2">'+level2+'</span>' +
            '        </p>' +
            '        <hr>' +
            '        <span data-id="span_note" class="d-inline-block text-truncate" style="max-wdata-idth: 250px;">'+note+'</span>' +
            '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '            <span aria-hdata-idden="true">&times;</span>' +
            '        </button>' +
            '    </div>'
        );
        $(".cz-div-info").prepend(log);
        //
        // $('#span_level1').html(level1);
        // $('#span_level2').html(level2);
        // $('#span_customer').html(customer);
        // $('#span_note').html(note);
        // $('#span_time').html(getTime());
        $('.toast').toast('show');
    };
    var options = {
        beforeSubmit:  showRequest,  //提交前处理
        success:       showResponse,  //处理完成
        resetForm: true,
        target:    $("#cz_tip")//可以将服务器返回的数据直接加载到此元素中
    };

    $('#form_').submit(function() {
        $(this).ajaxSubmit(options);
        return false;//阻止表单默认提交
    });


</script>
<script>

    //监听selection
    $('#level1').change(function () {
        $('input[name="level1_name"]').val($(this).find('option:selected').text());
    });
    $('#level2').change(function () {
        $('input[name="level2_name"]').val($(this).find('option:selected').text());
    });

</script>
<script type="text/javascript">//调试信息


</script>
