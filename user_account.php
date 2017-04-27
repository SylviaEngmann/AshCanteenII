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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

    //function drawChart() {
     // var jsonData = $.ajax({
          //url: "user_data.php",
          //dataType: "json",
          //async: false
          //}).responseText;
          
      // Create our data table out of JSON data loaded from server.
      //var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      //var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      //chart.draw(data, {width: 400, height: 300});
    //}

    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
    </script>
  </head>
  <body>
          <nav >
            <div class="nav-wrapper" style="background:#ff9e80">
              <a href="#" class="center brand-logo"><span class="white-text">Bon Appetit</span>
              </a>
              <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i>
              </a>
            <ul class="side-nav" id="mobile-demo">
              <li>
                 <div class="userView">
                    <?php echo "<span class='black-text'>{$_SESSION['username']}</span>";?>
                 </div>
              </li>
              <li><a href="dashboard.php"><i class="material-icons">menu</i>Dashboard</a></li>
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
              
              <?php
                  $pid = $_SESSION['person_id'];
                    include('objects.php');
                        $obj=new object();
                        $result=$obj->viewUser($pid);
                          if($result==false){
                              echo "'$result' is false";
                            }
                            else{
                              while($row=$obj->fetch()){
                                 echo "<center>";
                                 echo "<div class='col s6 card-panel'>";
                                 echo '<span style="font-size:14px">'.$row['firstname'].'</span>';
                                 echo '<span style="font-size:14px">'.$row['lastname'].'</span>';
                                 echo "<div style='font-size:14px'>".$row['username']."</div>"; 
                                 echo "</div>";
                                 echo "</center>";
                                $row=$obj->fetch();
                              }
                            }
                    ?> 

                <div id="piechart" style="width: 400px; height: 300px;"></div>
                <div id="chart_div"></div>             
             
               </div>

    <script src="scripts/jquery.js"></script>
    <script src="scripts/materialize.min.js"></script>
    <script type="text/javascript" src="scripts/platformOverrides.js"></script>
    <script type="text/javascript">
        (function($){
            $(function(){

                $('.button-collapse').sideNav();

             }); // end of document ready
        })(jQuery); // end of jQuery name space
    </script>
  </body>
</html>
