<?php include "config.php"; 
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
	<body onload='requestPermission()'>
        	<nav >
        		<div class="nav-wrapper" style="background:#ff9e80">
        			<a href="#" class="brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
        			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i>
              </a>
						<ul class="side-nav" id="mobile-demo">
							<li>
							   <div class="userView">
                    <?php echo "<span class='black-text'>{$_SESSION['username']}</span>";?>
                  </div>
							</li>

        			<li><a href="<?php print $site_root; ?>viewOrders.php"><i class="material-icons">menu</i>Orders</a></li>
              <li><a href="<?php print $site_root; ?>user_account.php"><i class="material-icons">account_circle</i>Account</a></li>
        			<li><a href="#"><i class="material-icons">settings</i>Settings</a>
              </li>
        			<li><a href="#"><i class="material-icons">help</i>Help</a>
              </li>
              <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Log out</a>
              </li>
        		</ul>
            </div>
        	</nav>
              <div class="container">
                    <ul class="collection">
                      <?php
                          include('objects.php');
                            $obj=new object();
                            $result=$obj->getCanteens();
                            if($result==false){
                              echo "result is false";
                            }else{
                              $row=$obj->fetch();
                              while($row){
                                echo "<div class='col s6 card-panel'>";
                                echo "<span style:'margin-right:30cm'><center><img src='{$image_folder}{$row['Picture']}' style='width:150px;'></center></span>";
								echo "<span style:'margin-right:2cm'><center><button class=\"btn waves-effect white\" onclick=\"menu({$row['Id']})\"><a class='black-text'>Menu</a></button></center></span></div>";
                                $row=$obj->fetch();
                              }
                            }
                      ?>
                    </ul>
                </div>
              </div><!--container-->  
     
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
		<script src="scripts/jquery.js"></script>
		<script src="scripts/materialize.min.js"></script>
		<script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script type="text/javascript">
      var config = {
    apiKey: "AIzaSyCQJAXYH2tfABXZGHV03C6T21TltFosTNo",
    authDomain: "order-48f1f.firebaseapp.com",
    databaseURL: "https://order-48f1f.firebaseio.com",
    projectId: "order-48f1f",
    storageBucket: "order-48f1f.appspot.com",
    messagingSenderId: "627691006531"
  };

  firebase.initializeApp(config);

  const messaging = firebase.messaging();
  const tokenDivId = 'token_div';
  const permissionDivId = 'permission_div';

  messaging.onTokenRefresh(function() {
    messaging.getToken()
    .then(function(refreshedToken) {
      console.log('Token refreshed.');
      setTokenSentToServer(false);
      sendTokenToServer(refreshedToken);
      
      resetUI();
    })
    .catch(function(err) {
      console.log('Unable to retrieve refreshed token ', err);
    });
  });
  
  messaging.onMessage(function(payload) {
    // console.log("Message received. ", payload);
    var audioElement = document.createElement('audio');
  audioElement.setAttribute('src', 'sms-alert-2-daniel_simon.mp3');
  audioElement.play();
  });

  function resetUI() {    
    messaging.getToken()
    .then(function(currentToken) {
      if (currentToken) {
        sendTokenToServer(currentToken);
        upd(currentToken);    
      } else {
        console.log('No Instance ID token available. Request permission to generate one.');
        setTokenSentToServer(false);
      }
    })
    .catch(function(err) {
      console.log('An error occurred while retrieving token. ', err);
      setTokenSentToServer(false);
    });
  }
  
  function upd(currentToken){
      var username= "<?php echo $_SESSION['username']; ?>";
      console.log(currentToken);

    $.ajax({   
          type: "POST",  
          url: "fcm.php",  
          cache:false,  
          data:{
          token:currentToken,
          username:username
          },
          dataType: "html",       
          success: function(response)  
          {   
          }   
        });  
  }
  
  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }
  }
  function isTokenSentToServer() {
    if (window.localStorage.getItem('sentToServer') == 1) {
          return true;
    }
    return false;
  }
  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
  }
 
  function requestPermission() {
    console.log('Requesting permission...');
    messaging.requestPermission()
    .then(function() {
      console.log('Notification permission granted.');
      
      resetUI();
    })
    .catch(function(err) {
      console.log('Unable to get permission to notify.', err);
    });
  }
   resetUI();
    </script>
    
		<script>
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space
    </script>
    <script type="text/javascript">
      function menu(can_id){
        var canteen_id = can_id;
        window.location.href = "<?php print $site_root; ?>menu.php?canteen_id="+canteen_id;
      }
    </script>      
	</body>
</html>
