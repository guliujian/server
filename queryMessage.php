<?php
	session_start();
	//echo "lanxiang";
	//$_SESSION['unreadNewsId']=0;
	//$_SESSION['userId']=1;
	$userId=$_SESSION['userId'];
	if(!isset($_SESSION['onlineTime']))
		$_SESSION['onlineTime'] = date('Y-m-d H:i:s',time());
	$mysqltime=$_SESSION['onlineTime'];
	$con = mysql_connect("localhost","root","");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("test",$con);
	mysql_query("set names 'gbk'");
	$sql="SELECT * FROM status,friends,user WHERE ((friends.user_id1='$userId' AND friends.user_id2=status.user_id) OR (friends.user_id2='$userId' AND friends.user_id1=status.user_id)) AND user.user_id = status.user_id AND UNIX_TIMESTAMP( time_stamp ) >= UNIX_TIMESTAMP ('$mysqltime')";
	if(isset($_SESSION['unreadNewsId'])){
	$maxReadId=$_SESSION['unreadNewsId'];
	$sql.= "AND status.status_id>'$maxReadId'";
	}
	//��sql�������û���¼֮�������û����ѷ�������Ϣ
	
	//echo $sql;
	
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{	
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$friends_news[$i]['Longitude']=$row['longitude'];
			$friends_news[$i]['Latitude']=$row['latitude'];
			$friends_news[$i]['Head']="http://192.168.1.101/server/portrait/";
			$friends_news[$i]['Head'].=$row['portrait'];		
			$friends_news[$i]['Id']=$row['user_id'];	
			$friends_news[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
			$friends_news[$i]['Picture']=$row['picture'];
			$friends_news[$i++]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			$_SESSION['unreadNewsId']=$row['status_id'];
		}
		
		echo json_encode($friends_news);
	}
	else{
		echo '1';//��ʾû�е�ͼ��û������Ϣ��
	}
	?>