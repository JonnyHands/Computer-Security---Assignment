<?php
echo "<form action='registerFormCheck.php' method='POST'>";
echo "<h1> Please register your details below: </h1>";
echo "<pre>";
echo "Type in your Email address";
echo "	<input name='txtEmail1' type='text' />";
echo "<br/> Type your email address again";
echo "	<input name='txtEmail2' type='text' />";
echo "<br/> Type in your password";
echo "		<input name='txtPassword1' type='password' />";
echo "<br/> Type your password again";
echo "	<input name='txtPassword2' type='password' />";
echo "<br/>Type in your Forename";
echo "	<input name='txtForename' type='text' />";
echo "<br/>Type in your Surname";
echo "	<input name='txtSurname' type='text' />";
echo "<br/>Type in your Phone number";
echo "	<input name='txtPhonenumber' type='text' />";
echo "<br/>What is your mothers maiden name?";
echo "	<input name='txtSecurityAnswer1' type='text' />";
echo "<br/>What was the name of your first school?";
echo "	<input name='txtSecurityAnswer2' type='text' />";
echo "</pre>";
echo "<br/> <input type='submit' value='Register'>";
echo "</form>";
echo "<br/> <br/> Want to login? Click <a href='complexLoginForm.php'> HERE </a>";
?>