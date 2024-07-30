<?
session_start();
if(isset($_SESSION['astuser'])){
	$username= $_SESSION['astuser'];
	$userid	= $_SESSION['astid'];
	$rly	= $_SESSION['astrly'];
	$divn	= $_SESSION['astdivn'];
	//$dept	= $_SESSION['astdept'];
	$email	= $_SESSION['astemail'];
	$desig	= $_SESSION['astdesig'];
	$cug	= $_SESSION['astcug'];
	$access	= $_SESSION['astaccess'];
	$user_type = $_SESSION['astuser_type'];
	//$brd = $_SESSION['board'];

}
else{
	
print '<script>alert("Please Login")</script>';
header("Location: ./login.html");
}


?>
