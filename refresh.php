<?php
//点击我的主页时调用，将unread_reply赋值为最大，即全都未读
	session_start();
	include "jingdian_evaluate.php";
	require_once ("mysql_connect.php");
	//echo $_POST['id_name'];
		//$_SESSION['userId']=1;//暂时给userId赋值给1，实际上登录时即可赋值
		//$user_id=$_SESSION['userId'];
		//return $con;
		//测试时将user_id赋值为1，实际中要用到全局变量SESSION['userId'] y
		$sql = "SELECT evaluate_id FROM jingdian_evaluate WHERE jingdian_id=2 ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result =mysqli_query($con,$sql);
		$unread_id=mysqli_fetch_array($result);
		$_SESSION['unread_evaluate_id']=$unread_id['evaluate_id'];
		$_SESSION['unread_evaluate_id']++;
		mysqli_close($con);
		//echo $_SESSION['unread_id'];
		//echo $_POST;
		$id_name=$_POST['id_name'];
		$res=get_jingdian_evaluation($id_name);
		//echo json_encode($_SESSION['unread_id']);
		echo json_encode($res);
