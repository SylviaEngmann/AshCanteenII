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
       <div class = "container">
                <center><img src="<?php print $image_folder; ?>app_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
                <!--<div id='loading' style='display: none'><img src="loading.gif" title="Loading" /></div>-->
                <div class = "container">
                  <div class="row">
                        <form method="get" action="login_page.php" class="col s12">
                                <div class="row">
                                  <div class="input-field">
                                    <input placeholder="Username" type="text" id="username" name="username" class="validate">
                                    </div>
                                  <div class="input-field">
                                    <input placeholder="Password" type="password" id="pword" name="password" class="validate">
                                    </div>
                                    </div>
                        </form>   
                        <div class="row">
                        <div class="col s12">
                        <center><button class="btn-large waves-effect waves-light deep-orange" id="btnlogin" type="submit" name="action"><a class="white-text">Log in</a></button></center>
                        </div>
                        </div>
                  </div>
                </div>
                <br><br>
                <div class="row">
                          <div class="col s6 left">
                            <button class="btn-small waves-effect waves-light deep-orange" id="back"><a href="<?php print $site_root; ?>index.php" class="white-text">Go Back</a></button>
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
      <script>
      document.getElementById ("btnlogin").addEventListener ('click', login, false);
        function loginComplete(xhr,status){
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
				else if (obj.row <= 0)
				{
					alert(obj.message);
				}
				else if(obj.row>0){
                    //divStatus.innerHTML= "Log in Success";
                      alert("Log in Success");
                      //window.location="dashboard.php";
                      window.location="<?php print $site_root; ?>dashboard.php";
					
                }else{
                    divStatus=obj.message;
                }
				//alert(xhr.responseText);
                currentObject=null;
            }
            
            function login()
            {
              var username = document.getElementById("username").value;
              var password = document.getElementById("pword").value;

                var url = "<?php print $site_root; ?>login.php?username="+username+"&password="+password;

                //var loadingdiv = document.getElementById('loading');
                //loadingdiv.style.display = "block";
                $.ajax(url,{
                  async:true,complete:loginComplete
                });
                //var loadingdiv = document.getElementById('loading');
                //loadingdiv.style.display = "none";    
            }
        
        </script>    
		
	</body>
</html>
