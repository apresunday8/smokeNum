<?php
//连接数据库
//设置字符集编码
header("content-type:text/html;charset=utf-8");
//设置连接数据库参数
$DB_HOST = "127.0.0.1";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "student";

//连接数据库
$link = @mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD);
if (!$link) {
	echo "<p style= color:red;font-size:30px;>连接Mysql数据库失败</p>";
	exit();
}
//连接成功则执行选择数据库
$select = mysql_select_db($DB_NAME);
mysql_query("set names utf8");
if (!$select) {
	echo "<p style = color:red;font-size:30px;>选择数据库失败</p>";
}
function dump($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}
?>