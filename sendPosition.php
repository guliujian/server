<?php
session_start();
require_once ("mysql_connect.php");
$userId = $_SESSION['userId'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$sql="UPDATE user SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = $userId";//更新用户最新位置
//echo $sql;
$result=mysqli_query($con,$sql);
if($result==FALSE){
	echo -1;//出错了。
}
else{
	echo 0;//正确
}
$sql="INSERT INTO user_location (user_id,latitude,longitude) VALUES ('$userId','$latitude','$longitude')";
//插入记录用户位置的表
$result=mysqli_query($con,$sql);
if($result==FALSE){
	echo -1;//出错了。
}
else{
	echo 0;//正确
}
