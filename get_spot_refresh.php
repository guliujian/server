<?php
//点击我的主页时调用，将unread_reply赋值为最大，即全都未读
	include "jingdian_new_things.php";
	include_once ("mysql_connect.php");
	session_start();
		//$_SESSION['userId']=1;//暂时给userId赋值给1，实际上登录时即可赋值
		//$user_id=$_SESSION['userId'];
		//return $con;
		//测试时将user_id赋值为1，实际中要用到全局变量SESSION['userId'] y
		$sql = "SELECT status_id FROM jingdian_status WHERE jingqu_id=1 ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result = mysqli_query($con,$sql);
		$unread_id=mysqli_fetch_array($result);
		$unread_id=$unread_id['status_id'];
		$unread_id++;
		//echo json_encode($unread_id);
		$_SESSION['unread_id']=$unread_id;
		mysqli_close($con);
		//echo $_SESSION['unread_id'];
		$res=jingdian_status();
		//echo json_encode($_SESSION['unread_id']);
		
		echo json_encode($res);
