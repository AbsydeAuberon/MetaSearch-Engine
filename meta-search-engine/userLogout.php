<?php

require_once("db.php");
session_start();

if(isset($_SESSION['login']) && isset($_COOKIE['login']))
{
    if($_COOKIE['login'] == 1)
    { 
        $_SESSION = array();
        setcookie("login", '', time() - 10000000, '/');
        session_destroy();
        echo "<p> You logged out succesfully. Go back to the main page.</p> <br> <h3><a href = \"MSE.php\"> > HOME</a></h3>";
    }

    die();
}

?>