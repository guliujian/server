<?php
//点击加载时调用该函数，然后调用ponsernal_status
	session_start();
	include "jingdian_evaluate.php";
		$res=get_jingdian_evaluation($_POST['id_name']);
		echo json_encode($res);
