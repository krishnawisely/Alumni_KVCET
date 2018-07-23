<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=0.7">
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style>
        .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
            }
            .log_date{
                position:absolute;
                top:40%;
                color:orange;
                font-family:sans-serif;
                font-size:20px;
                left:50%;
                transform:translate(-50%);
            }
            .search_button{
                background-color:orange;
                border-color:orange;
                color:white;
                font-family:sans-serif;
                font-size:15px;
            }
            .log_head{
                background-color:rgb(99, 98, 98);
                box-shadow:0px 12px 12px 0px rgba(0,0,0,0.3);
                margin-top:10px;
                color:white;
                font-size:18px;
                font-family:sans-serif;
            }
            .log_content{
                margin-top:10px;
                color:white;
                font-size:18px;
                font-family:sans-serif;
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
    
    <div>
    <div class="log_date">From<input type="date" name="from_date" />To<input type="date" name="to_date" /><input class="search_button" type="submit" name="search_log" value="search"/></div>
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
    if(isset($_POST['search_log']))
    {
    $sql_stmt=$db_conn->prepare("SELECT doctor_name,clinic_name,date_log,file,disease,tablets,email FROM patient_logs WHERE date BETWEEN ? AND ? ");
    $sql_stmt->bind_param('ss',$from_date,$to_date);
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];
    if($sql_stmt->execute())
    {
        echo "Query executed!";
    }
    else
    {
        echo "Query is not executed!";
    }
    $sql_stmt->store_result();
    $sql_stmt->bind_result($doctor_name,$clinic_name,$date_log,$file,$disease,$tablet,$email);
    //echo "<table style='position:absolute;top:50%;'>";
    echo "<div style='position:absolute;top:50%;left:50%;transform:translate(-50%);text-align:center;'>";
    while($sql_stmt->fetch())
    {
        //echo "<tr><th>DOCTOR NEME</th><th>DATE</th></tr>";
        //echo "<tr><td>".$doctor_name."</td><td>".$date_log."</td></tr>";
        echo "<div style='box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);width:380px;'>";
        echo "<div style='background-color:brown;color:white;font-size:20px;'>$date_log</div>";
        echo "<div class='log_head' style='margin-top:0px;'>DOCTOR NAME</div>";
        echo "<div class='log_content'>$doctor_name</div>";
        echo "<div class='log_head'>CLINIC NAME</div>"; 
        echo "<div class='log_content'>$clinic_name</div>";
        echo "<div class='log_head'>FILE</div>";
        echo "<div class='log_content'><a href=".$file." download><img src='download.gif' width='100px' height='100px'></a></div>";
        echo "<div class='log_head'>DISEASE</div>";
        echo "<div class='log_content'>".$disease."</div>";
        echo "<div class='log_head'>TABLETS</div>";
        echo "<div class='log_content'>".$tablet."</div>";
        echo "</div><br>";
    }
    echo "</div>";
    //echo "</table>";
    }
?>