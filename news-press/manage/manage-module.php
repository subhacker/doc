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

        #list_header{
            font-size: 110%;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
        }

    </style>

</head>
<body>


<?php
include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}

$module_changer=get_login_user();
$module_revise_time=time();
$selected_module_id=$_GET['module-id'];

include "../common-files/mysql.php";
$database=new mysql();
?>

<div class="container">
    <div class="row">
        <div class="col-md-3" id="left-list">
            <div><span id="left-title">操作列表</span></div>
            <ul class="nav nav-pills nav-stacked">
                <li><a id="add-module-a" href="add-module.php">添加模块</a></li>
                <li><a id="revise-module-a" href="">修改模块</a></li>
                <li><a id="add-news-a"  href="add-news.php">添加新闻</a></li>
                <li><a id="revise-news-a" href="manage-news.php">修改新闻</a></li>
            </ul>

            <div id="success-exit"><a href="destroy-login.php">[安全退出]</a></div>
        </div>

        <div class="col-md-6 ">
            <div id="revise_module" class="container">
                <div id='list_header' class="row">
                    <div class="col-md-2">id值</div>
                    <div class="col-md-2">内容</div>
                    <div class="col-md-2">添加人</div>
                    <div class="col-md-2">添加时间</div>
                    <div class="col-md-2">操作</div>
                </div>

                <?php
                $query_module_list_str="select * from module_info";

                $query_module_list_result=$database->link($query_module_list_str);
                while($query_module_list_arr=mysqli_fetch_array($query_module_list_result,MYSQLI_BOTH)){

                    ?>
                    <div class="row">
                        <?php if ($selected_module_id==$query_module_list_arr['module_id']){?>
                            <div class="col-md-2"><input id="change-order" size="10" type="text" value="<?php echo $query_module_list_arr['module_order']?>"/></div>
                            <div class="col-md-2"><input id="change_name" size="10" type="text" value="<?php echo $query_module_list_arr['module_name']?>"/></div>
                        <?php }else{?>
                            <div class="col-md-2"><?php echo $query_module_list_arr['module_order']?></div>
                            <div class="col-md-2"><?php echo $query_module_list_arr['module_name']?></div>

                        <?php } ?>

                        <div class="col-md-2"><?php echo $query_module_list_arr['add_user']?></div>
                        <div class="col-md-2"><?php echo $query_module_list_arr['add_time']?></div>
                        <div id="<?php echo $query_module_list_arr['module_id']?>" class="col-md-2">

                            <?php if($selected_module_id==$query_module_list_arr['module_id']){?>
                                <a href="" class="btn btn-default btn-sm save">保存</a>
                            <?php }else{?>
                                <a href="" class="btn btn-default btn-sm revise">修改</a>
                            <?php }?>

                            <a href="" class="btn btn-default btn-sm delete">删除</a>
                        </div>
                    </div>

                <?php }?>
            </div>
        </div>
    </div>
</div>

<script>
    var isRevising=false;
    $('a').filter('.delete').click(function (ev) {
        var module_id=$(ev.target).parent().attr('id')
        console.log(module_id)
        var obj={
            method:'delete',
            module_id:module_id
        }
        $.get('delete-module.php',obj)
    })

    $('a').filter('.revise').click(function (ev) {
        ev.preventDefault();
        isRevising=true;
        var module_id=$(ev.target).parent().attr('id');
        var href='manage-module.php?module-id='+module_id;
        location.href=href;
    })

    $('a').filter('.save').click(function (ev) {
        ev.preventDefault();
        var module_id=$(ev.target).parent().attr('id')
        var module_order=$('#change-order').val();
        var module_name=$('#change_name').val();
        var obj={
            method:'save',
            module_id:module_id,
            module_order:module_order,
            module_name:module_name
        }
        $.get('save-new-module.php',obj);

        location.href='manage-module.php'
    });

    $('#change-order').change(function (ev) {

        //会重复提交alert确认
        var pattern=/[0-9]/
        if(pattern.test(this.value)){

            alert('输入的数据必须为数字')
        }else {
            console.log('succe')
        }
        //需要增加对输入的数据的提示等
        console.log(this.value)
    });
    $('#change_name').change(function (ev) {
        console.log(this.value)
    })

</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>