<?php

$servername = "localhost";
$username = "id6061128_immisoft24";
$password = "imrandell";
$dbname = "id6061128_user_details";

try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }

?>

