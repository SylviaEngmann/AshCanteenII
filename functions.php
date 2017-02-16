<?php

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
		echo '{"result":0,"message":"You have not been added"}';
	}

	else{
		echo '{"result":1,"message":"You have been registered"}';

	}

}
?>
		