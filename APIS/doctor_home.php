<?php
session_start();
if(!$_SESSION['name'])
{
    header('location:signin.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width">
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
           .mystyle_request{
                color:white;
                background-color:brown;
                width:250px;
                height:auto;
                position:absolute;
                font-size:20px;
                top:50%;
                left:50%;
                transform:translate(-50%);
                text-align:center;
                box-shadow:10px 12px 12px 0px rgba(0,0,0,0.5);
           }
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
            <div class="active"><a href="home.php"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
    </div>
        </form>
      <a href="patient_edit.php"><div class="mystyle_request"><img src="patient.png" width="120px" height="100px"><br>Patient details</div></a>
    </body>
    </html>
    <?php

        if(isset($_POST['signout']))
        {
            header('location:signin.php');
            session_destroy();
        }
    ?>