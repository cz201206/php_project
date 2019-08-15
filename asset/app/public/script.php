<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.3.1/js/bootstrap.bundle.js"></script>
<script>
    function getTime(){     	//获取时间
        var date=new Date();

        var year=date.getFullYear();
        var month=date.getMonth()+1;
        var day=date.getDate();

        var hour=date.getHours();
        var minute=date.getMinutes();
        var second=date.getSeconds();

        //这样写显示时间在1~9会挤占空间；所以要在1~9的数字前补零;
        if (hour<10) {
            hour='0'+hour;
        }
        if (minute<10) {
            minute='0'+minute;
        }
        if (second<10) {
            second='0'+second;
        }


        var x=date.getDay();//获取星期


        var time=year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second

        return time;

    }

</script>
