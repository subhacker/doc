<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20
 * Time: 20:44
 */
include '../common-files/get_user_info.php';
$username=get_login_user();

$module_name=$_POST['moduleName'];
$module_index=$_POST['moduleIndex'];

$module_id=time();
$module_create_time=date('Y-m-d h:i:s',$module_id);

include "../common-files/mysql.php";

$module_name_ok=true;
$module_index_ok=true;
$has_success_insert_into=false;

$database=new mysql();
$query_module_name_str="SELECT * FROM `module_info` WHERE module_name='$module_name'";
$query_module_name_result=$database->link($query_module_name_str);
if($query_module_name_num=mysqli_num_rows($query_module_name_result)) {
    $module_name_ok=false;
}

$query_module_index_str="SELECT * FROM `module_info` WHERE module_order='$module_index'";
$query_module_index_result=$database->link($query_module_index_str);
if($query_module_index_num=mysqli_num_rows($query_module_index_result)) {
    $module_index_ok=false;
}
if($module_name_ok&&$module_index_ok){
    $insert_str="INSERT INTO `module_info`(`module_id`, `module_order`, `module_name`, `add_user`, `add_time`) VALUES ('$module_id','$module_index','$module_name','$username','$module_create_time')";

    $insert_result=$database->link($insert_str);
    if($insert_result){
        $has_success_insert_into=true;
    }else{
        $has_success_insert_into=false;
    }

}
$result_arr=array(
    "moduleName"=>$module_name_ok,
    "moduleIndex"=>$module_index_ok,
    "hasInto"=>$has_success_insert_into,
    "adder"=>$username,
    "addTime"=>$module_create_time
);

echo json_encode($result_arr);





