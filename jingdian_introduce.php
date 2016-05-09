<?php
	session_start();
	include_once ("mysql_connect.php");
	function jingdian_introduce($id_name){
		$sql="SELECT * FROM jingdian_inf WHERE id_name='$id_name'";
		$res=mysqli_query($con,$sql);
		//echo $res;
		$i=0;
		$jingdian_info="";
		$jingdian_id="";
		while($row=mysqli_fetch_array($res)){
			//echo $row['jingdian_name'];
			$jingdian_id=$row['jingdian_id'];
			$jingdian_info['jingdian_id']=$row['jingdian_id'];
			$jingdian_info['jingdian_name']=$row['jingdian_name'];
			//echo $jingdian_name['jingdian_name'];
			$jingdian_info['jingdian_portrait']=$row['portrait'];
			//echo $row['portrait'];
			$jingdian_info['jingdian_piciture']=$row['introduce_picture'];			
			$jingdian_info['jingdian_content']=$row['jingdian_introduce'];
		}
		$sql = "SELECT * FROM jingdian_status WHERE jingdian_id='$jingdian_id' ORDER BY time_stamp  DESC LIMIT 5";//select 6 entry everty time
		//echo $sql;
		$result = mysqli_query($con,$sql);
		//echo $result;
		//return $result;
		while($row=mysqli_fetch_array($result))
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
		
