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
	/**
	*Adds a new user
	*@param string name user name
	*@param string username user name
	*@param string email email
	*@param string password password

	*@return boolean returns true if successful or false
	*/

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
}
?>
 