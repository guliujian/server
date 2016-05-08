<?php
session_start();
include_once ("mysql_connect.php");
//$_SESSION['userId']= 1;
$userId = $_SESSION['userId'];
//查找好友的信息
$sql = "SELECT user.* FROM user,friends WHERE ((friends.user_id1=$userId AND friends.user_id2=user.user_id) OR (friends.user_id2=$userId AND friends.user_id1=user.user_id) )";
		$result = mysqli_query($sql,$con);

	$i=0;
	while($row=mysqli_fetch_array($result))
	{
		$friends_info_rows[$i]['Longitude']=$row['longitude'];
		$friends_info_rows[$i]['Latitude']=$row['latitude'];
		$friends_info_rows[$i]['Head']="http://localhost/register8.24/";
		$friends_info_rows[$i]['Head'].=$row['portrait'];		
		$friends_info_rows[$i]['Id']=$row['user_id'];	
		$friends_info_rows[$i++]['Name']=$row['user_name'];
		
	}
	mysqli_close($con);
	//var_dump($a);
	echo json_encode($friends_info_rows);	
