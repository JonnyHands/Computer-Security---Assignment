<?php
//logs user out, destroys sesssion brings back to login page

 session_start();

  echo "User logged out ";
  session_destroy();   
  header("Location: complexLoginForm.php" ,TRUE, 301);
?>