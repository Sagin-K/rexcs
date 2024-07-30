<? 
//date_default_timezone_set('Asia/Kolkata');
include('./userAccess.php');
//include('./header.php');
if (isset($_GET['variable'])){
	$variable=$_GET['variable'];
//session_start(); 
$_SESSION[$variable]=$_GET['value'];
$retTxt="Server Selected for Configuration";
print $retTxt;
}
?>
