<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 20:02
 */


include "../common-files/mysql.php";
include '../common-files/get_user_info.php';
$news_adder=get_login_user();
$id=time();
$database=new mysql();

$title=$_POST['newsTitle'];
$content=$_POST['newsContent'];
$category=$_POST['newsModule'];

session_start();


$news_add_time=date('Y-m-d h:i:s',$id);

$query_module_id_str="select * from module_info where module_name='$category'";
$query_module_id_result=$database->link($query_module_id_str);
$query_module_id_arr=mysqli_fetch_array($query_module_id_result);
$filter_id=$query_module_id_arr['module_id'];

$insert_news_str="INSERT INTO `news_info`(`id`,`module_id`,`module_name`,  `title`, `context`, `add_user`, `add_time`, `visit_times`) VALUES ($id,$filter_id,'$category','$title','$content','$news_adder','$news_add_time',56)";
$result=$database->link($insert_news_str);

$result_arr=array('adder'=>$news_adder,'addTime'=>$news_add_time);

echo json_encode($insert_news_str);
