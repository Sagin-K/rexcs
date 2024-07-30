<?
include("./header.php");
include("./userAccess.php");

function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	  return $data;
	}

//-------------------------------------------------------------
if(isset($_GET['action'])){
	$action=$_GET['action'];
	$v="";
	$retStr="";
	if(isset($_SESSION['registrar'])){
		$server_id=$_SESSION['registrar'];
		$q="select * from $regTable where id=$server_id ";
			$s=mysqli_query($conn,$q);
			if(!(!$s) || mysqli_num_rows($s)>0){
			while($d=mysqli_fetch_assoc($s)){ 
				$rly1=$d['rly'];
				$divn1=$d['divn'];
				$reg1_name=$d['reg1_name'];
				$reg1_ip=$d['reg1_ip'];
				$location=$d['location'];
				$rly_no_length=$d['rly_no_length'];
				$icom_no_length=$d['icom_no_length'];
				$pstn_no_length=$d['pstn_no_length'];
				}
			}
	}
	
	
	if(isset($_GET['f'])){
		$f=$_GET['f'];
	}
	if(isset($_GET[$f]) && $_GET[$f]!=""){
		$v = $_GET[$f];
		
//-------------- check duplicate Registrar -------------------------
	
	if ($f=="reg1_ip" || $f=="reg2_ip" ) {
	$query="SELECT * FROM $regTable WHERE reg1_ip!='' ";
	if($action=='search'){
		if($v!='' && $v!='other'){
			$query.=" AND (reg1_ip RLIKE \"$v \" || reg2_ip RLIKE \"$v \") ";
		}
	}
	elseif($action=='match'){
		if($v!='' && $v!='other'){
			$query.=" AND ( reg1_ip = \"$v \" || reg2_ip = \"$v \") ";
		}
	}
	$query.=" ORDER BY reg1_ip";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		//$retStr="[{}";
		$retStr="<b class='w3-text-red'>Already in use.</b>";
		/*while($d=mysqli_fetch_assoc($status)){
			$retStr.=(($k++>0)?",":"");
			$retStr.="{\"id\":\"{$d['id']}\",\"pg_no\":\"{$d['pg_no']}\",\"code\":\"{$d['code']}\",
					  \"name\":\"{$d['name']}\",\"description\":\"{$d['description']}\",
					  \"unit\":\"{$d['unit']}\",\"balance_qty\":\"{$d['balance_qty']}\",\"last_txn\":\"{$d['last_txn']}\"}";
		}*/
	print $retStr;
	return;	
	}
	}
//-------------- check duplicate icom_no -------------------------
//-------------- check duplicate -------------------------
	
	if ($f=="acc_name" || $f=="rly_no" || $f=="pstn_no" || $f=="map_no" || $f=="byte_no" ) {
	$query="SELECT * FROM $accTable INNER JOIN registrars ON accounts.server_id = registrars.id WHERE accounts.acc_name!='' AND registrars.rly= '$rly1' and registrars.divn='$divn1' and registrars.id='$server_id' ";
	if($action=='search'){
		if($v!='' && $v!='other'){
			$query.=" AND $f RLIKE \"$v \"";
		}
	}
	elseif($action=='match'){
		if($v!='' && $v!='other'){
			$query.=" AND $f = \"$v \"";
		}
	}
	$query.=" ORDER BY accounts.acc_name";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		//$retStr="[{}";
		$retStr="<b class='w3-text-red'>Already in use.</b>";
		/*while($d=mysqli_fetch_assoc($status)){
			$retStr.=(($k++>0)?",":"");
			$retStr.="{\"id\":\"{$d['id']}\",\"pg_no\":\"{$d['pg_no']}\",\"code\":\"{$d['code']}\",
					  \"name\":\"{$d['name']}\",\"description\":\"{$d['description']}\",
					  \"unit\":\"{$d['unit']}\",\"balance_qty\":\"{$d['balance_qty']}\",\"last_txn\":\"{$d['last_txn']}\"}";
		}*/
	print $retStr;
	return;	
	}
	}
