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
echo $email $password;
$sql="selct * from admin where email='$email'";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
echo $rs['password'];
if($password=$rs['password']){
//    return true;
    echo "<script type='text/javascript'>alert('登陆成功');location='./admin/admin-form.html';</script>";
}else{
//    return false;
    echo "<script type='text/javascript'>alert('密码错误');location='./admin/index.html';</script>";
}