<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */

$method=$_GET['delete'];
$id=$_GET['id'];
print_r($method);
include '../common-files/mysql.php';
$database=new mysql();

$delete_str="DElETE  FROM `news_info` WHERE id='$id'";

$delete_result=$database->link($delete_str);
if ($delete_result){
    echo '删除成功';
}else{
    echo '删除失败';
}