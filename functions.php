<?php
//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		case 2:
			login();
		break;
		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}
function addUser(){
	if(!isset($_REQUEST['username'])){
		echo '{"result":0,"message":"Please enter username"}';
		return;
	}
	if(!isset($_REQUEST['email'])){
		echo '{"result":0,"message":"Please enter email"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Please enter password"}';
		return;
	}
	if($_REQUEST['username']==""){
		echo '{"result":0,"message":"Please enter username"}';
		return;
	}
	if($_REQUEST['email']==""){
		echo '{"result":0,"message":"Please enter email"}';
		return;
	}
		if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Please enter password"}';
		return;
	}
	$username=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	include('users.php');
	$obj=new user();
	$row=$obj->addUser($username, $email, $password);

	if($row==true){
		echo '{"result":1,"message":"User added"}';
	}

	else{
		echo '{"result":0,"message":"User not added"}';
	}

}

function login(){
	if(!isset($_REQUEST['email'])){
		echo '{"result":0,"message":"Please enter email"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Please enter password"}';
		return;
	}
	
	if($_REQUEST['email']==""){
		echo '{"result":0,"message":"Please enter email"}';
		return;
	}
	if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Please enter password"}';
		return;
	}
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	include('users.php');
	$obj=new user();
	$row=$obj->login($email, $password);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"user":';
		echo json_encode($row);
		echo "}";
	}
	else{
		echo '{"result":0,"message":"Login failed"}';
	}
}
function getMenu(){

	include('user.php');
	$obj=new user();
	$row=$obj->getPool();
	if($row==true){
		$row=$obj->fetch();
			echo '{"result":1,"pool":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch pools"}';
	}

}
function getNews(){

	include('user.php');
	$obj=new user();
	$row=$obj->getNews();
	if($row==true){
		$row=$obj->fetch();
			echo '{"result":1,"news":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch pools"}';
	}

}

function addPool(){
	if(!isset($_REQUEST['source'])){
		echo '{"result":0,"message":"Source is not given"}';
		return;
	}
	if(!isset($_REQUEST['destination'])){
		echo '{"result":0,"message":"Destination is not given"}';
		return;
	}
	if(!isset($_REQUEST['date'])){
		echo '{"result":0,"message":"Date is not given"}';
		return;
	}
	if(!isset($_REQUEST['starttime'])){
		echo '{"result":0,"message":"Start time is not given"}';
		return;
	}
	if(!isset($_REQUEST['endtime'])){
		echo '{"result":0,"message":"End time is not given"}';
		return;
	}
	if($_REQUEST['source']==""){
		echo '{"result":0,"message":"Source is not given"}';
		return;
	}
	if($_REQUEST['destination']==""){
		echo '{"result":0,"message":"Destination is not given"}';
		return;
	}
	if($_REQUEST['date']==""){
		echo '{"result":0,"message":"Date is not given"}';
		return;
	}
	if($_REQUEST['starttime']==""){
		echo '{"result":0,"message":"Start time is not given"}';
		return;
	}
	if($_REQUEST['endtime']==""){
		echo '{"result":0,"message":"End time is not given"}';
		return;
	}
	if($_REQUEST['people']==""){
		echo '{"result":0,"message":"Number of people is not given"}';
		return;
	}
	$source=$_REQUEST['source'];
	$destination=$_REQUEST['destination'];
	$date=$_REQUEST['date'];
	$starttime=$_REQUEST['starttime'];
	$endtime=$_REQUEST['endtime'];
	$carregistration=$_REQUEST['carregistration'];
	$cartype=$_REQUEST['cartype'];
	$broadcast=$_REQUEST['broadcast'];
	$email=$_REQUEST['email'];
	$num=$_REQUEST['people'];
	
	include('user.php');
	$obj=new user();
	$row=$obj->addPool($email,$source, $destination, $date, $starttime, $endtime,$num,$carregistration,$cartype,$broadcast);

	if($row==true){
		echo '{"result":1,"message":"Pool added"}';
	}
	else{
		echo '{"result":0,"message":"Pool not added"}';
	}

}

function updatePool(){

	$cid=$_REQUEST['cid'];
	$mode=$_REQUEST['mode'];
	include('user.php');
	if(isset($_REQUEST['dest'])){
		$dest=$_REQUEST['dest'];
		$user=$_REQUEST['user'];
		$email2=$_REQUEST['email2'];
		$obj=new user();
		$row=$obj->getUser($user);
		if($row==true){
		$row=$obj->fetch();
		$man2=$row['phone'];
		
		$url = 'http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=' . $man2. '&from=LetsGO&text=You%20successfully%20joined%20the%20pool%20to%20'.$dest.'%20by%20'.$email2;
        TRIM($url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
         session_write_close();

        // Get the response and close the channel.
        $response = curl_exec($ch);
        echo $response;
        curl_close($ch);
		
	}
}
	$numpeople=$_REQUEST['numjoin'];
	
	$obj=new user();
	$row=$obj->updatePool(1,$cid,$mode,$numpeople);

	if($row==true){

		echo '{"result":1,"message":"Sucessfully joined pool"}';
	}
		
	
	else{
		echo '{"result":0,"message":"An error occured while joining pool"}';
	}
}

function sendSMStoOwner(){
	
	$email=$_REQUEST['email'];
	$user=$_REQUEST['user'];
	$dest=$_REQUEST['dest'];
	$email2=$_REQUEST['email2'];
	include('user.php');
	$obj=new user();

	$row=$obj->getUser($email);
	if($row==true){
		$row=$obj->fetch();
		$man=$row['phone'];
		
		$url ='http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=' . $man. '&from=LetsGO&text=Your%20pool%20is%20full';
			TRIM($url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

        // Get the response and close the channel.
       //session_write_close();
        

        // Get the response and close the channel.
        session_write_close();
            if (curl_exec($ch) === FALSE) {
   die("Curl Failed: " . curl_error($ch));
} else {
   return curl_exec($ch);
}
        echo $response;
        curl_close($ch);

        $obj=new user();
		 $row=$obj->getUser($user);
		 if($row==true){
			$row=$obj->fetch();
		 	$man2=$row['phone'];
			
		 	$url = 'http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=' . $man2. '&from=LetsGO&text=You%20successfully%20joined%20the%20pool%20to%20'.$dest.'%20by%20'.$email2;
	        echo $url;

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);

	        // Set so curl_exec returns the result instead of outputting it.
	       curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

	 //        // Get the response and close the channel.
	 //         //session_write_close();
	        session_write_close()
	        $response = curl_exec($ch);
	 //         echo "Response is: ". $response . "....from the server";
	        curl_close($ch);
	        
	//}
	//echo '{"result":1,"message":"You successfully joined pool"}';
}

	else{
		echo '{"result":0,"message":"Could not fetch users"}';
	}
}


function addNews(){
	 if(!isset($_REQUEST['location'])){
	 	echo '{"result":0,"message":"Location is not given"}';
		return;
	 }
	// if(!isset($_REQUEST['image'])){
	// 	echo '{"result":0,"message":"Image is not given"}';
	// 	return;
	// }
	 if(!isset($_REQUEST['destnews'])){
	 	echo '{"result":0,"message":"Description is not given"}';
	 	return;
	 }
	$location=$_REQUEST['location'];
	//$image=$_REQUEST['image'];
	// echo $image;
	// exit;
	 $description=$_REQUEST['destnews'];


 
	
	include('user.php');
	$obj=new user();
	$row=$obj->addImage($location,$description);

	if($row==true){
		echo '{"result":1,"message":"News added"}';
	}
	else{
		echo '{"result":0,"message":"News not added"}';
	}

}

?>
