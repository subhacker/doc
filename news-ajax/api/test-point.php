<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3
 * Time: 21:17
 */




include '../common-files/mysql.php';
$database=new mysql();

$name=$_GET['name'];$age=$_GET['age'];

//print_r(getallheaders());


$result=array(
    'name'=>$name,
    'age'=>$age
);

echo json_encode($result);
