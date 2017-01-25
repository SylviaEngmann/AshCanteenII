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
	*@param string username user name
	*@param string email email
	*@param string password password

	*@return boolean returns true if successful or false
	*/

    /*This function takes in the entered parameters and enters them in the database*/
	function addUser($username,$email,$password){
		$strQuery="insert into users
						(username,email,password)
						VALUES('$username','$email',MD5('$password'))";
		return $this->query($strQuery);
		}
		
	function login($username,$password){
		$strQuery="select uid,username,password from users where
					username = '$username' and password =MD5('$password')";

		return $this->query($strQuery);
	}
}
?>
 