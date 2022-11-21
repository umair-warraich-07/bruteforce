<?php 
//create database connection 
//(servaer name, Username, Password)
$connection = mysqli_connect("localhost", "root", "");

//check the connection 
if(!$connection){
	echo "Failed to connect database" . die(mysqli_error($connection));
}
$dbselect = mysqli_select_db($connection, "login");
if(!$dbselect){
	echo "Failed to Select database" . die(mysqli_error($connection));
}
?>
