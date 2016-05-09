<?php
	session_start();
	require_once ("mysql_connect.php");
	$content=$_POST['content'];
	//$_SESSION['userId']=4;
	$userId = $_SESSION['userId'];
	$content=iconv('UTF-8','gb2312//IGNORE',$content);
	if(isset($_SESSION['photo'])){
	$pic = $_SESSION['photo'];//获取图片信息
	$sql = "INSERT INTO status (user_id,content,picture) VALUES ('$userId','$content','$pic')";
	//echo $sql;
		unset($_SESSION['photo']);
	}
	else{
		$sql="INSERT INTO status (user_id,content) VALUES ('$userId','$content')";
	}
	//echo $sql;
	$result=mysqli_query($con,$sql);
	mysqli_close($con);
	if(!$result){
		echo -1;//-1代表出错
	}
	else
		echo 0;//成功发送！	

