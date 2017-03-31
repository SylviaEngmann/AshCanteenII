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
  <link rel="stylesheet" type="text/css" href="css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/component2.css" />
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
        <div data-role="page" id="menu" style="background:white">
          <nav >  
            <div class="nav-wrapper" style="background:#ff9e80">
                <a href="cart.php"><i class="right material-icons">shopping_cart</i></a>
                <a href="menu.php"><i class="left material-icons">back</i></a>
            </div> 
          </nav>
           <div data-role="content">
              <div class="container">
              <form>
                   <div class="input-field">
                    <input id="search" type="search" required>
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    </div>
                </form>
                
                      <?php
                          
                      ?>
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

                