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
    <nav>
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
          <div class="row">
                          <div class="col s6 left">
                            <button class="btn-small waves-effect waves-light deep-orange" id="back"><a href="<?php print $site_root; ?>dashboard.php" class="white-text">Go Back</a></button>
                          </div>
          </div>
                    <?php
                           $canteen_id=$_GET['canteen_id'];
                           $_SESSION['canteen_id']=$canteen_id;
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
                                echo "<div class='card-action'>";
                                echo "<a onclick='add_rev({$row['F_Id']},{$_SESSION['canteen_id']})' class='secondary-content'><i class='material-icons'>add</i></a>";
                                echo "<a onclick='view_rev({$row['F_Id']},{$_SESSION['canteen_id']})' class='secondary-content'><i class='material-icons'>comment</i></a>";
                                echo "<a onclick='details({$row['F_Id']},{$_SESSION['canteen_id']})' class='secondary-content'><i class='material-icons'>open_in_new</i></a>";
                                echo "</div>";
                                echo "</div>";
                                $row=$obj->fetch();
                              }
                            }
                      ?>
                    </div>

        
    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script>
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space

        </script>

    <script>  
        function details(food_id,can_Id){
          var food_id = food_id;
          var can_Id = can_Id;  
          window.location.href = "<?php print $site_root; ?>order_details.php?food_id="+food_id+"&can_Id="+can_Id;
        }

        function add_rev(food_id,can_Id){
          var food_id = food_id;
          var canteen_id = can_Id;  
          window.location.href = "<?php print $site_root; ?>add_reviews.php?food_id="+food_id+"&canteen_id="+canteen_id;
        }

        function view_rev(food_id,can_Id){
          var food_id = food_id;
          var canteen_id = can_Id;  
          window.location.href = "<?php print $site_root; ?>view_reviews.php?food_id="+food_id+"&canteen_id="+canteen_id;
        }
    </script>        
  </body>
</html>
