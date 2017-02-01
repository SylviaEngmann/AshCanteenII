<?php
//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		case 2:
			login();
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

function login(){
	if(!isset($_REQUEST['username'])){
		echo '{"result":0,"message":"Please enter email"}';
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
	$row=$obj->login($username, $password);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"user":';
		echo json_encode($row);
		echo "}";
	}
	else{
		echo '{"result":0,"message":"Login failed"}';
	}
}
?>
