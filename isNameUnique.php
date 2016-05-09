<?php
header('Content-type:text/html;charset:GB2312');
include_once ("mysql_connect.php");
$username=$_GET['username'];
//$username=iconv('UTF-8','gb2312//IGNORE',$username);
$exec="SELECT * FROM user WHERE user_name = '$username'";
$result=mysqli_query($con,$exec);
$numrows=mysql_num_rows($result);
if($numrows>0){
	echo "1";//说明数据库中已有该用户名
}
else{
	echo "0";//该用户名可以使用
}
