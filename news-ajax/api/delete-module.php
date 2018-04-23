<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */


$id=$_GET['deleteId'];

include '../common-files/mysql.php';
$database=new mysql();

$delete_str="DElETE  FROM `module_info` WHERE module_id='$id'";

$delete_result=$database->link($delete_str);
if ($delete_result){
    echo 'cjeg';

}else{
    echo '删除失败';
}