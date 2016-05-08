<?php
header('Content-type:text/html;charset:GB2312');
$username=$_GET['username'];
//$username=iconv('UTF-8','gb2312//IGNORE',$username);
$exec="SELECT * FROM user WHERE user_name = '$username'";
$link = mysql_connect("localhost","root","");
mysql_query("set names 'GB2312'");
mysql_select_db("test");
$result=mysql_query($exec);
$numrows=mysql_num_rows($result);
if($numrows>0){
	echo "1";//说明数据库中已有该用户名
}
else{
	echo "0";//该用户名可以使用
}
