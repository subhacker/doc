<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>登录首页</title>
    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
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

        .error-container{
            margin-top: 18px;
            font-size: 80%;
            color: red;
            visibility: visible;
        }
    </style>
</head>
<body>

<?php

/**
 * 该页面主要实现登录，根据Post回来的用户账号，
 * 用户密码进行判断，并根据判断的结果做出适当的提示。
 */

include ('../common-files/mysql.php');
$database=new mysql();
$has_name_err=false;
$has_password_err=false;
$tag=$_POST['tag'];
$account=$_POST['inputAccount'];
$password=$_POST['inputPassword'];

if ($tag==1){
    $query_user_str="select * from user_info WHERE name='$account'";
    $query_user_result=$database->link($query_user_str);
    $query_user_num=mysqli_num_rows($query_user_result);
    if($query_user_num){
        $query_user_arr=mysqli_fetch_array($query_user_result,MYSQLI_BOTH);

        if($query_user_arr['password']==$password){
            session_start();
            $_SESSION['username']=$account;
            $_SESSION['password']=$password;
            echo "<script type='application/javascript'> location.href='index.php'</script>";
        }else{
            $has_password_err=true;
        }
    }else{
        $has_name_err=true;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 "></div>
        <div class="col-md-6">
            <form class="form-horizontal" method="post" action="login.php" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="inputAccount" class="col-sm-2 control-label">账号:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="inputAccount" id="inputAccount" value="<?php echo $account?>" >
                    </div>
                    <?php if ($has_name_err) { ?>
                    <div  class="error-container"><span class="tip-text">该账号不存在</span></div>
                    <?php } ?>

                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword"  >
                    </div>
                    <?php if ($has_password_err) { ?>
                    <div class="error-container"><span class="tip-text">密码错误</span></div>
                    <?php } ?>
                </div>

                <input type="hidden" name="tag" value="1">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <button type="submit" class="btn btn-default">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>