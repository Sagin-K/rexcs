<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./../w3.css">
<link rel="stylesheet" href="./../../jquery/jquery-ui.css">
<script src="./../../jquery/jquery-1.10.2.js"></script>
<script src="./../../jquery/jquery-ui.js"></script>	<!--script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script-->
<link rel="stylesheet" href="./../../jquery/style.css">
<script src="./datepicker.js"></script>
<script src="./index.js"></script>
<?
include("./createTables.php");
include("./userAccess.php");
include("./header.php");
//$department=$_SESSION['dept'];
//regTable();
//icomTable();
//gatewayTable();
//accountTable();
//routeTable();
//phoneTable();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body style="background:#EBF5FB ">

<?			
		if(isset($_SESSION['registrar'])){
		$registrar=$_SESSION['registrar'];
		$q1="SELECT * FROM $regTable where id = $registrar";
		$s1=mysqli_query($conn,$q1);
		if(!(!$s1) || mysqli_num_rows($s1)>0){
		while($d1=mysqli_fetch_assoc($s1)){ 
		$rly1=$d1['rly'];
		$divn1=$d1['divn'];
		$reg1_name=$d1['reg1_name'];
		$reg1_ip=$d1['reg1_ip'];
		$reg2_ip=$d1['reg2_ip'];
		$reg1_user=$d1['reg1_user'];
		$reg1_root=$d1['reg1_root'];
		$location=$d1['location'];
		}}
//----------------------------------------copy files & reload Remote server -----------------------
	echo "<br>";
	echo "<center>";
	echo "<table  width=60% class='w3-threequarter w3-large '>";
	echo "<tr><td  colspan=2 class='w3-xlarge w3-center'><b class='w3-large w3-text-brown w3-center'>Asterisk Configuration </b></td></tr>";
	echo "<tr><td  colspan=2 class='w3-xlarge w3-center'><b class='w3-large w3-text-brown w3-center'>Server: $reg1_name </b></td></tr>";  // heading of Table
		
	
		set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
		include('Net/SSH2.php');
		include('Net/SFTP.php');
	
		$sftp = new Net_SFTP($reg1_ip);
		if (!$sftp->login($reg1_user, $reg1_root)) {
			//echo 'Login Failed sftp';
		}
		
		$ssh = new Net_SFTP($reg1_ip);
		if (!$ssh->login($reg1_user, $reg1_root)) {
			//echo 'Login Failed ssh';
		}	
		$ssh->exec('mkdir /usr/local/share/AstInst');  //create Data folder in Remote server
		//$ssh->exec('cd /etc/asterisk/data && rm * '); // clears folders
		//$ssh->exec('cd /etc/asterisk/voip && rm * ');
		
	//-------------------------- copy rexcl file to data folder in remote server --------------	
		echo "<tr><td  width=60% ><b class='w3-text-blue w3-large'> Copying 'install' File </b></td><td   width=40% class='w3-white w3-large w3-center'>";
		if (!$sftp->put('/usr/local/share/AstInst/install', "./rexcl/install", NET_SFTP_LOCAL_FILE)){
			echo "<a href='/configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl' width=100% ><i class='fa fa-times w3-text-red'  aria-hidden='true'></i></a>";
		} else {
			echo "<a href='/configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl' width=100%><i class='fa fa-check w3-text-green' aria-hidden='true'></i></a>";
		}
		echo "</td></tr>"; 
	//-------------------------- copy rexcl file ends --------------
	$ssh->exec('cd /usr/local/share && chmod -R 777 AstInst');  //---------------- change the folder privacy
	echo "<tr><td  width=60% ><b  class='w3-text-blue w3-large' > Start Installation </b></td><td class='w3-white w3-large w3-center'>";
		if(!$ssh->exec('cd /usr/local/share/AstInst && ./install')){ //--------------------- go to AstInst folder and run ./install file
			echo "<i class='fa fa-times w3-text-red' aria-hidden='true'></i></td></tr>";
		} else { 
			echo "<i class='fa fa-check w3-text-green' aria-hidden='true'></i></td></tr>";
		}
	echo "</table>";
		}
		else {
			print "BR";
		}?>