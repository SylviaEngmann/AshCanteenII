<?php

	$username=$_REQUEST['username'];
	$token=$_REQUEST['token'];
	
	include('objects.php');
	$obj=new object();
	$row=$obj->setToken($username,$token);
	if($row==true){
		echo '{"result":1,"message":"token set"}';
	}
	else {
		echo '{"result":0,"message:"token not set"}';
	}
?>