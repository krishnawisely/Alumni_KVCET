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
<meta charset="utf-8">
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
            .blood_request_table{
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%);
            }
            .blood_request_table th{
                font-size:20px;
                text-align:center;
                background-color:blue;
                color:white;
                font-family:sans-serif;
                width:200px;
                height:auto;
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
            }
            .blood_request_table td{
                font-size:20px;
                color:orange;
                text-align:center;
                margin-top:10px;
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
                font-family:sans-serif;
                height:70px;
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
            <a href="home.php"><div id="nav1"><img src="home.png" width="70px" height="70px"><br>Home</div></a>
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

    $sql_stmt=$db_conn->prepare("SELECT blood_group,contact_no,address,date_blood,time_blood,status FROM blood_request WHERE blood_group=?");
    $sql_stmt->bind_param('s',$_SESSION['blood_group']);
    $sql_stmt->execute();
    $sql_stmt->bind_result($blood_group,$contact,$address,$date_blood,$time_blood,$status);
    if($sql_stmt)
    {
        echo "<table class='blood_request_table'>";
        echo "<tr><th>Blood Group</th><th>Contact No</th><th>Address</th><th>Date</th><th>Time</th><th>Status</th></tr>";
        echo "<script>window.alert('I am executed!');</script>";
        while($sql_stmt->fetch())
        {
        echo "<tr><td>$blood_group</td><td>$contact</td><td>$address</td><td>$date_blood</td><td>$time_blood</td><td>$status</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<script>window.alert('I am not executed!');</script>";
    }
    
    $query_stmt=$db_conn->prepare("SELECT pvcno FROM user WHERE email_id=?");
    $query_stmt->bind_param('s',$mail);
    $mail=$_SESSION['mail_id'];
    $query_stmt->execute();
    $query_stmt->store_result();
    $query_stmt->bind_result($pvcno);
    if($query_stmt->fetch())
    {
        if($pvcno != 0)
        {
        echo "<div id='pvc_block' style='background-color:brown;position:absolute;width:200px;height:80px;color:white;font-size:20px;text-align:center;top:30%;left:50%;transform:translate(-50%)'>";
        echo "<div style='background-color:rgb(83, 80, 80)'>PVCNO</div>";
        echo "<div id='pvcno'>$pvcno</div>";
        echo "</div>";
       // echo "<script>window.alert('PVCNO':$pvcno);</script>";
        }
    }
    else
    {
        echo "<script>window.alert('PVCNO ERROR!');</script>";
    }
    
?>