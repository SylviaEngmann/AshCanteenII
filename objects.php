<?php
session_start();

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
						(name,username,email,password)
						VALUES('$name','$username','$email',MD5('$password'))";
		return $this->query($strQuery);
		}	
	function login($username,$password){
		$strQuery="SELECT * from person WHERE username= '$username' AND password=MD5('$password')";
		return $this->query($strQuery);
	}
	function getCafeteria(){
		$strQuery="SELECT cafeteria_name,picture from cafeteria";
		return $this->query($strQuery);
	}
	function getAkMeals(){
		$strQuery="SELECT * from menu where cid=1";
		return $this->query($strQuery);
	}
	function getBbMeals(){
		$strQuery="SELECT * from menu where cid=2";
		return $this->query($strQuery);
	}
	
	function cuisine(){
		$strQuery="SELECT menu.meal_name,menu.meal_type,menu.description,cuisine.meal_id from cuisine inner join menu on menu.meal_id= cuisine.meal_id";
		return $this->query($strQuery);
	}
	function getOrder(){
		$strQuery="SELECT from ";
	}
 
}
?>
 