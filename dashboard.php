<?php
session_start();
  if(!isset($_SESSION['person']['pid'])){
    header("Location: index.php");
    exit();
  }
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
      <div data-role="page" id="dashboard" style="background:white">
        	<nav >
        		<div class="nav-wrapper" style="background:#ff9e80">
        			<a href="#" class="brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
        			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i>
              </a>
						<ul class="side-nav" id="mobile-demo">
							<li>
							   <div class="userView">
                    <!--<a href="#!name"><span class="black-text name">Sylvia Engmann</span></a>
                    <a href="#!email"><span class="black-text email">sylvia.engmann8@gmail.com</span></a>-->
                    <?php 
                            echo $_SESSION['person']['name'];
                            echo $_SESSION['person']['email'];
                    ?>
                  </div>
							</li>
        			<li><a href="#"><i class="material-icons">menu</i>Menu</a></li>
        			<li><a href="#"><i class="material-icons">settings</i>Settings</a>
              </li>
        			<li><a href="#"><i class="material-icons">help</i>Help</a>
              </li>
        		</ul>
            </div>
        	</nav>
        	 <div data-role="content">
              <div class="container">
                <div class="col s6 card-panel" style="">
                    <ul class="collection">
                      <?php
                          include('objects.php');
                            $obj=new object();
                            $result=$obj->getCafeteria();
                            if($result==false){
                              echo "result is false";
                            }else{
                              $row=$obj->fetch();
                              while($row){
                                echo "<li class='collection-item avatar'>";
                                echo "<span style:'margin-right:30cm'><center><img src='{$row['picture']}' style='width:150px;'></center></span>";
                                echo '<span style:"margin-right:2cm"><a href="#menu"><center><button class="btn waves-effect white">Menu</button></center></a></span>';
                                echo "</li>";
                                $row=$obj->fetch();


      //echo '<a href="http://35.166.18.143/~gifty.mate-kole/store/edit.php?pno='.$row['pno'].'&pname='.$row['pname'].'&qoh='.$row['qoh'].'&price='.$row['price'].'&olevel='.$row['olevel'].'"><button id="btn_menu" class="btn waves-effect waves-teal" style="margin-left:2em">Edit</button></a>';

      //echo "<span class='title' style='font-size:20px;margin-left:2em'>Order level: {$row['olevel']}</span>"; 

                              }
                            }
                      ?>
                    </ul>
                </div>
              </div><!--container-->  
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
	</body>
</html>
