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
            <div class="card-tabs">
              <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#">Meal</a></li>
                <li class="tab"><a href="#">Quantity</a></li>
                <li class="tab"><a href="#">Total</a></li>
                <li class="tab"><a href="#"></a></li>
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
                              echo '<form method="post" action="checkout.php">';
                              while($row){
                                //$total = 0;
                                 echo '<div class="col s6 card-panel">';
                                 echo '<li class="collection-item avatar">';
                                 echo '<p>';
                                 echo '<span class="p-name" style="font-size:20px;margin-left:-3em;margin-down:3em">'.$row['meal_name'].'</span>';
                                 echo '<span class="p-name" style="font-size:20px;;margin-down:3em">'.$row['qty'].'</span>';
                                 echo '<span class="p-name" style="font-size:20px;margin-right:-3em;margin-down:3em">'.$row['price'].'</span>';
                                 echo "<span style='margin-down:3em'><a onclick='remove({$row['meal_id']}) 'href=''><i class='material-icons'>delete</i></a></span>";
                                 echo '</p>';
                                 echo "</br>";
                                 echo "</li>";    
                                 echo "</div>";
                                  $row=$obj->fetch();
                              }
                                 echo '</form>';
                            }
                              ?>                              
          </ul>

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
    <script type="text/javascript">
    function removeComplete(xhr,status){
          if(status!="success"){
            alert("Error");
            return;
          }
          divStatus=xhr.responseText;
          var obj=JSON.parse(xhr.responseText);
          if(obj.result==0){  
                     alert(obj.message);
                }else{
                      alert("Removed");
                    window.location.href = "cart.php";
                }
              }
              
        function remove(meal_id){
          var meal_id = meal_id;
          var url="functions.php?cmd=3&meal_id="+meal_id;
          $.ajax(url,
            {async:true,complete:removeComplete});
        }
        </script>

  </body>
</html>
