<?php
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
      <div data-role="page" id="cart" style="background:white">
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
                    <?php 
                            session_start();
                            echo "<span class='black-text'>{$_SESSION['username']}</span>";
                    ?>
                  </div>
              </li>

              <li><a href="#"><i class="material-icons">menu</i>Menu</a></li>
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
                <h5><b><center>Order Details</center></b></h5>
              </div>
              <div class="card-tabs">
              <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#">Meal</a></li>
                <li class="tab"><a href="#">Q'ty</a></li>
                <li class="tab"><a href="#">Price</a></li>
                <li class="tab"><a href="#">Total</a></li>
              </ul>
            </div>
            
              <ul class="collection">
              <?php
                  $pid = $_SESSION['person_id'];
                    include('objects.php');
                        $obj=new object();
                        $result=$obj->getOrders($pid);
                          if($result==false){
                              echo "'$result' is false";
                            }
                            else{
                              $row=$obj->fetch();
                              $total = 0;
                              $s_total = 0;
                              while($row){
                                 echo '<div class="col s6 card-panel">';
                                 echo '<table>';
                                 echo '<tr>';
                                 echo '<td width=30%>';
                                 echo "<span class='title' style='font-size:14px'>".$row['meal_name']."</span>";
                                 echo '</td>';
                                 echo '<td width=28%>';
                                 echo '<span class="qty" style="font-size:14px">'.$row['qty'].'</span>';
                                 echo '</td>';
                                 echo '<td>';
                                 echo '<span class="price" style="font-size:14px">'.$row['price'].'</span>';
                                 echo '</td>';
                                 $meal_total = ($row['price']*$row['qty']);
                                 $s_total = $meal_total + $s_total;
                                 echo '<td>';
                                 echo '<span class="meal_total" style="font-size:14px">'.$meal_total.'</span>';
                                 echo '<td>';
                                 echo '</tr>';
                                 echo '</table>';    
                                 echo "</div>";
                                  $row=$obj->fetch();
                                }
                               }
                            echo '<div class= "row">';
                            echo '<p>Subtotal: GHC '.$s_total.'</p></div>';
                            echo '<div class="row">';
                            echo '<div class ="row col s6">';
                            echo '<input name="type" type="radio" id="deli" value="deli"/>';
                            echo '<label for="deli">Delivery</label></div>';
                            echo '<div class="row col s6">';
                            echo '<input name="type" type="radio" id="pick" value="pick"/>';
                            echo '<label for="pick">Pickup</label></div></div> '; 
                            echo '<div class="col s6">';
                            echo "<button type='button' class='btn waves-effect' onclick='add({$row['meal_id']},{$row['qty']},{$row['price']},{$_SESSION['person_id']})'><a>Place Order</a></button>";
                            echo '</div>';

                    ?>                              
                </ul>
                <div class='row'>

                </div>
               </div><!--content-->
        </div><!-- /page -->

        
    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script src="scripts/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script>
      document.getElementById('checkout').addEventListener('click',checkout,false);
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space

     function checkout(){
      var meal_id = document.getElementById('m_name').value;
      var qty = document.getElementById('m_qty').value;
      var price = document.getElementById('m_price').value;
      var person_id = document.getElementById('pid').value;
      var order_type = $('input[type="radio"]:checked').val();

      var url="checkout.php&meal_id="+meal_id+"&qty="+qty+"&price="+price+"&person_id="+person_id+"&order_type="+order_type;
      alert(url);
     }

  </body>
</html>
