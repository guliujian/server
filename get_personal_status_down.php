<?php
//�������ʱ���øú�����Ȼ�����ponsernal_status
	include "personal_status.php";	
	session_start();
	$res=personal_status();
	if($res==1)
	{
		echo 1;//û������Ϣ
	}else{
		echo json_encode($res);
	}
