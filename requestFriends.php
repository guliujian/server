<?php
session_start();
//$_SESSION['userId']= 1;
$userId = $_SESSION['userId'];
$targetId=$_POST['targetId'];
$con = mysql_connect("localhost","root","");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_query("set names 'GB2312'");
mysql_select_db("test",$con);
//查找好友的信息
$sql = "SELECT * FROM tempRelation WHERE user_id1='$userId' AND user_id2='$targetId'";
	$result = mysql_query($sql,$con);
	if(mysql_num_rows($result)>0)
	{
		echo '1';//表示已经发送了请求。
	}
	else{
	$sql2 = "INSERT INTO tempRelation (user_id1,user_id2,status) VALUES ('$userId','$targetId','0')";
	$result2 = mysql_query($sql2,$con);
		if($result2==FALSE)
		{
			echo '-1';//表示插入失败
		}
		else{
			echo '0';//添加好友
		}
	}	
?>