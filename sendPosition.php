<?php
session_start();
$userId = $_SESSION['userId'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$con = mysql_connect("localhost","root","");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("test",$con);
$sql="UPDATE user SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = $userId";//�����û�����λ��
//echo $sql;
$result=mysql_query($sql);
if($result==FALSE){
	echo -1;//�����ˡ�
}
else{
	echo 0;//��ȷ
}
$sql="INSERT INTO user_location (user_id,latitude,longitude) VALUES ('$userId','$latitude','$longitude')";
//�����¼�û�λ�õı�
$result=mysql_query($sql);
if($result==FALSE){
	echo -1;//�����ˡ�
}
else{
	echo 0;//��ȷ
}
?>