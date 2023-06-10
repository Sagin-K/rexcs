<?
date_default_timezone_set('Asia/Kolkata');
include("./userAccess.php");
include("./header.php");

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
			$reg1_user=$d1['reg1_user'];
			$reg1_root=$d1['reg1_root'];
			$location=$d1['location'];
			}
		}
		$retStr=array(99,'','');
		
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
	if((isset($_GET['action'])) && ($_GET['action']=="connect")){
			$ssh->exec('mkdir /etc/asterisk/data');  //create Data folder in Remote server
			$ssh->exec('mkdir /etc/asterisk/backup');  //create Data folder in Remote server
			$ssh->exec('cd /etc/asterisk/data && rm * '); // clears folders
			$ssh->exec('cd /etc/asterisk/voip && rm * ');
		
					if (!$ssh->exec('mkdir /etc/asterisk/voip')){
							$retStr=array(22,'exit','Not able To connect');
						} else {
							$retStr=array(11,'copy','Connected');
					}
						
	}
	if((isset($_GET['action'])) && ($_GET['action']=="copy")){
//--	
	//-------------------------- copy rexcl file to data folder in remote server --------------	
		if (!$sftp->put('/etc/asterisk/data/'.$reg1_name.'_'.$divn1.'_'.$rly1.'_rexcl.rexcl', "./configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl", NET_SFTP_LOCAL_FILE)){
			$retStr=array(33,'exit','Not copied');
		} else {
			$retStr=array(11,'run','Copied');
		}
	//-------------------------- copy rexcl file ends --------------
	}
	if((isset($_GET['action'])) && ($_GET['action']=="run")){
//--
	//-------------------------- execute python3 rexcl file in remote server --------------	
		
		$ssh->exec('cd /etc/asterisk/data && python3 /usr/local/share/Asterisk/rexcl/main.py /etc/asterisk/data/'.$reg1_name.'_'.$divn1.'_'.$rly1.'_rexcl.rexcl');
		if (!$ssh->exec("cp /etc/asterisk/data/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl /etc/asterisk/backup/".$reg1_name."_".$divn1."_".$rly1."_".date('Y-m-d').".rexcl")){
			$retStr=array(11,'update','Excecuted');
		} else {
			$retStr=array(44,'exit',date('Y-m-d'));
		}
	//-------------------------- execute python3 ends --------------	
	}
	if((isset($_GET['action'])) && ($_GET['action']=="update")){
//--
	//--------------- placeholder replacement in remote server------------------
		copy("./configfiles/placeholder-sip.conf","./configfiles/placeholder-".$reg1_ip."-sip.conf");			//-- copy blank placeholder-sip.conf
		copy("./configfiles/placeholder-exten.conf","./configfiles/placeholder-".$reg1_ip."-exten.conf");       //-- copy blank placeholder-exten.conf
		
		$sipfile = fopen("./configfiles/placeholder-".$reg1_ip."-sip.conf", "a") or die("Unable to open file!");
		$extfile = fopen("./configfiles/placeholder-".$reg1_ip."-exten.conf", "a") or die("Unable to open file!");
			$txt="#include \"/etc/asterisk/data/".$reg1_name."-". $reg1_ip."-exten.conf\" \n";
			fwrite($extfile, $txt);																//-- add #include line in placeholder-exten
			$txt="#include \"/etc/asterisk/data/".$reg1_name."-". $reg1_ip ."-sip.conf\" \n";
			fwrite($sipfile, $txt);																//-- add #include line in placeholder-sip
			
			if (!$sftp->put('/etc/asterisk/voip/placeholder-sip.conf',"./configfiles/placeholder-".$reg1_ip."-sip.conf", NET_SFTP_LOCAL_FILE)){   //-- copy placeholder-sip to Remote serv
				$retStr=array(44,'exit','Not copied');	
			} else {
				$retStr=array(11,'exit','SIP copied');
			}
		
		if (!$sftp->put('/etc/asterisk/voip/placeholder-exten.conf',"./configfiles/placeholder-".$reg1_ip."-exten.conf", NET_SFTP_LOCAL_FILE)){ //-- copy placeholder-exten to Remote serv
			$retStr=array(44,'exit','Not copied');	
			} else {
				$retStr=array(11,'reload','EXTN copied');
			}
		
	//--------------- placeholder replacement ends------------------
	}
	if((isset($_GET['action'])) && ($_GET['action']=="reload")){
//--
	//--------------- Reload sip & dialplan in Remote server------------------	
	$ssh->exec('asterisk -rx "sip reload"');
		if(!$ssh->exec('asterisk -rx "dialplan reload"')){
				$retStr=array(44,'exit','Not copied');	
			} else {
				$retStr=array(11,'commit','Reloaded');
			}
		
	//--------------- Reload sip & dialplan ends--------------------
	}
	if((isset($_GET['action'])) && ($_GET['action']=="commit")){

//----------------------------------------copy files & reload Remote server ENDS-----------------------		

	//---------------------- save committed time -------------------
		$q="UPDATE $regTable SET ";
		
		$q.="committed_on=NOW(),log_stamp=NOW() WHERE id = $registrar";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,'exit','Updated DB');
		}
		else{
			$retStr=array(91,'exit',mysqli_error($conn)."<br>".$q);
		}
	}	
	//----------------------------------------------------------- Committed Time save ends-------------------------------------------------------------------------//
	print "[{\"retCode\":\"{$retStr[0]}\", \"retValue\":\"{$retStr[1]}\", \"retMsg\":\"{$retStr[2]}\"}]";	
	} else{      //-------------------------- Choose Server
			Print "<b class='w3-xlarge  w3-text-red'>Please choose a VOIP Server <a href='./index.html?page=reg&acc_type=reg' > From Here </a></b> ";
			}
			?>