<?php
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta enctype="utf-8">
    <meta name="viewport" content="device=width-device, initial-scale=0.7">
    <link rel="stylesheet" href="style.css">
    <style>
       /* ul{
            background-color: rgb(107, 16, 16);
            list-style:none;
            overflow:hidden;
            margin:0;
            padding:0;
        }
        ul li{
            float:left;
        }
        ul li a{
            display:block;
            padding:10px;
            color:white;
            text-decoration:none;
            font-family:cursive;
        }
        ul li:hover{
            background-color: brown;
        }
        */
       /* .website_title{
            background-color: rgb(107, 16, 16);
            text-align:center;
            box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
        }
        */
        
        .note{
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%);
            width:520px;
            height:350px;
            background-color:gray;
            color:white;
            font-size:18px;
            box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
           
        }
        .note_sub{
            box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
            text-align:center;
            background-color:rgb(77, 70, 70);
            animation-name:note;
            animation-iteration-count:1;
            animation-duration:3s;
            width:100%;
            color:white;
            font-family:cursive;
            font-size:20px;
            border-radius:50%;
        }
       
        @keyframes note{
            50%{
                width:50px;
            }
        }
        .hospital_signin_pannel{
                position:absolute;
                top:30%;
                right:20px;
                text-align:center;
                box-shadow:0px 12px 12px 0px;
                height:200px;
            }
        .hospital_signin_pannel div{
            margin-top:5px;
            color:white;
            font-size:20px;
        }
        </style>
</head>
<body>
<!--<div class="website_title">
        <div style="font-family:cursive;color:white;font-size:40px;">Patient Information System</div>
</div>-->
            
            <div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><img src="aboutme.png" width="70px" height="70px"><br>About me</a></div>
            <div id="nav1"><a href="signin.php"><img src="signin.png" width="70px" height="70px"><br>Signin</a></div>
            <div class="active"><a href="#"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
            
        </div>
        <!--<ul>
            <li><a href="#">Home</a></li>
            <li style="float:right"><a href="#">About</a></li>
            <li style="float:right"><a href="#">Signin</a></li>
        </ul> -->
       <form method="post">
       <div class="hospital_signin_pannel">
            <div>Hospital Signin</div>
            <div>E-mail</div>
            <div><input type="email" name="mail" /></div>
            <div>Password</div>
            <div><input type="password" name="password" /></div>
            <div><button name="signin">Signin</button><button name="signup">Signup</button></div>
        </div>
       </form>
        <div class="note">
            <div class="note_sub">Note:</div>
            <div style="margin-top:15px;font-family:sans-serif">Such as just go to site and click a signup after it will be ask to enter an individual’s details like name , phone number, age, weight ,date of birth , blood group , address etc. Same time doctors and hospitals also registers in this site and after login enter patient details. In this, details are get immediately after when a patient result is done. If a person need blood group like B+ve notification will sent only to who is registered B+ve. So , avoid everyone to get notification. If any person sent notification for need blood that notification is expires one day. so, the person who sent notification must update that everyday. so, avoid fake news. Once the donor donate the blood it will automatically not use the donor detail for next three months. Message is erased after patient received blood. We are protecting patient information.</div>
        </div>
    
        
</body>
</html>

<?php

    include "db_connection.php";
    session_start();
    if(isset($_POST['signin']))
    {
        $sql_stmt=$db_conn->prepare("SELECT hospital_name,pic FROM hospital WHERE mail=? AND password=? ");
        $sql_stmt->bind_param('ss',$mail,$password);
        $mail=$_POST['mail'];
        $password=$_POST['password'];
        if($sql_stmt->execute())
        {
            $sql_stmt->store_result();
            $sql_stmt->bind_result($hospital_name,$pic);
            $sql_stmt->fetch();
            $_SESSION['hospital_name']=$hospital_name;
            $_SESSION['pic']=$pic;
            header('location:hospital_home.php');
        }
        else
        {
            echo "<script>window.alert('ERROR!')</script>";
        }

    }
    if(isset($_POST['signup']))
    {
        header('location:hospital_register.php');
    }
    ob_end_flush();
?>