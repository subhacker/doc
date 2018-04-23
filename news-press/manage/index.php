<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>管理首页</title>
    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../common-files/jquery-1.12.4.js"></script>
    <style>
        body{
            background: #feffe9;
        }
        form{
            margin-top: 50px;
        }
        h3{
            margin-top: 20px;
        }
        textarea{
            width: 100%;
        }
        .container{
            margin-left: 0px;
            margin-top: 0px;
        }
        #left-title{
            padding-left: 15px;
            font-size: 120%;
        }
        #left-list{
            margin-top: 20px;
        }

        ul{
            width: 45%;
        }
        #success-exit{
            padding-left: 13px;
            padding-top: 20px;
        }
        .error-container{
            margin-top: 18px;
            font-size: 80%;
            color: red;
        }
        .visible{
            display: none;
        }
        #welcome-msg{
            margin-bottom: 40px;
            margin-top: 60px;
        }
    </style>

</head>
<body>


<?php

/**
 * 登录后的首页，主要显示操作菜单
 */

include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-3" id="left-list">
            <div><span id="left-title">操作列表</span></div>
            <ul class="nav nav-pills nav-stacked">
                <li><a id="add-module-a" href="add-module.php">添加模块</a></li>
                <li><a id="revise-module-a" href="manage-module.php">修改模块</a></li>
                <li><a id="add-news-a"  href="add-news.php">添加新闻</a></li>
                <li><a id="revise-news-a" href="manage-news.php">修改新闻</a></li>
            </ul>
            <div id="success-exit"><a href="destroy-login.php">[安全退出]</a></div>
        </div>

        <div class="col-md-7 col-md-push-1">
            <div>
                <h2 id="welcome-msg">欢迎登录新闻管理系统</h2>
                <p>请选择所需的菜单项进行操作</p>
            </div>


        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>