<?php
		session_start();
		include_once ("mysql_connect.php");
		function login($l_name,$l_password,$con){
//		$l_name=iconv('UTF-8','gb2312//IGNORE',$l_name);
		$sql_reg="SELECT * FROM user WHERE user_name='$l_name'";//选择姓名为输入值的一条记录
		$result1=mysqli_query($con,$sql_reg);
		$password="";
		$usr_id="";
		while($rs=mysqli_fetch_array($result1)){//将该记录中的密码和id号拿出来
			$password=$rs['password'];
			$usr_id=$rs['user_id'];
		}
			if($password==""){//如果密码为空说明数据库中不存在输入的用户名，返回-1
				return "-1";
			}
			else 
			//echo($rs['password']);
			if($password==$l_password){//如果密码等于输入的密码，说明登陆成功，返回0，并将密码与id号赋值到全局变量
				$_SESSION['userName']=$l_name;
				$_SESSION['userId']=$usr_id;
				return "0";
			}
			else{//剩下的情况即为输入密码与数据库密码不相符，因此返回1，说明输入密码错误
			//echo $result1;
				return "1";
			}
		
	}
//	$username=$_POST['username'];
    $username=$_POST['username'];
	$result=login($username,$_POST['password'],$con);
	//根据result的不同返回值，返回到前台不同的值
	if($result=="-1"){
		echo -1;
	}
	else if($result=="0")
	{
		echo 0;
	}
	else{
		echo 1;
	}
