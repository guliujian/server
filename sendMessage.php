<?php
	session_start();
	$content=$_POST['content'];
	//$_SESSION['userId']=4;
	$userId = $_SESSION['userId'];
	$content=iconv('UTF-8','gb2312//IGNORE',$content);
	$con = mysql_connect("localhost","root","");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("test",$con);
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
	mysql_query("set names 'gbk'");
	$result=mysql_query($sql,$con);
	mysql_close($con);	
	if(!$result){
		echo -1;//-1代表出错
	}
	else
		echo 0;//成功发送！	
?>
