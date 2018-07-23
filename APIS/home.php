<?php
session_start();
if(!$_SESSION['user_name'])
{
    header('location:signin.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" href="style.css">
        <style>
            .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
            }
            .horizontal-pannel div{
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
                margin-top:25%;
                margin-left:7%;
                width:300px;
                height:130px;
                background-color:rgb(180, 133, 47);
                color:white;
                float:left;
                text-align:center;
                font-size:20px;
            }
            .horizontal-pannel  div a{
                display:block;
                text-decoration:none;
                color:white;
            }
            .sub-nav{
                background-color:brown;
                position:absolute;
                top:25%;
                left:86%;
                
            }
            .sub-nav a{
                text-decoration:none;
            }
            .sub-nav div{
                text-align:center;
                width:212px;
                font-size:20px;
                color:white;
                font-family:sans-serif;
                margin-top:18px;
                
            }
            .sub-nav .sub-nav1:hover{
                background-color:rgb(196, 55, 55);
                box-shadow:0px 12px 10px 0px rgba(0,0,0,0.5);
            }
            
        </style>
    </head>
    <body>
        <form method="post">
    <div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><button class="signout_button" name="signout"><img src="signout.png" width="70px" height="70px"><br>Signout</button></a></div>
            <a><div id="nav1"><img style="border-radius:50%" src="<?php  
                            
                            echo $_SESSION['image_url'];
                            ?>"       
                width="70px" height="70px"><br>
                <?php
                echo $_SESSION['user_name'];
            ?>
            </div></a>
            <a href="#"><div id="nav1" class="active"><img src="home.png" width="70px" height="70px"><br>Home</div></a>
    </div>
        
        <div class="sub-nav">
        <center><div style="background-color:inherit;width:100px;"><img style="border-radius:50%" src="<?php  
                            
                            echo $_SESSION['image_url'];
                            ?>"       
                width="70px" height="70px">
        
        <br>
                <?php
                echo $_SESSION['user_name'];
            ?>
            
            </div></center>
            <a href="notification.php"><div class="sub-nav1"><img src="Bell-icon.png" width="50px" height="50px" border="4px" style="border-radius:50%;border-color:white;"><br>Notification</div></a>
            <a href="patient_update.php"><div class="sub-nav1"><img src="update.gif" width="50px" height="50px" ><br>Update</div></a>
            <a href="#"><div class="sub-nav1"><button name="signout" style="width:200px;background-color:inherit;border:none;color:white;font-size:20px"><img src="signout.png" width="70px" height="70px" ><br>Signout</button></div></a>
            <a href="patient_logs.php"><div class="sub-nav1"><img src="Bell-icon.png" width="50px" height="50px" border="4px" style="border-radius:50%;border-color:white;"><br>My Logs</div></a>
        </div>
        <div class="horizontal-pannel">
        <div><a href="patient_details.php"><img src="patient.png" width="120px" height="100px"><br>Patient Discription</a></div>
        <div><a href="blood_request.php"><img src="blood_drop.png" width="120px" height="100px"><br>Blood Request</a></div>
        <div><a href="emergency.php"><img src="emergency.png" width="120px" height="100px"><br>Emergency Register</a></div>
        </div>
        <div style="position:absolute;top:80%;left:50%;transform:translate(-50%);background-color:rgb(180, 133, 47);width:300px;height:130px;text-align:center">
            <div><a href="Doctor_appoinment.php" style="text-decoration:none;font-size:20px;color:white"><img src="doctor.png" width="120px" height="100px"><br>Appointment</a></div>
        </div>
        
        </form>
    </body>
    </html>
    <?php

        if(isset($_POST['signout']))
        {
            header('location:signin.php');
            session_destroy();
        }
        
    ?>