<html>
<head>
    <title>file</title>
</head>
<body>
<?php
if(file_exists('file.txt')){
    echo 'run';
    $file=fopen('file.txt','a+');
    $context=fgets($file);
    echo $context;
    fclose($file);


    $next_file=fopen('file.txt','a+');
    $num=fwrite($next_file,'tianjiedez');
    fclose($next_file);

    $another_file=fopen('file.txt','a+');
    $after_context=fgets($another_file);
    echo $after_context;

}
?>



<h1>
    图片
</h1>
<img src="./image/mysql.png" height="40px " width="40px"/>
<?php
$addr="./image/";
$dir=dir($addr);
while ($file_name=$dir->read()) {
    if ($file_name != '.' && $file_name != '..') {
        echo $addr.$file_name;
        echo '<br>';

        #图片的路径中不允许含有空格，由于src无法识别，导致路径解析错误
        echo "<img src=".$addr.$file_name." width=40 height=40/>";
    }
}

$file_array=scandir($addr);
if($file_array){
    echo 'exist';
}else{
    echo 'none';
}
echo '<br>';
for($i=0;$i<count($file_array);$i++){
    if($file_array[$i]!='.'&&$file_array[$i]!='..'){

      echo "<img src=".$addr.$file_array[$i]." width=60 height=60/>";
    }

}

?>
</body>
</html>