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
        <div data-role="page" id="initpage" style="background:white">
              <div data-role="content">
              <div class="container">
                <center><img src="app_logo.png" width="200" height="200" alt="Bon Appetit"></center>
                </div>
                <div class ="container">
                  <div class="section">                           
                		<div class="row">
								      <div class="col s6">
                          <button class="btn-small waves-effect waves-light deep-orange" name="action" id="fixed-btn"><a class="white-text" href="#loginpage">Log in</a>
                          </button>
                      </div>
                      <div class="col s6">
                          <button class="btn-small waves-effect waves-light deep-orange" name="action" id="fixed-btn"><a class="white-text" href="#signup">Sign Up</a></button>
                      </div>
                    </div>
                  </div>
                </div><!--container-->
              </div><!--content-->
        </div><!-- /page -->

    <div data-role="page" id="loginpage" style="background:white">
                <div data-role="content">
                <center><img src="app_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
                <!--<div id='loading' style='display: none'><img src="loading.gif" title="Loading" /></div>-->
                <div class = "container">
                  <div class="row">
                        <form method="get" action="#loginpage" class="col s12">
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
                        <button class="btn-large waves-effect waves-light deep-orange" id="btnlogin" type="submit" name="action"><a class="white-text">Log in <i class="material-icons right">send</i></a>
                        </button>
                        </div>
                        </div>
                  </div>
                </div>
                </div><!--content-->
        </div><!-- /page -->

    <div data-role="page" id="signup" style="background:white">
                <div data-role="content">
                <center><img src="app_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
                <p3 class="black-text"><center><strong>Enter Your Details</strong></center></p3>
                <div class="row">
                        <form method="get" action="#signup" class="col s12">
                                <div class="row">
                                <div class="input-field">
                                        <input placeholder="First Name" id="fname" type="text" name="fname" class="validate" required>
                                  </div>
                                	<div class="input-field">
                                    		<input placeholder="Last Name" id="lname" type="text" name="lname" class="validate" required>
                                  </div>
                                  <div class="input-field">
                                        <input placeholder="Preferred Username" id="sign_username" type="text" name="username" class="validate" required>
                                  </div>
                                  <div class="input-field">
                                    		<input placeholder="Password" type="password" id="sign_pword" name="password" class="validate" required>
                                  </div>
                                  <div class="input-field">
                                        <input placeholder="Email" type="text" id="email" name="mail" class="validate" required>
                                  </div>
                                </div>
                				<div class="row">
								          <div class="col s12">
                            <button class="btn-large waves-effect waves-light deep-orange" id="btnsignup" type="submit" name="action"><a class="white-text">Register<i class="material-icons right">send</i>
                            </a>
                            </button>
                            </div>
                        </div>
                    	</form>
                </div>
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
      <script>
      document.getElementById ("btnlogin").addEventListener ('click', login, false);
      document.getElementById ("btnsignup").addEventListener ('click', signup, false);

        function signupComplete(xhr,status){
                if(status!="success"){
                    //divStatus.innerHTML="error sending request";
					alert('Error sending request');
                    return;
                }
                divStatus=xhr.responseText;
                //alert(xhr.responseText);
                var obj=JSON.parse(xhr.responseText);
                if(obj.result==0){
                  divStatus.innerHTML=obj.message;  
                     alert(obj.message);
                }else{
                      alert("You've been added");
                      alert("Please log in now");
                }
                //window.location="#loginpage";
                currentObject=null;
            }
        
      
            function signup()
            {
              var fname = document.getElementById("fname").value;
              var lname = document.getElementById("lname").value;
              var username = document.getElementById("sign_username").value;
              var password = document.getElementById("sign_pword").value;
              var email = document.getElementById("email").value;
              
              var url = "<?php print $site_root; ?>functions.php?cmd=1&fname="+fname+"&lname="+lname+"&username="+username+"&password="+password+"&email="+email;
              $.ajax(url,
                    {async:true,complete:signupComplete}
                    );   
            }

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
