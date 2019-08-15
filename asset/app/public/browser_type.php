<script  type="text/javascript">

    function myBrowser(){
        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var isOpera = userAgent.indexOf("Opera") > -1; //判断是否Opera浏览器
        var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera; //判断是否IE浏览器
        var isFF = userAgent.indexOf("Firefox") > -1; //判断是否Firefox浏览器
        var isSafari = userAgent.indexOf("Safari") > -1; //判断是否Safari浏览器
        if (isIE) {
            var IE5 = IE55 = IE6 = IE7 = IE8 = false;
            var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
            reIE.test(userAgent);
            var fIEVersion = parseFloat(RegExp["$1"]);
            IE55 = fIEVersion == 5.5;
            IE6 = fIEVersion == 6.0;
            IE7 = fIEVersion == 7.0;
            IE8 = fIEVersion == 8.0;

            alert('浏览器版本:'+fIEVersion+".请使用火狐、谷歌等最新版本访问此网页！");
            window.location = '/project/tmall/client/error.php';

            if (IE55) {
                return "IE55";
            }
            if (IE6) {
                return "IE6";
            }
            if (IE7) {
                return "IE7";
            }
            if (IE8) {
                return "IE8";
            }
            return "其他版本IE"+fIEVersion;
        }//isIE end
        if (isFF) {
            return "FF";
        }
        if (isOpera) {
            return "Opera";
        }
        if (isSafari) {
            return "Safari";
        }
    }//myBrowser() end
    myBrowser();
    /*
        //以下是调用上面的函数
    if (myBrowser() == "FF") {
        alert("我是 Firefox");
    }else
    if (myBrowser() == "Opera") {
        alert("我是 Opera");
    }else
    if (myBrowser() == "Safari") {
        alert("我是 Safari");
    }else
    if (myBrowser() == "IE55") {
        alert("我是 IE5.5");
    }else
    if (myBrowser() == "IE6") {
        alert("我是 IE6");
    }else
    if (myBrowser() == "IE7") {
        alert("我是 IE7");
    }else
    if (myBrowser() == "IE8") {
        alert("我是 IE8");
    }else
    alert(myBrowser());
    */

</script>