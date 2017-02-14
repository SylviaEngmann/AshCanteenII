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
               	echo '{"result":0,"message":"Username or Password is wrong"}';

           	}else{
           			session_start();
           			$_SESSION['person']=$result;
				//header("Location:dashboard.php");
				header("Location:http://35.166.18.143/~sylvia.engmann/applied/dashboard.php");
				}
?>          