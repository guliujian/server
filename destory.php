<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 16/5/11
 * Time: 15:17
 */
session_start();
if($_POST['data']==1){
    session_destroy();
    echo 0;
}