<?php
	session_start();
	//$totalMessage = array();
	function NotFriend($id,$totalMessage){
		if($totalMessage['friendInfoInMap']=="")
		return true;
		else{
			for($i=0;$i<count($totalMessage['friendInfoInMap']);$i++){
				if($totalMessage['friendInfoInMap'][$i]['Id']==$id)
				return false;
			}
		}
		return true;
	}
	$_SESSION['userId']= 1;
	$userId = $_SESSION['userId'];
	//$_SESSION['unreadNewsId']=0;//δ������״̬
	//$_SESSION['unreadJingdianNewsId']=0;//δ��������Ϣ
	$con = mysql_connect("localhost","root","");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_query("set names 'gbk'");
	mysql_select_db("test",$con);
	
	//���Һ��ѵ���Ϣ
	$sql = "SELECT user.* FROM user,friends WHERE ((friends.user_id1=$userId AND friends.user_id2=user.user_id) OR (friends.user_id2=$userId AND friends.user_id1=user.user_id) )";
	$result = mysql_query($sql,$con);
	if(mysql_num_rows($result)>0){
	$i=0;
	while($row=mysql_fetch_array($result))
	{
		$friends_info_rows[$i]['Longitude']=$row['longitude'];
		$friends_info_rows[$i]['Latitude']=$row['latitude'];
		//$friends_info_rows[$i]['Head']="http://localhost/register8.24/";
		$friends_info_rows[$i]['Head']="";
		$friends_info_rows[$i]['Head'].=$row['portrait'];		
		$friends_info_rows[$i]['Id']=$row['user_id'];
		$friends_info_rows[$i++]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
		
	}
	$totalMessage['friendInfoInMap'] = $friends_info_rows;
	}else{
		$totalMessage['friendInfoInMap'] = "";
	}
	//����¿�ѵ���Ϣ
	$sql = "SELECT user.* FROM user WHERE user_id!='$userId'";
	$result = mysql_query($sql,$con);
	if(mysql_num_rows($result)>0){
	$i=0;
	while($row=mysql_fetch_array($result))
	{
		if(NotFriend($row['user_id'],$totalMessage)){
		$strange_info_rows[$i]['Longitude']=$row['longitude'];
		$strange_info_rows[$i]['Latitude']=$row['latitude'];
		//$strange_info_rows[$i]['Head']="http://localhost/register8.24/";
		$strange_info_rows[$i]['Head']="";
		$strange_info_rows[$i]['Head'].=$row['portrait'];		
		$strange_info_rows[$i]['Id']=$row['user_id'];	
		$strange_info_rows[$i++]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
		}
	}
	$totalMessage['strangeInfoInMap'] = $strange_info_rows;
	}
	else{
		$totalMessage['strangeInfoInMap'] = "";
	}
	//��ѯ��״̬
	if(!isset($_SESSION['onlineTime']))
	$_SESSION['onlineTime'] = date('Y-m-d H:i:s',time());
	$mysqltime=$_SESSION['onlineTime'];
	$sql="SELECT * FROM status,friends,user WHERE ((friends.user_id1='$userId' AND friends.user_id2=status.user_id) OR (friends.user_id2='$userId' AND friends.user_id1=status.user_id)) AND user.user_id = status.user_id AND UNIX_TIMESTAMP( time_stamp ) > UNIX_TIMESTAMP ('$mysqltime')";//Ӧ��������֮�������ô��ںţ����������С�ں�
	if(isset($_SESSION['unreadNewsId'])){
		$maxReadId=$_SESSION['unreadNewsId'];
		$sql.= "AND status.status_id>'$maxReadId'";
	}
	//��sql�������û���¼֮�������û����ѷ�������Ϣ
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{	
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$friends_news[$i]['Longitude']=$row['longitude'];
			$friends_news[$i]['Latitude']=$row['latitude'];
			//$friends_news[$i]['Head']="http://192.168.1.101/server/portrait/";
			$friends_news[$i]['Head']="";
			$friends_news[$i]['Head'].=$row['portrait'];		
			$friends_news[$i]['Id']=$row['user_id'];
			$friends_news[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
			$friends_news[$i]['Picture']=$row['picture'];
			$friends_news[$i++]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			$_SESSION['unreadNewsId']=$row['status_id'];
		}		
		$totalMessage['friendNews'] = $friends_news;
	}
	else{
		$totalMessage['friendNews']="";//��ʾû������Ϣ
	}
	//��ѯ�Ƿ��������������Ϊ����
	$sql = "SELECT * FROM tempRelation WHERE user_id2='$userId' and status = 0";//�����Ƿ��������������Ϊ����
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
			$strange_request_rows[$i]['Longitude']=$row['longitude'];
			$strange_request_rows[$i]['Latitude']=$row['latitude'];
			//$strange_request_rows[$i]['Head']="http://localhost/register8.24/";
			$strange_request_rows[$i]['Head']="";
			$strange_request_rows[$i]['Head'].=$row['portrait'];		
			$strange_request_rows[$i]['Id']=$row['user_id'];	
			$strange_request_rows[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['user_name']);
		}
		$totalMessage['strangeRequestInfo'] = $strange_request_rows;
		$sql = "UPDATE tempRelation SET status='1' WHERE user_id2 = '$userId'";//���������״̬��1����Ŀ�귽��ȡ
		$result = mysql_query($sql,$con);		
	}
	else{
		$totalMessage['strangeRequestInfo'] ="";//��ʾû�������������Ϊ���ѡ�
	}
	$sql="SELECT jingdian_inf.*,jingdian_status.*,eyeon.* FROM jingdian_inf,jingdian_status, eyeon WHERE eyeon.jingdian_id=jingdian_inf.jingdian_id AND eyeon.jingdian_id=jingdian_status.jingdian_id AND eyeon.user_id = '$userId' AND UNIX_TIMESTAMP( time_stamp ) > UNIX_TIMESTAMP ('$mysqltime')";//Ӧ��������֮�������ô��ںţ����������С�ں�
	if(isset($_SESSION['unreadJingdianNewsId'])){
		$maxReadId=$_SESSION['unreadJingdianNewsId'];
		$sql.= " AND jingdian_status.status_id>'$maxReadId'";
	}
	//��sql�������û���¼֮�����о��㷢������Ϣ
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{	
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$jingdian_news[$i]['Id']=$row['jingdian_id'];
			$jingdian_news[$i]['Head']=$row['portrait'];
			$jingdian_news[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$row['jingdian_name']);
			$jingdian_news[$i]['Picture']=$row['picture'];
			$jingdian_news[$i]['IdName']=$row['id_name'];
			$jingdian_news[$i++]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			$_SESSION['unreadJingdianNewsId']=$row['status_id'];
		}
		$totalMessage['JdNews'] = $jingdian_news;
	}	
	else{
		$totalMessage['JdNews']="";//��ʾû�е�ͼ��û������Ϣ��
	}
	echo json_encode($totalMessage);
	//�����ǲ����û�����λ�õ����ģ�飬����ʱ��ʱ���á�
	/* 
	$longitude = $_POST['longitude'];
	$latitude = $_POST['latitude'];
	$sql="UPDATE user SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = $userId";//�����û�����λ��
	$result=mysql_query($sql);	
	$sql="INSERT INTO user_location (user_id,latitude,longitude) VALUES ('$userId','$latitude','$longitude')";
	//�����¼�û�λ�õı�
	$result=mysql_query($sql);
	*/
	mysql_close($con);
?>

