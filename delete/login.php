<html>
<head>
    <title>Form</title>
</head>
<body>
<?php
$tag=$_POST['tag'];
if ($tag==1){
    echo 'tag=1';
    $add1=$_POST['add1'];
    $add2=$_POST['add2'];
    $sum=$add1+$add2;
}else{
    $add1=0;
    $add2=0;
    $sum=false;
}
?>
<form method="post" action="login.php">
    <input type="hidden" name="tag" value="1">
    <input type="text" id="add1" name="add1" size="4" placeholder="0" value='<?php echo $add1?>'>+
    <input type="text" id="add2" name="add2" size="4" placeholder="0" value="<?php echo $add2?>">=
    <span id="sum"><?php echo $sum?></span>
    <br>
    <input type="file" value="上传">文件的上传
    <button type="submit" name="cal">计算</button>
    <button type="button" id="reset" name="reset">重置</button>


</form>

<script>
    var button=document.getElementById('reset');
    button.addEventListener('click',function () {
        var add1=document.getElementById('add1');
        var add2=document.getElementById('add2');
        var sum=document.getElementById('sum');
        add1.value=0;
        add2.value=0;
        sum.innerHTML='0';

    })
</script>
</body>
</html>