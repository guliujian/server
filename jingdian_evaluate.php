<?php
	include_once ("mysql_connect.php");
	function get_jingdian_evaluation($id_name){
	/*	$usr_id=_SESSION['username'];
		$status_id=$_POST['status_id'];
		$object_user_name=$_POST['object_user_name'];
		$content=$_POST['content'];*/
		
		$unread_id=$_SESSION['unread_evaluate_id'];
		$sql1="SELECT * FROM jingdian_evaluate WHERE id_name='$id_name' AND evaluate_id<'$unread_id' ORDER BY time_stamp  DESC LIMIT 3";
		$result1 = mysqli_query($con,$sql1);
		if (mysql_num_rows($result1)>1){
			$i=0;
			$jingdian_evaluate="";
			while($row1 = mysqli_fetch_array($result1)){
				$id=$row1['evaluator_id'];
				//$jingdian_evaluate[$i]['evaluator_id']=$row1['evaluator_id'];
				//iconv('gb2312//IGNORE','UTF-8',$row1['evaluator_name']);
				//$name=$row1['evaluator_name'];
				//echo $name;
				//echo $jingdian_evaluate[$i]['evaluator_name'];
				$sql2="SELECT * FROM user WHERE user_id='$id'";
				$result2=mysqli_query($con,$sql2);
				$row2=mysqli_fetch_array($result2);
				$jingdian_evaluate[$i]['evaluate_id']=$row1['evaluate_id'];
				$jingdian_evaluate[$i]['portrait']=$row2['portrait'];
				$jingdian_evaluate[$i]['evaluator_name']=$row2['user_name'];
				$jingdian_evaluate[$i]['content']==$row1['content'];
				$jingdian_evaluate[$i]['star']=$row1['star'];
				$_SESSION['unread_evaluate_id']=$row1['evaluate_id'];
				$i++;
			} 
			//return $row1['reply_id'];
			//$new_reply_id = $row1['reply_id'];
			//$new_reply_id++;
			//return $new_reply_id;
			//return $user_id;
			//return $status_id;
			//return $object_name;
			//mysql_query("set names 'gbk'");
			//$content=iconv('UTF-8','gb2312//IGNORE',$content);
			//return $content;
			
			//$sql2="INSERT INTO status_reply (user_id,status_id,object_user_name,content,flag) VALUES ('$user_id','$status_id','$object_name','$content','1')";
			//return $user_id;
			//return $sql2;
			//mysql_query($sql2,$con);
			//$_SESSION['unread_evaluate_id']++;
			return $jingdian_evaluate;
			}
			else{
				return 1;
			}
		}
