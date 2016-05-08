<?php
	//session_start();
	function jingdian_status(){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test",$con);
		//$_SESSION['userId']=1;//暂时给userId赋值给1，实际上登录时即可赋值
		//$user_id=$_SESSION['userId'];
		//return $con;
		$unread_id=$_SESSION['unread_id'];
		//return $unread_id;
		mysql_query("set names 'gbk'");
		//测试时将user_id赋值为1，实际中要用到全局变量SESSION['userId'] y
		$sql = "SELECT * FROM jingdian_status WHERE status_id<$unread_id AND jingqu_id=1 ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		//echo $sql;
		$result = mysql_query($sql,$con);
		//echo $result;
		
		//return $result;
		$friends_status_rows="";
		$i=0;
		$j=0;
		while($row=mysql_fetch_array($result))
		{
			$sql1 = "SELECT portrait FROM jingdian_inf WHERE jingdian_id=".$row['jingdian_id']."";
			//$sql2 = "SELECT * FROM status_reply WHERE status_id=".$row['status_id']."";
			$sql_name = "SELECT jingdian_name FROM jingdian_inf WHERE jingdian_id=".$row['jingdian_id']."";
			$name1=mysql_query($sql_name,$con);
			$name=mysql_fetch_array($name1);
			$result1 = mysql_query($sql1,$con);
			//$result2 = mysql_query($sql2,$con);
			$res1=mysql_fetch_array($result1);
			//$usr_id=$row2['name_id'];
			$friends_status_rows[$i]['Head']=$res1['portrait'];		
			$friends_status_rows[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$name['jingdian_name']);
			//echo $friends_status_rows[$i]['Name'];
			$friends_status_rows[$i]['Entry_id']=$row['status_id'];
			$friends_status_rows[$i]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			//echo $row['content'];
			//$friends_status_rows[$i]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);//iconv('gb2312//IGNORE','UTF-8',$row['content']);
			//echo $row['content'];
			//echo $friends_status_rows[$i]['Content'];
			$friends_status_rows[$i]['IMG']=$row['picture'];
			$i++;
		}
			//return $i;
			$i--;
			//$down_id+=1;
			$entryId= $friends_status_rows[$i]['Entry_id'];
			//return $entryId;
			$_SESSION['unread_id']=$entryId;
			//return $_SESSION['unread_id'];
			$sql_set_back_id="UPDATE unread_entry SET entry_id='$entryId' WHERE user_id_receive=20022";//更新unread_entry数据库，当前的状态id替换进去()_直接在session中设置一个变量来实现(此处假设该用户的id为20022，以后用要输入)
			$set=mysql_query($sql_set_back_id,$con);
			mysql_close($con);
		if($i==-1)
		{
			return 0;
		}
			return $friends_status_rows;
	}
	
?>