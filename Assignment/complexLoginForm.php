<?php
echo "<form action='complexLoginCheck.php' method='POST' onsubmit='return checkForm(this);' ";
echo "<pre>";
echo "Email";
echo "   <input name='txtEmail' type='text' />";
echo "<br /> Password";
echo "   <input name='txtPassword' type='password'/>";
echo "<br /> <br/> <input type='submit' value='Login'>";
echo "<p><img src='captcha.php' width='120' height='30' border='1' alt='CAPTCHA'></p>";
echo "<p><input type='text' size='6' maxlength='5' name='captcha' value=''> <br>";
echo "<small>copy the text from the image into this box</small></p>";
echo "</pre>";
echo "</form>";
echo "<br/> <br/> Not registered yet? Click <a href='registerForm.php'> HERE </a>";
echo "<br/> <br/> Forgot your password? Click <a href='forgotPasswordForm.php'> HERE </a>";
?>
