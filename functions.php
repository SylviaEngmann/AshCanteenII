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
		case 4:
			add_review();
		break;
		case 5:
			place_order();
		break;	
		case 6:
			view_canteens();
		break;			
		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}
function view_menu(){
	$canteen_id=$_GET['can_Id'];
    $_SESSION['canteen_id']=$canteen_id;
	include('objects.php');
	$obj=new object();
	$result=$obj->getMeals($canteen_id);
	if($result==false){
		echo '{"result":0,"message":"Not found"}';
	}else{
		$row=$obj->fetch();
		echo '{"result":1 , "meal":[';
		while($row){
			echo json_encode($row);
			$row=$obj->fetch();
			if($row!=false){
                echo ",";
            }
        }
        echo "]}";
    }
}

function view_canteens(){
	include('objects.php');
	$obj=new object();
	$result=$obj->getCanteens();
	if($result==false){
		echo '{"result":0,"message":"Not found"}';
	}else{
		$row=$obj->fetch();
		echo '{"result":1 , "canteen":[';
		//$_SESSION['canteen_id']=$row['Id'];
		while($row){
			echo json_encode($row);
			$row=$obj->fetch();
			if($row!=false){
                echo ",";
            }
        }
        echo "]}";
    }
}

function place_order(){

	if(!isset($_REQUEST['F_Id'])){
				echo '{"result":0,"message":"Please choose a meal"}';
					return;
				}
			if(!isset($_REQUEST['qty'])){
				echo '{"result":0,"message":"Please specify quantity"}';
					return;
				}
	
			if($_REQUEST['price'] == ""){
				echo '{"result":0,"message":"Please select meal type"}';
					return;
				}
    $temp_id=$_REQUEST['temp_id'];			
	$food_id=$_REQUEST['F_Id'];
	$qty=$_REQUEST['qty'];
	$price=$_REQUEST['price'];
	$person_id = $_REQUEST['person_id'];
	$order_type=$_REQUEST['order_type'];

	include('objects.php');
	$obj=new object();
    $obj1=new object();

	$row=$obj->place_order($person_id,$food_id,$qty,$price,$order_type);
	$row1=$obj1->delete_order($temp_id);

	if($row==true){
		echo '{"result":1,"message":"Order Placed"}';
	}
	else {
		echo '{"result":0,"message:"Order not placed"}';
	}

}

function add_review(){
	$food_id=$_REQUEST['food_id'];
	$review=$_REQUEST['review'];
	$rating=$_REQUEST['rating'];

	include('objects.php');
	$obj=new object();
	$row=$obj->addReview($food_id,$review,$rating);
	
	if($row==true){
		echo '{"result":1,"message":"Review added"}';
	}

	else{
		echo '{"result":0,"message":"Review not completed"}';
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
		echo '{"result":1,"message":"You have been registered"}';
	}

	else{
		echo '{"result":0,"message":"You have not been added"}';
	}
}

function addtoCart(){
	$F_Id=$_REQUEST['food_id'];
	$qty=$_REQUEST['qty'];
	$price=$_REQUEST['price'];
	$person_id = $_REQUEST['person_id'];
	//echo $person_id;
	include('objects.php');
	$obj=new object();
	$row=$obj->addtoCart($F_Id,$qty,$price,$person_id);
	if($row==true){
		echo '{"result":1,"message":"Meal added to cart"}';
	}
	else{
		echo '{"result":0,"message":"Meal not added to Cart"}';
		}
	}


function removefromCart(){
	$F_Id=$_REQUEST['F_Id'];
	include('objects.php');
	$obj=new object();
	$row=$obj->remove($F_Id);

	if($row==true){
		echo '{"result":1,"message":"Removed from cart"}';
	}
	else{
			echo '{"result":0,"message":"Meal not removed"}';
		}
	}
?>
		