<nav class="navbar navbar-dark bg-primary">

    <a class="navbar-brand" href="#">欢迎 <?=$user['name']?>(<?=$user['group_name']?>)</a>

    <form action="/project/tmall/controller/userController.php" class="form-inline" method="post">
        <input name="action" type="hidden" value="log_out"/>
        <button class="btn btn-danger my-2 my-sm-0" type="submit">注销</button>
    </form>

</nav>
