<?php
require_once("db.php");

$confirm_code = $_GET['code'];

$stmt = $mysqli->prepare("UPDATE user SET is_confirmed = 'true' WHERE confirm_code = ?");
$stmt->bind_param("s", $confirm_code);
$stmt->execute();


$stmt = $mysqli->prepare("SELECT * FROM user WHERE confirm_code = ? AND is_confirmed = 'true'");
$stmt->bind_param("s", $confirm_code);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows != 1)
{
    echo "<p> Your activation code didn't belong to any account. Please try again. <h2><a href = \"userLogin.php\"> > BACK</a></h2>";
}

else
{
    echo "<p> Congratulations, you have activated your account succesfully. Now you can login on the webpage. <h2><a href = \"MSE.php\"> > HOME</a></h2>";
}
?>