<?php
session_start();
	$picname = $_FILES['file']['name'];
	$type = strstr($picname, '.');
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
		$pic_path = "portrait/". $pics;
		move_uploaded_file($_FILES['file']['tmp_name'], $pic_path);
	$_SESSION['pic']="http://127.0.0.1/server/portrait/";
	$_SESSION['pic'].=$pics;
		echo $pics;
