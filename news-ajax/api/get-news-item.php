<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 20:41
 */


include '../common-files/mysql.php';
$database=new mysql();
$news_id=$_GET['newsId'];

$query_news_item_str="select * from news_info where id='$news_id'";


$query_news_item_result=$database->link($query_news_item_str);





$query_news_item_arr=mysqli_fetch_array($query_news_item_result,MYSQLI_BOTH);

    $news_item=array(
        'newsIndex'=>$query_news_item_arr['id'],
        'newsOption'=>$query_news_item_arr['module_name'],
        'newsTitle'=>$query_news_item_arr['title'],
        'adder'=>$query_news_item_arr['add_user'],
        'addTime'=>$query_news_item_arr['add_time'],
        'visitTimes'=>$query_news_item_arr['visit_times'],
        'newsContent'=>$query_news_item_arr['context']
    );
  




echo json_encode($news_item);

