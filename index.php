<!--<?php
//session_start();
  //if(!isset($_SESSION['person']['pid'])){
    //header("Location: index.php");
    //exit();
  //}
  ?>-->

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
        <div data-role="page" id="initpage" style="background:white">
              <div data-role="content">
              <div class="container">
                <center><img src="my_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </div>
                <div class ="container">
                  <div class="section">                           
                		<div class="row">
								      <div class="col s12 s4">
                        <div class="row center">
                          <button class="btn-small waves-effect waves-light deep-orange" name="action" id="fixed-btn"><a class="white-text" href="#loginpage">Log in</a>
                          </button>
                          <button class="btn-small waves-effect waves-light deep-orange" name="action" id="fixed-btnn"><a class="white-text" href="#signup">Sign Up</a></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!--container-->
              </div><!--content-->
        </div><!-- /page -->

    <div data-role="page" id="loginpage" style="background:white">
                <div data-role="content">
                <center><img src="my_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
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
                        <button class="btn-large waves-effect waves-light deep-orange" onclick="login()" type="submit" name="action"><a class="white-text">Log in <i class="material-icons right">send</i></a>
                        </button>
                        </div>
                        </div>
                  </div>
                </div>
                </div><!--content-->
        </div><!-- /page -->

    <div data-role="page" id="signup" style="background:white">
                <div data-role="content">
                <center><img src="my_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
                <p3 class="black-text"><center><strong>Enter Your Details</strong></center></p3>
                <div class="row">
                        <form method="get" action="#signup" class="col s12">
                                <div class="row">
                                	<div class="input-field">
                                    		<input placeholder="Your Name" id="name" type="text" name="name" class="validate" required>
                                  </div>
                                  <div class="row">
                                  <div class="input-field">
                                        <input placeholder="Preferred Username" id="username" type="text" name="username" class="validate" required>
                                  </div>
                                  <div class="input-field">
                                    		<input placeholder="Email" type="text" id="email" name="mail" class="validate" required>
                                  </div>
                                  <div class="input-field">
                                    		<input placeholder="Password" type="password" id="pword" name="password" class="validate" required>
                                  </div>
                                </div>
                				<div class="row">
								          <div class="col s12">
                            <button class="btn-large waves-effect waves-light deep-orange" onclick="signup()" type="submit" name="action"><a class="white-text">Register<i class="material-icons right">send</i>
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
        function signupComplete(xhr,status){
                if(status!="success"){
                    divStatus.innerHTML="error sending request";
                    return;
                }
                divStatus=xhr.responseText;
                var obj=JSON.parse(xhr.responseText);
                if(obj.result==0){
                    divStatus=obj.message;
                     alert(obj.message);
                }else{
                    divStatus.innerHTML= "You've been added";
                      alert("You've been added");
                      alert("Please log in now");
                }
                window.location="#loginpage";

            currentObject=null;
            }
            
            function signup()
            {
              var name = document.getElementById("name").value;
              var username = document.getElementById("username").value;    
              var email = document.getElementById("email").value;
              var password = document.getElementById("pword").value;

                //$.ajax("http://52.89.116.249/~sylvia.engmann/ridealong/signin.php?username="+username+"&password="+password,{async:true,complete:loginComplete});
                
                $.ajax("functions.php?cmd=1&name="+name+"&username="+username+"&email="+email+"&password="+password,
                    {async:true,complete:signupComplete}
                    );   
            }

        function loginComplete(xhr,status){
                if(status!="success"){
                    divStatus.innerHTML="error sending request";
                    return;
                }
                divStatus=xhr.responseText;
                var obj=JSON.parse(xhr.responseText);
                if(obj.result==0){
                    divStatus=obj.message;
                }else{
                    divStatus.innerHTML= "Log in Success";
                      alert("Log in Success")
                }
                window.location="dashboard.php";

            currentObject=null;
            }
            
            function login()
            {
              var username = document.getElementById("username").value;
              var password = document.getElementById("pword").value;

                //$.ajax("http://52.89.116.249/~sylvia.engmann/ridealong/signin.php?username="+username+"&password="+password,{async:true,complete:loginComplete});
                
                $.ajax("login.php?username="+username+"&password="+password,
                    {async:true,complete:loginComplete}
                    );    
            }
        
        </script>    
		
	</body>
</html>