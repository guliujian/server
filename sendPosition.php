<?php
session_start();
$userId = $_SESSION['userId'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$con = mysql_connect("localhost","root","");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("test",$con);
$sql="UPDATE user SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = $userId";//更新用户最新位置
//echo $sql;
$result=mysql_query($sql);
if($result==FALSE){
	echo -1;//出错了。
}
else{
	echo 0;//正确
}
$sql="INSERT INTO user_location (user_id,latitude,longitude) VALUES ('$userId','$latitude','$longitude')";
//插入记录用户位置的表
$result=mysql_query($sql);
if($result==FALSE){
	echo -1;//出错了。
}
else{
	echo 0;//正确
}
?>