<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */


$id=$_GET['reviseModuleId'];
$module_order=$_GET['newModuleIndex'];
$module_name=$_GET['newModuleName'];



include '../common-files/mysql.php';
$database=new mysql();

$delete_str="UPDATE `module_info` SET `module_order`='$module_order',`module_name`='$module_name' WHERE module_id=$id";


echo $delete_str;
$delete_result=$database->link($delete_str);
