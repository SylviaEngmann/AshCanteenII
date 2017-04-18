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
        <div data-role = "page" id="meal_details" style = "background:white">
          <nav >
            <div class="nav-wrapper" style="background:#ff9e80">
              <?php 
              $can_id=$_SESSION['canteen_id'];
              //print_r($can_id);
              echo "<a href='' onclick='menu($can_id)' class='left'><i class='material-icons'>navigate_before</i></a>";
              ?>
              <a href="#" class="center brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
              <a href="<?php print $site_root; ?>cart.php" class="right">
              <span class="badge" id="comparison-count"></span><i class="material-icons">shopping_cart</i>
              </a> 
          </div>
          </nav>
          <div data-role = "content">
            <?php
              $food_id=$_REQUEST['food_id'];
              $_SESSION['person_id'];
              include('objects.php');
               $obj = new object();
               $result=$obj->getFood($food_id);
               if($result==false){
                 echo "'$result' is false";
               }
               else{
                $row=$obj->fetch();
                $price = 0;
                while($row){
                  echo "<img src='{$image_folder}{$row['Picture']}' style='width:300px;height:200px;'>";
                  echo "<h3><b>{$row['fName']}</b></h3>";
                  echo "<p3>{$row['Description']}</p3>";
                  echo "<br>";
                  echo "<span>";
				                    echo '<div class ="row">';
                            echo '<div class ="row col s6">';
                            echo '<input name="meal_type" type="radio" id="classic" value="classic"/>';
                             echo '<label for="classic">Classic</label></div>'; 

                             echo '<div class="row col s6">';
                            echo '<input name="meal_type" type="radio" id="deluxe" value="deluxe"/>';
                            echo '<label for="deluxe">Deluxe</label></div></div>';

                  echo "<p4>Price: GHC</p>";
                  echo '<div id = "price">'.$price.'</div>';
                  $price_n = 7.50;
                  echo "</span>";
                  echo "<br>";
                  echo "<div class = 'row'>";
                  echo '<div class ="row col s6">';
                  echo "<p4><b>Quantity</b></p4>";
                  echo "</div>";
                  echo "<div class='input-field col s4'>";
                  echo "<input id='qty_val' type='number' value='1' min='1' max='100' class='validate'>";
                  echo "</div>";
                  echo "</div>";
                  echo "<button type='button' class='btn waves-effect' onclick='add({$row['F_Id']},$price_n,{$_SESSION['person_id']})'><a>Add To Cart</a></button>";
                $row=$obj->fetch();
                }
               }
            ?>
          </div>
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

    var price = document.getElementById("price");
    var price_val = parseFloat(price.innerHTML);
    var deluxe = parseFloat('8.50');
    var classic = parseFloat('7.50');

    $('#deluxe').click(function(){
      document.getElementById("price").innerHTML = deluxe ;
    });

    $('#classic').click(function(){
      document.getElementById("price").innerHTML = classic;

    });
    
      function menu(can_id){
        var canteen_id = can_id;
        window.location.href = "<?php print $site_root; ?>menu.php?canteen_id="+can_id;
      }
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
                      window.location.href = "<?php print $site_root; ?>cart.php";
                }
              }
              
        function add(food_id,price,person_id){
          var food_id = food_id;
          var qty = document.getElementById('qty_val').value;
          var price = price;
          var person_id = person_id;
          var url="<?php print $site_root; ?>functions.php?cmd=2&food_id="+food_id+"&qty="+qty+"&price="+price+"&person_id="+person_id;
          $.ajax(url,
            {async:true,complete:addComplete});
        }
    </script>
  </body>
</html>
