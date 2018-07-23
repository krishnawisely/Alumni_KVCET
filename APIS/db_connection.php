<?php

    $host_name="localhost";
    $user_name="root";
    $password="";
    $db_name="apis";

    $db_conn=mysqli_connect($host_name,$user_name,$password,$db_name) or die("connection error@".connect_error());

?>