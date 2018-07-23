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
            .patient_details{
                font-family:sans-serif;
                font-size:20px;
                color:white;
                text-align:center;
                background-color:brown;
                position:absolute;
                width:450px;
                height:auto;
                top:50%;
                left:50%;
                transform:translate(-50%);
            }
            .patient_details .sub{
                background-color:rgb(214, 37, 37);
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.2);
            }
            .patient_details #my_style_title{
                background-color:rgb(194, 24, 24);
                box-shadow:0px 12px 10px 0px rgba(0,0,0,0.5);
                margin-top:10px;
            }
            .patient_details #my_style_content{
                margin-top:10px;

            }
        </style>
    </head>
    <body>
    <form method="post" enctype="multipart/form-data">
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
    <div class="patient_details">
    <div class="sub">Patient Details</div>
    <div id="my_style_title">Clinic Name</div>
    <div id="my_style_content"><input type="text" name="clinic_name" style="width:230px;"/></div>
    <div id="my_style_title">Name</div>
    <div id="my_style_content"><?php echo $_SESSION['patient_name']; ?></div>
    <div id="my_style_title">Age</div>
    <div id="my_style_content"><?php echo $_SESSION['age']; ?></div>
    <div id="my_style_title">blood_group</div>
    <div id="my_style_content"><?php echo $_SESSION['blood_group']; ?></div>
    <div id="my_style_title">Disease</div>
    <div id="my_style_content"><textarea name="description" rows="12" cols="40"></textarea></div>
    <div id="my_style_title">Tablets</div>
    <div id="my_style_content"><textarea name="tablets" cols="40" rows="12"></textarea></div>
    <div id="my_style_title">Files</div>
    <div id="my_style_content"><input type="file" name="filepatient"></div>
    <div><button name="update">Update</button>
    </div>
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
     ob_end_flush();

     if(isset($_POST['update']))
     {
         $mail=$_SESSION['mailid'];
         $sql_stmt=$db_conn->prepare("UPDATE user SET description=?,tablets=?,file=? WHERE email_id='$mail'");
         $sql_stmt->bind_param('sss',$disease,$tablets,$file);
         $disease=$_POST['description'];
         $tablets=$_POST['tablets'];
         $file="\APIS\Patient_file\pic".$_FILES['filepatient']['name'];
        if($sql_stmt->execute())
        {
            $stmt=$db_conn->prepare("INSERT INTO patient_logs(doctor_name,clinic_name,date_log,file,disease,tablets,email,date) VALUES(?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssss',$docotor_name,$clinic_name,$date_log,$file,$disease,$tablets,$email,$date);
            $docotor_name=$_SESSION['name'];
            $clinic_name=$_POST['clinic_name'];
            $date_log=date("l dS \of F Y h:i:s A");
            $date=date("Y-m-d");
            $file="\APIS\Patient_file\pic".$_FILES['filepatient']['name'];
            $disease=$_POST['description'];
            $tablets=$_POST['tablets'];
            $email=$_SESSION['email'];
            if($stmt->execute())
            {
            echo "<script>window.alert('code execute!');</script>";
            }
            else
            {
                echo "<script>window.alert('Code1 is not execute!');</script>";
            }
            $destination="C:/xampp/htdocs/APIS/Patient_file/pic".$_FILES['filepatient']['name'];
            if(move_uploaded_file($_FILES['filepatient']['tmp_name'],$destination))
            {
                echo "<script>window.alert('img uploaded!');</script>";
            }
        }
        else
        {
            echo "<script>window.alert('Code is not execute!');</script>";
        }
     }

    ?>