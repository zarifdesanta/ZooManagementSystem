<?php 
	
	$username = 'group2';
	$hostname = 'localhost';
	$password = '1234';
	$dbmsname = 'zdbms';

	//making connection with the database
	$conn = mysqli_connect($hostname,$username,$password,$dbmsname);

	//check connection
	if(!$conn){
		echo 'Connection error: ' . mysql_connect_error();
	}

?>