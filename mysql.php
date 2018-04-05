<html>
<head>
    <title>MYSQL 测试</title></head>
<body>

<h1>Mysql ceshi</h1>

<?php
$id= mysqli_connect('127.0.0.1','hans','hans@mysql');
if($id){
    $select_db_ok=mysqli_select_db($id,'student');
    if($select_db_ok){
        echo '数据库选择success';
        $result=mysqli_query($id,'SELECT * FROM info');
        if($result){
            $num=mysqli_num_rows($result);
            $result_array=mysqli_fetch_array($result,MYSQLI_BOTH);
            echo $num.'<br>';
            echo $result_array['name'].'<br>';
            echo $result_array['sex'].'<br>';
            echo $result_array['addr'].'<br>';
            echo $result_array['job'].'<br>';
            echo $result_array['short desc'].'<br>';
        }else{
            echo 'query fail';
        }

    }else{
        echo '数据库选择fail';
    }

}else{
    echo 'fail in connecting to MySQL';
}

?>


</body>
</html>