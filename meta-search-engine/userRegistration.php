<?php

require_once("db.php");
require_once("mailer.php");
session_start();

if(isset($_SESSION['login']) && isset($_COOKIE['login']))
{
    if($_COOKIE['login'] == 1)
    {
        echo "<p> You are already logged in! </p> <br> <h3><a href = \"MSE.php\"> > HOME</a></h3>";
    }

    die();
}

if (isset($_POST["email"]) && isset($_POST["pass"]))
{

    $mail = mysqli_fix_string($mysqli, $_POST["email"]);
    $pass = mysqli_fix_string($mysqli, $_POST["pass"]);
    $hash_pass = hash("md5", $pass);

    $confirm_code = bin2hex(random_bytes(5));
    $is_confirmed = "false";


    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        $stmt = $mysqli->prepare("INSERT INTO user (mail, pass, is_confirmed, confirm_code) 
        VALUES ( ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $mail, $hash_pass, $is_confirmed, $confirm_code);
        $stmt->execute();
        $result = $stmt->get_result();
        
        echo "<p>You have to confirm your user with the link we have sent to your e-mail.</p>";
        sendEmailConfirmation($mail, $confirm_code);
    }

    else
    {
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            echo "<p> Your email is invalid. Be sure to put a correct email.</p>";
        }

        else
        {
            echo "<p> Invalid information on the fields.</p>";
        }
    }

}

else{
    
    echo "
    <html>
        <head>
            <title> REGISTER - Metasearch Engine </title>
        </head>

        <body>
            <form method = 'post' action = ''>

                <label> E-mail: </label> <br>
                <input type = 'text' name = 'email'>

                <br></br>

                <label> Password: </label> <br>
                <input type = 'password' name = 'pass'>

                <br></br>
        
                <input type='submit' value='Submit'>

                <br></br>
                <h3><a href = \"index.php\"> > HOME</a></h3>

            </form>
        </body>
    

    </html>
";

}


function mysqli_fix_string($mysqli, $string)
{
    if(get_magic_quotes_gpc())
    {
        $string = stripslashes($string);
    }

    return $mysqli->real_escape_string($string);
}
?>