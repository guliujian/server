<?php
session_start();
include_once ("mysql_connect.php");
//$_SESSION['userId']= 1;
$userId = $_SESSION['userId'];
$idName=$_POST['idName'];
$sql0 =  "SELECT * FROM jingdian_inf WHERE id_name = '$idName'";
echo $sql0;
$result0=mysqli_query($con,$sql0);
$jingdianId=mysqli_fetch_array($result0)['jingdian_id'];
$sql = "SELECT * FROM eyeon WHERE user_id='$userId' AND jingdian_id='$jingdianId'";
	$result = mysqli_query($con,$sql);
	if(mysql_num_rows($result)>0)
	{
		echo '1';//表示已经发送了关注该景点的请求。
	}
	else{
	$sql2 = "INSERT INTO eyeon (jingdian_id,user_id) VALUES ('$jingdianId','$userId')";
	$result2 = mysqli_query($con,$sql2);
		if($result2==FALSE)
		{
			echo '-1';//表示插入失败
		}
		else{
			echo '0';//关注该景点成功
		}
	}	
