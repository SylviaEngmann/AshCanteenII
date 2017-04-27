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
              <a href="cart.php" class="right"><i class="material-icons">shopping_cart</i></a> 
              <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i>
              </a>
            <ul class="side-nav" id="mobile-demo">
              <li>
                 <div class="userView">
                    <?php echo "<span class='black-text'>{$_SESSION['username']}</span>";?>
                 </div>
              </li>
              <li><a href="dashboard.php"><i class="material-icons">menu</i>Dashboard</a></li>
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
              <div class="row">
                <h5><b><center>Order Status</center></b></h5>
              </div>
              <div class="card-tabs">
              <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#">Order</a></li>
                <li class="tab"><a href="#">Meal</a></li>
                <li class="tab"><a href="#">Order Status</a></li>
              </ul>
            </div>
              <?php
                  $pid = $_SESSION['person_id'];
                    include('objects.php');
                        $obj=new object();
                        $result=$obj->viewOrders($pid);
                          if($result==false){
                              echo "'$result' is false";
                            }
                            else{
                              while($row=$obj->fetch()){
                                echo '<div class="col s6 card-panel">';
                                 echo '<table>';
                                 echo '<tr>';
                                 echo '<td width=25%>';
                                 echo '<span class="o_num" style="font-size:14px">'.$row['Id'].'</span>';
                                 echo '</td>';
                                 echo '<td width=30%>';
                                 echo "<span class='title' style='font-size:14px'>".$row['fName']."</span>";
                                 echo '</td>';
                                 echo '<td width=30%>';
                                 echo "<span class='title' style='font-size:14px'>Pending</span>";
                                 echo '</td>';
                                 echo '</tr>';
                                 echo '</table>';    
                                echo "</div>";
                              }
                            }
                    ?>                              
               </div>
        
    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script type="text/javascript">
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space
    </script>
  </body>
</html>
