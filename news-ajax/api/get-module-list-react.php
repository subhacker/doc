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
    $module_item=array(
        'moduleId'=>$query_module_list_arr['module_id'],
        'moduleIndex'=>$query_module_list_arr['module_order'],
        'moduleName'=>$query_module_list_arr['module_name']

    );
    array_push($result_arr,$module_item);

}

echo json_encode($result_arr);



