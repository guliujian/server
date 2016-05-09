<?php
session_start();
require_once ("mysql_connect.php");
//$_SESSION['userId']= 1;
$userId = $_SESSION['userId'];
	$sql = "select user.*,tempRelation.status from user,tempRelation where tempRelation.user_id2=user.user_id and tempRelation.user_id1='$userId' and tempRelation.status in ('3','2')";
	//echo $sql;
	$result = mysqli_query($con,$sql);
	$i=0;
	while($row=mysqli_fetch_array($result))
	{
		$strange_info_rows[$i]['Longitude']=$row['longitude'];
		$strange_info_rows[$i]['Latitude']=$row['latitude'];
		$strange_info_rows[$i]['Head']="http://localhost/register8.24/";
		$strange_info_rows[$i]['Head'].=$row['portrait'];		
		$strange_info_rows[$i]['Id']=$row['user_id'];
		if($row['status']==2)
			$strange_info_rows[$i]['status']=1;//用户的请求被接受
		else
			$strange_info_rows[$i]['status']=0;//用户的请求被拒绝
		$strange_info_rows[$i++]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
	}
	$sql = "DELETE FROM tempRelation WHERE user_id1='$userId' and status in ('3','2')";
	mysqli_query($con,$sql);
	mysqli_close($con);
	//var_dump($a);
	if(isset($strange_info_rows)){
		echo json_encode($strange_info_rows);	
	}
	else{
		echo "";
	}
