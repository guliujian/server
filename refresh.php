<?php
//����ҵ���ҳʱ���ã���unread_reply��ֵΪ��󣬼�ȫ��δ��
	session_start();
	include "jingdian_evaluate.php";
	
	//echo $_POST['id_name'];
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test",$con);
		//$_SESSION['userId']=1;//��ʱ��userId��ֵ��1��ʵ���ϵ�¼ʱ���ɸ�ֵ
		//$user_id=$_SESSION['userId'];
		//return $con;
		//����ʱ��user_id��ֵΪ1��ʵ����Ҫ�õ�ȫ�ֱ���SESSION['userId'] y
		$sql = "SELECT evaluate_id FROM jingdian_evaluate WHERE jingdian_id=2 ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result = mysql_query($sql,$con);
		$unread_id=mysql_fetch_array($result);		
		$_SESSION['unread_evaluate_id']=$unread_id['evaluate_id'];
		$_SESSION['unread_evaluate_id']++;
		mysql_close($con);
		//echo $_SESSION['unread_id'];
		//echo $_POST;
		$id_name=$_POST['id_name'];
		$res=get_jingdian_evaluation($id_name);
		//echo json_encode($_SESSION['unread_id']);
		
		echo json_encode($res);
?>