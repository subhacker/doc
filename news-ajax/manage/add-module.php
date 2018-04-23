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

        #dummy-module-index,#dummy-module-name,#repeat-module-index-err,#repeat-module-name-err{
            display: none;
        }


        #output-preview{
            display: none;
        }
    </style>

</head>
<body>

<?php
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
            <div><h3 id="add-title">新闻模块添加</h3> </div>
            <form class="form-horizontal" >
                <div class="form-group">
                    <label for="module-name" class="col-md-2 control-label">模块添加:</label>
                    <div class="col-md-7">
                        <input type="text" name="module-name" class="form-control input-sm" id="module-name"  >
                    </div>

                    <div class="error-container visible" id="dummy-module-name"><span>数据不能为空</span></div>
                    <div class="error-container" id="repeat-module-name-err" ><span>名称重复</span></div>


                </div>
                <div class="form-group">
                    <label for="module-index" class="col-md-2 control-label">添加序号:</label>
                    <div class="col-md-7">
                        <input type="number" name="module-index" class="form-control input-sm" id="module-index"  >
                    </div>

                    <div class="error-container visible" id="dummy-module-index"><span>密码不能为空</span></div>
                    <div class="error-container" id="repeat-module-index-err"><span>指定新的序号</span></div>

                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-7">
                        <button type="submit" id="add-news-button" class="btn btn-default">添加</button>
                    </div>
                </div>
            </form>
            </div>

            <div id="output-preview" >
                <h4>您已成功添加如下模块</h4>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>模块名称</td>
                        <td id="module-name-prev"></td>
                    </tr>
                    <tr>
                        <td>模块序号</td>
                        <td id="module-index-prev"></td>
                    </tr>
                    <tr>
                        <td>添加人</td>
                        <td id="module-adder-prev"></td>
                    </tr>
                    <tr>
                        <td>添加时间</td>
                        <td id="module-add-time-prev"></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    let dummyModuleName=document.getElementById('dummy-module-name');
    let dummyModuleIndex=document.getElementById('dummy-module-index');
    let repeatModuleNameErr=document.getElementById('repeat-module-name-err');
    let repeatModuleIndexErr=document.getElementById('repeat-module-index-err');
    $('form').submit(function (ev) {
        ev.preventDefault();
        if(!$('#module-name').val()){
            dummyModuleName.style.display='inline'
        }else{
            dummyModuleName.style.display='none'
        }
        if(!$('#module-index').val()){
            dummyModuleIndex.style.display='inline'
        }else{
            dummyModuleIndex.style.display='none';
        }

        if($('#module-name').val()&&$('#module-index').val()){
            let data={
                moduleName:$('#module-name').val(),
                moduleIndex:$('#module-index').val()
            };
            $.post('../api/add-module.php',data)
                .done(function (returnData) {
                    console.log(returnData)
                    let data=JSON.parse(returnData);
                    if(data.moduleName){
                        repeatModuleNameErr.style.display='none'
                    }else {
                        repeatModuleNameErr.style.display='inline'
                    }
                    if(data.moduleIndex){
                        repeatModuleIndexErr.style.display='none'
                    }else {
                        repeatModuleIndexErr.style.display='inline'
                    }
                    if(data.moduleName&&data.moduleIndex){
                        $('#module-name-prev').text($('#module-name').val());
                        $('#module-index-prev').text($('#module-index').val());
                        let adder=data.adder;
                       $('#module-adder-prev').text(adder);
                      $('#module-add-time-prev').text(data.addTime)
                       document.getElementById('output-preview').style.display='inline'
                    }else{
                        document.getElementById('output-preview').style.display='none'
                    }

                }).fail(function (err) {


            })


        }







    })


</script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>