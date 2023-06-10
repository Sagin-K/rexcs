<?php
/*set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Net/SFTP.php');

$sftp = new Net_SFTP('10.187.1.10');
if (!$sftp->login('root', 'adminpgt')) {
    exit('Login Failed');
}

// outputs the contents of filename.remote to the screen
//echo $sftp->get('/etc/asterisk/sip.conf');
// copies filename.remote to filename.local from the SFTP server
$sftp->get('/etc/asterisk/extensions.conf', 'D:/SSE T TR/extensions.conf');*/
$password="Admin@123";
$hashed_pw=md5($password);
print $hashed_pw;
?>