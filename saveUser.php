<?
//-------------------------------------------------------
date_default_timezone_set("Asia/Kolkata");
$retStr="";
//include('./storesFns.php');
$err[99]="ERROR: Server connection failed. Please retry...";
$err[90]="Unable to select user Database.";
$err[50]="ERROR: This username is in use.";
$err[55]="ERROR: This username doesn't exist.";
$err[40]="ERROR: Failed to create Username. Please retry.";
$err[30]="ERROR: Password mismatch";
$err[35]="ERROR: Password entered is wrong";
$err[11]="Created username";
$err[10]="Signup Request received. please Contact admin for activation";
$err[20]="ERROR: Failed to update";
///////////////////////////////////////////////////////////////
include ('./header.php');
	if(!$conn){
		$retStr=array(90,0,$err[90]." ".mysqli_error($conn));//Error-90: "Unable to select Database: <b>$dbName</b>
	}
$fList	=array("rly","divn","cug","desig","email","name","accountStatus","access","user_type");
///////////////////////////////////////////////////////////////
if(isset($_GET['action'])){
	$action=strtolower($_GET['action']);

		$id=$_GET['id'];
if($id=='' && $action!="activate"){
		if($action=='signup'){
			$fList	=array("rly","divn","cug","desig","email","name");
		}



			//------------ INSERT DATA INTO TABLE ---------------------
		//-------------------------------------------------
		$email=$_GET['email'];
		$passwd=$_GET['passwd'];
		$c_passwd=$_GET['c_passwd'];
		//-------------------------------------------------
		if (empty($_GET["email"])) {
			$emailErr = "Email is required";
			$retStr=array(40,'',$emailErr);
		  } else {
			$email = test_input($_GET["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $emailErr = "Invalid email format";
			  $retStr=array(40,'',$emailErr);
			}
		  
		elseif($passwd==$c_passwd){
			$email=strtolower($email);
			if(!$conn){
					$retStr=array(90,0,$err[90]." ".mysqli_error($conn));//Error-90: "Unable to select Database: <b>$dbName</b>
				}
				else{
					$q="SELECT * FROM $userTable WHERE email=\"$email\" ";
					$s=mysqli_query($conn,$q);
					//print $q." \n\n".mysqli_error($conn)."\n".mysqli_num_rows($s);
					// If the same username is NOT registered, register it.
					if(mysqli_num_rows($s)==0){	// && mysql_num_rows($s)==0){
						$k=0;
						//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
						$q1="INSERT INTO $userTable (";
						$q2="VALUES (";
						foreach($fList as $f){
							if($_GET[$f]!=''){
								if($k>0){
									$q1.=",$f";
									$q2.=",\"".$_GET[$f]."\"";
								}
								else{
									$q1.="$f";
									$q2.="\"".$_GET[$f]."\"";
								}
						

								$k++;
							}
						}
						$q1.=",passwd,activationKey)";
						$q2.=",CONCAT('*', UPPER(SHA1(UNHEX(SHA1(\"$passwd\"))))),	FLOOR(RAND()*1000000))";

						$q="$q1 $q2";
						$status=mysqli_query($conn,$q);
						if(!$status){
							$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
						
						}
						else{
							$id=mysqli_insert_id($conn);
							$query="SELECT name, activationKey, email FROM $userTable WHERE id=\"$id\"";
							$status=mysqli_query($conn,$query);
							$d=mysqli_fetch_array($status);
							//---------------------email ----
							$to = $d['email'];
							
							$retStr= array(11,"email=".$d['email']."&name=".$d['name']."&key=".$d['activationKey']," Activation Key sent to your mail ID -".$to); 
							
							/*	$email = "rexcs.ir@gmail.com";
								
								$subject = "RExCS Activation Key";
								$body = "
										<html>
										<head>
										<title>HTML email</title>
										</head>
										<body>
										<p> Dear ".$d['name']." , </br><h4>Your account is created in RExCS Successfully.</h4>
										<br> Username :<b>".$to."</b>
										<br> Activation key :<b>".$d['activationKey']."</b>
										<br><br> This Activation key can be used to activate your account. </p>
										<br><br><i> Contact RExCS Administrator if any assistance is required:  9000841246</i>
										</body>
										</html>
										";

								// Always set content-type when sending HTML email
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								// More headers
								$headers .= "From: <" .$email.">" . "\r\n";
								if (mail($to, $subject, $body, $headers)) { */
								
								//}else {$retStr= array(33,$d['email'],"Failed to send email");}
							//-------------------------------
							//$retStr= array(11,$d['email'],"Successfuly Created username: <b>$email</b>");// SUCCESS --> USER CREATED
						}
					}
					// If the same username is already registered, do not register/override it. Print Error.
					else{
						$retStr=array(50,0,$err[50]." ".mysqli_num_rows($s));//Error-50: "ERROR: This username is in use.","");
					}
				}

		}
		//-------------------------------------------------
		else{
			$retStr=array(30,'','Password Mismatch');
		}
		}
		//-------------------------------------------------
	
	
	
}
elseif($action=='change'){
		/////////////////change PW/////////////////

		$id=$_GET['id'];
		//$email=$_GET['email'];
		//$cug=$_GET['cug'];
		$cur_passwd=$_GET['cur_passwd'];
		$passwd=$_GET['passwd'];
		$c_passwd=$_GET['c_passwd'];
		//-------------------------------------------------
		if($passwd==$c_passwd){
			//$email=strtolower($email);
			if(!$conn){
					$retStr=array(90,0,$err[90]." ".mysqli_error($conn));//Error-90: "Unable to select Database: <b>$dbName</b>
				}
				else{
					$q="SELECT * FROM $userTable WHERE id=\"$id\" AND accountStatus=\"active\"";
					$s=mysqli_query($conn,$q);
					//print $q." \n\n".mysqli_error($conn)."\n".mysqli_num_rows($s);
					// If the same username is NOT registered, register it.
					if(mysqli_num_rows($s)!=0){	// && mysql_num_rows($s)==0){
						//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
						
					$query="SELECT * FROM  $userTable
							WHERE 	id=\"$id\" AND passwd=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(\"$cur_passwd\")))))";
					$status=mysqli_query($conn,$query);
					//-------------------------------------------------
					if(!(!$status) && mysqli_num_rows($status)>0){
						
						$q="UPDATE $userTable SET passwd=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(\"$passwd\"))))), activationKey=FLOOR(RAND()*1000000) WHERE id=\"$id\"";
						
						$status=mysqli_query($conn,$q);
						if(!$status){
							$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
						}
						else{
							$id=mysqli_insert_id($conn);
							$query="SELECT activationKey FROM $userTable WHERE id=\"$id\"";
							$status=mysqli_query($conn,$query);
							$d=mysqli_fetch_array($status);
							$retStr= array(11,"","Password Changed <br> Please logout and login with new credentials");// SUCCESS --> USER CREATED
						}
					}
					else{
						$retStr=array(35,0,$err[35]." ".mysqli_num_rows($s));//Error-50: "ERROR: Wrong Password","");
					}
					}
					// If the same username is already registered, do not register/override it. Print Error.
					else{
						$retStr=array(55,0,$err[55]." ".mysqli_num_rows($s));//Error-50: "ERROR: This username doesn't extst.","");
					}
				}

		}
		//-------------------------------------------------
		else{
			$retStr=array(30,'','Password Mismatch');
		}		
	}
		elseif($action=='edit'){
			//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
			$q="UPDATE $userTable SET ";
			$k=0;
			foreach($fList as $f){
				if($_GET[$f]!=''){
					if($k>0){
						$q.=", $f=\"".$_GET[$f]."\"";
					}
					else{
						$q.="$f=\"".$_GET[$f]."\"";
					}
					$k++;
				}
			}
			$q.=" WHERE id=\"$id\"";
			$status=mysqli_query($conn,$q);
			if(!$status){
				$retStr=array(30,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
			}
			else{
				$query="SELECT activationKey FROM $userTable WHERE id=\"$id\"";
				$status=mysqli_query($conn,$query);
				$d=mysqli_fetch_array($status);
				$retStr= array(11,"","Successfuly Updated User");// SUCCESS --> USER CREATED
			}

	} 
	elseif($action=='reset'){
			//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
			$q="UPDATE $userTable SET passwd=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(\"iriset\"))))), activationKey=FLOOR(RAND()*1000000) WHERE id=\"$id\"";
						
						$status=mysqli_query($conn,$q);
						if(!$status){
							$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
						}
						else{
							$id=mysqli_insert_id($conn);
							$query="SELECT activationKey FROM $userTable WHERE id=\"$id\"";
							$status=mysqli_query($conn,$query);
							$d=mysqli_fetch_array($status);
							$retStr= array(11,"","Password Reset: New PW- 'iriset' ");// SUCCESS --> USER CREATED
						}

	}
	elseif($action=='activate'){
			$email=$_GET['email'];
			$key=$_GET['key'];
				$query="SELECT activationKey FROM $userTable WHERE email=\"$email\"";
				$status=mysqli_query($conn,$query);
				if(!(!$status) && mysqli_num_rows($status)>0){
								$d=mysqli_fetch_array($status);
								$actKey=$d['activationKey'];
							if ($key==$actKey){
							$q="UPDATE $userTable SET accountStatus='active' WHERE email=\"$email\"";
										
										$status=mysqli_query($conn,$q);
										if(!$status){
											$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
										}
										else{
											$retStr= array(12,"","Account Active");// SUCCESS --> USER CREATED
										}
							}
							else{
											$retStr= array(44,"","Wrong Activation Key");// SUCCESS --> USER CREATED
										}

						}
						else{
							$retStr=array(55,0,$err[55]."/Mail ID not registered.");//Error-55: "ERROR: This username doesn't extst.","");
						}
			
	}
	elseif($action=='activateid'){
							$q="UPDATE $userTable SET accountStatus='active' WHERE id=\"$id\"";
								$status=mysqli_query($conn,$q);
										if(!$status){
											$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
										}
										else{
											$retStr= array(11,"","Account Active");// SUCCESS --> USER CREATED
										}
	}
	elseif($action=='deactivate'){
			//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
			$q="UPDATE $userTable SET accountStatus='inactive' WHERE id=\"$id\"";
						
						$status=mysqli_query($conn,$q);
						if(!$status){
							$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
						}
						else{
							$id=mysqli_insert_id($conn);
							$query="SELECT activationKey FROM $userTable WHERE id=\"$id\"";
							$status=mysqli_query($conn,$query);
							$d=mysqli_fetch_array($status);
							$retStr= array(11,"","Account deactivated");// SUCCESS --> USER CREATED
						}

	}
	elseif($action=='delete'){
			//$q1="INSERT INTO $userTable (rly_code,divn_code,username";
			$q="DELETE FROM $userTable WHERE id=\"$id\"";
						
						$status=mysqli_query($conn,$q);
						if(!$status){
							$retStr=array(20,0,$err[40]." ".mysqli_error($conn));//Error-40: "ERROR: Failed to create Username. Please retry.","");//"SERVER WRITE ERROR";
						}
						else{
							
							$retStr= array(11,"","Account Deleted");// SUCCESS --> USER CREATED
						}

	}
		else {
		$retStr=array(70,'',"Invalid Request");
	}
}
else{
	$retStr=array(98,'',"Invalid Request");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//---------------------------------------------------------
	print "[{ \"retCode\":\"{$retStr[0]}\",	\"retValue\":\"{$retStr[1]}\",	\"retMsg\":\"{$retStr[2]}\"}]";
//---------------------------------------------------------
?>
