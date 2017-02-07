<?php

	session_start();
	if(!isset($_SESSION['person']['pid'])){
		header("Location: index.php");
		exit();
	}

//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}
function addUser(){
	if(!isset($_REQUEST['name'])){
		echo '{"result":0,"message":"Please enter name"}';
		return;
	}
	$name=$_REQUEST['name'];
	$username=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	include('objects.php');
	$obj=new object();
	$row=$obj->addUser($name, $username, $email, $password);

	if(!$row==true){
		echo '{"result":0,"message":"User not added"}';
	}

	else{
		echo '{"result":1,"message":"User added"}';
	}

}

}
?>
			$row=$result->fetch_assoc();
			
			
			if(!$row){
				$response='<div style="position:absolute; top:300px; font-size:25px; color:red; margin-left:41%;">Username or Password is wrong.</div>';
				echo $response;
			}else{
				session_start();
				$_SESSION['user']=$row;
				header("Location:http://52.89.116.249/~gifty.mate-kole/carpool/index1.html");
			