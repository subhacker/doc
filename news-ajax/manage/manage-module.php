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

        #output-preview h4{
            margin-left: 100px;
        }


        #list_header{
            font-size: 110%;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        input{
            width: 100%;
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
                <li><a id="revise-module-a" href="">修改模块</a></li>
                <li><a id="add-news-a"  href="add-news.php">添加新闻</a></li>
                <li><a id="revise-news-a" href="manage-news.php">修改新闻</a></li>
            </ul>

            <div id="success-exit"><a href="destroy-login.php">[安全退出]</a></div>
        </div>

        <div class="col-md-6 ">
            <div id="module-list" class="container">
                <div id='list_header' class="row">
                    <div class="col-md-2">id值</div>
                    <div class="col-md-2">内容</div>
                    <div class="col-md-2">添加人</div>
                    <div class="col-md-2">添加时间</div>
                    <div class="col-md-2">操作</div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function (ev) {
        $.get('../api/manage-module.php').done(function (returnData) {
            let data=JSON.parse(returnData)
            let moduleList=document.getElementById('module-list');
            let itemContainer;

            for(let i=0;i<data.length;i++){
                itemContainer=document.createElement('div')
                itemContainer.className='row';

                let moduleIndexTextNode=document.createTextNode(data[i].moduleIndex)
                let moduleIndexDivNode=document.createElement('div')
                moduleIndexDivNode.className='col-md-2'
                moduleIndexDivNode.appendChild(moduleIndexTextNode);
                itemContainer.appendChild(moduleIndexDivNode)

                let moduleNameTextNode=document.createTextNode(data[i].moduleName)
                let moduleNameDivNode=document.createElement('div')
                moduleNameDivNode.className='col-md-2'
                moduleNameDivNode.appendChild(moduleNameTextNode);
                itemContainer.appendChild(moduleNameDivNode)



                let moduleAdderTextNode=document.createTextNode(data[i].adder)
                let moduleAdderDivNode=document.createElement('div')
                moduleAdderDivNode.className='col-md-2'
                moduleAdderDivNode.appendChild(moduleAdderTextNode);
                itemContainer.appendChild(moduleAdderDivNode)

                let moduleAddTimeTextNode=document.createTextNode(data[i].addTime)
                let moduleAddTimeDivNode=document.createElement('div')
                moduleAddTimeDivNode.className='col-md-2'
                moduleAddTimeDivNode.appendChild(moduleAddTimeTextNode);
                itemContainer.appendChild(moduleAddTimeDivNode);

                let saveButtonText=document.createTextNode('修改');
                let saveButton=document.createElement('button');
                saveButton.appendChild(saveButtonText);
                saveButton.className='btn btn-default btn-sm'

                let freezeButtonText=document.createTextNode('冻结');
                let freezeButton=document.createElement('button');
                freezeButton.appendChild(freezeButtonText);
                freezeButton.className='btn btn-default btn-sm'

                let deleteButtonText=document.createTextNode('删除');
                let deleteButton=document.createElement('button');
                deleteButton.appendChild(deleteButtonText);
                deleteButton.className='btn btn-default btn-sm'

                let operateDivContainer=document.createElement('div');
                operateDivContainer.className='operate-board';
                operateDivContainer.id=data[i].moduleId;
                operateDivContainer.appendChild(saveButton)
                operateDivContainer.appendChild(freezeButton);
                operateDivContainer.appendChild(deleteButton)

                itemContainer.appendChild(operateDivContainer)
                moduleList.appendChild(itemContainer)
           }

          $('.operate-board').click(function (ev) {
              if(ev.target.innerHTML=='删除'){
                  console.log('shancu')
                  let moduleId=ev.currentTarget.id;
                  let data={
                      deleteId:moduleId
                  };
                  $.get('../api/delete-module.php',data).done(function (data) {
                      console.log(data)
                     ev.currentTarget.parentNode.parentNode.removeChild(ev.currentTarget.parentNode)
                  })
              }
              if(ev.target.innerHTML=='冻结'){
                  console.log('shancu')
              }

              if(ev.target.innerHTML=='修改'){
                  ev.target.innerHTML='保存'
                  let moduleId=ev.currentTarget;
                  let moduleIndexEle=ev.currentTarget.parentNode.firstElementChild;
                  let moduleNameEle=moduleIndexEle.nextElementSibling;

                  console.log('第一个和第二个元素')
                  console.log(moduleIndexEle);
                  console.log(moduleNameEle);

                  let moduleIndexReviseInput=document.createElement('input');
                  moduleIndexReviseInput.type='text';
                  moduleIndexReviseInput.id='revise-module-index'
                  moduleIndexReviseInput.value=moduleIndexEle.innerHTML;
                  moduleIndexEle.innerHTML=''
                  moduleIndexEle.appendChild(moduleIndexReviseInput);
                  console.log('moduleIndexEle');

                  console.log(moduleIndexEle);

                  let moduleNameReviseInput=document.createElement('input');
                  moduleNameReviseInput.type='text';
                  moduleNameReviseInput.id='revise-module-name';
                  moduleNameReviseInput.value=moduleNameEle.innerHTML;
                  moduleNameEle.innerHTML='';
                  moduleNameEle.appendChild(moduleNameReviseInput);
              return
              }


              if(ev.target.innerHTML=='保存'){

                  let newModuleIndex=document.getElementById('revise-module-index').value;
                  let newModuleName=document.getElementById('revise-module-name').value;
                  console.log('修改后的值')
                  console.log(newModuleIndex)
                  let moduleId=ev.currentTarget.id;
                 let postData={
                      reviseModuleId:moduleId,
                      newModuleName:newModuleName,
                      newModuleIndex:newModuleIndex
                  };
                 console.log('post data');
                 console.log(postData)
                  $.get('../api/revise-module.php',postData).done(function (data) {
                      console.log('修改后返回的数据');
                      console.log(data)
                      ev.target.innerHTML='修改';
                      let moduleIndexEle=ev.currentTarget.parentNode.firstElementChild;
                      let moduleNameEle=moduleIndexEle.nextElementSibling;

                      console.log('修改后的moduleIndexEle的值以及moduleNameEle的值')
                      console.log(moduleIndexEle);

                      let newModuleIndexTextNode=document.createTextNode(newModuleIndex)

                      moduleIndexEle.innerHTML='';
                      moduleIndexEle.appendChild(newModuleIndexTextNode)

                      console.log('修改添加appenchid后的值')
                      console.log(moduleIndexEle)


                     let newModuleNameTextNode=document.createTextNode(newModuleName);
                      moduleNameEle.innerHTML='';
                      moduleNameEle.appendChild(newModuleNameTextNode)
                      return


                  })
              }


          })



        })
    })






</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>