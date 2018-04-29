<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/20
 * Time: 23:19
 */

if($_POST['submit']=='submit'){
    echo 'submit';
    print_r($_FILES);
    echo '<br>';
    echo '文件的名称';
    echo $_FILES['file_upload']['name'];
    echo '<br>';
    echo '文件的类型';
    echo $_FILES['file_upload']['type'];
    echo '<br>';
    echo '文件的临时名称';
    echo $_FILES['file_upload']['tmp_name'];
    echo '<br>';
    echo '文件的大小';
    echo $_FILES['file_upload']['size'];
    echo '<br>';

    #上传的路径必须包含具体的路径以及文件名，文件的格式
    $rand1=rand(0,9);
    $rand2=rand(0,9);
    $rand3=rand(0,9);
    $filename_after_upload=date('Ymdhms').$rand1.$rand2.$rand3;
    $filename=$_FILES['file_upload']['name'];

    if(empty($filename)){
        echo '文件名不得为空';
        exit();
    }
    $file_type=substr(
            $filename,
            strrpos($filename,'.'),
            strlen($filename)-strrpos($filename,'.')
    );
    echo $file_type;

    $savedir='./upload/'.$filename_after_upload.$file_type;

    $upload_file=$_FILES['file_upload']['tmp_name'];
    if(move_uploaded_file($upload_file,$savedir)){
        echo '文件上传成功';
    }else{
        echo '文件上传失败';
    }

}

?>

<html>
<head>
    <title>
        文件上传
    </title>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="file.php">
    <input type="file" name="file_upload" >
    <input type="submit" name="submit" value="submit" >

</form>
</body>
</html>
