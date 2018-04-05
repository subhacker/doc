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
            margin-top: 20px;
        }
        h3{
            margin-top: 10px;
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
    </style>

</head>
<body>

<?php

include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}

include "../common-files/mysql.php";

$input_id=$_GET['id'];
$filter=$_GET['filter'];
$database=new mysql();
if($input_id){
    $select_str="SELECT * FROM news_info WHERE id='$input_id'";
    if($select_result=$database->link($select_str)){
        $arr=mysqli_fetch_array($select_result);
    }
}

$tag=$_POST['tag'];
if($tag){
    $post_title=$_POST['title'];
    $post_content=$_POST['content'];
    $post_id=$_POST['id'];
    $update_str="UPDATE `news_info` SET `title`='$post_title',`context`='$post_content' WHERE id='$post_id'";
    $update_result=$database->link($update_str);
    if($update_result){
        $href='manage-news.php?filter='.$filter;

        echo "<script type='application/javascript'> location.href='$href'</script>";
    }else{
        echo'修改失败';
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

            <div id="success-exit"><a>[安全退出]</a></div>
        </div>

        <div class="col-md-5 col-md-push-1">

            <div> <h3 class="text-center">新闻修改</h3></div>

            <form class="form-horizontal" method="post" action="revise-news.php?filter=<?php echo $filter?>" >

                <div class="form-group">
                    <label for="revise-title" class="col-md-3 control-label ">新闻标题:</label>
                    <div class="col-md-9">
                        <input type="text" value="<?php echo $arr['title']?>" name="title" class="form-control input-sm" id="revise-title" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-md-3 control-label">所属模块:</label>
                    <div id="select-category" class="col-md-9">
                        <select id="category" name="category">
                            <option class="disabled">请选择</option>
                            <option class="disabled">科技前沿</option>
                            <option class="disabled">企业研发</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label id="revise-context-label" for="revise-context" class="col-md-3 control-label">修改新闻:</label>
                    <div class="col-md-9" id="revise-context">
                        <textarea rows="10" name="content" >
                            <?php echo $arr['context'] ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="admin" class="col-md-3 control-label">添加人:</label>
                    <div class="col-md-9" id="admin">
                        <p class="form-control-static">Admin</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date-time" class="col-md-3 control-label">添加人:</label>
                    <div class="col-md-9" id="date-time">
                        <p class="form-control-static">2018-2-2 22:08:56</p>
                    </div>
                </div>
                <input type="hidden" name="tag" value='1'>
                <input type="hidden" name="id" value="<?php echo $input_id?>">

                <div class="form-group">
                    <div class="col-md-3 col-md-push-5">
                        <button type="submit" id="add-news-button" class="btn btn-default">提交</button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>







<script>



</script>








<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>