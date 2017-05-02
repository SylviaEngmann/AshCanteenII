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
           <div class="container">
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
                              //$row=$obj->fetch();
                              $total = 0;
                              $s_total = 0;
							  $tmp_count = 0;
							  $order_json = "[";
                              while($row=$obj->fetch()){
                                echo "<input type='text' id ='can_fcm' value='{$row['fcm']}' hidden/>";
                                 $tmp_count +=1;
								 echo '<div class="col s6 card-panel">';
                                 echo '<table>';
                                 echo "<input type='text' id ='temp_id' value='{$row['temp_id']}' hidden/>";
                                 echo '<tr>';
                                 echo '<td width=30%>';
                                 echo "<span class='title' style='font-size:14px'>".$row['fName']."</span>";
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
								if($tmp_count > 1) { $order_json .=","; }
								$order_json .="{order_id:{$row['temp_id']},food_id:{$row['F_Id']},qty:{$row['qty']},price:{$row['price']},person_id:{$_SESSION['person_id']} }";
                                }
							  $order_json .= "]";
                               }
                            echo '<div class= "row">';
                            echo '<div class ="row col s6">';
                            echo '<div>Subtotal: </div>';
                            echo '<div id = "sub_total">'.$s_total.'</div></div></div>';
                            echo '<div class="row">';
                            echo '<div class ="row col s6">';
                            echo '<input name="type" type="radio" id="deli" value="delivery"/>';
                            echo '<label for="deli">Delivery</label></div>';
                            echo '<div class="row col s6">';
                            echo '<input name="type" type="radio" id="pick" value="pickup"/>';
                            echo '<label for="pick">Pickup</label></div></div> ';
                            
              echo '<div>Total :GHC</div>';
							 echo '<div id = "total">'.$total.'</div>';
								    echo '<div class="col s6">';
							echo "<center><input value='Checkout' type='button' class='btn-large waves-effect waves-light deep-orange' onclick='checkout_worker($order_json);'></center>";
							echo '</div>';
              unset($_SESSION['canteen_id']);
                    ?>                              
                </ul>
                <div class='row'>

                </div>
               </div><!--content-->
        </div><!-- /page -->

        
    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <script>
    // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCGdK6I94ELulY_4xSmVUHZRBqqQlsTrL8",
    authDomain: "capstone-project-applied-proj.firebaseapp.com",
    databaseURL: "https://capstone-project-applied-proj.firebaseio.com",
    projectId: "capstone-project-applied-proj",
    storageBucket: "capstone-project-applied-proj.appspot.com",
    messagingSenderId: "754159741664"
  };
  firebase.initializeApp(config);
</script>
    <script type="text/javascript">
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space

  var sub_total = document.getElementById("sub_total");
  var sub_total_val = parseFloat(sub_total.innerHTML);
  var delivery = parseFloat('2.00');

        $('#deli').click(function(){
          var new_total = sub_total_val + delivery;
          document.getElementById("total").innerHTML = new_total;
    });
    
        $('#pick').click(function(){
          var new_total = sub_total_val;
          document.getElementById("total").innerHTML = new_total;
        });
    
	function checkout_worker(list_of_orders)
	{
		for (var i =0; i < list_of_orders.length; i++) 
		{
			var item_order = list_of_orders[i];
			//total_price = total_price+item_order.price; 
			checkout(item_order.temp_id,item_order.food_id,item_order.qty,item_order.price,item_order.person_id);
			}
	}

  function checkoutComplete(xhr,status){
                if(status!="success"){
                    //divStatus.innerHTML="error sending request";
                    alert("error ");
                    return;
                }
                divStatus=xhr.responseText;
                var obj=JSON.parse(xhr.responseText);
        if(obj.result == 0)
        {
          alert(obj.message);
        }
        else if (obj.result == 1)
        {
          send_notification();
          alert(obj.message);
          alert("We're taking you to your orders page");
          window.location="<?php print $site_root; ?>viewOrders.php";
        }else{
          divStatus=obj.message;
        }
                currentObject=null;
            }
     
	
     function checkout(temp_id,F_Id,qty,price,person_id,order_type){
      var temp_id = temp_id;
      var F_Id = F_Id;
      var qty = qty;
      var price = price;
      var person_id = person_id;
      var order_type = $('input[type="radio"]:checked').val();

      var url="<?php print $site_root; ?>functions.php?cmd=5&temp_id="+temp_id+"&F_Id="+F_Id+"&qty="+qty+"&price="+price+"&person_id="+person_id+"&order_type="+order_type;
       $.ajax(url,{
                  async:true,complete:checkoutComplete
                });
     }

     function send_notification(){
      var can_fcm = document.getElementById('can_fcm').value;
      console.log(can_fcm);
      
       $.ajax({   
          type: "POST",  
          url: "send.php",  
          cache:false,  
          data:{
          can_fcm:can_fcm
          },
          dataType: "html",       
          success: function(response)  
          {   
          }   
        });  

     }


	</script>
  </body>
</html>
