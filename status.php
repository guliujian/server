<?php
	session_start();
	function status(){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test",$con);
		//return $con;
		$sql = "SELECT * FROM status ORDER BY time_stamp  DESC LIMIT 1";//select 6 entry everty time
		$result = mysql_query($sql,$con);
		//echo $result;
		//return $result;
		if(mysql_num_rows($result)>0){
			$friends_status_rows="";
			$i=0;
			$j=0;
			while($row=mysql_fetch_array($result))
			{
				$sql1 = "SELECT portrait FROM user WHERE user_id=".$row['user_id'];
				$sql2 = "SELECT * FROM status_reply WHERE status_id=".$row['status_id'];
				$sql_name = "SELECT user_name FROM user WHERE user_id=".$row['user_id'];
				$name=mysql_fetch_array(mysql_query($sql_name,$con));
				$result1 = mysql_query($sql1,$con);
				$result2 = mysql_query($sql2,$con);
				$res1=mysql_fetch_array($result1);
				//$usr_id=$row2['name_id'];
				$friends_status_rows[$i]['Head']=$res1['portrait'];		
				$friends_status_rows[$i]['Name']=$name['user_name'];
				$friends_status_rows[$i]['Id']=$row['user_id'];
				$friends_status_rows[$i]['Entry_id']=$row['status_id'];
				$friends_status_rows[$i]['Content']=$row['content'];
				$friends_status_rows[$i]['IMG']=$row['picture'];
				while($row2=mysql_fetch_array($result2)){
					$sql_portrait = "SELECT portrait FROM user WHERE user_id=".$row2['user_id']."";
					$port=mysql_fetch_array(mysql_query($sql_portrait,$con));
					$sql_name1 = "SELECT user_name FROM user WHERE user_id=".$row2['user_id']."";
					$port=mysql_fetch_array(mysql_query($sql_portrait,$con));
					$name1=mysql_fetch_array(mysql_query($sql_name1,$con));
					$friends_status_rows[$i]['Reply'][$j]['Head']=$port['portrait'];
					$friends_status_rows[$i]['Reply'][$j]['Name']=$name1['user_name'];
					$friends_status_rows[$i]['Reply'][$j]['Id']=$row2['user_id'];
					$friends_status_rows[$i]['Reply'][$j]['Reply_id']=$row2['reply_id'];
					$sql_name2 = "SELECT user_name FROM user WHERE user_id=".$row2['object_user_id']."";
					$name2=mysql_fetch_array(mysql_query($sql_name2,$con));
					$friends_status_rows[$i]['Reply'][$j]['Target_Name']=$name2['user_name'];
					$friends_status_rows[$i]['Reply'][$j]['Content']=$row2['content'];
					$friends_status_rows[$i]['Reply'][$j]['IMG']=$row2['picture'];
					$j++;
					}
					$i++;
			}
				//return $i;
				//return $friends_status_rows[3]['Entry_id'];
				//return $friends_status_rows[$i]['Entry_id'];
				$i--;
				$_id=$friends_status_rows[$i]['Entry_id'] ;
				//return $i;
				//return $friends_status_rows[$i]['Entry_id'];
				$_SESSION['unread_id']=$_id;;//更新unread_entry数据库，当前的状态id替换进去()_直接在session中设置一个变量来实现
				//$set=mysql_query($sql_set_back_id,$con);
				//return $friends_status_rows[$i]['Entry_id'];
				mysql_close($con);
				return $friends_status_rows;
				}
			else {
				return 1;
				}
				
			}
	
	?>