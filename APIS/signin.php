<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=0.7">
    <link rel="stylesheet" href="style.css">
    <style>
        .signin-pannel-doctor{
            box-shadow:10px 12px 12px 0px rgba(0,0,0,0.5);
            position:absolute;
            top:50%;
            left:30%;
            transform:translate(-50%);
            background-color:black;
            opacity:0.7;
            width:250px;
            height:auto;
            text-align:center;
            color:rgb(62, 180, 47);
            
        }
        .signin-pannel-doctor div{
            margin-top:7px;
            font-family:sans-serif;
        }
        .signin-pannel-patient{
            box-shadow:10px 12px 12px 0px rgba(0,0,0,0.5);
            position:absolute;
            top:50%;
            left:70%;
            transform:translate(-50%);
            background-color:black;
            opacity:0.7;
            width:250px;
            height:auto;
            text-align:center;
            color:rgb(62, 180, 47);
            
        }
        .signin-pannel-patient div{
            margin-top:7px;
            font-family:sans-serif;
        }
    </style>
</head>
<body>

<div class="sticky">
<div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><img src="aboutme.png" width="70px" height="70px"><br>About me</a></div>
            <div class="active"><a href="#"><img src="signin.png" width="70px" height="70px"><br>Signin</a></div>
            <div id="nav1"><a href="index.php"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
</div>
</div>
    <form method="post">
    <div class="signin-pannel-doctor">
        <div style="margin:0;font-size:20px;height:20px;background-color:red;"><font color="white">Doctor</font></div>
        <div><img src="doctor.png" width="150px" height="150px"></div>
        <div>E-MAIL ID</div>
        <div><input type="email" name="email_doctor"></div>
        <div>PASSWORD</div>
        <div><input type="password" name="password_doctor"></div>
        <div><button class="mystyle_button" name="signin_doctor_button">SIGNIN</button></div>
        <div><a href="doctor_signup.php" style="color:white;text-decoration:none">Register</a></div>
    </div>
    <div class="signin-pannel-patient">
        <div style="margin:0;font-size:20px;height:20px;background-color:red;"><font color="white">Patient</font></div>
        <div><img src="patient.png" width="150px" height="150px"></div>
        <div>E-MAIL ID</div>
        <div><input type="email" name="email"></div>
        <div>PASSWORD</div>
        <div class="button_"><input type="password" name="password"></div>
        <div><button class="mystyle_button" name="signin_button">SIGNIN</button></div>
        <div><a href="signup.php" style="color:white;text-decoration:none">Register</a></div>
        
    </div>
    </form>
</body>
</html>

<?php  
    include "db_connection.php";
    session_start();
    //patient signin
    if(isset($_POST['signin_button']))
    {
       
        $sql_stmt=$db_conn->prepare("SELECT email_id,user_name,img_url,blood_group FROM user WHERE email_id=? AND password=?");
        $sql_stmt->bind_param("ss",$mail_id,$password);
        $mail_id=$_POST['email'];
        $password=$_POST['password'];
        $sql_stmt->execute();
        $sql_stmt->store_result();
        $sql_stmt->bind_result($mail_id,$user_name,$image_url,$blood_group);
        $result=$sql_stmt->fetch();
        if($result)
        {
            /*
            $result=$db_conn->query($sql_stmt);
            $row=$result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['user_name']=$row['user_name'];
            header('location:home.php');
            */
            /*echo "Signin success!";
            echo "E-mail:".$mail_id."<br>UserName=".$user_name."<br>IMG_URL=".$image_url;*/
            $_SESSION['user_name']=$user_name;
            $_SESSION['image_url']=$image_url;
            $_SESSION['mail_id']=$mail_id;
            $_SESSION['blood_group']=$blood_group;
            header("location:home.php");
        }
        else{
            echo "<script>window.alert('Signin ERROR!Invalid username or password');</script>";
        }
        $sql_stmt->free_result();
        $sql_stmt->close();
    }
//doctor signin
    if(isset($_POST['signin_doctor_button']))
    {
        

        $sql_stmt=$db_conn->prepare("SELECT name,email,profilepic_url FROM doctor WHERE email=? AND password=?");
        $sql_stmt->bind_param('ss',$email,$password);
        $email=$_POST['email_doctor'];
        $password=$_POST['password_doctor'];
        $sql_stmt->execute();
        
        $sql_stmt->bind_result($name,$email_doctor,$profile_pic);
        $result=$sql_stmt->fetch();
       
        if($result)
        {
            echo "Query is executed!";
            $_SESSION['name']=$name;
            $_SESSION['profile_pic']=$profile_pic;
            $_SESSION['email']=$email_doctor;
            header('location:doctor_home.php');
            
        }
        else{
            echo "Query is not executed!";
            echo "<script>window.alert('Signin ERROR!Invalid username or password');</script>";
            echo $name.$email.$profile_pic;
        }
        $sql_stmt->free_result();
        $sql_stmt->close();
        
    }

?>