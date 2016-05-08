<?php
session_start();
//$_SESSION['userId']= 6;
$userId = $_SESSION['userId'];
$con = mysql_connect("localhost","root","");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_query("set names 'GB2312'");
mysql_select_db("test",$con);
//查找好友的信息
$sql = "SELECT * FROM tempRelation WHERE user_id2='$userId' and status = 0";//查找是否有人请求添加我为好友
	$result = mysql_query($sql,$con);	
	if(mysql_num_rows($result)>0)
	{		
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$strangeId[$i]=$row['user_id1'];
			$i++;
		}
		for($i=0;$i<count($strangeId);$i++){
		$sql = "SELECT * FROM user WHERE user_id='$strangeId[$i]'";
		$result = mysql_query($sql,$con);
		$row=mysql_fetch_array($result);
		$strange_info_rows[$i]['Longitude']=$row['longitude'];
		$strange_info_rows[$i]['Latitude']=$row['latitude'];
		$strange_info_rows[$i]['Head']="http://localhost/register8.24/";
		$strange_info_rows[$i]['Head'].=$row['portrait'];		
		$strange_info_rows[$i]['Id']=$row['user_id'];	
		$strange_info_rows[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
		}
		echo json_encode($strange_info_rows);
		$sql = "UPDATE tempRelation SET status='1' WHERE user_id2 = '$userId'";//更新请求的状态，1代表被目标方读取
		//echo $sql;
		$result = mysql_query($sql,$con);
		if($result==FALSE)
		{
			echo "-1";//更新失败
		}
		else{
			echo "";//更新成功
		}
	}
	else{
		echo '1';//表示没有人请求添加我为好友。
	}	
	mysql_close($con);
?>