<?php
	function remind(){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test",$con);
		//获得之前读到的状态id
		$sql = "SELECT * FROM status_reply WHERE object_user_name=1";//选择出回复对象是该用户的flag字段，从而得知是否有未查看的回复
		$result = mysql_query($sql,$con);
		$flag=0;
		$entry_id="";
		while($row=mysql_fetch_array($result)){
			if($row['flag']=="1"){
				$flag=1;
				return 1;
			}
		}
		if($flag==0){
			return 0;
		}
	
}
	
	$result=remind();
	echo json_encode($result);
?>