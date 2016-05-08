<?php
	session_start();
	include_once ("mysql_connect.php");
	function get_new_reply($user_id,$status_id,$target_id,$content,$con){
	/*	$usr_id=_SESSION['username'];
		$status_id=$_POST['status_id'];
		$object_user_name=$_POST['object_user_name'];
		$content=$_POST['content'];*/
		$sql1="SELECT reply_id FROM status_reply ORDER BY time_stamp  DESC LIMIT 1";
		$result1 = mysqli_query($con,$sql1);
		$row1 = mysqli_fetch_array($result1);
		//return $row1['reply_id'];
		$new_reply_id = $row1['reply_id'];
		$new_reply_id++;
		//return $new_reply_id;
		//return $user_id;
		//return $status_id;
		//return $object_name;
		//mysql_query("set names 'gbk'");
		$content=iconv('UTF-8','gb2312//IGNORE',$content);
		//return $content;
		
		$sql2="INSERT INTO status_reply (user_id,status_id,object_user_id,content,flag) VALUES ('$user_id','$status_id','$target_id','$content','1')";
		//return $user_id;
		//return $sql2;
		mysqli_query($con,$sql2);
		return 1;
		}
		echo $_POST['status_id'];
		$status_id=$_POST['status_id'];
		$object_name=$_POST['object_name'];
		$content=$_POST['content'];
		$res=get_new_reply('20033',"$status_id","$object_name","$content",$con);
		echo $res;	
?>