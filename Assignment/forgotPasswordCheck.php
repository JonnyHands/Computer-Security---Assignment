<?php
//setup
include 'config.php';

//variables
$email = mysqli_real_escape_string($connection,$_POST['txtEmail']);
$newpassword1 = mysqli_real_escape_string($connection,$_POST['txtNewPassword1']);
$newpassword2 = mysqli_real_escape_string($connection,$_POST['txtNewPassword2']);
$securityAnswer1 = mysqli_real_escape_string($connection,$_POST['txtSecurityAnswer1']);
$securityAnswer2 = mysqli_real_escape_string($connection,$_POST['txtSecurityAnswer2']);
$newpasswordhash = password_hash($newpassword1, PASSWORD_DEFAULT);
$errorOccurred = 0;
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);

//checks new password is entered
if ($newpassword1 == "" or $newpassword2 == "") {
  echo "Password empty, check it. <br/>";
  $errorOccurred = 1;
}

//checks if passwords match
if ($newpassword1 != $newpassword2) {
  echo "The passwords are different <br/>";
  $errorOccurred = 1;
}

//checks if password is strong, by being over 8 characters, less than 50 characters, and if it contains one upper case, one number and one symbol
if (preg_match("#.*^(?=.{8,50})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $newpassword1) == 0) {
  echo "Password should be at least 8 characters in length, no longer than 50 characters and should include at least one upper case letter, one number, and one special character! <br/>";
  $errorOccurred = 1;
}



//hashes password, checks password is correct and then updates database with new password
echo "<table border='0'>";
if ($userResult->num_rows > 0) {
  while ($userRow = $userResult->fetch_assoc()) {
    if ($userRow['Email'] == $email) {
      $userFound = 1;
      $sec1hash = $userRow['SecurityAnswer1'];
      $sec2hash = $userRow['SecurityAnswer2'];
      $verifysec1 = password_verify($securityAnswer1, $sec1hash);
      $verifysec2 = password_verify($securityAnswer2, $sec2hash);
      if ($verifysec1 and $verifysec2) {
        $sql = "UPDATE SystemUser SET Password='$newpasswordhash' WHERE Email ='$email'";
        if ($connection->query($sql) === TRUE) {
          echo "<br/> Your password has been changed.";
        }
      } else {
        echo "A security question answer is incorrect" . $connection->error;
      }
    }
  }
}
echo "</table>";
?>