<?php
session_start();
	$picname = $_FILES['file']['name'];
	$type = strstr($picname, '.');
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
		$pic_path = "photo/". $pics;
		move_uploaded_file($_FILES['file']['tmp_name'], $pic_path);
	$_SESSION['photo']="http://192.168.1.101/server/photo/";
	$_SESSION['photo'].=$pics;
		echo $pics;
?>