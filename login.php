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
			
			$username=$_REQUEST['username'];
			$password=$_REQUEST['password'];

			include('objects.php');
			$obj=new object();
			$result=$obj->login($username, $password);
			$result=$obj->fetch();
			if(!$result){
				$response='<div style="position:absolute; top:300px; font-size:25px; color:red; margin-left:41%;">Username or Password is wrong.</div>';
               echo $response;
           	}else{
           			session_start();
           			$_SESSION['person']=$result;
				header("Location:dashboard.php");
				}
?>          