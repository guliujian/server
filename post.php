<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 16/5/16
 * Time: 00:50
 */
require_once ("mysql_connect.php");
$title=$_POST['post_title'];
$ab=$_POST['post_ab'];
$content=$_POST['content'];
$sql="insert into post(title, ab, content) VALUES ('$title','$ab','$content')";
$result =mysqli_query($con,$sql);
if(!$result){
    echo "<script type='text/javascript'>alert('发布成功');location='./admin/admin-form.html';</script>";
}
