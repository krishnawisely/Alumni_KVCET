<?php
session_start();
ob_start();
if(!$_SESSION['name'])
{
    header('location:signin.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width,initial-scale=0.7">
        <link rel="stylesheet" href="style.css">
        <style>
            .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
                display:block;
            }
            .search_pannel{
                position:absolute;
                top:0;
                color:white;
                font-family:sans-serif;
                font-size:20px;
                text-align:center;
                background-color:rgb(48, 206, 48);
                width:300px;
                height:70px;
                top:50%;
                left:50%;
                border-radius:10px;
                box-shadow:0px 12px 10px 0px rgba(0,0,0,0.5);
                transform:translate(-50%);
                opacity:1;
                animation-name:search_pannel;
                animation-iteration-count:1;
                animation-duration:4s;
                
            }
            @keyframes search_pannel{
                10%{
                    opacity:0;
                }
                100%{
                    opacity:0.7;
                }
            }
            .pvc{
                position:absolute;
                display:none;
                top:0;
                color:white;
                font-family:sans-serif;
                font-size:20px;
                text-align:center;
                background-color:rgb(48, 206, 48);
                width:300px;
                height:70px;
                top:50%;
                left:50%;
                border-radius:10px;
                box-shadow:0px 12px 10px 0px rgba(0,0,0,0.5);
                transform:translate(-50%);
                opacity:1;
                animation-name:search_pannel;
                animation-iteration-count:1;
                animation-duration:4s;
                
            }
           
            .mystyle_table{
                position:absolute;
                opacity:0.8;
                text-align:center;
                top:70%;
                left:50%;
                transform:translate(-50%);
                width:50%;
                font-size:20px;
                font-family:sans-serif;
            }
            .mystyle_table th{
                background-color:blue;
                color:white;
                box-shadow:0px 10px 10px 0px rgba(0,0,0,0.3);
                
            }
            .mystyle_table td{
                color:white;
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
            }
            .mystyle_button1{
                border:none;
                color:white;
                height:20px;
                background-color:rgb(48, 128, 33);
            }
            .input_search{
                height:20px;
            }
           /*.pvc_generate{
                position:absolute;
                display:none;
                top:50%;
           }*/
        </style>
    </head>
    <body>
        <form method="post">
    <div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><button class="signout_button" name="signout"><img src="signout.png" width="70px" height="70px"><br>Signout</button></a></div>
            <div id="nav1"><a><img style="border-radius:50%" src="<?php  
                            
                            echo $_SESSION['profile_pic'];
                            ?>"       
                width="70px" height="70px"><br>
                <?php
                echo $_SESSION['name'];
            ?></a>
            </div>
            <div id="nav1"><a href="doctor_home.php"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
    </div>
    <center>
    <div id="search" class="search_pannel">
           <div>E-mail or UserName</div>
           <div><input class="input_search" type="text" name="user" style="border:none;border-radius:10px"><button class="mystyle_button1" name="search" style="border-radius:10px">Search</button></div>
    </div>
  
   
    <div id="pvc" class="pvc">
           <div>Enter PVC code(OTP)</div>
           <div><input type="text" name="pvccode" style="border:none;border-radius:10px" class="input_search"><button class="mystyle_button1" name="pvcbutton" style="border-radius:10px">Ok</button></div>
    </div>
    <!--<div id="pvc_generate" class="pvc_generate"><button name="pvc_generate" onclick="document.getElementById('pvc').style.display='block';">Generate PVC number</button></div>-->
    </center>
    </form>
       
    </body>
    </html>
    <?php
        include "db_connection.php";
        if(isset($_POST['signout']))
        {
            header('location:signin.php');
            session_destroy();
        }
       

        if(isset($_POST['search']))
        {
           
            $sql_stmt=$db_conn->prepare("SELECT email_id,user_name,img_url FROM user WHERE email_id=? OR user_name=?");
            $sql_stmt->bind_param('ss',$user,$user);
            $user=$_POST['user'];
            $sql_stmt->execute();
            $sql_stmt->store_result();
            $sql_stmt->bind_result($mail,$name,$imgurl);
            $result=$sql_stmt->fetch();
            if($result){
                $query=$db_conn->prepare("UPDATE user SET pvcno=? WHERE email_id=?");
                $query->bind_param('ss',$pvcno,$email);
                $pvcno=rand(0,1000000);
                $email=$mail;
                $query->execute();
                echo "<table class=\"mystyle_table\"><tr><th>Profilepic</th><th>UserName</th><th>E-mail_id</th><th>Edit</th></tr>";
                echo "<tr><td><img src=".$imgurl." width=\"100px\" height=\"100px\" style=\"border-radius:10%;\"></td><td>".$name."</td><td>".$mail."</td><td><button onclick=\"document.getElementById('pvc').style.display='block';document.getElementById('search').style.display='none';\" class=\"pvc_button\">Edit</button></td></tr></table>";
            }
            else
            {
                echo "<script>window.alert('No user found!');</script>";
            }
        
    
          $sql_stmt->free_result();
          $sql_stmt->close();
        }
        
        
        /*if(isset($_POST['edit']))
        {
            echo "<script>
            
                fonction myclick(){
                    pvc.style.display='block';
                }
            
            </script>";
        }
        */
    ?>
    <?php

if(isset($_POST['pvcbutton']))
{
    $sql_stmt=$db_conn->prepare("SELECT user_name,age,blood_group,email_id FROM user WHERE pvcno=?");
    $sql_stmt->bind_param('s',$pvcno);
    $pvcno=$_POST['pvccode'];
    $sql_stmt->execute();
    $sql_stmt->store_result();
    $sql_stmt->bind_result($name,$age,$blood_group,$mail);
    $result=$sql_stmt->fetch();
    if($result)
    {
        $query=$db_conn->prepare("UPDATE user SET pvcno=? WHERE email_id='$mail'");
        $query->bind_param('s',$pvcno);
        $pvcno=""; 
        $query->execute();
        $_SESSION['patient_name']=$name;
        $_SESSION['age']=$age;
        $_SESSION['blood_group']=$blood_group;
        $_SESSION['mailid']=$mail;
        header("location:patient_doctor_edit.php");
    }
    else
    {
        echo "<script>window.alert('Invalid PVCNO!');</script>";
    }
    $sql_stmt->free_result();
    $sql_stmt->close();
   ob_end_flush();

}

    ?>