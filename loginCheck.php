<?
//session_start();
//----------------------------------------------------------
//--function to verify Login & Passwords--------------------
function validateLogRequest($u,$p){
include ('./Connect.php');
	$userTable="astusers";
		$query="SELECT * FROM $userTable
				WHERE 	email=\"$u\" ";
		$status=mysqli_query($conn,$query);
		//--------------------------------------------------
		if(!$status){
			return array(90,"",mysqli_error($conn));
		}
		else{
			if(mysqli_num_rows($status)>0){
				$userData=mysqli_fetch_assoc($status);
				//------------------------------------------
				if(strcasecmp($userData['accountStatus'],'inactive')==0){
					return array(50,"","");		// username EXISTS but INACTIVE
				}
				elseif(strcasecmp($userData['accountStatus'],'disabled')==0){
					return array(51,"","");		// username EXISTS but DISABLED
				}
				elseif(strcasecmp($userData['accountStatus'],'deactivated')==0){
					return array(52,"","");		// username EXISTS but DEACTIVATED
				}
				elseif(strcasecmp($userData['accountStatus'],'deleted')==0){
					return array(53,"","");		// username EXISTS but DELETED
				}
				elseif(strcasecmp($userData['accountStatus'],'blocked')==0){
					return array(53,"","");		// username EXISTS but DELETED
				}
				else{
					
					//-------------------------------------------------
					// 	If user Id is Active, ie. Activated, not-disabled,
					//	not-deleted, then check password
					//-------------------------------------------------
					$query="SELECT * FROM  $userTable
							WHERE 	email=\"$u\" AND passwd=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(\"$p\"))))) AND accountStatus=\"active\"";
					
					$status=mysqli_query($conn,$query);
					//print $query;
					//-------------------------------------------------
					if(!(!$status) & mysqli_num_rows($status)>0){
						//-------Start Session of User ----------------
						$data=mysqli_fetch_assoc($status);
						//session_start();
						
						$_SESSION['astuser']=		$data['name'];
						$_SESSION['astid']=			$data['id'];
						$_SESSION['astrly']=		$data['rly'];
						$_SESSION['astdivn']=		$data['divn'];
						//$_SESSION['dept']=		$data['dept'];
						$_SESSION['astemail']=		$data['email'];
						$_SESSION['astdesig']=		$data['desig'];
						$_SESSION['astcug']=		$data['cug'];
						$_SESSION['astaccess']=		$data['access'];
						$_SESSION['astuser_type']=	$data['user_type'];
						//$_SESSION['board']=		$data['board'];
						$_SESSION['astlog_stamp']=	date('r');
						$query="UPDATE $userTable SET last_log=NOW() WHERE id=\"{$data['id']}\"";
						$status=mysqli_query($conn,$query);
						//		WHERE 	username=\"$u\" AND passwd=PASSWORD(\"$p\") AND
						//				rly_code=\"$r\" AND divn_code=\"$d\"";
						$tableName="astusers_log";
						$query="INSERT INTO $tableName (ref_id,action, log_stamp)
								VALUES (\"{$data['id']}\",'LOGIN',NOW())";
						$status=mysqli_query($conn,$query);
						// //-------------------------------------------------						
						return array(11,"","");		// username EXISTS, PASSWORD CORRECT & Matches
					}
					else{
						print mysqli_error($conn);
						return array(40,"",mysqli_error($conn));		// username EXISTS but PASSWORD INCORRECT
					}
					//------------------------------------------------- 
					return array(11,"","");
				}
				//------------------------------------------
			}
			else{
				return array(54,"",mysqli_error($conn));	// Incorrect username
			}
		}
	
}


//----------------------------------------------------------
//----------------------------------------------------------
date_default_timezone_set("Asia/Kolkata");
// Requires the PHP Functions for processing the Login-process
//include("./storesFns.php");
//----------------------------------------------------------
$err[99]="ERR-99: Server connection failed. Retry. ";
$err[90]="ERR-90: Unable to select user Database. ";
$err[50]="ERR-50: Inactive USER-ID. Contact <br>System Admin with Activation Key. ";
$err[51]="ERR-51: User ID Disabled. ";
$err[52]="ERR-52: User ID Deactivated. ";
$err[53]="ERR-53: User ID Deleted. ";
$err[54]="ERR-54: Invalid User ID. ";
$err[55]="ERR-55: Invalid User ID. ";
$err[40]="ERR-40: Incorrect password. Retry. ";
$err[11]="Login Successful. ";
$err[10]="Login Failed. Retry. ";
$err[00]="Login Failed. Retry. ";
$logStatus=array(00,"","");
//----------------------------------------------------------
if(isset($_GET['action'])){
	include ('./Connect.php');
	session_start();
	if(strcasecmp($_GET['action'],"login")==0){
		$u=		$_GET['u'];
		$p=		$_GET['p'];
		$logStatus=validateLogRequest($u,$p);
	}
	
//-----------------------------------------------------------
//--------------- WHEN USER LOGS OUT FROM ANY PAGE ----------
//-----------------------------------------------------------
	else if(strcasecmp($_GET['action'],"logout")==0 && isset($_SESSION['astuser'])){	
		$userTable="astusers";
		$query="SELECT id FROM $userTable WHERE name=\"".$_SESSION['astuser']."\"";
		$status=mysqli_query($conn,$query);
		//print "2.".$query."<br>".mysql_error();
		$data=mysqli_fetch_assoc($status);
		
		$tableName="astusers_log";
		$query="INSERT INTO $tableName (ref_id,action,log_stamp)
				VALUES (\"{$data['id']}\",'LOGOUT',NOW())";
		$status=mysqli_query($conn,$query);
		//print "2.".$query."<br>".mysql_error();
		unset($_SESSION['astuser']);
		unset($_SESSION['astid']);
		unset($_SESSION['astdivn']);
		unset($_SESSION['astrly']);
		unset($_SESSION['astemail']);
		unset($_SESSION['astdesig']);
		unset($_SESSION['astcug']);
		unset($_SESSION['astaccess']);
		unset($_SESSION['astuser_type']);
		unset($_SESSION['registrar']);
		$logStatus=array(false,"You have successfully logged out.");
		header("Location: /login.html");
	}
	else{
		$logStatus=array(00,"","");
	}
}



//----------------------------------------------------------
$retStr="[{	\"retCode\" :\"{$logStatus[0]}\",
			\"retValue\":\"{$logStatus[1]}\",
			\"retMsg\"	:\"".$err[$logStatus[0]].$logStatus[2]."\"}]";
print $retStr;
//----------------------------------------------------------



?>
