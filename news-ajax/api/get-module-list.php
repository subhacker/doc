<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 19:39
 */
include "../common-files/mysql.php";
$database=new mysql();
$query_module_list_str="select * from module_info";
$query_module_list_result=$database->link($query_module_list_str);
$result_arr=[];
while ($query_module_list_arr=mysqli_fetch_array($query_module_list_result)) {
    array_push($result_arr,$query_module_list_arr['module_name']);

}

echo json_encode($result_arr);



