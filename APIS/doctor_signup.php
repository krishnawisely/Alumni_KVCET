<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <link rel="stylesheet" href="style.css">
    <style>
        .signup_pannel{
            position:absolute;
            background-color:black;
            opacity:0.7;
            width:250px;
            height:auto;
            top:50%;
            left:50%;
            transform:translate(-50%);
        }
        .signup_pannel div{
            margin-top:8px;
            color:rgb(33, 216, 79);
            text-align:center;
        }
       
    </style>
</head>
<body>

<div class="nav" style="background-color: rgb(107, 16, 16);height:auto">
            <div style="border:none;float:left;margin-top:0"><img src="patient.png" width="120px" height="100px"></div>
            <div style="border:none;float:left;"><font style="font-family:sans-serif;color:white;font-size:40px;">Patient Information System</font></div>
            <div id="nav1"><a href="#"><img src="aboutme.png" width="70px" height="70px"><br>About me</a></div>
            <div id="nav1"><a href="signin.php"><img src="signin.png" width="70px" height="70px"><br>Signin</a></div>
            <div id="nav1"><a href="index.php"><img src="home.png" width="70px" height="70px"><br>Home</a></div>
</div>

<form method="post" enctype="multipart/form-data">
<div class="signup_pannel">
<div>Name</div>
<div><input type="text" name="doctor_name"></div>
<div>DOB</div>
<div><input type="date" name="dob" id="dob"></div>
<div>Age</div>
<div><input type="number" name="age" id="age"></div>
<div>MIC No</div>
<div><input type="text" name="micno"></div>
<div>Profile Picture</div>
<div><input type="file" name="pic"></div>
<div>Certificates copy</div>
<div><input type="file" name="certificate_copy"></div>
<div>email_id</div>
<div><input type="email" name="email"></div>
<div>Password</div>
<div><input type="password" name="password" id="password"></div>
<div><meter id="password_meter" low="0" high="4" optimum="9" max="14" max-lenght="15"></div>
<div>Repassword</div>
<div><input type="repassword" name="repassword"></div>
<div><button name="signup">Signup</button></div>
</div>
</form>
</body>
</html>
<script>
//Age calculation
age.addEventListener('mouseover',function()
{
    var dob=document.getElementById('dob').value;
    var doctor_dob=new Date(dob);
    var today_date=new Date();
    var age=today_date.getFullYear() - doctor_dob.getFullYear();
    document.getElementById('age').value=age;
});

//Meter for password 
    var meter=document.getElementById("password_meter");
    var password_length=0;
    password.addEventListener('keypress',function()
    {
        meter.style.display="block";
        //meter.style.textAlign="center";
        password_length=password.value.length;
        password_meter.value=password_length;
        
    });
</script>
<?php
include "db_connection.php";

if(isset($_POST['signup']))
{

    if($_POST['password'] == $_POST['repassword'])
    {
    $sql_stmt=$db_conn->prepare("INSERT INTO doctor(name,dob,age,micno,email,password,profilepic_url,certificate_url) VALUES(?,?,?,?,?,?,?,?)");
    $sql_stmt->bind_param('ssisssss',$name,$date,$age,$micno,$email,$password,$profile_location,$certificate_doctor);
    $name=$_POST['doctor_name'];
    $date=$_POST['dob'];
    $age=$_POST['age'];
    $micno=$_POST['micno'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $profile_location="\APIS\doctor_pic\pic".$_FILES['pic']['name'];
    $certificate_doctor="\APIS\certificate_doctor\doctor".$_FILES['certificate_copy']['name'];
    $sql_stmt->execute();
    if($sql_stmt)
    {
        echo "query is executed!";
        $destination_pic="C:/xampp/htdocs/APIS/doctor_pic/pic".$_FILES['pic']['name'];
        $destination_certificate="C:/xampp/htdocs/APIS/certificate_doctor/doctor".$_FILES['certificate_copy']['name'];
        if(move_uploaded_file($_FILES['pic']['tmp_name'],$destination_pic) && move_uploaded_file($_FILES['certificate_copy']['tmp_name'],$destination_certificate))
        {
            echo "Image uploaded!";
        }
        else
        {
            echo "Image is not uploaded!";
        }

    }
    else
    {
        echo "query is not executed!";
    }
    }
    else
    {
        echo "<script>window.alert('Password Not Match!');</script>";
    }
}

?>