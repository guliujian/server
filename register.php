<?php
	session_start();
    include_once("mysql_connect.php");
	function register($user_name,$password,$gender,$age,$con)
	{
		if(isset($_SESSION['pic'])){
		$pic = $_SESSION['pic'];//获取肖像信息
//		$sql_reg = "INSERT INTO user (user_name,password,gender,age,portrait) VALUES('$user_name','$password','$gender','$age','$pic')";
		//echo $sql_reg;
            $sql_reg="INSERT INTO user(user_name, passowrd, gender, age,portrait) VALUES ('$user_name','$password','$gender','$age','$pic')";
		unset($_SESSION['pic']);
		}
		else{
//		$sql_reg="INSERT INTO user (user_name,password,gender,age) VALUES('$user_name','$password','$gender','$age')";
        $sql_reg="INSERT INTO user(user_name, passowrd, gender, age) VALUES ('$user_name','$password','$gender','$age')";
        }
		//echo $sql_reg;
//		mysql_query("set names 'gbk'");
//        $sql_reg="INSERT INTO user(user_name, passowrd, gender, age) VALUES ('111','2222','333','222')";
		$result1=mysqli_query($con,$sql_reg);
		
		$_SESSION['userId']=mysqli_insert_id($con);
		$_SESSION['userName'] = $user_name;
		
//		mysqli_close($con);
		//echo $_SESSION['userId'];
		return $_SESSION['userId'];
//        return $result1;
	}
	$username=$_POST['username'];
//	$username=iconv('UTF-8','gb2312//IGNORE',$username);
	$result=register($username,$_POST['password'],$_POST['gender'],$_POST['age'],$con);//执行注册函数
//存储并设置头像
	if($result==-1){
		echo -1;//1代表出错
	}
	else
		echo 0;//成功注册！	

