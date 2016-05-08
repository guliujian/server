<?php
	session_start();
	function jingdian_introduce($id_name){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		//echo $id_name;
		mysql_select_db("test",$con);
		mysql_query("set names 'gbk'");
		
			$sql="SELECT * FROM jingdian_inf WHERE id_name='$id_name'";
		$res=mysql_query($sql,$con);
		//echo $res;
		$i=0;
		$jingdian_info="";
		$jingdian_id="";
		while($row=mysql_fetch_array($res)){
			//echo $row['jingdian_name'];
			$jingdian_id=$row['jingdian_id'];
			$jingdian_info['jingdian_id']=$row['jingdian_id'];
			$jingdian_info['jingdian_name']=iconv('gb2312//IGNORE','UTF-8',$row['jingdian_name']);
			//echo $jingdian_name['jingdian_name'];
			$jingdian_info['jingdian_portrait']=$row['portrait'];
			//echo $row['portrait'];
			$jingdian_info['jingdian_piciture']=$row['introduce_picture'];			
			$jingdian_info['jingdian_content']=iconv('gb2312//IGNORE','UTF-8',$row['jingdian_introduce']);	
			
		}
		
		
		
		$sql = "SELECT * FROM jingdian_status WHERE jingdian_id='$jingdian_id' ORDER BY time_stamp  DESC LIMIT 5";//select 6 entry everty time
		//echo $sql;
		$result = mysql_query($sql,$con);
		//echo $result;
		
		//return $result;
		while($row=mysql_fetch_array($result))
		{
			//sql1 = "SELECT portrait FROM jingdian_inf WHERE jingdian_id=".$row['jingdian_id']."";
			//$sql2 = "SELECT * FROM status_reply WHERE status_id=".$row['status_id']."";
			//$sql_name = "SELECT jingdian_name FROM jingdian_inf WHERE jingdian_id=".$row['jingdian_id']."";
			//$name1=mysql_query($sql_name,$con);
			//$name=mysql_fetch_array($name1);
			//$result1 = mysql_query($sql1,$con);
			//$result2 = mysql_query($sql2,$con);
			//$res1=mysql_fetch_array($result1);
			//$usr_id=$row2['name_id'];
			//$jingdian_info['Head']=$res1['portrait'];		
			//$jingdian_info['Name']=iconv('gb2312//IGNORE','UTF-8',$name['jingdian_name']);
			//echo $friends_status_rows[$i]['Name'];
		//	$jingdian_info[$i]['Entry_id']=$row['status_id'];
			$jingdian_info['new_things'][$i]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);
			//echo $row['content'];
			//$friends_status_rows[$i]['Content']=iconv('gb2312//IGNORE','UTF-8',$row['content']);//iconv('gb2312//IGNORE','UTF-8',$row['content']);
			//echo $row['content'];
			//echo $friends_status_rows[$i]['Content'];
			$jingdian_info['new_things'][$i]['IMG']=$row['picture'];
			$i++;
		}
		
		
		
		
	
			return $jingdian_info;
		}
		
	
		$id_name=$_POST['id_name'];
		$result=jingdian_introduce($id_name);
		//echo $id_name;
		
		echo json_encode($result);
		
?>