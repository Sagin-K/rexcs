<?
include("./header.php");
//include("./userAccess.php");

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

	
	if(isset($_GET['f'])){
		$f=$_GET['f'];
	}
	if(isset($_GET[$f]) && $_GET[$f]!=""){
		$v = $_GET[$f];
		
//-------------- check duplicate -------------------------
	
	if ($f=="name" || $f=="email" || $f=="cug" ) {
	$query="SELECT * FROM astusers WHERE email!='' ";
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
	$query.=" ORDER BY name";
	//----------------------------------------------------------
	$status=mysqli_query($conn,$query);
	if(!$status){
		$retStr="";
	}
	elseif(mysqli_num_rows($status)>0){
		$k=0;
		//$retStr="[{}";
		$retStr="<b class='w3-text-red'>Already in use.</b>";
	print $retStr;
	return;	
	}
	}
	
//----------------------
		// Email
//----------------------
  if ($f=="email") {
	  if ($v==""){
		$retStr = "<b class='w3-text-red'>*Email is required</b>";
	  } else {
		$email = test_input($v);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$retStr = "<b class='w3-text-red'>*Invalid email format</b>";
		}
		
	  }
  } 
//----------------------
		// Password: Letter, Number, between 3 to 16
//----------------------
	if ($f=="passwd" || $f=="c_passwd" ) {
		if ($v==""){
			$retStr = "<b class='w3-text-red'>* Password is required</b>";
		} else {
			  $retStr = ((strlen($v) < 8 || strlen($v) > 16  ) ? "<b class='w3-text-red'>*Password length should be between 8 to 16</b>":"");
			
			if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* [Password should be of minimum 8 characters which contain at least one numeric digit, one uppercase and one lowercase letter]</b>";
			}
		  }
	}
//----------------------
		// Names: Letters and Numbers - No whitespace
//----------------------
	if ($f=="name" || $f=="divn"  || $f=="rly"   || $f=="desig" ) {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) > 30  ) ? "<b class='w3-text-red'>* Maximum length 30 characters only</b>":"");
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z-0-9\/\_]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Some Special characters and WHITE-SPACE NOT allowed</b>";
			}
		  }
	}
//---------------------

//----------------------
		// Numbers only - No blank
//----------------------
	if ($f=="cug") {
		if ($v==""){	
			$retStr = "Should NOT be blank";
		} else {
			$retStr = ((strlen($v) != 10  ) ? "<b class='w3-text-red'>* CUG number should be of 10 digit </b>":"");
			if (!preg_match("/^[0-9]*$/",$v)) {
			  $retStr = "<b class='w3-text-red'>* Numbers Only (0-9).</b>";
			}
		}
	}
	
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