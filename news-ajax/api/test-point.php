<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */




include '../common-files/mysql.php';
$database=new mysql();

$name=$_POST['name'];$age=$_POST['age'];

//print_r(getallheaders());


$result=array(
    'name'=>$name,
    'age'=>$age
);

echo json_encode($result);
