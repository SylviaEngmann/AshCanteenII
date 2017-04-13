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
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.css">
  <link rel="stylesheet" href="css/jquery.mobile.theme-1.4.5.css">
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
      <div data-role="page" id="menu" style="background:white">
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
                    <?php 
                            session_start();
                            echo "<span class='black-text'>{$_SESSION['username']}</span>";
                    ?>
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
           <div data-role="content">
                  <ul class='collection'>
                    <?php
                           $canteen_id=$_GET['canteen_id'];
						   
                           include('objects.php');
                            $obj=new object();
                            $result=$obj->getMeals($canteen_id);
                            if($result==false){
                              echo "'$result' is false";
                            }else{
                              $row=$obj->fetch();
                              while($row){
                                echo "<div class='col s6 card-panel'>";
                                echo "<img src='{$image_folder}{$row['Picture']}' style='width:50px;'>";
                                echo "<span class='title'>{$row['fName']}</span>";
                                echo "<p>{$row['Description']}</p>";
                                //echo "<a href='' onclick='details({$row['meal_id']})' class='secondary-content'><i class='material-icons'>label_outline</i></a>";
                                echo "<a href='' onclick='details({$row['F_Id']})' class='secondary-content'><i class='material-icons'>label_outline</i></a>";
                                echo "</div>";
                                $row=$obj->fetch();
                              }
                            }
                      ?>
                      </ul>
            </div><!--content-->
        </div><!-- page -->
        
    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script src="scripts/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script>
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space
        </script>

    <script>  
        function details(food_id){
          //var meal_id = meal_id;  
          var food_id = food_id;        
          window.location.href = "<?php print $site_root; ?>order_details.php?food_id="+food_id;
        }
    </script>        
  </body>
</html>
