<?php
//session_start();

/**
*/
include_once("db_connect.php");
/**
*Objects class
*/
class object extends db_connect{
	function object(){
	}
    /*This function takes in the entered parameters and enters them in the database*/
    function addUser($firstname, $lastname,$username,$password,$email){
		$strQuery="insert into person
						(firstname,lastname,username,password,email)
						VALUES('$firstname','$lastname','$username',MD5('$password'),'$email')";
		return $this->query($strQuery);
		}	
	
	function login($username,$password){
		$strQuery="select * from person where username like '$username' and password like MD5('$password')";
		return $this->query($strQuery);
	}
	function getCanteens(){
		$strQuery="SELECT * from canteens";
		return $this->query($strQuery);
	}
	
	function getMeals($canteen_Id){
		$strQuery="select menu.Id,menu.F_Id,foodlist.fName,foodlist.Description,foodlist.Picture,foodlist.canteen from menu inner join foodlist on menu.F_Id = foodlist.Id where can_Id= '$canteen_Id'";
		return $this->query($strQuery);
	}
	function getFood($food_id){
		$strQuery="select menu.Id,menu.F_Id,foodlist.fName,foodlist.Description,foodlist.Picture,foodlist.canteen from menu inner join foodlist on menu.F_Id =foodlist.Id where F_Id= '$food_id'";
		return $this->query($strQuery);
	}

	function addtoCart($F_Id,$qty,$price,$person_id){
		$strQuery="INSERT into temp_orders
					(F_Id,qty,price,pid)
					VALUES('$F_Id','$qty','$price','$person_id')";
		return $this->query($strQuery);
	}
	
	function remove($F_Id){
		$strQuery="DELETE from temp_orders where F_Id='$F_Id'";
		return $this->query($strQuery);
	}
	function getOrders($pid){
		$strQuery="select temp_orders.F_Id,foodlist.fName,temp_orders.qty, temp_orders.price from temp_orders 
		join foodlist on temp_orders.F_Id=foodlist.F_Id where pid='$pid'";
		return $this->query($strQuery);
	}
}
?>
 