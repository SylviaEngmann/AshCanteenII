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

  <style>
  	.rating {
  		position: relative;
  		top: 2px;
  		float: right;
  		margin: 0;
  		padding: 0;
  	}
  	.rating li.rated {
  		float: left;
  		display: block;
  		height: 16px;
  		width: 16px;
  		margin-left: 5px;
  		content: url("/AshCanteenII/images/star.png") no-repeat 0 0;
  	}
  	 .rating li.rated {
  	 	background-position: 0px -16px;
  	 }
  </style>
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
              <a href="cart.php" class="right">
              <span class="badge" id="comparison-count"></span><i class="material-icons">shopping_cart</i>
              </a> 
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
           <?php
                           $canteen_id=$_GET['canteen_id'];
                           $food_id=$_REQUEST['food_id'];
                           $_SESSION['canteen_id']=$canteen_id;
                           include('objects.php');
                            $obj=new object();
                            $result=$obj->getFood($food_id);
                            if($result==false){
                              echo "'$result' is false";
                            }else{
                              $row=$obj->fetch();
                              while($row){
                                echo "<img src='{$image_folder}{$row['Picture']}' style='width:300px;height:200px;'>";
                                echo "<h5><center><b>{$row['fName']}</b></center></h5>";
                                $row=$obj->fetch();
                            }
                        }
            ?>                                      
           <div class="row">
           <div id="response"></div>
           <div id="view"></div>
           		<form class="col s12">
           			<div class="row">
           				<div class="input-field col s12">
           					<textarea id="textarea1" class="materialize-textarea"></textarea>
           				</div>
           			</div>
           		</form>
            </div>
           <div class="row">		
           	<div class="details">
           		<!--<span class=”time”>12 hours ago</span>-->
           		<ul class="rating">
           			<li class="rated"></li>
           			<li class="rated"></li>
           			<li class="rated"></li>
           			<li class="rated"></li>
           			<li class="rated"></li>
           		</ul>
           	</div>
           </div>	
           		<button id = "btn-review" class="waves-effect waves-light btn">Submit Review</button>
           </div><!--content-->
           </div><!--page-->

	<script src="scripts/jquery.js"></script>
	<script src="scripts/materialize.min.js"></script>
	<script src="scripts/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" src="scripts/platformOverrides.js"></script>
	<script>
		$('#textarea1').val('New Text');
		$('#textarea1').trigger('autoresize');

		document.getElementById('btn-review').addEventListener('click',add_review,false);

		function add_reviewComplete(xhr,status){
          if(status!="success"){
            alert("Error");
            return;
          }
          divStatus=xhr.responseText;
          var obj=JSON.parse(xhr.responseText);
          if(obj.result==0){  
                     alert(obj.message);
                }else{
                      document.getElementById("response").innerHTML = obj.message;
                      //window.location.href = "<?php print $site_root; ?>cart.php";
                }
              }
              
        function add_review(){
          var food_id = food_id;
          var review = document.getElementById('textarea1').value;
          //var rating =
          var url="<?php print $site_root; ?>functions.php?cmd=4&food_id="+food_id+"&review="+review;
          //+"&rating="+rating;
          $.ajax(url,
            {async:true,complete:add_reviewComplete});
      }
	</script> 
 </body>
 </html>