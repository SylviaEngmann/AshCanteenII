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
			getCart();
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
$cart_array;

function addtoCart(){
	$meal_id=$_REQUEST['meal_id'];
	include('objects.php');
	$obj=new object();
	$result=$obj->getMeal($meal_id);

	$_SESSION['cart'];

	$cart_array = array('meal_id'=>$meal_id);
		if(!isset($_SESSION['cart'])){
    		$_SESSION['cart'] = array();
    	}
    	if(array_key_exists($meal_id, $_SESSION['cart'])){
    		echo '{"result":0,"message":"Meal Not Added: It already is in the cart"}';
    		}
    		else{
    			$_SESSION['cart'][$meal_id]=$cart_array;
    			echo '{"result":1,"message":"Meal Added to Cart"}';
    		}
    	}

	function getCart(){                
		$cart_array=$_SESSION['cart'];    
        $items = $cart_array;
        //print json_encode($items);
        echo json_encode($items);
        if($items!=false){
                echo ",";
            }
        else 
        {
        	echo " ";
        }    
    }

                    
			
?>
		