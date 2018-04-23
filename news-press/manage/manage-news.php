<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>新闻管理</title>

    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

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
        .header div div div{
             padding: 1px;

         }
        .context div div div{
            padding: 1px;
        }
        .header .inn{
            background: #2520ff;
        }

        .context .inn{
            background: #a8ffb9;
        }
        #pagination{
            margin-left: auto;
            margin-right: auto;
            width: 400px;
        }
        #navigator{
            margin-bottom: 10px;
            margin-left: 61px;
        }

        #navigator a{
            margin-left: 5px;
        }

        .choose{
            color: red;
            background: aqua;
        }

    </style>
</head>
<body>

<?php

include '../common-files/get_user_info.php';
if(!hasLogin()) {
    echo "<script>location.href='login.php'</script>";
}

/**
 * 设置每页显示的数量以及最大的pagination最大显示的标签数量
 */

$LIST_PER_PAGE=10;
$MAX_PAGINATION_NUM=4;

include '../common-files/mysql.php';
$database=new mysql();

$filter=$_GET['filter'];
$page=$_GET['page'];
$page_start=$_GET['page-start'];

/**
 * 对page，page-start,page-end进行更完整的验证，在输入不完整的情况下
 */


/**
 * query_content_str是根据filter的值，来查询满足条件的所有的新闻对象
 * query_list_max_num是根据filter的时，来插线该filter的新闻的数量
 */
if(strtolower($filter)=='all'){
    $query_content_str='select * from news_info limit '.$page .','.$LIST_PER_PAGE;
    $query_list_max_num_str='select * from news_info';
}else{
    //根据输入的filter获取对应的module_id值
    $query_module_id_str="select * from module_info where module_name='$filter'";
    $query_module_id_result=$database->link($query_module_id_str);
    $query_module_id_arr=mysqli_fetch_array($query_module_id_result);
    $filter_id=$query_module_id_arr['module_id'];

    $query_content_str="select * from news_info where module_id=".$filter_id." limit ".$page.','.$LIST_PER_PAGE;
    $query_list_max_num_str="select * from news_info where module_id='$filter_id'";
}

$query_content_result=$database->link($query_content_str);

$query_list_max_num_result=$database->link($query_list_max_num_str);
$max_list_num=mysqli_num_rows($query_list_max_num_result);
$page_end=$_GET['page-end'];
?>

<div><h3 class="text-center">新闻管理</h3></div>
<div id="navigator">
    <span>新闻模块选择:</span>
    <?php

    //获取所有列表的数量，用于all的快速链接使用
    $query_max_news_num_all_str="select * from news_info";
    $query_max_news_num_all_result=$database->link($query_max_news_num_all_str);
    $max_all_news_num=mysqli_num_rows($query_max_news_num_all_result);

    ?>
    <a href=<?php echo "manage-news.php?filter=all&page=0&page-start=0&page-end=".(floor($max_all_news_num/$LIST_PER_PAGE)<$MAX_PAGINATION_NUM?floor($max_all_news_num/$LIST_PER_PAGE):$MAX_PAGINATION_NUM)?> >ALL</a>
    <?php

    //查询所有的module列表
    $query_module_list_str="select * from module_info order by 'module_order' asc ";
    $query_module_list_result=$database->link($query_module_list_str);

    while ($query_module_list_arr=mysqli_fetch_array($query_module_list_result)){

        //获取每个module_name对应的新闻的数量
        $current_module_name=$query_module_list_arr['module_name'];
        $query_current_module_max_num_str="select * from news_info where module_name='$current_module_name'";
        $query_current_module_max_num_result=$database->link($query_current_module_max_num_str);
        $current_max_num=mysqli_num_rows($query_current_module_max_num_result);
    ?>
    <a href="<?php $link='manage-news.php?filter='.$query_module_list_arr['module_name'].'&page=0&page-start=0&page-end='.(floor($current_max_num/$LIST_PER_PAGE)<$MAX_PAGINATION_NUM ?floor($current_max_num/$LIST_PER_PAGE):$MAX_PAGINATION_NUM);
    echo $link;
    ?>"><?php echo $query_module_list_arr['module_name']?></a>
    <?php }?>
</div>

<div class="container">
    <div class="row header">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-2">
                    <div class="inn">
                        <span>编号</span>
                    </div></div>
                <div class="col-md-2">
                    <div class="inn">
                        <span class="text-center">所属模块</span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="inn">
                        <span>标题</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="inn">
                        <span>浏览次数</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inn">
                        <span>创建人</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inn">
                        <span>添加时间</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inn">
                        <span>操作</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
while ($arr=mysqli_fetch_array($query_content_result,MYSQLI_BOTH)){
?>

    <div class="row context">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-2"><div class="inn"><span><?php echo $arr[id] ?></span></div></div>
                <div class="col-md-2"><div class="inn"><span class="text-center"><?php echo $arr[module_name] ?></span></div></div>
                <div class="col-md-8"><div class="inn"><span><?php echo $arr['title']?></span></div></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-3"><div class="inn"><span><?php echo $arr['visit_times'] ?></span></div></div>
                <div class="col-md-3"><div class="inn"><span><?php echo $arr['add_user'] ?></span></div></div>
                <div class="col-md-3"><div class="inn"><span><?php echo $arr['add_time'] ?></span></div></div>
                <div class="col-md-3">
                    <div class="inn" id="<?php echo $arr['id']?>">
                        <a class='delete' href="">删除</a>
                        <a  class="revise" href="">修改</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
     }

    ?>
    <div id="pagination">
        <ul class="pagination ">
            <?php

            if($page_start>0){
                $prev_href='manage-news.php?filter='.$filter.'&page='.($page_start).'&page-start='.($page_start>$MAX_PAGINATION_NUM?$page_end-$MAX_PAGINATION_NUM:0).'&page-end='.$page_start;
                echo "<li><a href=$prev_href><<</a></li>";
            }else{
                echo "<li  class='disabled'><a><<</a></li>";
            }

            for($j=$page_start;$j<=$page_end;$j++){
                $current_page=$j+1;
                $page_href='manage-news.php?filter='.$filter.'&page='.($current_page-1).'&page-start='.$page_start.'&page-end='.$page_end;
                echo "<li  ><a href=$page_href>$current_page</a></li>";
            }
            if(floor($maxlist_num/$LIST_PER_PAGE)-$page_end>0){
                $next_href='manage-news.php?filter='.$filter.'&page='.($page_end+1).'&page-start='.($page_end+1).'&page-end='.(floor($max_list_num/$LIST_PER_PAGE)-$page_end>$MAX_PAGINATION_NUM?$MAX_PAGINATION_NUM:floor($max_list_num/$LIST_PER_PAGE));
                echo "<li ><a href=$next_href>>></a></li>";
            }else{
                echo "<li  class='disabled'><a>>></a></li>";
            }
            ?>
        </ul>
    </div>
</div>

</div>

<script>

    $('a').filter('.delete').click(function (ev) {
        console.log('点击删除按钮');
        var id=$(ev.target).parent().attr('id')
            console.log(id);
        var obj={
            method:'delete',
            id:id
        };
        $.get('delete.php',obj);
        }
    )

    $('a').filter('.revise').click(function (ev) {
        ev.preventDefault();
        var reviseId=$(ev.target).parent().attr('id');
        var href='http://localhost:8080/news-press/manage/revise-news.php?'+'id='+reviseId+'&filter='+'<?php echo $filter?>';
        console.log(href)
        window.location.href=href;
        }

    )
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>