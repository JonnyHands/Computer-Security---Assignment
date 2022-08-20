<?php
$mysql_host = "krier.uscs.susx.ac.uk";
// qW2bp4hG5&31v6jVOeTd
$mysql_database = "G6077_jh747";    // name of the database, it is empty for now
$mysql_user = "jh747";    // type your username
$mysql_password = "Mysql_462396";  //  type the password, it is Mysql_<Personcod> You will need to replace person code with number from your ID card.
// 


// Create connection
$connection = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die("could not connect to the server");

// Check connection
if ($connection->connect_error) {
  die("Connection failed" . $connection->connect_error);
}
?>