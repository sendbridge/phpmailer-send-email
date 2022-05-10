<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);

include("phpmailer/PHPMailerAutoload.php");

// create free smtp account at https://sendbridge.com
// get PHPMailer library at https://github.com/PHPMailer/PHPMailer

$server = "smtp.sendbridge.net";
$port = 25;	// could be 25 or 587
$username = "your_smtp_username"; // from your Sendbridge account
$password = "your_smtp_password"; // from your Sendbridge account

$from = "your_authorized_email_address";  // from your Sendbridge account
$from_name = "John Doe";

$recipient = "recipientaddress@example.com";

$subject = "This is a sample email from Sendbridge";

$body = "Hi there,<br>
	this is a sample email from Sendbridge.com.<br>
	Please respond.<br><br>
	Kind regards,<br>
	John Doe
	";

$mail = new PHPMailer;

$mail->Subject = $subject;

$mail->setFrom($from, $from_name);
$mail->addReplyTo($from);
$mail->addAddress($recipient);
$mail->msgHTML($body);
$mail->isHTML(true);	// true, false in case you'll send plain text email

$mail->SMTPDebug  = 3;	//1,2,3 - 3 is a debug, 0 is silent
$mail->Debugoutput = 'html';
$mail->isSMTP();
$mail->SMTPKeepAlive = true;

$mail->Username = $username;
$mail->Password = $password;
$mail->Host = $server;
$mail->Port = $port;

$mail->SMTPAuth = true;
//$mail->SMTPSecure = true;
$mail->SMTPAutoTLS = true;

$mail->CharSet = 'utf-8';

// you can pass custom email header also e.g. for handling bounces on your side
//$mail->addCustomHeader("X-My-Custom-Header", "abc-123");

// attach a document optionally
//$mail->AddAttachment(dirname(__FILE__)."/document.pdf");


if($mail->send()) {
    echo "email sent!";
}
else {
    echo "there was an error sending email";
}

//$mail->ClearAddresses();
