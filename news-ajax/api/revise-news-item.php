<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */




include '../common-files/mysql.php';
$database=new mysql();

$post_title=$_POST['title'];
$post_content=$_POST['content'];
$post_option=$_POST['option'];
$post_id=$_POST['id'];
$update_str="UPDATE `news_info` SET `title`='$post_title',`module_name`='$post_option',`context`='$post_content' WHERE id='$post_id'";
$update_result=$database->link($update_str);
echo $update_result;
