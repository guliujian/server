<?php
//点击加载时调用该函数，然后调用ponsernal_status
	include "jingdian_new_things.php";	
	session_start();
		$res=jingdian_status();
		echo json_encode($res);
