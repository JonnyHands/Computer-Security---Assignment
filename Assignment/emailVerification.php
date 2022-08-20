<?php
//setup
include 'config.php';
$PIN =$_POST['txtPin'];
session_start();

//variables
$email =$_SESSION['confirmEmail'];
$tempconnection = new PDO('mysql:host=krier.uscs.susx.ac.uk;dbname=G6077_jh747', 'jh747', 'Mysql_462396') or die ("could not connect to the server");
//checks pin is correct, if so verifies user if not says isnt valid and gets user to start again.
echo "<table border='1'>";
if ($PIN = $_SESSION['$pin'])
{	
	  $stmt = $tempconnection->prepare("UPDATE SystemUser SET Verified='1' WHERE Email=:email");
	  $stmt->bindValue(':email', $email);
	  $stmt->execute();
	  if ($stmt ->execute() === TRUE)
	  {
		  $_SESSION["email"] = $email;
		  $sql = "UPDATE SystemUser SET Verified='1' WHERE Email ='$email'";
		  echo "Your email has been verified";
		  echo "<br/> <br/> To return click <a href='complexLoginForm.php'> HERE </a>";
	  }
}
else
{
  echo "Incorrect pin please start again.";
  echo "Please create a verified account here <a href='registerForm.php'> HERE </a>";
}
 
?>