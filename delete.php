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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">

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
      <div data-role="page" id="dashboard" style="background:white">
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
            <div class="card-tabs">
              <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#">Meal</a></li>
                <li class="tab"><a href="#">Quantity</a></li>
                <li class="tab"><a href="#">Total</a></li>
                <li class="tab"><a href="#"></a></li>
              </ul>
            </div>

            <div class="col s12 card-panel">
              <?php
                  if(isset($_SESSION['cart']))
                  {
                    $total = 0;
                     echo '<form method="post" action="checkout.php">';
                      echo '<ul class="collection">';
                     //$cart_items = 0;
                     foreach ($_SESSION['cart'] as $item)
                     {
                       echo '<li class="collection-item avatar">';
                       echo '<p>';
                       //echo '<p class="p-name">'.$item['meal_id'].'</p>';
                       //echo '<span class="p-name">'.$item['meal_id'].'</span>';

                       echo '<span class="p-name" style="font-size:20px;margin-left:-3em;margin-down:3em">'.$item['meal_name'].'</span>';
                       //echo "<span class='product-quantity'>";
                       //echo "<input type='number' value='1' min='1' id='in'>";
                       //echo "</span>";
                       echo "<span style='margin-down:3em'><a href=''><i class='material-icons'>delete</i></a></span>";
                       echo '</p>';
                       //echo "<button class='waves-effect red btn-small' style='margin-left:2em;' onclick='rem()'> Remove</button>";
                       echo "</br>";
                       echo "</li>";    
                       //$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
                       //$total = ($total + $subtotal);

                       //echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->product_name.'" />';
                       //echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
                       //echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->product_desc.'" />';
                       //echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
                       //$cart_items ++;
                     }
         //echo '<span class="check-out-txt">';
         //echo '<strong>Total : '.$currency.$total.'</strong>  ';
         //echo '</span>';
                       echo '</ul>';
                       echo '</form>';

    }

    ?>
            
            </div>
              <div class="row">
                  <div class="col s6">
                    <a onclick="menu()" href="menu.php"><button>Continue</button></a>
                  </div>
                  <div class="col s6">
                    <button>Checkout</button>
                  </div>
                </div>
            </div><!--content-->
        </div><!-- /page -->

        
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

        <script type="text/javascript">
      function menu(){
        window.location.href = "menu.php";
      }
    </script>  
  </body>
</html>
