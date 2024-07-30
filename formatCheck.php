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
		$v = test_input($_GET[$f]);
		
	//----------------------
	//---------------------
	//----------------------
	if ($f=="secret1") {
	if ($v==""){
		$retStr = "Should NOT be blank";
	} else {
		// check if name only contains letters and whitespace
		
		  $retStr = ((strlen($v) < 3 || strlen($v) > 16  ) ? "<b class='w3-text-red'>*Password length should be between 3 to 16</b>":"");
		
		if (!preg_match("/^[a-zA-Z-0-9'_]*$/",$v)) {
		  $retStr = "<b class='w3-text-red'>* Some Special characters NOT allowed</b>";
		}
	  }
	}
	//---------------------
	//----------------------
	if ($f=="disp_name" || $f=="user_id2" || $f=="acc_name") {
	if ($v==""){	
		$retStr = "Should NOT be blank";
	} else {
		$retStr = ((strlen($v) > 16  ) ? "<b class='w3-text-red'>* Maximum length 16 characters only</b>":"");
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z-0-9'_]*$/",$v)) {
		  $retStr = "<b class='w3-text-red'>* Some Special characters including Whitespace NOT allowed</b>";
		}
	  }
	}
	//---------------------
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
	//---------------------
	//----------------------
	if ($f=="icom_no") {
	if ($v==""){	
		$retStr = "Should NOT be blank";
	} else {
		$retStr = ((strlen($v) != 3  ) ? "<b class='w3-text-red'>* ICOM number should be of ".$icom_no_length." digit </b>":"");
		// check if name only contains letters and whitespace
		//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
		if (!preg_match("/^[0-9]*$/",$v)) {
		  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
		}
	  }
	}
	//---------------------
	//----------------------
	if ($f=="rly_no") {
	if ($v==""){	
		$retStr = "Should NOT be blank";
	} else {
		$retStr = ((strlen($v) != 3  ) ? "<b class='w3-text-red'>* ICOM number should be of ".$rly_no_length." digit </b>":"");
		// check if name only contains letters and whitespace
		//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
		if (!preg_match("/^[0-9]*$/",$v)) {
		  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
		}
	  }
	}
	//---------------------
	//----------------------
	if ($f=="icom_no") {
	if ($v==""){	
		$retStr = "Should NOT be blank";
	} else {
		$retStr = ((strlen($v) != 3  ) ? "<b class='w3-text-red'>* ICOM number should be of ".$icom_no_length." digit </b>":"");
		// check if name only contains letters and whitespace
		//$macStr = '/^[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}-[A-F0-9]{2}$/i';
		if (!preg_match("/^[0-9]*$/",$v)) {
		  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
		}
	  }
	}
	//---------------------
	
	}
}
print $retStr;

?>
