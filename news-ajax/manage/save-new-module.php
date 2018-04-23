<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */


$id=$_GET['module_id'];
$module_order=$_GET['module_order'];
$module_name=$_GET['module_name'];


include '../common-files/mysql.php';
$database=new mysql();

$delete_str="UPDATE `module_info` SET `module_order`=$module_order,`module_name`='$module_name' WHERE module_id=$id";

$delete_result=$database->link($delete_str);
if ($delete_result){

}else{
    echo '删除失败';
}