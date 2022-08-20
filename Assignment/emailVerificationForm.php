<?php
echo 'Please check your email inbox for the pin to verify your account.';
echo "<form action='emailVerification.php' method='POST'>";
echo "<pre>";
echo "Please enter your verification pin sent to";
echo "   <input name='txtPin' type='text' />";
echo "<br /> <br/> <input type='submit' value='Submit'>";
echo "</pre>";
echo "</form>";
?>