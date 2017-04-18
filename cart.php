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
                              while($row){
                                //$total = 0;
                                 echo '<div class="col s6 card-panel">';
                                 echo '<table>';
                                 echo '<tr>';
                                 echo '<td width=30%>';
                                 echo "<span class='title' style='font-size:14px'>".$row['fName']."</span>";
                                 echo '</td>';
                                 echo '<td width=25%>';
                                 echo '<span class="qty" style="font-size:14px">'.$row['qty'].'</span>';
                                 echo '</td>';
                                 echo '<td width=20%>';
                                 echo '<span class="price" style="font-size:14px">'.$row['price'].'</span>';
                                 echo '</td>';
                                 $meal_total = ($row['price']*$row['qty']);
                                 echo '<td width=20%>';
                                 echo '<span class="meal_total" style="font-size:14px">'.$meal_total.'</span>';
                                 echo '</td>';
                                 echo '<td>';
                                 echo "<span><a onclick='remove({$row['F_Id']}) 'href=''><i class='material-icons'>delete</i></a></span>";
                                 echo '</td>';
                                 echo '</tr>';
                                 echo '</table>';    
                                 echo '</div>';
                                  $row=$obj->fetch();
                              }
                            }
                              ?>                              
          </ul>

              <div class="row">
                  <div class="col s6">
                  <?php $can_id=$_SESSION['canteen_id'];
                    echo "<a onclick='menu($can_id)'' ><button>Continue</button></a>";
                    ?>
                  </div>
                  <div class="col s6">
                    <button id ='checkout' type ='submit'>Checkout</button>
                  </div>
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

      function menu(can_id){
        var canteen_id = can_id;
        window.location.href = "<?php print $site_root; ?>menu.php?canteen_id="+can_id;
      }
      
     function checkout(){
        window.location.href = "<?php print $site_root; ?>checkout.php";
     }

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
                    window.location.href = "<?php print $site_root; ?>cart.php";
                }
              }
              
        function remove(F_Id){
          var F_Id = F_Id;
          var url="<?php print $site_root; ?>functions.php?cmd=3&F_Id="+F_Id;
          $.ajax(url,
            {async:true,complete:removeComplete});
        }
        </script>

  </body>
</html>
