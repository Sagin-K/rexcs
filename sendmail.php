<?php
$email = "rexcs.ir@gmail.com";
$to = "sagisince1986@gmail.com";
$subject = "Hi!";
$body = "Hi,its from PC - Sending on".Date('r');
$headers = 'From: ' .$email;
if (mail($to, $subject, $body, $headers)) { echo("<p>Email successfully sent</p>" .Date('r')); }
else {
	$error=error_get_last()['message'];
	echo("<p>Email delivery failed</p>".$error);}
?>