//-------------- check duplicate icom_no -------------------------
	
	if ($f=="icom_no") {
		
	$query="SELECT * FROM $accTable INNER JOIN registrars ON accounts.server_id = registrars.id WHERE accounts.acc_name!='' AND registrars.rly= '$rly1' and registrars.divn='$divn1' and registrars.id='$server_id' ";
	if(isset($_GET['icom_name'])){
		$icom_name=$_GET['icom_name'];
		$query.=" AND accounts.icom_name= \"$icom_name\" ";
	}
	if($action=='search'){
		if($v!='' && $v!='other'){
			$query.=" AND $f RLIKE \"$v\"";
		}
	}
	elseif($action=='match'){
		if($v!='' && $v!='other'){
			$query.=" AND $f = \"$v\"";
		}
	}
	$query.=" ORDER BY accounts.acc_name";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		//$retStr="[{}";
		$retStr="<b class='w3-text-red'>Already in use.</b>";
		/*while($d=mysqli_fetch_assoc($status)){
			$retStr.=(($k++>0)?",":"");
			$retStr.="{\"id\":\"{$d['id']}\",\"pg_no\":\"{$d['pg_no']}\",\"code\":\"{$d['code']}\",
					  \"name\":\"{$d['name']}\",\"description\":\"{$d['description']}\",
					  \"unit\":\"{$d['unit']}\",\"balance_qty\":\"{$d['balance_qty']}\",\"last_txn\":\"{$d['last_txn']}\"}";
		}*/
	print $retStr;
	return;	
	}
	}
//-------------- check duplicate - Conference -------------------------
	
	if ($f=="conf_name" || $f=="conf_no" || $f=="conf_admin" ) {
	$query="SELECT * FROM $confTable INNER JOIN registrars ON conferences.server_id = registrars.id WHERE conf_name!='' AND rly= '$rly1' and divn='$divn1'  and registrars.id='$server_id'";
	if($action=='search'){
		if($v!='' && $v!='other'){
			$query.=" AND $f RLIKE \"$v\"";
		}
	}
	elseif($action=='match'){
		if($v!='' && $v!='other'){
			$query.=" AND $f = \"$v\"";
		}
	}
	$query.=" ORDER BY conf_name";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		$retStr="<b class='w3-text-red'>Already in use.</b>";
	print $retStr;
	return;	
	}
	}
	
//----------------------
	
//-------------- check duplicate - Gateway -------------------------
	
	if ($f=="port_name" || $f=="port_no" || $f=="acc_id" ) {
	$query="SELECT * FROM $gwTable INNER JOIN registrars ON gwports.server_id = registrars.id WHERE port_name!='' AND rly= '$rly1' and divn='$divn1'  and registrar.id='$server_id'";
	if($action=='search'){
		if($v!='' && $v!='other'){
			$query.=" AND $f RLIKE \"$v\"";
		}
	}
	elseif($action=='match'){
		if($v!='' && $v!='other'){
			$query.=" AND $f = \"$v\"";
		}
	}
	$query.=" ORDER BY port_name";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		$retStr="<b class='w3-text-red'>Already in use.</b>";
	print $retStr;
	return;	
	}
	}
	
//----------------------
		// Password: Letter, Number, between 3 to 16
//----------------------
  if ($f=="email") {
	  if ($v==""){
		$emailErr = "Email is required";
	  } else {
		$email = test_input($v);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format";
		}
	  }
  } 
//----------------------
		// Password: Letter, Number, between 3 to 16
//----------------------
	if ($f=="secret1" || $f=="password2") {
		if ($v==""){
			$retStr = "Password is required";
		} else {
			  $retStr = ((strlen($v) < 3 || strlen($v) > 16  ) ? "<b class='w3-text-red'>*Password length should be between 3 to 16</b>":"");
			
			if (!preg_match("/^[a-zA-Z-0-9_]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Some Special characters and WHITE-SPACE NOT allowed</b>";
			}
		  }
	}
//----------------------
		// Names: Letters and Numbers - No whitespace
//----------------------
	if ($f=="disp_name" || $f=="user_id2" ||$f=="acc_name" ||$f=="reg1_name" ||$f=="icom_name" ||$f=="gw_name" ||$f=="route_name" ||$f=="conf_name" ||$f=="port_name") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) > 30  ) ? "<b class='w3-text-red'>* Maximum length 30 characters only</b>":"");
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z-0-9\/_]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Some Special characters and WHITE-SPACE  NOT allowed</b>";
			}
			
		  }
	}
//---------------------
		// Numbers only
