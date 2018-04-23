<?php

include ('../common-files/mysql.php');
$database=new mysql();
$username=$_POST['username'];
$password=$_POST['password'];

$has_name_exist=false;
$has_password_exist=false;

$query_username_str="select * from user_info WHERE name='$username'";
$query_username_result=$database->link($query_username_str);
$query_username_num=mysqli_num_rows($query_username_result);

if($query_username_num) {
    $has_name_exist = true;
    $query_username_arr = mysqli_fetch_array($query_username_result, MYSQLI_BOTH);



    if ($query_username_arr['password'] == $password) {
        $has_password_exist = true;
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

    }



}

$result_arr=array(
    "username"=>$has_name_exist,
    "password"=>$has_password_exist);

echo json_encode($result_arr);