<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */

$method=$_GET['delete'];
$id=$_GET['module_id'];

include '../common-files/mysql.php';
$database=new mysql();

$delete_str="DElETE  FROM `module_info` WHERE module_id='$id'";

$delete_result=$database->link($delete_str);
if ($delete_result){

}else{
    echo '删除失败';
}