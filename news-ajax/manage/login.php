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

    <script src="../common-files/jquery-3.3.1.min.js"></script>

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
        #dummy-username,#none-username,#dummy-password,#error-password{
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 "></div>
        <div class="col-md-6">
            <form class="form-horizontal" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">账号:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $account?>" >
                    </div>
                    <div id="dummy-username"  class="error-container"><span class="tip-text">账号不能为空</span></div>
                    <div id="none-username" class="error-container"><span class="tip-text">账号不存在</span></div>
                </div>

                <div class="form-group">
                    <label for="user-password" class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="user-password" id="user-password"  >
                    </div>
                    <div id="dummy-password" class="error-container"><span class="tip-text">密码不能为空</span></div>
                    <div id="error-password" class="error-container"><span class="tip-text">密码错误</span></div>
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


<script>
    let dummyUserName=document.getElementById('dummy-username');
    let noneUserName=document.getElementById('none-username');
    let dummyPassword=document.getElementById('dummy-password');
    let errorPassword=document.getElementById('error-password');

    $('form').submit(function (ev) {
        ev.preventDefault();
        console.log('表单提交')

        if(!$('#username').val()){
            dummyUserName.style.display='inline';
        }else{
            dummyUserName.style.display='none';
        }

        if(!$('#user-password').val()){
            dummyPassword.style.display='inline';

        }else{
            dummyPassword.style.display='none';
        }

        if($('#username').val()&&$('#user-password').val()){
            let data={
                username:$('#username').val(),
                password:$('#user-password').val()
            };
            $.post('../api/manage-login.php',data)
                .done(function (data) {
                    let result=JSON.parse(data);
                    if(result.username){
                        noneUserName.style.display='none';
                        if(result.password){
                            errorPassword.style.display='none';
                            location.href='index.php'
                        }else{
                            errorPassword.style.display='inline'
                        }

                    }else{
                        noneUserName.style.display='inline'
                    }
            })
                .fail(function (err) {
                    console.log('获取失败')

            })
        }

    })
</script>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>