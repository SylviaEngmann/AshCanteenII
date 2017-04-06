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
			//$person_id =$row['pid'];
			//print_r($row['pid']);
			//echo $person_id;
			//$_SESSION['person_id']=$person_id;
			if($row){
				//$_SESSION['person']=$row;
				//print_r($_SESSION['person']);
				$_SESSION['username']=$username;
           		//$_SESSION['person_id']=$row['pid'];
           		 echo '{"row":0,"message":"Log in success"}';
           		}
           	else{
           		echo '{"row":1,"message":"Username or Password is wrong"}';
           		}
?>          