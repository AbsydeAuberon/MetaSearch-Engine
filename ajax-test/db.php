<?php

$hostname = "localhost";
$user = "admincities";
$pass = "admin";
$database = "cities";

$mysqli = new mysqli($hostname, $user, $pass, $database);

if($mysqli->connect_errno != 0)
{
    die($mysqli->connect_error);
}
    
?>