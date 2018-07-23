<?php

   
    $host_name="localhost";
    $user_name="root";
    $password="";
    $db_name="alumni";

    $db_conn=mysqli_connect($host_name,$user_name,$password,$db_name) OR die("Connection Error!");
   

    if($db_conn)
    {
        //echo "connection success!";
    }
    else
    {
        echo "<script>window.alert('connection error!');</script>";    
    }
    
?>