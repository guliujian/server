<?php
	//session_start();
	include "status_down.php";
	
	/*$con = mysql_connect("localhost","root","");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("test",$con);
	$sql = "SELECT entry_id FROM unread_entry WHERE $_SESSIOM['user_id']";
	$result = mysql_query($sql,$con);
	$entry_id="";
	while($row=mysql_fetch_array($result)){
		$entry_id=$row['entry_id']; 
	}*/
	$res=status_down();//从status_id数据库中拿出之前显示到的状态的id以及用户的id传入函数中，以便继续向下显示
	//echo $res;
	echo json_encode($res);
?>