<?php

session_start();

if(isset($_SESSION['login']) && isset($_COOKIE['login']))
{
    $html = "
    <!DOCTYPE html>
    <html>

        <head>
            <title>Metasearch Engine</title>
        </head>

        <script src = 'js/parseItems.js'></script>

        <body>
        <h1>SEARCH ITEMS</h1>
        <h3><a href = \"MSE.php\"> > HOME</a></h3>

        <form method = 'post' action = ''>
            <label> Search: </label> <br>
                <input type = 'text' onchange = 'performSearchItems(this.value);'>
        </form>
        <br></br>
        
        <table id=products>
        </table>";

    $html .= "</body>
    </html>
    ";

echo $html;

}

else
{

    echo "<h3> Please, login or register in our metasearch engine. </h3>
          <br></br>
          <h3><a href = \"MSE.php\"> > HOME</a></h3>";

}


?>