//----------------------
	if ( $f=="trans_no1" || $f=="trans_no2"  || $f=="conf_no" || $f=="vlan"  || $f=="pstn_no_length" || $f=="pstn_code" || $f=="callgroup" || $f=="pickupgroup") {
		if ($v==""){	
			$retStr = "";
		} else {
			//$retStr = ((strlen($v) != $rly_no_length  ) ? "<b class='w3-text-red'>* Railway Phone number should be of ".$rly_no_length." digit </b>":"");
			//check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		}
	}
//----------------------
		// Numbers only - No blank
//----------------------
	if ($f=="rly_no_length" || $f=="icom_no_length" || $f=="rly_code"  || $f=="port" || $f=="vm_pw"   ) {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			//$retStr = ((strlen($v) != $rly_no_length  ) ? "<b class='w3-text-red'>* Railway Phone number should be of ".$rly_no_length." digit </b>":"");
			//check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		}
	}
//----------------------
		// Railway number- Numbers only : 5 digits only
//----------------------
	if ($f=="rly_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) != $rly_no_length  ) ? "<b class='w3-text-red'>* Railway Phone number should be of ".$rly_no_length." digit </b>":"");
			//check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// Conference number- Numbers only : Max 5 digits only
//----------------------
	if ($f=="conf_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) > $rly_no_length  ) ? "<b class='w3-text-red'>* Conference number should not be of more than ".$rly_no_length." digit </b>":"");
			//check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// ICOM number- Numbers only : 3 digits only
//----------------------
	if ($f=="icom_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) != $icom_no_length  ) ? "<b class='w3-text-red'>* ICOM number should be of ".$icom_no_length." digit </b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// Short Code number- Numbers only : 3 digits only
//----------------------
	if ($f=="map_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) != 3  ) ? "<b class='w3-text-red'>* Short code should be of 3 digit </b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// Byte number- Numbers only : 2 digits only
//----------------------
	if ($f=="byte_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			//$retStr = ((strlen($v) != 2  ) ? "<b class='w3-text-red'>* Byte code should be of 2 digit </b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// PSTN number- Numbers only : 5 digits only
//----------------------
	if ($f=="pstn_no") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) != $pstn_no_length  ) ? "<b class='w3-text-red'>* PSTN number should be of ".$pstn_no_length." digit </b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		  }
	}
//----------------------
		// MAC - Pattern
//----------------------
	if ($f=="mac") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			//$retStr = ((strlen($v) < 16  ) ? "<b class='w3-text-red'>* Maximum length 16 characters only</b>":"");
			// check if name only contains letters and whitespace
			$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
			if (!preg_match($macStr,$v)) {
			  $retStr = "<b class='w3-text-red'>* Please provide MAC address in Correct Format.</b>";
			}
		  }
	}
//----------------------
		// IP adreess
//----------------------
	if ($f=="reg1_ip" ||  $f=="gw_ip" || $f=="server2" ) {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			//$retStr = ((strlen($v) < 16  ) ? "<b class='w3-text-red'>* Maximum length 16 characters only</b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/i';
			if (filter_var($v, FILTER_VALIDATE_IP)!== false) {
				//$retStr = "<b class='w3-text-red'>* Please provide IP address in Correct Format.</b>";
			} else {
				$retStr = "<b class='w3-text-red'>* Please provide IP address in Correct Format.</b>";
			}
		  }
	}
//---------------------
	
		// IP adreess not mandatory
//----------------------
	if ($f=="reg2_ip") {
		
			//$retStr = ((strlen($v) < 16  ) ? "<b class='w3-text-red'>* Maximum length 16 characters only</b>":"");
			// check if name only contains letters and whitespace
			//$macStr = '/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/i';
			if (filter_var($v, FILTER_VALIDATE_IP)!== false) {
				//$retStr = "<b class='w3-text-red'>* Please provide IP address in Correct Format.</b>";
			} else {
				$retStr = "<b class='w3-text-red'>* Please provide IP address in Correct Format.</b>";
			}
		  
	}
//---------------------
	
	
		// Date
//----------------------
	if ($f=="date") {
		
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			//$retStr = ((strlen($v) < 16  ) ? "<b class='w3-text-red'>* Maximum length 16 characters only</b>":"");
			// check if name only contains letters and whitespace
			$dateStr = '/^[0-3][0-9]-[0-1][0-9]-[0-9]{4}$/i';
			if (!preg_match($dateStr,$v)) {
			  $retStr = "<b class='w3-text-red'>* Please provide Date in dd-mm-YYYY format.</b>";
			}
		  }
	}
//---------------------
	

	}
print $retStr;
}
?>