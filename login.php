<?php
			if(!isset($_REQUEST['username'])){
				echo '{"result":0,"message":"Please enter username"}';
					return;
				}
			if(!isset($_REQUEST['password'])){
				echo '{"result":0,"message":"Please enter password"}';
					return;
				}
	
			if($_REQUEST['username']==""){
				echo '{"result":0,"message":"Please enter username"}';
					return;
				}
			if($_REQUEST['password']==""){
				echo '{"result":0,"message":"Please enter password"}';
					return;
				}

			session_start();

			$username=$_REQUEST['username'];
			$password=$_REQUEST['password'];

			$_SESSION['username']=$username;

			include('objects.php');
			$obj=new object();
			$row=$obj->login($username, $password);
			$row=$obj->fetch();
			if(!$row){
              echo '{"row":0,"message":"Username or Password is wrong"}';
           	}
           	else{
           			//session_start();
           			//$_SESSION['person']=$row;
           		$_SESSION['username']=$username;
           		 echo '{"row":1,"message":"Log in success"}';
				//header("Location:dashboard.php");
				//header("Location:http://35.166.18.143/~sylvia.engmann/applied/AshCanteen/dashboard.php");
				}
?>          