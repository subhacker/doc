##本次工程是使用PHP构建的新闻管理系统，也是后续React/Angular4.0/Vue重构的原型；

工程包含登录页面，主界面，新闻管理，新闻修改，模块添加，模块修改等页面，
使用到的工具包含PHP、JQuery、BootStrap、AJAX，MYSQL

本次工程包含两大部分，对应在news-press，news-ajax文件夹下，分别对用不同的渲染方式

news-press使用PHP最原始特性，通过不断刷新，直接从后端获取Html页面；

news-ajax使用AJAX与后端进行通信，页面中通过get、Post请求必要的数据，在前端通过修改DOM达到重新渲染页面的目的；

使用MySQL数据库进行数据的持久化存储