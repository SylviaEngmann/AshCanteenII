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
    function addUser($name,$username,$email,$password){
		$strQuery="insert into person
						(name,username,password)
						VALUES('$name','$username',MD5('$password'))";
		return $this->query($strQuery);
		}	
	
	function login($username,$password){
		$strQuery="select * from person where username = '$username' and Password='$password'";
		return $this->query($strQuery);
	}
	function getCafeteria(){
		$strQuery="SELECT cafeteria_name,picture from cafeteria";
		return $this->query($strQuery);
	}
	function getAkCafeteria(){
		$strQuery="SELECT picture from cafeteria where cid=1";
		return $this->query($strQuery);
	}

	function getAkMeals(){
		$strQuery="SELECT * from menu where cid=1";
		return $this->query($strQuery);
	}
	/*function addUser($name,$username,$password){
		$strQuery="insert into customers
						(cName,username,password)
						VALUES('$name','$username',MD5('$password'))";
		return $this->query($strQuery);
		}	*/
	
	/*function login($username,$password){
		$strQuery="select * from customers where username = '$username' and Password='$password'";
		return $this->query($strQuery);
	}*/
	/*function getCafeteria(){
		$strQuery="	select * from canteens";
		return $this->query($strQuery);
	}
	function getCategories(){
		$strQuery="	select * from meal_cat";
		return $this->query($strQuery);
	}*/
	function getMeal($meal_id){
		$strQuery="SELECT * from menu where meal_id='$meal_id'";
		return $this->query($strQuery);
	}
	function cuisine(){
		$strQuery="SELECT menu.meal_name,menu.meal_type,menu.description,cuisine.meal_id from cuisine inner join menu on menu.meal_id= cuisine.meal_id";
		return $this->query($strQuery);
	}
	function addOrder($meal_id){
		$strQuery="insert into meal_order set meal_id='$meal_id'";
		return $this->query($strQuery);

	}
	function getOrder(){
		$strQuery="SELECT menu.meal_name, menu.price,meal_order.meal_id from meal_order join menu on menu.meal_id=meal_order.meal_id ";
		return $this->query($strQuery);
	}
 
}
?>
 