<?php
//点击加载时调用该函数，然后调用ponsernal_status
	include "personal_status.php";	
	session_start();
	$res=personal_status();
	if($res==1)
	{
		echo 1;//没有新消息
	}else{
		echo json_encode($res);
	}
