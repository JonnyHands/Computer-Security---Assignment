<?php
//setup
session_start();
include 'config.php';

//variables
$email = mysqli_real_escape_string($connection,$_POST['txtEmail']);
$password = mysqli_real_escape_string($connection,$_POST['txtPassword']);
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);
$evaluationsQuery = "SELECT * FROM Evaluations";
$evalualtionsResult = $connection->query($evaluationsQuery);
$ipaddress = $_SERVER["REMOTE_ADDR"];
$userFound = 0;
$result = mysqli_query($connection, "SELECT COUNT(*) FROM `loginlogs` WHERE `IpAddress` LIKE '$ipaddress' AND `TryTime` > (now() - interval 10 minute)");
$totalCount = mysqli_fetch_array($result, MYSQLI_NUM);
$remainingAttempts = 3-$totalCount[0];

//checks captcha was correct
if($_POST['captcha'] != $_SESSION['code']){
  die("Sorry, the CAPTCHA code entered was incorrect!
      <br/> <br/> Try again by Clicking <a href='logout.php'> HERE </a>");
    } 


//checks user exists and hashes password, checks password is correct to email, checks user is verified by email and if user is an admin
echo "<table border='0'>";
if ($userResult->num_rows > 0) {
  while ($userRow = $userResult->fetch_assoc()) {
    if ($userRow['Email'] == $email) {
      $userFound = 1;
      $hash = $userRow['Password'];
      $verify = password_verify($password, $hash);
      $user_id =  $userRow['id'];
      if ($verify && $totalCount[0]<3) {
        $forename = $userRow['Forename'];
        $_SESSION['user'] = $user_id;
        $_SESSION['name'] = $forename;
        if ($userRow['Verified'] == 1)
				{
        if($userRow['Admin'] == 1){
          $_SESSION['Admin'] =1;
        }
        header("Location: https://users.sussex.ac.uk/~jh747/CS/evaluationRequestForm.php" ,TRUE, 301);
        exit();
      }
      }    
      else {
        if($totalCount[0]>3){
          echo "<br/> Maximum incorrect login attempts exceeded <br/> ";
        }
        else{
          echo "Incorrect login details <br/> $remainingAttempts attempts remaining.";
          mysqli_query($connection, "INSERT INTO `loginlogs` (`IpAddress` ,`TryTime`)VALUES ('$ipaddress',CURRENT_TIMESTAMP)");
          echo "<br/> <br/> Try again by Clicking <a href='logout.php'> HERE </a>";
        }        
      }
    }    
  }
  }
  else{
    echo "User not found in our database.";
  }


echo "</table>";

if ($userFound == 0) {
  echo "This user was not found in our database";
}
?>