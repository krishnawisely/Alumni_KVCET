<?php
    session_start();
    if(!$_SESSION['user'])
    {
        header('location:alumni.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
            <meta name="viewport" content="width=device-width,initial-scale=0.6">
            <link rel="stylesheet" href="/kvcet/nav-style.css">
        <style>
        .search
        {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            background-color:black;
            opacity:0.8;
            padding:10px;
            color:white;
            font-size:20px;
            box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
        }
        .user_details
        {
            position:absolute;
            top:55%;
            left:50%;
            transform:translate(-50%);
            color:white;
            text-align:center;
            box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);
            font-size:20px;
            background-color:gray;
        }
        .user_details div
        {
            margin-top:10px;
            
        }
        #label
        {
            background-image:linear-gradient(darkgray,black);
            border-radius:10%;
        }
        </style>
    </head>
    <body>
    <form method="post">
        <div class="nav-header"><div id="nav-header-name">KARPAGAVINAYAGA COLLAGE OF ENGINEERING AND TECHNOLOGY</div>
        <div class="nav-menu">
            <div><a href="#" style="background-color:rgb(53, 49, 49);">Home</a></div>
            <div><a href="#"><img src="<?php echo $_SESSION['img_url']; ?>" width="20px" height="20px" border=1px; style="border-radius:50%;"><?php echo $_SESSION['user']; ?></a>
            <div class="sub-nav">
            <div><a href="Update_user_profile.php">Update</a></div>
            <div><a href="#"><button name="logout" style="background-color:inherit;border:none;display:block;font-size:20px;color:white;font-family:cursive;">Logout</button></a></div>
            </div>
            </div>
        </div>
    </div>
    <div class="search">
        <div>Search
        <select name="batch">
            <option>--SELECT--</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
        </select>
        
        <select name="department">
        <option>--SELECT--</option>
        <option value="CSE">CSE</option>
        <option value="ECE">ECE</option>
        <option value="EEE">EEE</option>
        <option value="MECH">MECH</option>
        <option value="CIVIL">CIVIL</option>
        <option value="BIOTECH">BIOTECH</option>
        </select>
        <button name="ok">Search</button>
        </div>
    </div>
    </form>
    </body>
</html>

<?php

    include "connection.php";

    if(isset($_POST['logout']))
    {
        session_destroy();
        header('location:alumni.php');
    }

    if(isset($_POST['ok']))
    {

        $sql_stmt=$db_conn->prepare("SELECT user_name,email,department,live_at,work_at,profile_pic FROM user WHERE department=? AND batch=?");
        $sql_stmt->bind_param('ss',$department,$batch);
        $department=$_POST['department'];
        $batch=$_POST['batch'];
        $sql_stmt->execute();
        $sql_stmt->bind_result($user_name,$user_mail,$user_department,$user_liveat,$user_workat,$user_pic);
        while($sql_stmt->fetch())
        {
            echo "<div class='user_details'>";
            echo "<div><div><img src='$user_pic' width='100px' height='100px' border='5px' style='border-radius:50%;border-color:darkgray;'></div><div id='label'>username</div><div>$user_name</div><div id='label'>e-mail</div><div>$user_mail</div><div id='label'>department</div><div>$user_department</div><div id='label'>live_at</div><div>$user_liveat</div><div id='label'>work_at</div><div>$user_workat</div></div>";
            echo "</div>";
        }
    }
?>