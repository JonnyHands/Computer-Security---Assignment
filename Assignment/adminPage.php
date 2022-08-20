<?php
//setup
session_start();
include 'config.php';

//checks if user is admin, if not is sent back to previous page
if (isset($_SESSION['Admin'])) {
    $evaluationQuery = "SELECT * FROM Evaluations";
  $evaluationResult = $connection->query($evaluationQuery);
  
  //produces list of all eval requests from database
  if ($evaluationResult->num_rows > 0) {
      while ($info = $evaluationResult->fetch_assoc()) {
        {
            Echo "<b>Email:</b> ".$info['Email'] . " <br>";
            Echo "<b>Comment:</b> ".$info['Comment'] . "<br> ";
            Echo "<img src=https://users.sussex.ac.uk/~jh747/CS/uploads/".$info['Photo'] ."> <br>";                      
            Echo "<b>Preferred method of contact:</b> ".$info['PreferredContact'] . " <hr>";
             } 
      }
  }  

echo "<br/> <br/> To logout click <a href='logout.php'> HERE </a>";
  } else {
    echo "You are not an admin";
    echo "<br/> <br/> To go back Click <a href='evaluationRequestForm.php'> HERE </a>";
  }

 
?>
