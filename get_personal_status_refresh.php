<?php
//����ҵ���ҳʱ���ã���unread_reply��ֵΪ��󣬼�ȫ��δ��
	include_once ("mysql_connect.php");
	include "personal_status.php";
	session_start();
		//$_SESSION['userId'];//��ʱ��userId��ֵ��1��ʵ���ϵ�¼ʱ���ɸ�ֵ
		$user_id=$_SESSION['userId'];
		//return $con;
		//����ʱ��user_id��ֵΪ1��ʵ����Ҫ�õ�ȫ�ֱ���SESSION['userId'] y
		$sql = "SELECT status_id FROM status WHERE user_id='$user_id' ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result = mysqli_query($con.$sql);
		if(mysqli_num_rows($result)>0){
		$unread_id=mysqli_fetch_array($result);
		$unread_id=$unread_id['status_id'];
		$unread_id++;
		//echo json_encode($unread_id);
		$_SESSION['unread_id']=$unread_id;
		
		mysqli_close($con);
		$res=personal_status();
		//echo json_encode($_SESSION['unread_id']);
		echo json_encode($res);
		}
		else{
			$_SESSION['unread_id']=-1;
			return 1;//��ʾû���¼�¼
		}
