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


       <!-- google maps -->

       <div style="position:absolute;top:50%;left:50%;transform:translate(-50%);box-shadow:0px 12px 12px 12px rgba(0,0,0,0.2)" id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 20
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjiiK_4wRE7T2vAJMDMNoww55bPrEBeo0&callback=initMap">
    </script>

       <!-- <div style="position:absolute;top:50%;left:50%;transform:translate(-50%);box-shadow:0px 12px 12px 12px rgba(0,0,0,0.2)" id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjiiK_4wRE7T2vAJMDMNoww55bPrEBeo0&callback=initMap">
    </script> -->

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
        
        $sql_stmt=$db_conn->prepare("INSERT INTO emergency(mail_id,Hospital_name) VALUES(?,?)");
        $sql_stmt->bind_param('ss',$patient_mail,$hospital_name);
        
        $patient_mail=$_SESSION['mail_id'];
        $hospital_name=$_POST['search_hospital'];
        
        if($sql_stmt->execute())
        {
          echo "Row is inserted!";
        }
        else
        {
          echo "Row is not inserted!";
        }
    }
?>