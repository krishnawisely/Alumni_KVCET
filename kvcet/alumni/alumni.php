<!DOCTYPE html>
<html>
        <head>
        <mata name="viewport" content="width=device-width,initial-scale=0.6">
        <link rel="stylesheet" href="/kvcet/nav-style.css">
        <style>
            .signin-pannel{
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%,-50%);
                background-image:linear-gradient(black,darkgray);
                box-shadow:0px 10px 10px 0px rgba(0,0,0,0.5);
                text-align:center;
                font-size:20px;
                font-family:sans-serif;
                color:white;
                width:250px;
            }
            .signin-pannel .my_style{
                margin-top:10px;
                
               
            }
            .signin-pannel button{
                color:darkblue;
                padding:10px;
                border-radius:50%;
                font-size:20px;
            }    
            .signin-pannel a{
                text-decoration:none;
                color:white;
                font-family:sans-serif;
            }
            .header{
               margin-top:0;
               background-color:rgb(19, 78, 241);
               box-shadow:0px 5px 10px 0px rgba(0,0,0,0.5);
            }
            
        </style>
        </head>
        <body>
        <div class="nav-header"><div id="nav-header-name">KARPAGAVINAYAGA COLLAGE OF ENGINEERING AND TECHNOLOGY</div>
        <div class="nav-menu">
            <div><a href="/kvcet/index.html">Home</a></div>
            <div><a href="#" style="background-color:rgb(53, 49, 49);">Alumni</a></div>
            <div><a href="#">Departments</a>
            <div class="sub-nav">
              
                <div><a href="#">CSE</a></div>
                <div><a href="#">ECE</a></div>
                <div><a href="#">EEE</a></div>
                <div><a href="#">MECH</a></div>
                <div><a href="#">CIVIL</a></div>
                <div><a href="#">BIOTECH</a></div>
           
            </div>
            </div>
            <div><a href="#">Contact us</a></div>
        </div>
    </div>
    <form method="post">
    
    <div class="signin-pannel">
        <div class="header">Student Login</div>
        <div class="my_style"><img src="/kvcet/user.png" width="100px" height="100px"></div>
        <div class="my_style">E-mail</div>
        <div class="my_style"><input type="email" name="email"></div>
        <div class="my_style">Password</div>
        <div class="my_style"><input type="password" name="password"></div>
        <div class="my_style"><button name="ok">Login</button></div>
        <div class="my_style"><a href="register.php">Register Here</a></div>
    </div>
    </form>
        </body>
</html>
<?php
    include "connection.php";
    if(isset($_POST['ok']))
    {
        session_start();
        $sql_stmt=$db_conn->prepare("SELECT id,user_name,profile_pic,email,password FROM user WHERE email=? AND password=?");
        $sql_stmt->bind_param('ss',$email,$password);
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql_stmt->execute();
        $sql_stmt->bind_result($id,$user,$img_url,$email,$user_password);
        if($sql_stmt->fetch())
        {
            $_SESSION['user']=$user;
            $_SESSION['img_url']=$img_url;
            $_SESSION['email']=$email;
            $_SESSION['password']=$user_password;
            $_SESSION['id']=$id;
            header('location:home.php');
            echo "<script>window.alert('Executed!');</script>";
        
        }else{
            echo "<script>window.alert('Not Executed!');</script>";
        }
        
    }

?>