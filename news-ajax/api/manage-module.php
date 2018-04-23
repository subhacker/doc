<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20
 * Time: 21:43
 */
include '../common-files/get_user_info.php';
$module_changer=get_login_user();
$module_revise_time=time();


include "../common-files/mysql.php";
$database=new mysql();

$query_module_list_str="select * from module_info";

$query_module_list_result=$database->link($query_module_list_str);
$result_arr=[];
while($query_module_list_arr=mysqli_fetch_array($query_module_list_result,MYSQLI_BOTH)){

    $item_arr=array(
        'moduleName'=>$query_module_list_arr['module_name'],
        'moduleIndex'=>$query_module_list_arr['module_order'],
        'adder'=>$query_module_list_arr['add_user'],
        'addTime'=>$query_module_list_arr['add_time'],
        'moduleId'=>$query_module_list_arr['module_id']
        );
   array_push($result_arr,$item_arr);
}

echo json_encode($result_arr);
