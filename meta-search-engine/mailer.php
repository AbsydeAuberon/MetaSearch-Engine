<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';


function sendEmailConfirmation($address, $confirm_code)
{
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //Set the hostname of the mail server
    $mail->Host = gethostbyname('smtp.gmail.com');
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Error when trying to connect to SMTP
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'fakemailpapi@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'fakemailpapi1234';
    //Set who the message is to be sent from
    $mail->setFrom('MSE@PAPI.COM', 'Metasearch Engine');
    //Set an alternative reply-to address
    $mail->addReplyTo('MSE@PAPI.COM', 'Metasearch Engine');
    //Set who the message is to be sent to
    $mail->addAddress($address, 'John Doe');
    //Set the subject line
    $mail->Subject = 'Confirm your account - MSE';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $txtHTML="
        <p>
            Hi! , <br> You can confirm your account through this link: <a href=http://localhost/api/group-assignment/MetaSearch-Engine/meta-search-engine/activationUser.php?code={$confirm_code}> LINK </a>
        </p>";

    $mail->msgHTML($txtHTML);
    //Replace the plain text body with one created manually
    $mail->AltBody = ' OWO ';
    //Attach an image file
    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}


function sendEmailRecovery($address, $recovery_code)
{
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //Set the hostname of the mail server
    $mail->Host = gethostbyname('smtp.gmail.com');
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Error when trying to connect to SMTP
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'fakemailpapi@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'fakemailpapi1234';
    //Set who the message is to be sent from
    $mail->setFrom('energyecom@drink.com', 'Energy E-Commerce');
    //Set an alternative reply-to address
    $mail->addReplyTo('energyecom@drink.com', 'Energy E-Commerce');
    //Set who the message is to be sent to
    $mail->addAddress($address, 'John Doe');
    //Set the subject line
    $mail->Subject = 'Recover your password - Energy E-Commerce';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $txtHTML="
        <p>
            Hi! , <br> Here you can change your password: <a href=https://apiatomas.000webhostapp.com/individual-assignment-two/recoverPassword.php?recovery={$recovery_code}> LINK </a>
        </p>";

    $mail->msgHTML($txtHTML);
    //Replace the plain text body with one created manually
    $mail->AltBody = ' OWO ';
    //Attach an image file
    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}

?>