<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Net/SSH2.php');

$ssh = new Net_SSH2('10.187.1.189');
if (!$ssh->login('root', 'pgt@123')) {
    echo "Login Failed";
	return;
}

echo $ssh->exec('cp /usr/local/share/Asterisk/rexcl/rexclconfi /usr/local/bin');
echo "<br>";
if (!$ssh->exec('cp /usr/local/share/Asterisk/rexcl/rexclconfi /usr/local/bin')){
				echo "Not installed";
			} else {
				echo "installed";
		}
//echo "<br>";
//$ssh->write("which asterisk\n"); // note the "\n"
//echo $ssh->read('');
?>
