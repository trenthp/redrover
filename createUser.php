<?php
session_start();
//get data from form

//create a PHP statement that gets the userid
$username = $_POST['username'];

if(isset($_POST['bizname'])){ $bizname = $_POST['bizname']; } 
if(isset($_POST['contactFirstName'])){ $contactFirstName = $_POST['contactFirstName']; } 
if(isset($_POST['contactLastName'])){ $contactLastName = $_POST['contactLastName']; } 
if(isset($_POST['contactPhone'])){ $contactPhone = $_POST['contactPhone']; } 
if(isset($_POST['description'])){ $description = $_POST['description'];}



$_SESSION['firstname'] = $contactFirstName;
$_SESSION['bizname'] = $bizname;
$_SESSION['username'] = $username;
//create IF statement that ensures that the two password entries are equal
if(($_POST['newpwd'])!=($_POST['newpwd2']))
	{
		echo "Passwords do not match - please use the \"Back/" + "button to re-enter the data.<b> />\n";
	}
else{
	$pwd = $_POST['newpwd'];


//assemble insert string
$query = "insert into businesses(username, password, name, contact_first_name, contact_last_name, contact_phone, description) ";
$query .= " values ('" .$username."', '".$pwd."' , '".$bizname."' , '".$contactFirstName."' , '".$contactLastName."' , '".$contactPhone."' , '".$description."');";

//connect to the database
//$db = mysqli_connect("localhost", "database userid", "database user password", database);
$db = mysqli_connect("redroversql.cyn207s6dony.us-west-2.rds.amazonaws.com", "redrover", "startupweekend", "redrover");

//create a variable string to execute the database insert statement
$result = mysqli_query($db, $query);

//close the database
mysqli_close($db);


//Set the session variable = the new user is logged in

$_SESSION['loggedIn'] = true;


//Redirect the user to the main menu web page
header('Location:Thankyou.html');

}

?>
