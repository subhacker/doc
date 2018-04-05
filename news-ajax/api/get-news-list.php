<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 20:41
 */


include '../common-files/mysql.php';
$database=new mysql();
$filter=$_GET['filter'];
$startNews=$_GET['startNews'];
$requiredNewsNum=$_GET['requiredNewsNum'];

if(strtolower($filter)=='all'){
   # $query_news_list_str='select * from news_info';
   $query_news_list_str='select * from news_info limit '.$startNews .','.$requiredNewsNum;
    $query_list_max_num_str='select * from news_info';
}else{
    //根据输入的filter获取对应的module_id值
    $query_module_id_str="select * from module_info where module_name='$filter'";
    $query_module_id_result=$database->link($query_module_id_str);
    $query_module_id_arr=mysqli_fetch_array($query_module_id_result);
    $filter_id=$query_module_id_arr['module_id'];

    #$query_news_list_str="select * from news_info where module_id=".$filter_id ;
    $query_news_list_str="select * from news_info where module_id=".$filter_id." limit ".$startNews.','.$requiredNewsNum;
    $query_list_max_num_str="select * from news_info where module_id='$filter_id'";
}

$query_news_list_result=$database->link($query_news_list_str);
$query_list_max_num_result=$database->link($query_list_max_num_str);


$news_arr=[];
$news_list_num=mysqli_num_rows($query_list_max_num_result);

while ($query_news_list_arr=mysqli_fetch_array($query_news_list_result,MYSQLI_BOTH)){
    $new_item=array(
        'newsId'=>$query_news_list_arr['id'],
        'newsModule'=>$query_news_list_arr['module_name'],
        'title'=>$query_news_list_arr['title'],
        'adder'=>$query_news_list_arr['add_user'],
        'addTime'=>$query_news_list_arr['add_time'],
        'visitTimes'=>$query_news_list_arr['visit_times']
    );
    array_push($news_arr,$new_item);
}

$return_arr=array('list_num'=>$news_list_num,'news_arr'=>$news_arr);

echo json_encode($return_arr);

