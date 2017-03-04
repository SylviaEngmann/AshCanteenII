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
  <!--<link rel="stylesheet" href="css/jqm-icon-pack-fa.css">
  <link rel="stylesheet" href="css/jqm-demos">-->
  <!--<link rel="stylesheet" href="css/jquery.mobile.icons-1.4.5">-->
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
      <div data-role="page" id="menu" style="background:white">
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
            <a class="btn-floating btn-large waves-effect waves-light red right" href="cart.php"><i class="material-icons">shopping_cart</i></a>

                <div class="col s6 card-panel" style="">
                    <ul class="collection">
                    <?php
                           include('objects.php');
                            $obj=new object();
                            $result=$obj->getAkMeals();
                            if($result==false){
                              echo "'$result' is false";
                            }else{
                              $row=$obj->fetch();
                              //echo "<span><center><img src='akornno.png' style='width:300px;height:100px'></center></span>";
                              while($row){
                                echo "<ul class='collection'>";
                                echo "<li class='collection-item avatar'>";
                                echo "<img src='{$row['picture']}' style='width:50px;'>";
                                echo "<span class='title'>{$row['meal_name']}</span>";
                                echo "<p>{$row['description']}</p>";
                                echo "<button onclick='add({$row['meal_id']})'><a><i class='material-icons'>shopping_cart</i></a></button>";
                                //echo "<a href='functions.php?cmd=2&meal_id={row['meal_id']}'><i class='material-icons'>shopping_cart</i></a>";
                                echo "</li>";
                                echo "</ul>";
                                $row=$obj->fetch();
                              }
                            }
                      ?>
                    </ul>
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
        function addComplete(xhr,status){
          if(status!="success"){
            alert("Error");
            return;
          }
          divStatus=xhr.responseText;
          var obj=JSON.parse(xhr.responseText);
          if(obj.result==0){  
                     alert(obj.message);
                }else{
                      alert("Added to cart");
                }
              }
              
        function add(meal_id){
          var meal_id = meal_id;
          var url="functions.php?cmd=2&meal_id="+meal_id;
          $.ajax(url,
            {async:true,complete:addComplete});
        }
    </script>        
  </body>
</html>
