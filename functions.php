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
	if(!isset($_REQUEST['fname'])){
		echo '{"result":0,"message":"Please enter firstname"}';
		return;
	}
	$firstname=$_REQUEST['fname'];
	$lastname=$_REQUEST['lname'];
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	$email=$_REQUEST['email'];

	include('objects.php');
	$obj=new object();
	$row=$obj->addUser($firstname,$lastname,$username,$password,$email);

	if($row==true){
		echo '{"result":0,"message":"You have been registered"}';
	}

	else{
		echo '{"result":1,"message":"You have not been added"}';
	}
}

function addtoCart(){
	$meal_id=$_REQUEST['meal_id'];
	$qty=$_REQUEST['qty'];
	$price=$_REQUEST['price'];
	$person_id = $_REQUEST['person_id'];
	//echo $person_id;
	include('objects.php');
	$obj=new object();
	$row=$obj->addtoCart($F_Id,$qty,$price,$person_id);
	if($row==true){
		echo '{"result":0,"message":"Meal added to cart"}';
	}
	else{
		echo '{"result":1,"message":"Meal not added to Cart"}';
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
		