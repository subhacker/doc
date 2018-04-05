<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>登录首页</title>

    <!-- Bootstrap -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body{
            background: #feffe9;
        }
        .row{
            margin-top: 100px;
        }
    </style>
</head>
<body>

<?php

include ('common-files/mysql.php');

$query='select * from user_info';
$database=new mysql();

$hans='hans';
$password='hans';
/**
$test_query="select * from user_info WHERE name='$hans' AND password='$password'";
$test_result=$database->link($test_query);
echo 'ceshijiesuo';
print_r($test_result);
**/


$tag=$_POST['tag'];
if ($tag){
    $account=$_POST['inputAccount'];
    $password=$_POST['inputPassword'];

   // print_r($_POST);

   // print_r($account);
   // print_r($password);
    $query_string="select * from user_info ";



    $consult_result=$database->link($query_string);
    while($consult_arr=mysqli_fetch_array($consult_result,MYSQLI_BOTH)){
        if($consult_arr['name']==$account&&$consult_arr['password']==$password){
            echo '登录成功';
        }

    }


}












?>



<div class="container">
    <div class="row">
        <div class="col-md-4 "></div>
        <div class="col-md-4">
            <form class="form-horizontal" method="post" action="login.php" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="inputAccount" class="col-sm-4 control-label">账号:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="inputAccount" id="inputAccount" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-4 control-label">密码:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox">保存密码
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="tag" value="1">
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">登录</button>
                    </div>
                </div>

            </form>

        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>