<!DOCTYPE html>
<html>
    <head>
            <meta name="viewport" content="width=device-width,initial-scale=0.6">
            <link rel="stylesheet" href="/kvcet/nav-style.css">
        <style>
        
            .signup-pannel
            {
                position:absolute;
                top:70%;
                left:50%;
                transform:translate(-50%,-50%);
                background-color:gray;
                text-align:center;
                color:white;
                font-size:20px;
                box-shadow:0px 10px 10px 0px rgba(0,0,0,0.5);
                background-image:linear-gradient(black,gray);
            }
            .signup-pannel div{
                margin-top:10px;
            }
            .signup-pannel button{
                padding:15px;
                border-radius:50%;
                font-size:20px;
                color:blue;
            }

        </style>
    </head>
    <body>
        <div class="nav-header"><div id="nav-header-name">KARPAGAVINAYAGA COLLAGE OF ENGINEERING AND TECHNOLOGY</div>
        <div class="nav-menu">
            <div><a href="\kvcet\index.html">Home</a></div>
            <div><a href="alumni.php">Alumni</a></div>
            <div><a href="#">Departments</a>
            <div class="sub-nav">
              
                <div><a href="#">CSE</a></div>
                <div><a href="#">ECE</a></div>
                <div><a href="#">EEE</a></div>
                <div><a href="#">MECH</a></div>
                <div><a href="#">CIVIL</a></div>
                <div><a href="#">BIOTECH</a></div>
           
            </div>
            </div>
            <div><a href="#">Contact us</a></div>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data">
    <div class="signup-pannel">
        <div>Name</div><div><input type="text" name="name"></div>
        <div>E-mail</div><div><input type="email" name="email"></div>
        <div>Profile Pic</div><div><input type="file" name="profilepic"></div>
        <div>Password</div><div><input type="password" id="password" name="password"></div>
        <div>Re-Password</div><div><input type="password" id="repassword" name="repassword"></div>
        <div id="errormsg" style="display:none;color:red;">Password not matched!</div>
        <div id="msg" style="display:none;color:green;">Password matched!</div>
        <div id="msg1" style="display:none;color:red;">Plz enter the Password</div>
        <div>DOB</div><div><input id="dob" type="date" name="date"></div>
        <div>Age</div><div><input id="age" type="number" name="age"></div>
        <div>Department</div><div><select name="department">
            <option>--SELECT--</option>
            <option value="CSE">CSE</option>
            <option value="CSE">ECE</option>
            <option value="CSE">EEE</option>
            <option value="CSE">MECH</option>
            <option value="CSE">AUTOMOBILE</option>
    </select>
        </div>
        <div>Live At</div><div><input type="text" name="liveat"></div>
        <div>Work At</div><div><input type="text" name="workat"></div>
        <div><button name="ok">Ok</button></div>
    </div>
    </form>
    </body>
</html>
<script>
    age.addEventListener('mouseover',function()
    {
        var today_date=new Date();
        var date=document.getElementById('dob').value;
        var dob=new Date(date);
        var age=today_date.getFullYear() - dob.getFullYear();
        document.getElementById('age').value=age;
    }
    );
    dob.addEventListener('mouseover',function()
    {
        
        var password=document.getElementById('password').value;
        var repassword=document.getElementById('repassword').value;
        var length=password.length;
        var repasslength=repassword.length;
        
        if(length > 0 && repasslength > 0)
        {
        if(password.localeCompare(repassword))
        {
        document.getElementById('errormsg').style.display='block';
        document.getElementById('msg').style.display='none';
        document.getElementById('msg1').style.display='none';
        }else
        {
        document.getElementById('msg').style.display='block';
        document.getElementById('errormsg').style.display='none';
        document.getElementById('msg1').style.display='none';
        }
        }else
        {
            document.getElementById('msg1').style.display='block';
        }
        
    });
</script>
<?php

    include "connection.php";

    if(isset($_POST['ok']))
    {
        

        $sql_stmt=$db_conn->prepare("INSERT INTO user(user_name,email,password,dob,age,department,live_at,work_at,profile_pic) VALUES(?,?,?,?,?,?,?,?,?)");
        $sql_stmt->bind_param('ssssissss',$user_name,$email,$password,$dob,$age,$department,$liveat,$workat,$profile_pic);
        $user_name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $dob=$_POST['date'];
        $age=$_POST['age'];
        $department=$_POST['department'];
        $liveat=$_POST['liveat'];
        $workat=$_POST['workat'];
        $profile_pic="\kvcet\alumni\pro_pic\user".$_FILES['profilepic']['name'];
        $result=$sql_stmt->execute();
        $destination="C:/xampp/htdocs/kvcet/alumni/pro_pic/user".$_FILES['profilepic']['name'];
        if(move_uploaded_file($_FILES['profilepic']['tmp_name'],$destination))
        {
            echo "profile pic uploaded!";
        }
        else
        {
            echo "profile pic is not uploaded!";
        }
        if($result)
        {
            echo "Row inserted!";
        }else
        {
            echo "Row is not inserted!";
        }
    }

?>