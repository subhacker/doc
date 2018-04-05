<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>添加新闻</title>

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
            margin-top: 20px;
        }
        h3{
            margin-top: 10px;
        }

        #left-list{
            margin-top: 20px;
        }

        #left-title{
            padding-left: 15px;
            font-size: 120%;
            margin-top: 15px;
        }

        ul{
            width: 45%;
        }
        #success-exit{
            padding-left: 13px;
            padding-top: 20px;
        }

        textarea{
            width: 100%;
        }

        .container{
            margin-left: 0px;
            margin-top: 0px;
        }

        #select-category{
            margin-top: 10px;
        }

        .err-tip-text{
            font-size: 80%;
            color: red;
            margin-top: 15px;
        }

        .err-tip-for-textarea{
            font-size: 80%;
            color: red;
            margin-top: 100px;
        }

        .err-tip{
            display: none;
        }

        #add-title{
            margin-left: 100px;
        }

        #result-board .row{
            margin-top: 20px;

        }

        #add-more{
            margin-left: 80px;
            margin-top: 20px;
        }

        #result-board .row .col-md-2 {
            font-size: 110%;
            font-weight: bold;
        }

    </style>
</head>
<body>

<?php

include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}

include "../common-files/mysql.php";
$has_success_post=false;
$module_adder=get_login_user();
$module_add_time=time();
$database=new mysql();

$title=$_POST['title'];
$content=$_POST['content'];
$category=$_POST['category'];
$tag=$_POST['tag'];
session_start();
$add_user=$_SESSION['username'];
$id=time();
$add_time=date('Y-m-d h:i:s',$id);

if($tag){
    /**
     * 根据提交的新闻信息，将其插入到数据库中
     */
    $query_module_id_str="select * from module_info where module_name='$category'";
    $query_module_id_result=$database->link($query_module_id_str);
    $query_module_id_arr=mysqli_fetch_array($query_module_id_result);
    $filter_id=$query_module_id_arr['module_id'];
    $insert_news_str="INSERT INTO `news_info`(`id`,`module_id`,`module_name`,  `title`, `context`, `add_user`, `add_time`, `visit_times`)
                      VALUES ($id,$filter_id,'$category','$title','$content','$add_user','$add_time',56)";
    $result=$database->link($insert_news_str);
    if($result){
        $has_success_post=true;
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

        <div class="col-md-7 ">

            <div id="add-board">

            <div> <h3 id="add-title">添加新闻</h3></div>
            <form class="form-horizontal" method="post" action="add-news.php" >

                <div class="form-group">
                    <label for="revise-title" class="col-md-2 control-label ">新闻标题:</label>
                    <div class="col-md-8">
                        <input type="text" name="title" class="form-control input-sm" id="revise-title" >
                    </div>
                    <div id="none-title" class="err-tip-text err-tip"><span>标题不能为空</span></div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-md-2 control-label">所属模块:</label>
                    <div id="select-category" class="col-md-3">
                        <select id="category" name="category">
                            <option value="choose">请选择</option>
                            <?php
                            $query_module_list_str="select * from module_info";
                            $query_module_list_result=$database->link($query_module_list_str);
                            while ($query_module_list_arr=mysqli_fetch_array($query_module_list_result)){
                            ?>
                            <option><?php echo $query_module_list_arr['module_name']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div id="none-select" class="err-tip-text err-tip"><span>标题不能为空</span></div>
                </div>

                <div class="form-group">
                    <label id="revise-context-label" for="revise-context" class="col-md-2 control-label">修改新闻:</label>
                    <div class="col-md-8" id="revise-context">
                        <textarea id="add-content" rows="10" name="content" ></textarea>
                    </div>
                    <div id="none-content" class="err-tip-for-textarea err-tip"><span>内容不能为空</span></div>
                </div>
                <input type="hidden" id="tag">

                <div class="form-group">
                    <div class="col-md-2 col-md-push-4">
                        <button type="submit" id="add-news-button" class="btn btn-default">提交</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="container" id="result-board">
            <div class="row">
                <div class="col-md-2">新闻标题</div>
                <div class="col-md-9"><span><?php echo $title ?></span></div>
            </div>
            <div class="row">
                <div class="col-md-2">新闻模块</div>
                <div class="col-md-9"><span><?php echo $category?></span></div>
            </div>
            <div class="row">
                <div class="col-md-2">新闻内容</div>
                <div class="col-md-9"><p style="display: inline"><?php echo $content?></p></div>
            </div>
            <div class="row">
                <div class="col-md-2">添加人员</div>
                <div class="col-md-9"><span><?php echo $module_adder?></span></div>
            </div>
            <div class="row">
                <div class="col-md-2">添加事件</div>
                <div class="col-md-9"><span><?php echo date("Y-m-d H:i:s",$module_add_time) ?></span></div>
            </div>
            <button  id="add-more" class="btn btn-primary">继续添加 +</button>

        </div>
    </div>
</div>

<script>

    /**
     * 根据输入的信息，对输入的内容的完整性进行判断，并给出适当的提示
     */

   $('form').submit(function (ev) {
       if(!$('#revise-title').val()){
           $('#none-title').removeClass('err-tip');
           ev.preventDefault();
       }
       console.log('zhi')
       console.log($('#category').val())

       if($('#category').val()=='choose'){
           $('#none-select').removeClass('err-tip');
           ev.preventDefault();
       }
       if(!$('#add-content').val()){
           $('#none-content').removeClass('err-tip');
           ev.preventDefault();
       }
   })

    var has_success_post=<?php echo $has_success_post?>;
    console.log(has_success_post)
   var addBoard=document.getElementById('add-board');
   var resultBoard=document.getElementById('result-board');
    if(has_success_post){
        addBoard.style.display='none';
    }else{
        resultBoard.style.display='none';
    }

    var addMore=document.getElementById('add-more');
    addMore.addEventListener('click',function (ev) {
        addBoard.style.display='block';
        resultBoard.style.display='none';

    })


</script>




<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>