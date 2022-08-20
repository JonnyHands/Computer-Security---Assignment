<?php
//setup
session_start();
include 'config.php';

//checks user is logged in then provides from for them to submit eval request
if (isset($_SESSION['user'])) {
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);

  if ($userResult->num_rows > 0) {
    while ($userRow = $userResult->fetch_assoc()) {
        $forename = $userRow['Forename'];
    }
}
echo "Hi " . $_SESSION['name'] . "!<br/>";
echo "<br/> Welcome Lovejoy’s Antique Evaluation Web Application <br />";
echo "<br /> Describe the object for evaluation below:" ;
echo "<form action='evaluationRequestCheck.php' method='POST' enctype='multipart/form-data'>";
echo "<pre>";
echo "<textarea name='txtComment' rows='5' cols='40'placeholder='Type description here...'></textarea><br />";
echo "<br /> *Optional* Upload photo here: <input type='file' name='uploadfile'><br />";
echo "<br /><p> Preferred method of contact:<select name='contactPref'><option value='Select'>Select</option><option value='Phone'>Phone</option><option value='Email'>Email</option></select></p>";
echo "<br /> <br/> <input type='submit' name='upload' value='Submit evaluation'>";
echo "</pre>";
echo "</form>";
echo "<br/> <br/> Admin Page Click <a href='adminPage.php'> HERE </a>";
echo "<br/> <br/> To logout click <a href='logout.php'> HERE </a>";
  } else {
    echo "Please login to an account.";
    echo "<br/> <br/> To login click <a href='complexLoginForm.php'> HERE </a>";
  }




?>