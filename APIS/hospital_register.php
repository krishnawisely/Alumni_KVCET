<!DOCTYPE html>
<html>
<haed>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=0.7">
<link rel="stylesheet" href="style.css">
<style>

.signup_pannel{
    top:50%;
    left:50%;
    transform:translate(-50%);
    position:absolute;
    background-color:black;
    opacity:0.7;
    text-align:center;
    width:350px;
    height:auto;
    font-family:sans-serif;
}
.signup_pannel div{
    margin-top:10px;
    color:rgb(33, 216, 79);
}
.my_style{
    background-color:orange;
    border-color:orange;
    border-radius:50%;
    height:60px;
    width:60px;
}
.my_style:hover{
    animation-name:button;
    animation-duration:3s;
    animation-iteration-count:infinte;
}
@keyframes button{

50%{
    border-color:black;
    border:10px;
}

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
    <div>Hospital Name</div>
    <div><input type="text" name="hospital_name"></div>
    <div></div>
    <div>Branches</div>
            
            <div><input type="checkbox" name="Angiology" value="Angiology">Angiology</div>
            <div><input type="checkbox" name="Cardiology" value="Cardiology">Cardiology</div>
            <div><input type="checkbox" name="Endocrinology" value="Endocrinology">Endocrinology</div>
            <div><input type="checkbox" name="Gastroenterology" value="Gastroenterology">Gastroenterology</div>
            <div><input type="checkbox" name="Hematology" value="Hematology">Hematology</div>
            <div><input type="checkbox" name="Hepatology" value="Hepatology">Hepatology</div>
            <div><input type="checkbox" name="Nephrology" value="Nephrology">Nephrology</div>
            <div><input type="checkbox" name="Oncology" value="Oncology">Oncology</div>
            
    <div>Mobile No.</div>
    <div><input type="number" name="mobile_number"></div>
    <div>Hospital logo</div>
    <div><input type="file" name="pic"></div>
    <div>Address</div>
    <div><textarea name="address" cols="30" rows="10"></textarea></div>
    <div>E-mail id</div>
    <div><input type="email" name="mail"></div>
    <div>Password</div>
    <div><input type="password" name="password" id="password"></div>
    <div><meter  id="password_meter" value="0" low="5" high="9" optimum="10" max="15" max-length="15"></meter></div>
    <div>Re-password</div>
    <div><input type="password" name="repassword"></div>
    <div><button class="my_style" name="signup">Signup</button></div>
    </div>

</form>
<script>
    //Password meter
    var meter=document.getElementById("password_meter");
    //var password=document.getElementById("password");
    var password_length=0;
    password.addEventListener('keypress',function()
    {
        meter.style.display="block";
        //meter.style.textAlign="center";
        password_length=password.value.length;
        password_meter.value=password_length;
        
    });
    
    
    //date od birth
    
    /*age.addEventListener('mouseover',function()
    {

        var today_date=new Date();
        var dob=document.getElementById('dob').value;
        var my_dob=new Date(dob);
        var age=today_date.getFullYear() - my_dob.getFullYear();
        document.getElementById('age').value=age;
       
    });
    </script>
</body>
</html>
<?php

    include "db_connection.php";

    if(isset($_POST['signup']))
    {
        $sql_stmt=$db_conn->prepare("INSERT INTO hospital(hospital_name,Angiology,Cardiology,Endocrinology,Gastroenterology,Hematology,Hepatology,Nephrology,Oncology,mobile_number,pic,address,mail,password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql_stmt->bind_param('ssssssssssssss',$hospital_name,$Angiology,$Cardiology,$Endocrinology,$Gastroenterology,$Hematology,$Hepatology,$Nephrology,$Oncology,$mobile_number,$pic,$address,$mail,$password);
        
        /*$Angiology_img="\APIS\disease\angiologija.jpg";
        $Cardiology_img= */
        $hospital_name=$_POST['hospital_name'];     
        $Angiology=$_POST['Angiology'];
        $Cardiology=$_POST['Cardiology'];
        $Endocrinology=$_POST['Endocrinology'];
        $Gastroenterology=$_POST['Gastroenterology'];
        $Hematology=$_POST['Hematology'];
        $Hepatology=$_POST['Hepatology'];
        $Nephrology=$_POST['Nephrology'];
        $Oncology=$_POST['Oncology'];
        $mobile_number=$_POST['mobile_number'];
        $pic="\APIS\Hospital_log\logo".$_FILES['pic']['name'];
        $address=$_POST['address'];
        $mail=$_POST['mail'];
        $password=$_POST['password'];
        if($sql_stmt->execute())
        {
           
            $destination="C:/xampp/htdocs/APIS/Hospital_log/logo".$_FILES['pic']['name'];
            move_uploaded_file($_FILES['pic']['tmp_name'],$destination);
            echo "<script>window.alert('Signup success');</script>";
        }
        else
        {
            echo "<script>window.alert('Signup success');</script>";
        }
        
       
    }  

?>