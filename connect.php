<?php
//connect to database

    $server="localhost";
    $db_username="root";
    $db_password="root";
    $db_name="project"; //数据库名字
    $con=mysqli_connect($server, $db_username, $db_password, $db_name);
    if(!$con)
    {
    	die("can't connect".mysqli_error());
    }
    
?>