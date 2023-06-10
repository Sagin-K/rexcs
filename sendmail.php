<?php
$email = "rexcs.ir@gmail.com";
$to = "sagisince1986@gmail.com";
$subject = "Hi!";
$body = "Hi,How are you?";
$headers = 'From: ' .$email;
if (mail($to, $subject, $body, $headers)) { echo("<p>Email successfully sent</p>"); }
else {echo("<p>Email delivery failed</p>");}
?>