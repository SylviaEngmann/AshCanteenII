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
                <center><img src="<?php print $image_folder; ?>app_logo.png" width="150" height="150" alt="Bon Appetit"></center>
                </br>
                <p3 class="black-text"><center><strong>Enter Your Details</strong></center></p3>
                <div class="row">
                        <form method="get" action="<?php print $site_root; ?>signup.php" class="col s12">
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
                            <center><button class="btn-large waves-effect waves-light deep-orange" id="btnsignup" type="submit" name="action"><a class="white-text">Register</a></button></center>
                            </div>
                        </div>
                      </form>
                </div>
                <br><br>
                <div class="row">
                          <div class="col s6 left">
                            <button class="btn-small waves-effect waves-light deep-orange" id="back"><a href="<?php print $site_root; ?>index.php" class="white-text">Go Back</a>
                            </button>
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
                window.location="<?php print $site_root; ?>login_page.php";
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
        </script>    
    
  </body>
</html>
