<?php
	session_start();
	//echo "lala";
	//$_SESSION['evaluator_id']='20099';//此处设置用户id为20099，在登陆的时候会将SESSION的user_id赋值的
	$evaluate['evaluator_id']=$_SESSION['evaluator_id'];//实际上应为user_id但此处测试，所以就暂时定义一个evaluator_id
	$evaluate['content']=$_POST['content'];
	//echo evaluate
	$evaluate['id_name']=$_POST['id_name'];
	//$jingdian_id=$_POST['jingdian_id'];
	$evaluate['star']=$_POST['star'];
	$evaluate['content']=$evaluate['content'];
//	$content
	$evaluator_id=$evaluate['evaluator_id'];
	$content=$evaluate['content'];
	//echo $
	
	$star=$evaluate['star'];
	$id_name=$evaluate['id_name'];
	
	$sql0="SELECT portrait FROM user WHERE user_id='$evaluator_id'";
	$result0=mysqli_query($con,$sql0);
	$row0=mysqli_fetch_array($result0);
	$evaluate['portrait']=$row0['portrait'];
	$sql1="SELECT jingdian_id FROM jingdian_inf WHERE id_name='$id_name'";
	$result1 = mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_array($result1);
		
	$new_jingdian_id = $row1['jingdian_id'];
	$id=$_SESSION['evaluator_id'];
	$sql2="SELECT user_name FROM user WHERE user_id='$evaluator_id'";
	$result2=mysql_query($sql2,$con);
	$row2=mysql_fetch_array($result2);
	$evaluate['evaluator_name']=$row2['user_name'];
		//echo $new_jingdian_id;
		//echo $id_name;
		//echo $evaluator_name;
		//echo $content;
		//echo $star;
		$sql2="INSERT INTO jingdian_evaluate (jingdian_id,id_name,evaluator_id,content,star) VALUES ('$new_jingdian_id','$id_name','$evaluator_id','$content','$star')";
		//echo $sql2;		
		
		mysql_query($sql2,$con);
		$evaluate['content']=iconv('gb2312//IGNORE','UTF-8',$evaluate['content']);
		$evaluate['evaluator_name']=iconv('gb2312//IGNORE','UTF-8',$evaluate['evaluator_name']);
		echo json_encode($evaluate);
