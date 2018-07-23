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
    <div>Name</div>
    <div><input type="text" name="name"></div>
    <div>DOB</div>
    <div><input type="date" name="dob" id="dob"></div>
    <div>Age</div>
    <div><input type="number" name="age" id="age" value=""></div>
    <div>Blood group</div>
    <div><select name="bloodgroup">
            <option>SELECT</option>
            <option value="AB-">AB-</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="A-">A-</option>
            <option value="O-">O-</option>
            <option value="B+">B+</option>
            <option value="A+">A+</option>
            <option value="O+">O+</option>
            </select></div>
    <div>Weight</div>
    <div><input type="number" name="weight"></div>
    <div>Mobile No.</div>
    <div><input type="number" name="mobile_number"></div>
    <div>profilePicure</div>
    <div><input type="file" name="pic"></div>
    <div>E-mail id</div>
    <div><input type="email" name="mail"></div>
    <div>Password</div>
    <div><input type="password" name="password" id="password"></div>
    <div><meter style="display:none" id="password_meter" value="0" low="5" high="9" optimum="10" max="15" max-length="15"></meter></div>
    <div>Re-password</div>
    <div><input type="password" name="repassword"></div>
    <div><button class="my_style" name="signup">Signup</button></div>
    </div>

</form>
<script>
    //Password meter
    var meter=document.getElementById("password_meter");
    var password_length=0;
    password.addEventListener('keypress',function()
    {
        meter.style.display="block";
        //meter.style.textAlign="center";
        password_length=password.value.length;
        password_meter.value=password_length;
        
    });
    
    
    //date od birth
    
    age.addEventListener('mouseover',function()
    {

        var today_date=new Date();
        var dob=document.getElementById('dob').value;
        var my_dob=new Date(dob);
        var age=today_date.getFullYear() - my_dob.getFullYear();
        document.getElementById('age').value=age;
        
    });

    /*var password=document.getElementById("password").value;
    var repassword=document.getElementById("repassword").value;
    if(password == repassword)
    {
        alert("Password Match!");
    }
    else
    {
        alert("Password not Match!");
    } */
    </script>
</body>
</html>
<?php

    include "db_connection.php";

    if(isset($_POST['signup']))
    {
        if($_POST['password'] == $_POST['repassword'])
        {
        $sql_stmt=$db_conn->prepare("INSERT INTO user(user_name,user_dob,age,blood_group,weight,mobile_no,email_id,password,img_url) VALUES(?,?,?,?,?,?,?,?,?)");
        $sql_stmt->bind_param("ssisdisss",$user_name,$user_dob,$user_age,$blood_group,$weight,$mobile_no,$mail,$password,$pic_location);
        $user_name=$_POST['name'];
        $user_dob=$_POST['dob'];
        $user_age=$_POST['age'];
        $blood_group=$_POST['bloodgroup'];
        $weight=$_POST['weight'];
        $mobile_no=$_POST['mobile_number'];
        $mail=$_POST['mail'];
        $password=$_POST['password'];
        $pic_location="\APIS\profilepic\patient".$_FILES['pic']['name'];
        $result=$sql_stmt->execute();
        $destination_pic="C:/xampp/htdocs/APIS/profilepic/patient".$_FILES['pic']['name'];
        if(move_uploaded_file($_FILES['pic']['tmp_name'], $destination_pic))
        {
            echo "Image is uploaded!";
            echo "<img src=".$pic_location." width=\"200px\ height=\"200px\">";
        }
        else
        {
            echo "Error upload image!";
        }
        if(!$result)
        {
            echo "<script>window.alert('ERROR!');</script>";
            
        }
        else 
        {
            echo "Row is inserte!";
           
        }
        $sql_stmt->close();
        $db_conn->close();
    }
    else
    {
        echo "<script>window.alert('Password Not Match!');</script>";
    }
    }

?>