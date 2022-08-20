<?php
echo "<form action='forgotPasswordCheck.php' method='POST'>";
echo "<pre>";
echo "Email";
echo "   <input name='txtEmail' type='text' />";
echo "<br />What is your mothers maiden name?";
echo "   <input name='txtSecurityAnswer1' type='text' />";
echo "<br />What was the name of your first school?";
echo "   <input name='txtSecurityAnswer2' type='text' />";
echo "<br /> New Password";
echo "   <input name='txtNewPassword1' type='password'/>";
echo "<br /> Confirm Password";
echo "   <input name='txtNewPassword2' type='password'/>";
echo "<br /> <br/> <input type='submit' value='Confirm'>";
echo "</pre>";
echo "</form>";
echo "<br/> <br/> Not registered yet? Click <a href='registerForm.php'> HERE </a>";
echo "<br/> <br/> Want to login?  </a>";
?>