
<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Net/SFTP.php');

$sftp = new Net_SFTP('10.0.253.92');
if (!$sftp->login('iriset', ']91QOYy\?>C[')) {
    exit('Login Failed');
}

// puts a three-byte file named filename.remote on the SFTP server
//$sftp->put('filename.remote', 'xxx');
// puts an x-byte file named filename.remote on the SFTP server,
// where x is the size of filename.local
$sftp->put('/var/www/iriset/*', 'C:/wamp/www/iriset/*', NET_SFTP_LOCAL_FILE);
?>