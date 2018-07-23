<?php
    session_start();
    if(!$_SESSION['user'])
    {
        header('location:alumni.php');
    }
?>
<?php
    include "connection.php";
    if(isset($_POST['logout']))
    {
        session_destroy();
        header('location:alumni.php');
    }

    if(isset($_POST['update']))
    {
        $sql_stmt=$db_conn->prepare("UPDATE user SET user_name=?,email=?,password=?,profile_pic=? WHERE id=?");
        $sql_stmt->bind_param('ssssi',$user_name,$user_mail,$user_password,$pic_url,$id);
        $user_name=$_POST['user_name'];
        $user_mail=$_POST['email'];
        $user_password=$_POST['password'];
        $pic_url="\kvcet\alumni\pro_pic\user".$_FILES['profile_pic']['name'];
        $id=$_SESSION['id'];
        if($sql_stmt->execute())
        {
        $_SESSION['user']=$user_name;
        $_SESSION['password']=$password;
        $_SESSION['email']=$user_mail;
        $_SESSION['img_url']=$pic_url;
        $destination="C:/xampp/htdocs/kvcet/alumni/pro_pic/user".$_FILES['profile_pic']['name'];
        
        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'],$destination))
        {
            echo "<script>window.alert('Image was uploaded!');</script>";
            

        }
        else
        {
            echo "<script>window.alert('Image was not uploaded!');</script>";
        }
    }
    }
?>
<!DOCTYPE html>
<html>
    <head>
            <meta name="viewport" content="width=device-width,initial-scale=0.6">
            <link rel="stylesheet" href="/kvcet/nav-style.css">
        <style>
        
            .update-pannel
            {
                position:absolute;
                top:70%;
                left:50%;
                transform:translate(-50%,-70%);
                text-align:center;
                color:white;
                font-size:20px;
                background-color:black;
                padding:25px;
                opacity:0.8;
                box-shadow:3px 12px 12px 0px rgba(0,0,0,0.5);
            }
            .sub-pannel div
            {
                margin-top:10px;
            }
            #title-update
            {
                background-color:red;
                width:100%;
                position:absolute;
                left:0;
                top:0;
            }
        </style>
    </head>
    <body>
    <form method="post" enctype="multipart/form-data">
        <div class="nav-header"><div id="nav-header-name">KARPAGAVINAYAGA COLLAGE OF ENGINEERING AND TECHNOLOGY</div>
        <div class="nav-menu">
            <div><a href="home.php">Home</a></div>
            <div><a href="#"><img src="<?php echo $_SESSION['img_url']; ?>" width="20px" height="20px" border=1px; style="border-radius:50%;"><?php echo $_SESSION['user']; ?></a>
            <div class="sub-nav">
            <!--<div><a href="#" style="background-color:rgb(53, 49, 49);">Update</a></div>-->
            <div><a href="#"><button name="logout" style="background-color:inherit;border:none;display:block;font-size:20px;color:white;font-family:cursive;">Logout</button></a></div>
            </div>
            </div>
        </div>
    </div>
    <div class="update-pannel">
        <div id="title-update">Update Details</div>
        <div class="sub-pannel">
        <div><img src="<?php echo $_SESSION['img_url']; ?>" width="100px" height="100px" border=5px; style="border-radius:50%;border-color:green;"></div>
        <div>Name</div><div><input type="text" name="user_name" value="<?php echo $_SESSION['user']; ?>" autofocus noedit></div>
        <div>E-mail</div><div><input type="email" name="email" value="<?php echo $_SESSION['email']; ?>"></div>
        <div>Password</div><div><input type="password" name="password" value="<?php echo $_SESSION['password']; ?>" required></div>
        <div>Profile Picture</div><div><input type="file" name="profile_pic"></div>
        <div><input type="submit" name="update" value="update"></div>
        </div>
    </div>
    </form>
    </body>
</html>

