<?php
include "config.php"; 
session_start();
?>
<!DOCTYPE html>
<html>
  <head>

    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <title></title>

    <!-- Path to your custom app styles-->
  <link rel="stylesheet" href="css/materialize.css">
  <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="manifest" href="manifest.json">
  <script>
      var userAgent = navigator.userAgent + '';
      if (userAgent.indexOf('iPhone') > -1) {
        document.write('<script src="scripts/cordova-iphone.js"></sc' + 'ript>');
        var mobile_system = 'iphone';
      } else if (userAgent.indexOf('Android') > -1) {
        document.write('<script src="scripts/cordova-android.js"></sc' + 'ript>');
        var mobile_system = 'android';
      } else {
        var mobile_system = '';
      }
    </script>
    
  </head>
  <body>
          <nav >
            <div class="nav-wrapper" style="background:#ff9e80">
              <a href="#" class="center brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
              <a href="cart.php" class="right">
              <span class="badge" id="comparison-count"></span><i class="material-icons">shopping_cart</i>
              </a> 
              <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i>
              </a>
            <ul class="side-nav" id="mobile-demo">
              <li>
                 <div class="userView">
                    <?php echo "<span class='black-text'>{$_SESSION['username']}</span>";?>
                  </div>
              </li>
              <li><a href="#"><i class="material-icons">account_circle</i>Account</a></li>
              <li><a href="#"><i class="material-icons">message</i>Notifications</a></li>
              <li><a href="#"><i class="material-icons">settings_applications</i>Settings</a>
              </li>
              <li><a href="#"><i class="material-icons">help</i>Help</a>
              </li>
              <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Log out</a>
              </li>
            </ul>
            </div>
          </nav>
           <div class="container">
           <?php
                           $canteen_id=$_GET['canteen_id'];
                           $food_id=$_REQUEST['food_id'];
                           include('objects.php');
                            $obj=new object();
                            $result=$obj->viewReview($food_id);
                            if($result==false){
                              echo "Nothing found";
                            }else{
                              $row=$obj->fetch();
                              if(empty($row)){
                                echo "No reviews for this meal";
                                echo "<input type='hidden' id ='cid' value ='$canteen_id'>";
                              }
                              else{
                              echo "<img src='{$image_folder}{$row['Picture']}' style='width:300px;height:200px;'>";
                              echo "<input type='hidden' id ='cid' value ='$canteen_id'>";
                              echo "<h5><center><b>{$row['fName']}</b></center></h5>";
                              while($row){
                                echo '<div class="col s6 card-panel">';
                                echo "<span>{$row['reviews']}</span>";
                                echo "<br>";
                                echo "<span>Rating : {$row['rating']}</span>";
                                echo "<br>";
                                echo "<span>{$row['time']}</span>";
                                echo "</div>";
                                $row=$obj->fetch();
                            }
                        }
                      }
            ?>                                      
           <div class="row">
              <div class="col s6 left">
              <button class="btn-small waves-effect waves-light deep-orange" id="back"><a class="white-text">Go Back</a></button>
              </div>
            </div>
           </div><!--content-->
           </div><!--page-->

	<script src="scripts/jquery.js"></script>
	<script src="scripts/materialize.min.js"></script>
	<script type="text/javascript" src="scripts/platformOverrides.js"></script>
  <script type="text/javascript">
        document.getElementById('back').addEventListener('click',back,false);

        function back(){
          var can_id = document.getElementById('cid').value;
          window.location.href = "<?php print $site_root; ?>menu.php?canteen_id="+can_id;
        }

  </script>
	 
 </body>
 </html>