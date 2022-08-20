
<?php
session_start();
include 'config.php';

if (isset($_SESSION['user'])) {
  $textComment = mysqli_real_escape_string($connection,$_POST['txtComment']);
  $prefContact = mysqli_real_escape_string($connection,$_POST['contactPref']);
  $preferredContact = '';
  $msg ="";

// query
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);



if ($userResult->num_rows > 0) {
    while ($userRow = $userResult->fetch_assoc()) {
               $email = $userRow['Email'];
               if($prefContact == 'Phone'){
                $preferredContact = $userRow['TelephoneNumber'];
              }
              if($prefContact == 'Email'){
                $preferredContact = $userRow['Email'];
              }
    }
}
// flag variable
$userFound = 0;

$statusMsg = '';

// Create a variable to indicate if an error has occurred or not, 0=false and 1=true. 
$errorOccurred = 0;

// File upload path

//$photo = $_POST['photo'];

  
  if(!isset($_POST['contactPref'])) 
  {
    $errorMessage .= "<li>You forgot to select your preferred method of contact!</li>";
  }

  if(isset($_POST["upload"]) && !empty($_FILES["uploadfile"]["name"])){
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "uploads/".$filename;      
    }

    
    echo  "Evaluation successfully uploaded. <br/> <br/> To submit another click <a href='evaluationRequestForm.php'> HERE </a>";
      



    $result = mysqli_query($connection, "SELECT * FROM image");
// Display status message


  //updates DB
  if ($errorOccurred == 0) {
    // add all of the contents of the variables to the SystemUser table
  
    $sql = "INSERT INTO Evaluations (Email, Comment, Photo, PreferredContact)
        VALUES ('$email', '$textComment', '$filename', '$preferredContact')";
    if ($connection->query($sql) === TRUE) {
        echo $msg;
    }
  }
  } else {
    // not logged in
  }

 

?>  
