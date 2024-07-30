
<?
date_default_timezone_set('Asia/Kolkata');
include("./createTables.php");
include("./header.php");

function ping($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return "<i class='fa fa-circle  w3-text-red w3-small' aria-hidden='false' ></i> "; } 
  $tA = microtime(true); 
  return "<i class='fa fa-circle w3-text-green w3-small' aria-hidden='false' ></i> "; 
}

//Echoing it will display the ping if the host is up, if not it'll say "down".
if (isset($_GET['id']) && $_GET['id']!=""){
	$id=$_GET['id'];
	$q="SELECT reg1_ip,reg2_ip FROM $regTable ";
	$q.=" where id=".$id ;
	$s=mysqli_query($conn,$q);
	while($d=mysqli_fetch_assoc($s)){
		$reg1_ip=$d['reg1_ip'];
		$reg2_ip=$d['reg2_ip'];
					}
	if ($reg1_ip!=""){
		$ping=ping($reg1_ip, 80, 10);
		$retStr="[{\"retCode\":\"11\",";
		$retStr.="\"reg1_ip\":\"$ping\",";
		if ($reg2_ip!=""){
			$ping=ping($reg2_ip, 80, 10);
			$retStr.="\"reg2_ip\":\"$ping\"}]";
		}else {
			$retStr.="\"reg2_ip\":\"\"}]";
		}
	}
	else {
		$retStr="[{\"retCode\":\"91\",\"reg1_ip\":\"\",\"reg1_ip\":\"\"}]";
	}
	print $retStr;
}
?>
