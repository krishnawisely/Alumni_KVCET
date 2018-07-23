<?php
  
   session_start();
   if(!$_SESSION['user_name'])
   {
       header('location:sigin.php');
   }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
    .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
            }
            .patient_update_pannel{
                color:white;
                font-size:18px;
                font-family:sans-serif;
                text-align:center;
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%);
                background-color:brown;
            }
            .patient_update_pannel div{
                margin-top:8px;
            }
    </style>
</head>
<body>
<form method="post" enctype="multipart/form-data">
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
            <a href="home.php"><div id="nav1" class="active"><img src="home.png" width="70px" height="70px"><br>Home</div></a>
    </div>
    <div class="patient_update_pannel">
        <div>NAME</div>
        <div><input type="text" name="user_name" /></div>
        <div>PROFILEPIC</div>
        <div><input type="file" name="pic" /></div>
        <div>AGE</div>
        <div><input type="text" name="age" /></div>
        <div>DOB</div>
        <div><input type="date" name="dob" /></div>
        <!--<div>PASSWORD</div>
        <div><input type="text" name="password" /></div>-->
        <div><button name="update">UPDATE</button></div>
        </div>
    </form>
</body>
</html>

<?php
    include "db_connection.php";
    if(isset($_POST['signout']))
    {
        header('location:signin.php');
    }
    if(isset($_POST['update']))
    {
        $sql_stmt=$db_conn->prepare("UPDATE user SET user_name=?, img_url=?, age=?, user_dob=? WHERE email_id=? ");
        $sql_stmt->bind_param('ssiss',$user_name,$pic_url,$age,$dob,$email_id);
        $user_name=$_POST['user_name'];
        $age=$_POST['age'];
        $dob=$_POST['dob'];
        $email_id=$_SESSION['mail_id'];
        $pic_url="\APIS\profilepic\patient".$_FILES['pic']['name'];
        $result=$sql_stmt->execute();

        if($result)
        {
            $destination_pic="C:/xampp/htdocs/APIS/profilepic/patient".$_FILES['pic']['name'];
            if(move_uploaded_file($_FILES['pic']['tmp_name'],$destination_pic))
            {
                echo "<script>window.alert('Hi image is uploaded!!')</script>";
            }
            else
            {
                echo "<script>window.alert('Hi image is not uploaded!!')</script>";
            }
            echo "<script>window.alert('Hi i am executed!')</script>";
        }
        else
        {
            echo "<script>window.alert('Hi i am executed!')</script>";
        }
    }
?>