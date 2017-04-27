<?php include "config.php"; ?>
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
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
              <div class="container">
                <center><img src="<?php print $image_folder; ?>app_logo.png" width="200" height="200" alt="Bon Appetit"></center>
                </div>
                <div class ="container">
                  <div class="section">                           
                		<div class="row">
								      <div class="col s6">
                          <button class="btn waves-effect waves-light deep-orange" name="action" id="fixed-btn"><a class="white-text" href="<?php print $site_root; ?>login_page.php">Log in</a>
                          </button>
                      </div>
                      <div class="col s6">
                          <button class="btn waves-effect waves-light deep-orange" name="action" id="fixed-btn"><a class="white-text" href="<?php print $site_root; ?>signup.php">Sign Up</a></button>
                      </div>
                    </div>
                  </div>
                
		<script src="scripts/jquery.js"></script>
		<script src="scripts/materialize.min.js"></script>
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
