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
            </ul>
            </div>
          </nav>
           <div data-role="content">
                <div id ="cart_display"></div>
                <div class="row">
                  <div class="col s6">
                    <a href="menu.php"><button>Continue</button></a>
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
    <script>
    $(document).ready(function (){
        viewCart();
           });

        function viewCartComplete(xhr,status){
            if(status!="success"){
              alert("Error");
                //pools.innerHTML = "error fetching cart";
                return;
            }
            var obj = JSON.parse(xhr.responseText);
            if(obj.result==0){
                //items.innerHTML = obj.message;
                alert("Non-existent");
            }
            else{
               var result="";
               var length = obj.meal_id.length;
               var meals = obj.meal_id;
               while(length>0){
                    result="<div class='col s6 card-panel' style=''><ul class='collection'>"+meals[length-1].meal_id+"</ul></div><div class='row'><div class='col s6'><a href='menu.php'><button>Continue</button></a></div><div class='col s6'><button>Checkout</button></div></div>";
                    length-=1;
                  }
                
              result= document.getElementById("cart_display");
            }           
            currentObject=null;
        }
        function viewCart(){
          var url="functions.php?cmd=3";
          $.ajax(url,
            {async:true,complete:viewCartComplete});
        }

        window.onload=viewCart();
        
    </script>        
  </body>
</html>
