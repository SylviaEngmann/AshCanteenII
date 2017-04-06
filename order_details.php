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
        <div data-role = "page" id="meal_details" style = "background:white">
          <nav >
            <div class="nav-wrapper" style="background:#ff9e80">
              <a href="menu.php" class="left"><i class="material-icons">reply</i></a>
              <a href="#" class="center brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
              <a href="cart.php" class="right">
              <span class="badge" id="comparison-count"></span><i class="material-icons">shopping_cart</i>
              </a> 
          </div>
          </nav>
          <div data-role = "content">
            <?php
              $meal_id=$_REQUEST['meal_id'];
              include('objects.php');
               $obj = new object();
               $result=$obj->getMeal($meal_id);
               if($result==false){
                 echo "'$result' is false";
               }
               else{
                $row=$obj->fetch();
                while($row){
                  echo "<img src='{$row['picture']}' style='width:300px;height:200px;'>";
                  echo "<h3><b>{$row['meal_name']}</b></h3>";
                  echo "<p3>{$row['description']}</p3>";
                  echo "<br>";
                  echo "<span>";
                  echo "<p4>Price: {$row['price']} </p>";
                  echo "</span>";
                  echo "<br>";
                  echo "<div class = 'row'>";
                  //echo "<div class = 'col s4'>";
                  //echo "<button type='button' class='btn-number btn-floating btn-small waves-effect waves-light deep-orange lighten-1' data-type='plus' data-field='quant[1]'><i class='material-icons'>add</i></button>";
                  //echo "</div>";
                  //echo "<div class = 'col s4'>";
                  //echo "<input type='text' id='qty_val' name='quant[1]'' class='form-control input-number' value='1' min='1' max='100' style=''>";
                  //echo "</div>";
                  echo "<p4><b>Quantity</b></p4>";
                  echo "<div class='input-field col s4'>";
                  echo "<input id='qty_val' type='number' value='1' min='1' max='100' class='validate'>";
                  echo "</div>";
                  //echo "<div class = 'col s4'>";
                  //echo "<button type='button' class='btn-number btn-floating btn-small waves-effect waves-light deep-orange lighten-1' data-type='minus' data-field='quant[1]'><i class='material-icons'>remove</i></button>"; 
                  echo "</div>";
                  //echo "</div>";
                  echo "<button type='button' class='btn waves-effect light deep-orange lighten-1' onclick='add({$row['meal_id']},{$row['price']})'><a><i class='material-icons'>shopping_cart</i></a></button>";
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
              
        function add(meal_id,price){
          var meal_id = meal_id;
          var qty = document.getElementById('qty_val').value;
          var price = price;

          var url="functions.php?cmd=2&meal_id="+meal_id+"&qty="+qty+"&price="+price;
          alert(url);
          $.ajax(url,
            {async:true,complete:addComplete});
        }
    </script>        
  </body>
</html>
