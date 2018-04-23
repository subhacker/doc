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

        #pagination a:hover{
            cursor: pointer;

        }

        #navigator a:hover{
            cursor: pointer;
        }

        .selected-module{
            background: blue;
            color: #fff0f0;
            font-size: 110%;
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


<div><h3 class="text-center">新闻管理</h3></div>
<div id="navigator">
    <span id="so">新闻模块选择:</span>
    <div id="module-list">
    </div>
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



</div>
<div id="news-list" class="container">
</div>
<div id="pagination">
    <ul id="ul"></ul>

</div>

</div>

<script>

    const maxPageIndicator=2;
    const maxListPerPage=3;
    let newsNum=0;
    let currentPage=0;
    let startPage=0;
    let currentModuleItem;

    let pageStr;
    let lastSelectedModule;

    function getNewsList(moduleItem,_currentPage,requiredPageNum) {
        let filter;
        if(moduleItem==undefined){
            filter='all'
        }else{
            filter=moduleItem
        }
        let data={
            filter:filter,
            startNews:_currentPage*maxListPerPage,
            requiredNewsNum:requiredPageNum
        };

        $.get('../api/get-news-list.php',data).done(function (returnData) {
            console.log(returnData);
            let data=JSON.parse(returnData).news_arr;
            let newsList=document.getElementById('news-list');
            newsList.innerHTML='';

            for(let i=0;i<data.length;i++){
                let newsItem=document.createElement('div');
                newsItem.className='row context';
                newsItem.id=data[i].newsId;
                let newsFirstPart=document.createElement('div');
                newsFirstPart.className='col-md-8';
                let newsFirstPartContainer=document.createElement('div');
                newsFirstPartContainer.className='row'
                let newsNextPart=document.createElement('div');
                newsNextPart.className='col-md-4';
                let newsNextPartContainer=document.createElement('div');
                newsNextPartContainer.className='row'
                newsItem.appendChild(newsFirstPart);
                newsItem.appendChild(newsNextPart);
                newsFirstPartContainer.innerHTML="<div class='col-md-2'><div class='inn'><span>"+data[i].newsId+"</span></div></div><div class='col-md-2'><div class='inn'><span class='text-center'>"+data[i].newsModule+"</span></div></div><div class='col-md-8'><div class='inn'><span>"+data[i].title+"</span></div></div>"

                let part1="<div class='col-md-3'><div class='inn'><span>"+data[i].visitTimes+"</span></div></div><div class='col-md-3'><div class='inn'><span>"+data[i].adder+"</span></div></div><div class='col-md-3'><div class='inn'><span>"+data[i].addTime+"</span></div></div>"
                let part2="<div class='col-md-3'><div class='inn' ><a class='delete' href=''>删除</a><a  class='revise' href=''>修改</a></div></div>"
                newsNextPartContainer.innerHTML=part1+part2;
                newsFirstPart.appendChild(newsFirstPartContainer);
                newsNextPart.appendChild(newsNextPartContainer);
                newsList.appendChild(newsItem)
            }

            $(newsList).click(function (ev) {
                ev.preventDefault();
                if(ev.target.className=='delete'){
                    let deleteNode=ev.target.parentNode.parentNode.parentNode.parentNode.parentNode;
                    let deleteNodeId=deleteNode.id;
                    console.log(deleteNodeId)
                    let deleteInfo={
                        deleteNodeId:deleteNodeId
                    };
                    $.get('../api/delete-news.php',deleteInfo).done(function (data) {
                        deleteNode.parentNode.removeChild(deleteNode);
                        newsNum--;
                    })
                }
                if(ev.target.className=='revise'){
                    //进行新闻的修改
                }

            });

            newsNum=JSON.parse(returnData).list_num;

            if(startPage===0){
                pageStr="<li  class='disabled'><a id='prev'  href='#'><<</a></li>"
            }else{
                pageStr="<li ><a id='prev'  href='#'><<</a></li>"
            }

            let pageNum;
            if(Math.ceil(newsNum/maxListPerPage)-startPage>maxPageIndicator){
                pageNum=maxPageIndicator;
            }else{
                pageNum=Math.ceil(newsNum/maxListPerPage)-startPage
            }

            for(let j=0;j<pageNum;j++){
                if(currentPage===startPage+j){
                    pageStr+="<li class='active'><a>"+(startPage+j+1)+"</a></li>"
            }else{
                    pageStr+="<li><a>"+(startPage+j+1)+"</a></li>"
                }
            }

            if(startPage+maxPageIndicator>newsNum/maxListPerPage){
                pageStr+="<li  class='disabled'><a id='next' href='#'>>></a></li>"

            }else{
                pageStr+="<li  ><a id='next' href='#'>>></a></li>"
            }

            let pagination=document.createElement('ul');
            pagination.className='pagination'
            pagination.innerHTML=pageStr
            document.getElementById('pagination').innerHTML=''
            document.getElementById('pagination').appendChild(pagination);
        })
    }
    $(document).ready(function (ev) {
        $.get('../api/get-module-list.php').done(function (returnData) {
            let data=JSON.parse(returnData);
            let moduleList=document.getElementById('module-list')
            for(let i=0;i<data.length;i++){
                let linkA=document.createElement('a');
                linkA.innerHTML=data[i]
                moduleList.appendChild(linkA)
            }
            getNewsList('all',currentPage,maxListPerPage);

            $(moduleList).click(function (ev) {
                ev.preventDefault();
                if(lastSelectedModule){
                    $(lastSelectedModule).removeClass('selected-module')
                }else{
                }
                lastSelectedModule=ev.target;
                $(lastSelectedModule).addClass('selected-module')
                currentModuleItem=ev.target.innerHTML
                currentPage=0;
                startPage=0;
                getNewsList(currentModuleItem,currentPage,maxListPerPage);
            });

            $('#pagination').click(function (ev) {
                ev.preventDefault();
                if(ev.target.id=='next') {
                    if (ev.target.parentNode.className == 'disabled') {
                        return
                    } else {
                        startPage = startPage + maxPageIndicator;
                        currentPage = startPage;

                        getNewsList(currentModuleItem, currentPage, maxListPerPage)
                        return
                    }
                }
                if(ev.target.id=='prev'){
                    if(ev.target.parentNode.className=='disabled'){
                        return
                    }else{
                        if(startPage>maxPageIndicator){
                            startPage=startPage-maxPageIndicator;
                            currentPage=startPage-1
                        }else{
                            currentPage=startPage-1;
                            startPage=0
                        }
                    }
                    getNewsList(currentModuleItem,currentPage,maxListPerPage)
                }
                if(Number.isInteger(parseInt(ev.target.innerHTML))){
                    currentPage=parseInt(ev.target.innerHTML)-1;
                    getNewsList(currentModuleItem,currentPage,maxListPerPage)
                }


            })
        })

    })


</script>
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>