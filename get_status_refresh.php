<?php
	include "status.php";
	$res=status();
	//echo $res;
	echo json_encode($res);
