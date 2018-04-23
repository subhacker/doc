<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/24
 * Time: 10:11
 */


$id=$_GET['deleteNodeId'];

include '../common-files/mysql.php';
$database=new mysql();

$delete_str="DElETE  FROM `news_info` WHERE id='$id'";
echo $delete_str;

$delete_result=$database->link($delete_str);
if ($delete_result){
    echo 'cjeg';

}else{
    echo '删除失败';
}