<?php

$html = "
<!DOCTYPE html>
<html>

    <head>
        <title>Metasearch Engine</title>
    </head>

    <body>
    <h1>METASEARCH ENGINE</h1>
    <h2> <a href = \"userRegistration.php\"> > Register</a></h2>
    <h2> <a href = \"userLogin.php\"> > Login</a></h2>
    <h2> <a href = \"listItems.php\"> > SEARCH</a></h2>
    <h2> <a href = \"getItemsJSON.php\"> > Get Items as JSON</a></h2>";

    if(isset($_SESSION['login']) && isset($_COOKIE['login']))
    {
        if($_COOKIE['login'] == 1)
        {
            $html .= "<h2> <a href = \"userLogout.php\"> > Log Out</a></h2>";
        }
    
        die();
    }


$html .= "</body>
</html>
";

echo $html;

?>