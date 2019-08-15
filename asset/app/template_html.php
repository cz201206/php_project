<!DOCTYPE html>
<html>
<head>
    <?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."meta.php" ?>
    <?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."browser_type.php" ?>
    <?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."link.php" ?>
    <?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."style.php" ?>
    <link href="/public/lib/icon/font-awesome.css" rel="stylesheet">
    <?php require_once  __DIR__.DIRECTORY_SEPARATOR."style.php" ?>
    <title>首页</title>
</head>
<body>
<?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."nav.php" ?>
<div class="container-fluid">
    <div class="row ">
        <div class="col-3">
            <?php require_once  __DIR__.DIRECTORY_SEPARATOR."left.php" ?>
        </div>
        <div class="col-6">

            <?php require_once  __DIR__.DIRECTORY_SEPARATOR."middle.php" ?>

        </div>
        <div class="col-3">
            <?php require_once  __DIR__.DIRECTORY_SEPARATOR."right.php" ?>
        </div>
    </div>
</div>
<?php require_once  dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."script.php" ?>
<?php require_once  __DIR__.DIRECTORY_SEPARATOR."script.php" ?>
</body>
</html>