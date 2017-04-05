<?php
session_start();

//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		case 2:
			addtoCart();
		break;
		case 3:
			removefromCart();
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

function addtoCart(){
	$meal_id=$_REQUEST['meal_id'];
	$qty=$_REQUEST['qty'];
	$price=$_REQUEST['price'];

	include('objects.php');
	$obj=new object();
	$row=$obj->addtoCart($meal_id,$qty,$price);
	if($row==true){
		echo '{"result":0,"message":"Meal added to cart"}';
	}
	else{
			echo '{"result":1,"message":"Meal not added Cart"}';
		}
	}


function removefromCart(){
	$meal_id=$_REQUEST['meal_id'];
	include('objects.php');
	$obj=new object();
	$row=$obj->remove($meal_id);

	if($row==true){
		echo '{"result":0,"message":"Removed from cart"}';
	}
	else{
			echo '{"result":1,"message":"Meal not added Removed"}';
		}
	}
	

	
    			
?>
		