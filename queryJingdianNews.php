<?php
	session_start();
	require_once ("mysql_connect.php");
	//echo "lanxiang";
	//$_SESSION['unreadJingdianNewsId']=0;
	//$jingdianId = $_POST['jingdianId'];
	//$_SESSION['userId']=1;
	$userId=$_SESSION['userId'];
	//$mysqltime = date('Y-m-d H:i:s',time());
	//$_SESSION['onlineTime'] = date('Y-m-d H:i:s',time());
	if(!isset($_SESSION['onlineTime']))
		$_SESSION['onlineTime'] = date('Y-m-d H:i:s',time());
	$mysqltime=$_SESSION['onlineTime'];
	//$sql="SELECT jingdian_inf.*,jingdian_status.*,eyeon.* FROM jingdian_inf,jingdian_status, eyeon WHERE eyeon.jingdian_id=jingdian_inf.jingdian_id AND eyeon.user_id = '$userId' AND UNIX_TIMESTAMP( time_stamp ) <= UNIX_TIMESTAMP ('$mysqltime')";
	$sql="SELECT jingdian_inf.*,jingdian_status.*,eyeon.* FROM jingdian_inf,jingdian_status, eyeon WHERE eyeon.jingdian_id=jingdian_inf.jingdian_id AND eyeon.jingdian_id=jingdian_status.jingdian_id AND eyeon.user_id = '$userId' AND UNIX_TIMESTAMP( time_stamp ) > UNIX_TIMESTAMP ('$mysqltime')";
	//echo $sql;
	if(isset($_SESSION['unreadJingdianNewsId'])){
	$maxReadId=$_SESSION['unreadJingdianNewsId'];
	$sql.= " AND jingdian_status.status_id>'$maxReadId'";
	}
	//该sql语句查找用户登录之后，所有景点发布的消息
	
	//echo $sql;
	
	$result=mysqli_query($con,$sql);
	if(mysql_num_rows($result)>0)
	{	
		$i=0;
		while($row=mysqli_fetch_array($result))
		{
			$jingdian_news[$i]['Id']=$row['jingdian_id'];
			$jingdian_news[$i]['Head']=$row['portrait'];
			$jingdian_news[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['jingdian_name']);
			$jingdian_news[$i]['Picture']=$row['picture'];
			$jingdian_news[$i]['IdName']=$row['id_name'];
			$jingdian_news[$i++]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			$_SESSION['unreadJingdianNewsId']=$row['status_id'];
		}
		
		echo json_encode($jingdian_news);
	}
	
	else{
		echo '1';//表示没有地图上没有新消息。
	}
