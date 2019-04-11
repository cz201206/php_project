<?php require_once __DIR__.DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php"?>
<?php
//debug();


class C1{
    public static $age = 9;
}

$c1 = new C1();
echo $c1::$age;

?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."client".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>


