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

    $hash_pass = hash("md5",$pass);

    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        $stmt = $mysqli->prepare("SELECT * FROM user WHERE mail = ? AND pass = ? AND is_confirmed = 'true'");
        $stmt->bind_param("ss", $mail, $hash_pass);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 0)
        {
            echo "<p> The information you entered is incorrect. Please try again. <h3><a href = \"userLogin.php\"> > BACK</a></h3>";
        }

        else
        {
            setcookie("login", "1", time() + 60 * 30);
            $_SESSION['login'] = "true";
            echo "<p> Succesfully logged in! </p> <br> <h3><a href = \"MSE.php\"> > HOME</a></h3>";
        }
    }

    else
    {
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            echo "<p> Your email is invalid. Be sure to put a correct email.</p> <br> <h3><a href = \"userLogin.php\"> > BACK</a></h3>";
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
            <title> LOGIN - Metasearch Engine </title>
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
                <h3><a href = \"MSE.php\"> > BACK</a></h3>
                

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