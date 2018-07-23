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
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width,initial-scale=0.7">
        <link rel="stylesheet" href="style.css">
        <style>
            .signout_button{
                background-color:inherit;
                border:none;
                color:white;
                font-family:cursive;
                font-size:16px;
            }
           .request_pannel{
               top:50%;
               left:50%;
               background-color:gray;
               transform:translate(-50%);
               position:absolute;
               background-color:black;
               opacity:0.7;
               width:300px;
               height:auto;
           }
           .request_pannel div{
               text-align:center;
               margin-top:10px;
               color:white;
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
        </form>
       <form method="post">
       <div class="request_pannel">
       <div>Bloodgroup</div><div><select name="bloodgroup">
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
            <div>Status</div>
            <div><select name="status"> <option>--SELECT--</option>
                                        <!--<option value="NORMAL">NORMAL</option>-->
                                        <option value="EMERGENCY">EMERGENCY</option>
                                        </select>
            </div>
            <div>Date</div>
            <div><input type="date" name="date_blood" /></div>
            <div>Time</div>
            <div><input type="time" name="time_blood" /></div>
            <div>Cotact No.</div>
            <div><input type="number" name="contactno"></div>
            <div>Address</div>
            <div><textarea name="address" cols="23" rows="5" style="background-color:rgb(236, 157, 11);color:white;font-size:18px;">
            </textarea></div>
            <div><button name="request">Send Request</button></div>
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
        if(isset($_POST['request']))
        {
           
            $sql_stmt=$db_conn->prepare("INSERT INTO blood_request(blood_group,contact_no,address,status,date_blood,time_blood) VALUES (?,?,?,?,?,?)");
            $sql_stmt->bind_param('ssssss',$blood_group,$contact_no,$address,$status,$date_blood,$time_blood);
            $blood_group=$_POST['bloodgroup'];
            $contact_no=$_POST['contactno'];
            $address=$_POST['address'];
            $status=$_POST['status'];
            $date_blood=$_POST['date_blood'];
            $time_blood=$_POST['time_blood'];
            $result=$sql_stmt->execute();
            if($result)
            {
                echo "<script>window.alert('I am executed!');</script>";
                echo "<p style='color:white;height:100px;width:100px;position:absolute;top:30%;left:50%;transform:translate(-50%);box-shadow:0px 12px 12px 0px rgba(0,0,0,0.5);' id='demo'></p>";


            }
            else
            {
                echo "<script>window.alert('I am not executed!');</script>";
            }
        }
    ?>

    <script>
// Set the date we're counting down to
var countDownDate = new Date("Apr 18, 2018 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>