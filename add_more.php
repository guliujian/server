<?php
//�������ʱ���øú�����Ȼ�����ponsernal_status
	session_start();
	include "jingdian_evaluate.php";
		$res=get_jingdian_evaluation($_POST['id_name']);
		echo json_encode($res);
