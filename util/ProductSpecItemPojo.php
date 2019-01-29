<?php

/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/6
 * Time: 15:37
 */
class ProductSpecItemPojo
{

    //数据库中字段
    public $ID;
    public $name;
    public $title;
    public $level;
    public $rank;
    public $product_category_ID;
    public $parent_ID;

    //内存中构造
    public $children;

}