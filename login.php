<?php
		session_start();
		function login($l_name,$l_password){
		$con = mysql_connect("localhost","root","");
		if (!$con)
		 {
		  die('Could not connect: ' . mysql_error());
		 }

		mysql_select_db("test",$con);
		mysql_query("set names 'gbk'");
		$l_name=iconv('UTF-8','gb2312//IGNORE',$l_name);
		$sql_reg="SELECT * FROM user WHERE user_name='$l_name'";//ѡ������Ϊ����ֵ��һ����¼

		$result1=mysql_query($sql_reg);
		$password="";
		$usr_id="";
		while($rs=mysql_fetch_array($result1)){//���ü�¼�е������id���ó���

			$password=$rs['password'];
			$usr_id=$rs['user_id'];
		}
			if($password==""){//�������Ϊ��˵�����ݿ��в�����������û���������-1
				return "-1";
			}
			else 
			//echo($rs['password']);
			if($password==$l_password){//������������������룬˵����½�ɹ�������0������������id�Ÿ�ֵ��ȫ�ֱ���
			
				$_SESSION['userName']=$l_name;
				$_SESSION['userId']=$usr_id;
				return "0";
			}
			else{//ʣ�µ������Ϊ�������������ݿ����벻�������˷���1��˵�������������
			//echo $result1;
				return "1";
			}
		
	}
	$username=$_POST['username'];
	$result=login($username,$_POST['password']);
	//����result�Ĳ�ͬ����ֵ�����ص�ǰ̨��ͬ��ֵ
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

?>