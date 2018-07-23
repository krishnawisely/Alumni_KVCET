<?php
    ob_start();
    session_start();
    if(!$_SESSION['hospital_name'])
    {
        header('location:index.php');
    }
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
        .signout_button{
    background-color:inherit;
    border:none;
    color:white;
    font-family:cursive;
    font-size:16px;
}
        </style>
</head>
<body>
<!--<div class="website_title">
        <div style="font-family:cursive;color:white;font-size:40px;">Patient Information System</div>
</div>-->
            
<form method="post">
    <div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><button class="signout_button" name="signout"><img src="signout.png" width="70px" height="70px"><br>Signout</button></a></div>
            <a><div id="nav1"><img style="border-radius:50%" src="<?php  
                            
                            echo $_SESSION['pic'];
                            ?>"       
                width="70px" height="70px"><br>
                <?php
                echo $_SESSION['hospital_name'];
            ?>
            </div></a>
            <a href="hospital_home"><div id="nav1"><img src="home.png" width="70px" height="70px"><br>Home</div></a>
    </div>
    
        </form>
        <!--<ul>
            <li><a href="#">Home</a></li>
            <li style="float:right"><a href="#">About</a></li>
            <li style="float:right"><a href="#">Signin</a></li>
        </ul> -->
        <table style="position:absolute;top:50%;">
        <tr><th>Branch</th><th>Date</th><th>Time</th><th>Hospital mail</th><th>Patient mail</th><th>Edit</th></tr>
      <div style="position:absolute;top:50%;">
                <?php
                    include "db_connection.php";

                    $sql_stmt=$db_conn->prepare("SELECT branch,date,time,Hospital_name,patient_mail FROM doctor_appointment");
                    $sql_stmt->execute();
                    $sql_stmt->store_result();
                    $sql_stmt->bind_result($branch,$date,$time,$hospital_name,$patient_mail);
                    while($sql_stmt->fetch())
                    {
                        echo "<tr><td>$branch</td><td>$date</td><td>$time</td><td>$hospital_name</td><td>$patient_mail</td><td></td></tr>";
                    }
                ?>
            
      </div>
    </table>
        
</body>
</html>
<?php
    if(isset($_POST['signout']))
    {
        header('location:index.php');
        session_destroy();
    }
?>