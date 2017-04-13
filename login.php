<?php

			session_start();
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


			$username=$_REQUEST['username'];
			$password=$_REQUEST['password'];

			unset($_SESSION['username']);
			unset($_SESSION['person_id']);
			include('objects.php');
			$obj=new object();
			$row=$obj->login($username, $password);
			$row=$obj->fetch();
			$person_id =$row['pid'];
			//print_r($person_id);
			$_SESSION['person_id']=$person_id;
			//print_r($_SESSION['person_id']);
			if($row){
				$_SESSION['username']=$username;
				$_SESSION['person_id']=$person_id;
				//print_r($_SESSION['person_id']);

				//echo $_SESSION['person_id'];
           		//$_SESSION['person_id']=$person_id;
           		//var_dump($_SESSION['person_id']);
           		 echo '{"row":1,"message":"Log in success"}';
           		}
           	else{
           		echo '{"row":0,"message":"Username or Password is wrong"}';
           		}
?>          