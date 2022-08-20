<?php
//setup
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'config.php';
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//variale setup
$email1 = mysqli_real_escape_string($connection,$_POST['txtEmail1']);
$email2 = mysqli_real_escape_string($connection,$_POST['txtEmail2']);
$password1 = mysqli_real_escape_string($connection,$_POST['txtPassword1']);
$password2 = mysqli_real_escape_string($connection,$_POST['txtPassword2']);
$forename = mysqli_real_escape_string($connection,$_POST['txtForename']);
$surname = mysqli_real_escape_string($connection,$_POST['txtSurname']);
$phonenumber = mysqli_real_escape_string($connection,$_POST['txtPhonenumber']);
$securityAnswer1 = mysqli_real_escape_string($connection,$_POST['txtSecurityAnswer1']);
$securityAnswer2 = mysqli_real_escape_string($connection,$_POST['txtSecurityAnswer2']);
$hash = password_hash($password1, PASSWORD_DEFAULT);
$sec1hash = password_hash($securityAnswer1, PASSWORD_DEFAULT);
$sec2hash = password_hash($securityAnswer2, PASSWORD_DEFAULT);
$key = password_hash($email1, PASSWORD_DEFAULT);
$_SESSION['$pin'] = mt_rand(0000,9999); 
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);
$_SESSION['confirmEmail'] = $email1;
$verified = 0;
$errorOccurred = 0;

//email setup
$subject = "Lovejoy Email Verification";
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Mailer = "smtp";
$phpmailer->SMTPDebug  = 1;  
$phpmailer->SMTPAuth = true;
$phpmailer->SMTPSecure = "tls";
$phpmailer->Port = 587;
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->Username = 'lovejoysantiquessussex@gmail.com';
$phpmailer->Password = 'Compsec1.';
$phpmailer->setFrom('lovejoysantiquessussex@gmail.com', 'Lovejoys Antiques');
$phpmailer->addAddress($email1); 
$phpmailer->isHTML(true);
$phpmailer->Subject = $subject;
$phpmailer->Body  = "<h1>Thank you for registering with us</h1>
<p>Here is your code for verification : </p>".$_SESSION['$pin'] ;
     
//checks if emails were entere
if ($email1 == "" or $email2 == "") {
  echo "Email not provided <br/>";
  $errorOccurred = 1;
}

//checks passwords were entered
if ($password1 == "" or $password2 == "") {
  echo "Password empty, check it. <br/>";
  $errorOccurred = 1;
}

//checks forename was entered
if ($forename == "") {
  echo "Forename was blank !<br/>";
  $errorOccurred = 1;
}

//checks surnmae was entered
if ($surname == "") {
  echo "Surname was blank <br/>";
  $errorOccurred = 1;
}

//checks phone nmber was entered
if ($phonenumber == "") {
  echo "Phone number was blank !<br/>";
  $errorOccurred = 1;
}

//checks phone number is 11 digits long
if (strlen($phonenumber) != 11) {
  echo "Phone number length invalid!<br/>";
  $errorOccurred = 1;
}

//checks phone number is only numbers
if (is_numeric($phonenumber) == false) {
  echo "Phone number can't contain letters!<br/>";
  $errorOccurred = 1;
}

//checks security answer was entered
if ($securityAnswer1 == "") {
  echo "Security answer was blank <br/>";
  $errorOccurred = 1;
}

//checks security answer was entered
if ($securityAnswer2 == "") {
  echo "Security answer was blank <br/>";
  $errorOccurred = 1;
}


// Check to see if the email address is registered.
$userResult = $connection->query("SELECT * FROM SystemUser");
while ($userRow = mysqli_fetch_array($userResult)) {
  if ($userRow['Email'] == $email1) {
    echo "This email address has already been used. <br/>";
    $errorOccurred = 1;
  }
}

//Checks email for @
if (strpos($email1, "@") == false or strpos($email2, "@") == false) {
  echo "The second email address are not valid <br/>";
}

//checks emails match
if ($email1 != $email2) {
  echo "Emails do not match <br/>";
}

//checks the passwords are the same
if ($password1 != $password2) {
  echo "The passwords are different <br/>";
  $errorOccurred = 1;
}

//checks if password is strong, by being over 8 characters, less than 50 characters, and if it contains one upper case, one number and one symbol
if (preg_match("#.*^(?=.{8,50})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password1) == 0) {
  echo "Password should be at least 8 characters in length, no longer than 50 characters and should include at least one upper case letter, one number, and one special character! <br/>";
  $errorOccurred = 1;
}




// Check to see if an error has occurred. Then add the details to the database. 
if ($errorOccurred == 0) {
  $sql = "INSERT INTO SystemUser (Email, Password, Forename, Surname, TelephoneNumber, SecurityAnswer1, SecurityAnswer2, Verified)
	  VALUES ('$email1', '$hash', '$forename', '$surname', '$phonenumber', '$sec1hash', '$sec2hash', '$verified')";
  if ($connection->query($sql) === TRUE) {
    //thanks and welcomes user
    echo htmlspecialchars("Hello " . $forename . " " . $surname . "<br/>");
    echo "Welcome to my Computing Security network";
  }
}

//sends email and prompts pin to be entered
if(!$phpmailer->send()) {
  echo 'Verification email could not be sent.';
  echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
} 
else {
header("Location:emailVerificationForm.php");
}
?>
