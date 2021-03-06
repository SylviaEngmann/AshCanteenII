<?php
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
		/*print ("\n<div>$strQuery</div>");*/
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
		$strQuery="select menu.Id,menu.F_Id,foodlist.fName,foodlist.Description,foodlist.Picture,foodlist.canteen from menu inner join foodlist on menu.F_Id = foodlist.Id where can_Id= '$canteen_Id' AND menu.category = 1";
		return $this->query($strQuery);
	}
	function getFood($food_id){
		$strQuery="select menu.Id,menu.F_Id,foodlist.fName,foodlist.Description,foodlist.Picture,foodlist.canteen from menu inner join foodlist on menu.F_Id =foodlist.Id where F_Id= '$food_id'";
		return $this->query($strQuery);
	}
	function getProteinAdditions(){
		$strQuery= "select menu.Id, menu.F_Id,foodlist.fName from menu inner join foodlist on menu.F_Id=foodlist.Id where menu.category = 2";
		return $this->query($strQuery);
	}

	function addtoCart($F_Id,$qty,$price,$person_id){
		$strQuery="INSERT into temp_orders
					(F_Id,qty,price,pid)
					VALUES('$F_Id','$qty','$price','$person_id')";
		return $this->query($strQuery);
	}
	function setToken($username,$token){
		$strQuery="UPDATE person set fcm='$token' where username='$username'";
		return $this->query($strQuery);
	}
	function remove($F_Id){
		$strQuery="DELETE from temp_orders where F_Id='$F_Id'";
		return $this->query($strQuery);
	}
	function getOrders($pid){
		$strQuery="select temp_orders.temp_id, temp_orders.F_Id,foodlist.fName,temp_orders.qty, temp_orders.price,foodlist.canteen,canteens.fcm  from temp_orders 
		inner join foodlist on temp_orders.F_Id=foodlist.Id 
        inner join canteens on foodlist.canteen=canteens.Id
        where pid='$pid'";
		return $this->query($strQuery);
	}
	function delete_order($temp_id){
		$strQuery="delete from temp_orders where temp_id = '$temp_id'";
	    return $this->query($strQuery);
	}
	function viewOrders($pid){
		$strQuery="select p_orders.Id, p_orders.F_Id,foodlist.fName from p_orders 
		inner join foodlist on p_orders.F_Id=foodlist.Id where C_Id='$pid'";
		return $this->query($strQuery);
	}
	function viewUser($pid){
		$strQuery="select * from person where pid='$pid'";
		return $this->query($strQuery);
	}
	function place_order($person_id,$food_id,$qty,$price,$order_type){
		$strQuery="INSERT into p_orders
					(C_Id,F_Id,Quantity,price,order_type)
					VALUES('$person_id','$food_id','$qty','$price','$order_type')";
			return $this->query($strQuery);		
	}
	function addReview($food_id,$review,$rating){
		$strQuery="INSERT into review
					(F_Id,reviews,rating,time)
					VALUES('$food_id','$review','$rating',CURRENT_TIMESTAMP)";
			return $this->query($strQuery);		
	}

	function viewReview($food_id){
		$strQuery="select review.F_Id, review.reviews,review.rating, review.time,foodlist.Picture,foodlist.fName from review 
		inner join foodlist on review.F_Id=foodlist.Id where F_Id='$food_id'";
			return $this->query($strQuery);		
	}
}
?>
 