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
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="style.css">
        <style>
            .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
            }
           .result_button{
               position:absolute;
               top:50%;
           }
           .user_details{
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%);
                width:350px;
                text-align:center;
                font-size:20px;
                font-family:sans-serif;
                color:white;      
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);       
           }
           .user_details div{
                margin-top:10px;
           }
           .user_details .title{
                background-color:rgb(117, 117, 106);
           }
           .download_button{
               text-decoration:none;
               
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
                            
                            echo $_SESSION['image_url'];
                            ?>"       
                width="70px" height="70px"><br>
                <?php
                echo $_SESSION['user_name'];
            ?></a>
            </div>
            <div id="nav1"><a href="home.php"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
            
            
    </div>
    
        </form>
       
    </body>
    </html>
    <?php
    if($_SESSION['mail_id'])
    {
    include "db_connection.php";
        
        $sql_stmt=$db_conn->prepare("SELECT user_name,user_dob,age,blood_group,weight,description,tablets,file FROM user WHERE email_id=?");
        $sql_stmt->bind_param('s',$email);
        $email=$_SESSION['mail_id'];
        $sql_stmt->execute();
        $sql_stmt->store_result();
        $sql_stmt->bind_result($name,$dob,$age,$blood_group,$weight,$description,$tablets,$file);
        $sql_stmt->fetch();
        echo "<form method=\"post\">";
        if($sql_stmt)
        {
            echo "<div class=\"user_details\"><div class=\"title\">NAME</div><div>$name</div><div class=\"title\">DOB</div><div>$dob</div><div class=\"title\">AGE</div><div>$age</div><div class=\"title\">BLOOD_GROUP</div><div>$blood_group</div><div class=\"title\">WEIGHT</div><div>$weight</div><div class=\"title\">DESCRIPTION</div><div>$description</div><div class=\"title\">TABLETS</div><div>$tablets</div><div class=\"title\">FILES</div><div><a class=\"download_button\" href=".$file." download><img src=\"/APIS/download.gif\" width=\"100px\" height=\"100px\"></a></div></div>";
        }
        echo "</form>";
    }
        if(isset($_POST['signout']))
        {
            header('location:signin.php');
            session_destroy();
        }
    ?>