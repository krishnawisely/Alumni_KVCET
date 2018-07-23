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
/* #map {
        height: 400px;
        width: 400px;
       } */
       #map {
        height: 400px;
        width: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
    /* html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      } */
      .hospital_list{
          position:absolute;
          top:70%;
          
          left:50%;
          transform:translate(-50%);
      }
      .hospital_list div{
          color:white;
          font-size:20px;
          font-family:sans-serif;
          margin-top:15px;
          width:400px;
          text-align:center;
          box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
      }
      .sub_hospital{
        background-color:rgb(124, 117, 117);
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


       
    <div style="position:absolute;top:35%;left:50%;transform:translate(-50%)">  <select name="hospitals">
                        <option>--SELECT--</option>
                        <?php

                            include "db_connection.php";
                            
                            $sql_stmt=$db_conn->prepare("SELECT hospital_name FROM hospital");
                            $sql_stmt->execute();
                            $sql_stmt->store_result();
                            $sql_stmt->bind_result($hospital_name);
                            while($sql_stmt->fetch())
                            {
                                echo "<option name='hospitals'>$hospital_name</option>";
                            }
                            $sql_stmt->free_result();
                            $sql_stmt->close();
                            $db_conn->close();
                        ?>
                        <!--<option value="Karpaga Vinayaga Medical Institute">Karpaga Vinayaga Medical Institute</option>-->
                    </select><button name="search_hospital">Search</button></div>
    </form>
</body>
<html>
<?php

    include "db_connection.php";

    if(isset($_POST['signout']))
    {
        session_destroy();
        header('location:signin.php');
    }

    
    if(isset($_POST['search_hospital']))
    {
        
        $sql_stmt=$db_conn->prepare("SELECT hospital_name,mobile_number,Angiology,Cardiology,Endocrinology,Gastroenterology,Hematology,Hepatology,Nephrology,Oncology FROM hospital WHERE hospital_name=?");
        $sql_stmt->bind_param('s',$hospital_name);
        $hospital_name=$_POST['hospitals'];
        $sql_stmt->execute();
        $sql_stmt->store_result();
        $sql_stmt->bind_result($hospital_name,$mobile_number,$Angiology,$Cardiology,$Endocrinology,$Gastroenterology,$Hematology,$Hepatology,$Nephrology,$Oncology);
        if($sql_stmt->fetch())
        {
            $_SESSION["hospitals"]=$_POST['hospitals'];
            echo "<div class='hospital_list'>
            <div class='sub_hospital'>Hospital Name</div>
            <div>$hospital_name</div>
            <div class='sub_hospital'>Contact</div>
            <div>$mobile_number</div>
            <div class='sub_hospital'>Branches</div>


            <div><img src='\APIS\disease\angiologija.jpg' width='100px' height='100px'><br>$Angiology
            <form method='post'>
            <input type='date' name='angiology_date' /><br>
            <input type='radio' name='Angiology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Angiology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Angiology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Angiology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Angiology_button'>Get Appoinment</button>
            </form></div>
            
        
            <div><img src='\APIS\disease\cardiology.jpg' width='100px' height='100px'><br>$Cardiology
            <form method='post'>
            <input type='date' name='Cardiology_date' /><br>
            <input type='radio' name='Cardiology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Cardiology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Cardiology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Cardiology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Cardiology_button'>Get Appoinment</button>
            </form></div>

            <div><img src='\APIS\disease\endocrinology.jpg' width='100px' height='100px'><br>$Endocrinology
            <form method='post'>
            <input type='date' name='Endocrinology_date' /><br>
            <input type='radio' name='Endocrinology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Endocrinology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Endocrinology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Endocrinology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Endocrinology_button'>Get Appoinment</button>
            </form></div>
            
            
            <div><img src='\APIS\disease\gastroente.jpeg' width='100px' height='100px'><br>$Gastroenterology
            <form method='post'>
            <input type='date' name='Gastroenterology_date' /><br>
            <input type='radio' name='Gastroenterology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Gastroenterology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Gastroenterology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Gastroenterology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Gastroenterology_button'>Get Appoinment</button>
            </form></div>
            
            
            <div><img src='\APIS\disease\hematology.jpg' width='100px' height='100px'><br>$Hematology
            <form method='post'>
            <input type='date' name='Hematology_date' /><br>
            <input type='radio' name='Hematology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Hematology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Hematology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Hematology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Hematology_button'>Get Appoinment</button>
            </form></div>
            
            
            <div><img src='\APIS\disease\hepatology.jpg' width='100px' height='100px'><br>$Hepatology
            <form method='post'>
            <input type='date' name='Hepatology_date' /><br>
            <input type='radio' name='Hepatology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Hepatology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Hepatology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Hepatology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Hepatology_button'>Get Appoinment</button>
            </form></div>
            
            
            <div><img src='\APIS\disease\Nephrology.jpeg' width='100px' height='100px'><br>$Nephrology
            <form method='post'>
            <input type='date' name='Nephrology_date' /><br>
            <input type='radio' name='Nephrology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Nephrology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Nephrology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Nephrology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Nephrology_button'>Get Appoinment</button>
            </form></div>
            
            
            <div><img src='\APIS\disease\oncology.jpg' width='100px' height='100px'><br>$Oncology
            <form method='post'>
            <input type='date' name='Oncology_date' /><br>
            <input type='radio' name='Oncology' value='10am-11am'>10am-11am<br>
            <input type='radio' name='Oncology' value='11am-12pm'>11am-12pm<br>
            <input type='radio' name='Oncology' value='01pm-02pm'>01pm-02pm<br>
            <input type='radio' name='Oncology' value='02pm-03pm'>02pm-03pm<br>
            <button name='Oncology_button'>Get Appoinment</button>
            </form></div>


            </div>";
        }
        else
        {
            echo "<script>window.alert('ERROR!');</script>";
        }
        $sql_stmt->free_result();
        $sql_stmt->close();
        $db_conn->close();

    }

    //Angiology

    if(isset($_POST['Angiology_button']))
        {
            /*$sql_stmt=$db_conn->prepare("SELECT * FROM doctor_appointment WHERE date=? AND time=? AND patient_mail=?");
            $sql_stmt->bind_param('sss',$date,$time,$patient_mail);
            $date=$_POST['angiology_date'];
            $time=$_POST['Angiology'];
            $patient_mail=$_SESSION['mail_id'];
            if(!$sql_stmt->execute())
            {
                echo "<script>window.alert('Already get appointed!')</script>";
            }
            else
            { */
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Angiology";
            $date=$_POST['angiology_date'];
            $time=$_POST['Angiology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
            //}
        }
        
    //Cardiology

    if(isset($_POST['Cardiology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Cardiology";
            $date=$_POST['Cardiology_date'];
            $time=$_POST['Cardiology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Endocrinology

    if(isset($_POST['Endocrinology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Endocrinology";
            $date=$_POST['Endocrinology_date'];
            $time=$_POST['Endocrinology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Gastroenterology

    if(isset($_POST['Gastroenterology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Gastroenterology";
            $date=$_POST['Gastroenterology_date'];
            $time=$_POST['Gastroenterology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Hematology

    if(isset($_POST['Hematology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Hematology";
            $date=$_POST['Hematology_date'];
            $time=$_POST['Hematology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Hepatology

    if(isset($_POST['Hepatology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Hepatology";
            $date=$_POST['Hepatology_date'];
            $time=$_POST['Hepatology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Nephrology

    if(isset($_POST['Nephrology_button']))
        {
            $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
            $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
            $branch="Nephrology";
            $date=$_POST['Nephrology_date'];
            $time=$_POST['Nephrology'];
            $hospital_name=$_SESSION["hospitals"];
            $patient_mail=$_SESSION['mail_id'];
            $sql_stmt->execute();
        }

    //Oncology

    if(isset($_POST['Oncology_button']))
    {
        $sql_stmt=$db_conn->prepare("INSERT INTO doctor_appointment(branch,date,time,Hospital_name,patient_mail) VALUES(?,?,?,?,?)");
        $sql_stmt->bind_param('sssss',$branch,$date,$time,$hospital_name,$patient_mail);
        $branch="Oncology";
        $date=$_POST['Oncology_date'];
        $time=$_POST['Oncology'];
        $hospital_name=$_SESSION["hospitals"];
        $patient_mail=$_SESSION['mail_id'];
        $sql_stmt->execute();
    }


?>