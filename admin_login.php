<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 16/5/16
 * Time: 01:20
 */
require_once ("mysql_connect.php");
$email=$_POST['email'];
$password=$_POST['password'];
$sql="selct * from admin where email='$email'";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
if($password=$rs['password']){
//    return true;
    echo "<script type='text/javascript'>alert('登陆成功');location='admin.php';</script>";
}else{
//    return false;
    echo "<script type='text/javascript'>alert('密码错误');location='index.html';</script>";
}