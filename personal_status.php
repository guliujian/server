<?php
	//session_start();
	function personal_status(){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test",$con);
		//$_SESSION['userId']=1;//暂时给userId赋值给1，实际上登录时即可赋值
		$user_id=$_SESSION['userId'];
		//return $con;
		$unread_id=$_SESSION['unread_id'];
		mysql_query("set names 'gbk'");
		//测试时将user_id赋值为1，实际中要用到全局变量SESSION['userId'] y
		$sql = "SELECT * FROM status WHERE status_id<$unread_id AND user_id='$user_id' ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result = mysql_query($sql,$con);
		//echo $result;
		if(mysql_num_rows($result)>0){
		//return $result;
		$friends_status_rows="";
		$i=0;
		$j=0;
		while($row=mysql_fetch_array($result))
		{
			$sql1 = "SELECT portrait FROM user WHERE user_id=".$row['user_id']."";
			$sql2 = "SELECT * FROM status_reply WHERE status_id=".$row['status_id']."";
			$sql_name = "SELECT user_name FROM user WHERE user_id=".$row['user_id']."";
			$name=mysql_fetch_array(mysql_query($sql_name,$con));
			$result1 = mysql_query($sql1,$con);
			$result2 = mysql_query($sql2,$con);
			$res1=mysql_fetch_array($result1);
			//$usr_id=$row2['name_id'];
			$friends_status_rows[$i]['Head']=$res1['portrait'];		
			$friends_status_rows[$i]['Name']=iconv('gb2312//IGNORE','UTF-8',$name['user_name']);
			$friends_status_rows[$i]['Entry_id']=$row['status_id'];
			$friends_status_rows[$i]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			$friends_status_rows[$i]['IMG']=$row['picture'];
			while($row2=mysql_fetch_array($result2)){
				$sql_portrait = "SELECT portrait FROM user WHERE user_id=".$row2['user_id']."";
				$port=mysql_fetch_array(mysql_query($sql_portrait,$con));
				$sql_name1 = "SELECT user_name FROM user WHERE user_id=".$row2['user_id']."";
				$port=mysql_fetch_array(mysql_query($sql_portrait,$con));
				$name1=mysql_fetch_array(mysql_query($sql_name1,$con));
				$friends_status_rows[$i][$j]['Head']=$port['portrait'];
				$friends_status_rows[$i][$j]['Name']=iconv('gb2312//IGNORE','UTF-8',$name1['user_name']);
				$friends_status_rows[$i][$j]['Reply_id']=$row2['status_id'];
				$friends_status_rows[$i][$j]['Target_Id']=iconv('gb2312//IGNORE','UTF-8',$row2['object_user_id']);
				$friends_status_rows[$i][$j]['Content']=iconv('gb2312//IGNORE','UTF-8',$row2['content']);
				$friends_status_rows[$i][$j]['IMG']=$row2['picture'];
				//return $row2['flag'];
				/*$reply_id=$row2['reply_id'];
				if($row2['flag']=='1'){
					//return $reply_id;
					$sql_change_flag="UPDATE status_reply SET flag='0' WHERE reply_id=$reply_id";
					mysql_query($sql_change_flag);
				}*/
				$j++;
				}
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
			return $friends_status_rows;
	}
	else{
		return 1;//表示没有新消息
	}
	}
	
?>