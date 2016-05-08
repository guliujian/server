<?php
session_start();
include_once ("mysql_connect.php");
//$_SESSION['userId']= 1;
$userId = $_SESSION['userId'];
//查找好友的信息
$sql = "SELECT * FROM user WHERE user_id = '$userId'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_array($result);
		//var_dump($row);
		$SelfInfo['Longitude']=$row['longitude'];
		$SelfInfo['Latitude']=$row['latitude'];
		//$SelfInfo['Head']="http://192.168.1.101/register8.24/";
		$SelfInfo['Head']="";
		$SelfInfo['Head'].=$row['portrait'];		
		$SelfInfo['Id']=$row['user_id'];	
		$SelfInfo['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);		
	mysqli_close($con);
	//var_dump($a);
	echo json_encode($SelfInfo);	
?>