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
            margin-top: 40px;
        }
        h3{
            margin-top: 15px;
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
            margin-top: 15px;
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
        #output-preview{
            width: 300px;
            margin-top: 20px;
        }

        #output-preview h4{
            margin-left: 100px;
        }
        #add-title{
            margin-left: 100px;
            margin-top: 40px;
        }
    </style>

</head>
<body>


<?php

include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}

$has_success_insert_into=false;
$username=get_login_user();
$module_name=$_POST['module-name'];
$module_index=$_POST['module-index'];
$module_adder=get_login_user();
$module_add_time=time();
$module_id=time();
$module_create_time=date('Y-m-d h:i:s',$module_id);
$has_repeat_module_name=false;
$has_repeat_module_id=false;

include "../common-files/mysql.php";

$database=new mysql();
$query_name_index_exist_str="SELECT * FROM `module_info` WHERE module_order='$module_index' OR module_name='$module_name'";
$query_name_index_exist_result=$database->link($query_name_index_exist_str);
if($query_name_index_exist_num=mysqli_num_rows($query_name_index_exist_result)){
    while ($query_name_index_exist_arr=mysqli_fetch_array($query_name_index_exist_result)){
        if($query_name_index_exist_arr['module_name']==$module_name){
            $has_repeat_module_name=true;
            break;
        }
        if($query_name_index_exist_arr['module_order']==$module_index){
            $has_repeat_module_id=true;
            break;
        }
    }
}else{

    $insert_str="INSERT INTO `module_info`(`module_id`, `module_order`, `module_name`, `add_user`, `add_time`) VALUES ('$module_id','$module_index','$module_name','$username','$module_create_time')";

    $insert_result=$database->link($insert_str);
    if($insert_result){
        $has_success_insert_into=true;
    }
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
            <div><h3 id="add-title">新闻模块添加</h3> </div>
            <form class="form-horizontal" method="post" action="add-module.php">
                <div class="form-group">
                    <label for="add-module" class="col-md-2 control-label">模块添加:</label>
                    <div class="col-md-7">
                        <input type="text" name="module-name" class="form-control input-sm" id="add-module"  >
                    </div>
                    <div class="error-container visible" id="tip-non-module"><span>数据不能为空</span></div>
                    <?php if ($has_repeat_module_name){?>
                        <div class="error-container" ><span>名称不能相同</span></div>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="add-index" class="col-md-2 control-label">添加序号:</label>
                    <div class="col-md-7">
                        <input type="number" name="module-index" class="form-control input-sm" id="add-index"  >
                    </div>
                    <div class="error-container visible" id="tip-non-index"><span>密码不能为空</span></div>
                    <?php if ($has_repeat_module_id){?>
                    <div class="error-container"><span>指定新的序号</span></div>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-7">
                        <button type="submit" id="add-news-button" class="btn btn-default">添加</button>
                    </div>
                </div>
            </form>
            </div>

            <div id="output-preview" style="visibility: <?php echo $has_success_insert_into? 'block':'hidden'?>;">
                <h4>您已成功添加如下模块</h4>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>模块名称</td>
                        <td><?php echo $module_name ?></td>
                    </tr>
                    <tr>
                        <td>模块序号</td>
                        <td><?php echo $module_index ?></td>
                    </tr>
                    <tr>
                        <td>添加人</td>
                        <td><?php echo $module_adder ?></td>
                    </tr>
                    <tr>
                        <td>添加时间</td>
                        <td><?php echo date("Y-m-d H:i:s",$module_add_time) ?></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    $('form').submit(function (ev) {
        console.log('non-module')
        if(!$('#add-module').val()){
            console.log('non-moudle')
            $('#tip-non-module').removeClass('visible');
            ev.preventDefault();

        }
        if(!$('#add-index').val()){
            $('#tip-non-index').removeClass('visible')
            ev.preventDefault();
        }

    })


</script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>