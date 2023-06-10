<?
date_default_timezone_set('Asia/Kolkata');
include("./createTables.php");
include("./header.php");
//require './AstConf/AstParserN.php';
//regTable();
//icomTable();
//gatewayTable();
//accountTable();
//routeTable();
//phoneTable();
$rootDirLoc="./";
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
			$reg1_user=$d1['reg1_user'];
			$reg1_root=$d1['reg1_root'];
			$location=$d1['location'];
			}
		}
							//print $d1['icom_name']."<br>Dept:".$d1['department'];
							
//---------------------------------------- Create Rexcl file from DATABASE records ---------------------------------------
	
	$myfile = fopen("./configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl", "w") or die("Unable to open file!");  //---open blank file
		
	//------------------------------------------------------------------------ Registrar List -----------------------------------------//			
		$q="SELECT * FROM $regTable where rly='$rly1' and divn='$divn1' and id='$registrar'";
		
		$q.=" ORDER BY reg1_name DESC";
		//print $q;
		$sn=1; 
	 		$txt="";
				$s=mysqli_query($conn,$q);
				print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				
				//--------------------------Write program should come here-------
					$txt.="registrar ".$d['reg1_name']."(".$d['reg1_ip'];
					if($d['reg2_ip']!=""){ $txt.=",".$d['reg2_ip']; }
					$txt.=")\n";
					if($d['rly_code']!=""){ $txt.="rly-std-code (".$d['rly_code'].") \n"; }
					if($d['pstn_code']!=""){ $txt.="pstn-std-code (".$d['pstn_code'].") \n"; }
					
					}
				}
	
	//----------------------------------------------------------- Registrar page ends------------------------------------------------//
		fwrite($myfile, $txt);
	//------------------------------------------------------------- Icom page  -----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $icomTable where server_id = $registrar ";
		
		$q.=" ORDER BY icom_name DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				
							$q1="SELECT * FROM $regTable where id = $registrar";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							//print $d1['icom_name']."<br>Dept:".$d1['department'];
							
					$txt.="icom ".$d['icom_name']."(".$d1['reg1_name'].")\n";
					}}
				}
				}
		fwrite($myfile, $txt);		
	//------------------------------------------------------------- Icom Vlan page  -----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $icomTable WHERE server_id = $registrar AND vlan!='' ";
		
		$q.=" ORDER BY icom_name DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){
					$txt.="vln ".$d['icom_name']."(".$d['vlan'].")\n";
				}
				}
		//fwrite($myfile, $txt);		
	//------------------------------------------------------------------------ Gateway  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $gwTable WHERE server_id = $registrar ";
		//$q.=$search;
		$q.=" ORDER BY gw_name DESC";
		//print $q;
		$sn=1; 

			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){
					
				//--------------------------Write program should come here----------------------------
				$txt.="gateway ".$d['gw_name']." (";
				$txt.=($d['type']=='exch')? "sip": $d['type'];
				$txt.=", ".$d['port'].", ".$d['gw_ip'].")\n";
				}
				}
		fwrite($myfile, $txt);		
	//----------------------------------------------------------- gateway page ends------------------------------------------------//

	//------------------------------------------------------------------------ ipphone -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where server_id= $registrar";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 

			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
							$icom_id=$d['icom_name'];
							$q1="SELECT * FROM $icomTable where id = $icom_id ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
				$txt.="phone ".$d['acc_name']." (".$d1['icom_name'].", ".$d['icom_no'].", ".$d['disp_name'].", ".$d['secret1'].", ".$d['rly_no'].", ";
				$txt.=($d['pstn_no']!="")?$d['pstn_no']:"-1";
				$txt.=")\n";
							}}
				}
				}
		
		fwrite($myfile, $txt);	
	//----------------------------------------------------------- ipphone1 page ends------------------------------------------------//

	//------------------------------------------------------------- IP2 page  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where acc_type = 'ip' AND server2!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				$txt.="ipphone2 ".$d['acc_name']." (".$d['server2'].", ".$d['user_id2'].", ".$d['password2'].")\n";
				}
				}			
		
		fwrite($myfile, $txt);	
	//----------------------------------------------------------- IP2 page ends-------------------------------------------------------------------------//

	//------------------------------------------------------------- Phone-Vlan page  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where acc_type = 'ip' AND acc_vlan!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				$txt.="phone-vlan ".$d['acc_name']." (".$d['acc_vlan'].")\n";
				}
				}			
		
		fwrite($myfile, $txt);	
	//----------------------------------------------------------- Phone-VLAN page ends-------------------------------------------------------------------------//

	//------------------------------------------------------------- map page  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where map_no!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				$txt.="map (".$d['map_no'].",".$d['acc_name'].")\n";
				}
				}			
		
		fwrite($myfile, $txt);	
	//----------------------------------------------------------- map page ends-------------------------------------------------------------------------//

	//------------------------------------------------------------- byte page  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where  byte_no!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				$txt.="byte (".$d['byte_no'].", ".$d['acc_name'].")\n";
				}
				}			
		
		fwrite($myfile, $txt);	
	//----------------------------------------------------------- byte page ends-------------------------------------------------------------------------//

	//------------------------------------------------------------- Boss Secratery  -----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $accTable where ps_no!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				$icom_id=$d['icom_name'];
							$q1="SELECT * FROM $icomTable where id = $icom_id ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$icom_name=$d1['icom_name'];
							}}
				$ps_no=$d['ps_no'];
							$q1="SELECT * FROM $accTable where id = $ps_no ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$ps_name=$d1['acc_name'];
							}}
				$txt.="boss-secy ".$d['acc_name']." ( ".$ps_name;
				if ($d['ps_type']=="only_secy"){ $txt.=",".$d['ps_type']; }
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);	
		//----------------------------------------------------------- Boss-Secy page ends-------------------------------------------------------------------------//
		//------------------------------------------------------------------------ Conference  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $confTable WHERE server_id = $registrar ";
		//$q.=$search;
		$q.=" ORDER BY conf_name DESC";
		//print $q;
		$sn=1; 

			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here----------------------------
				$txt.="conference ".$d['conf_name']."(".$reg1_name.", ".$d['conf_no'].", ".$d['conf_admin'];
				if($d['conf_type']=="attended"){ $txt.=", attended"; }
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);		
		//----------------------------------------------------------- conference lines ends------------------------------------------------//
		//------------------------------------------------------------------------ Route  -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $routeTable WHERE server_id = $registrar ";
		//$q.=$search;
		$q.=" ORDER BY route_name DESC";
		//print $q;
		$sn=1; 

			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here----------------------------
					$q1="SELECT * FROM $gwTable WHERE id =".$d['gw_id1'];
					//$q.=$search;
					$q1.=" ORDER BY gw_name DESC";
					$s1=mysqli_query($conn,$q1);
					//print mysqli_error($conn);
					if(!(!$s1) || mysqli_num_rows($s1)>0){
					while($d1=mysqli_fetch_assoc($s1)){ 
						if($d1['type']=="exch"){ $gw_type1="sip"; } else { $gw_type1=$d1['type']; }
						$gw_name1=$d1['gw_name'];
					}
					}
					if ($d['gw_id2']!="N.A"){
						$q1="SELECT * FROM $gwTable WHERE id =".$d['gw_id2'];
						//$q.=$search;
						$q1.=" ORDER BY gw_name DESC";
						$s1=mysqli_query($conn,$q1);
						//print mysqli_error($conn);
						if(!(!$s1) || mysqli_num_rows($s1)>0){
						while($d1=mysqli_fetch_assoc($s1)){ 
							if($d1['type']=="exch"){ $gw_type2="sip"; } else { $gw_type2=$d1['type']; }
							$gw_name2=$d1['gw_name'];
						}
						}
					}
					$txt.="route ".$d['route_name']."(".$reg1_name.", CLI-RLY , ".$d['pattern'].", ".$gw_type1.":".$gw_name1;
					
						if ($d['transform1']!="None"){    							//-- Transform and pattern for GW_1
							$txt.=":".$d['transform1']."(".$d['trans_no1'].")"; 
							}
						
						if ($d['gw_id2']!="N.A"){									//-- If GW_2 is Available
							$txt.=" | ".$gw_type2.":".$gw_name2;
							}
						if ($d['transform2']!="None"){ 								//-- Transform and pattern for GW_2
							$txt.=":".$d['transform2']."(".$d['trans_no2'].")"; 
							}
							
						$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);		
		//----------------------------------------------------------- Route lines ends------------------------------------------------//
			
				
	fclose($myfile);
//----------------------------------------------Rexcl file save End -------------------------------------------------------------------------
	
//----------------------------------------copy files & reload Remote server -----------------------
	echo "<div class=\"sticky w3-bar \">";
	echo "<div class=\"w3-bar-item w3-xxlarge\" style=\"text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';\"> Update Configuration</b></div>";
	echo "</div>";
	echo "<div class=\"sticky w3-bar \">";
	echo "<i class=\"w3-small w3-text-grey\" >".$reg1_name." Exchange (IP: ". $reg1_ip.")   / [". $divn1." division /". $rly1."]</i>";
	echo "</div>";
			
	echo "<br>";
	echo "<center>";
	echo "<table  width=60% class='w3-threequarter w3-large '>";
		
	
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
		$ssh->exec('mkdir /etc/asterisk/data');  //create Data folder in Remote server
		$ssh->exec('cd /etc/asterisk/data && rm * '); // clears folders
		$ssh->exec('cd /etc/asterisk/voip && rm * ');
		
	//-------------------------- copy rexcl file to data folder in remote server --------------	
		echo "<tr><td  width=60% ><b class='w3-text-blue w3-large'> REXCL File </b></td><td   width=40% class='w3-white w3-large w3-center'>";
		if (!$sftp->put('/etc/asterisk/data/'.$reg1_name.'_'.$divn1.'_'.$rly1.'_rexcl.rexcl', "./configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl", NET_SFTP_LOCAL_FILE)){
			echo "<a href='/configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl' width=100% download><i class='fa fa-download w3-text-red' aria-hidden='true'></i></a>";
		} else {
			echo "<a href='/configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl' width=100% download><i class='fa fa-download w3-text-green' aria-hidden='true'></i></a>";
		}
		echo "</td></tr>";
	//-------------------------- copy rexcl file ends --------------
	
	//-------------------------- execute python3 rexcl file in remote server --------------	
		
		$ssh->exec('cd /etc/asterisk/data && python3 /usr/local/share/Asterisk/rexcl/main.py /etc/asterisk/data/'.$reg1_name.'_'.$divn1.'_'.$rly1.'_rexcl.rexcl');
	//-------------------------- execute python3 ends --------------	
	
	//--------------- placeholder replacement in remote server------------------
		copy("./configfiles/placeholder-sip.conf","./configfiles/placeholder-".$reg1_ip."-sip.conf");			//-- copy blank placeholder-sip.conf
		copy("./configfiles/placeholder-exten.conf","./configfiles/placeholder-".$reg1_ip."-exten.conf"); //-- copy blank placeholder-exten.conf
		
		$sipfile = fopen("./configfiles/placeholder-".$reg1_ip."-sip.conf", "a") or die("Unable to open file!");
		$extfile = fopen("./configfiles/placeholder-".$reg1_ip."-exten.conf", "a") or die("Unable to open file!");
			$txt="#include \"/etc/asterisk/data/".$reg1_name."-". $reg1_ip."-exten.conf\" \n";
			fwrite($extfile, $txt);																//-- add #include line in placeholder-exten
			$txt="#include \"/etc/asterisk/data/".$reg1_name."-". $reg1_ip ."-sip.conf\" \n";
			fwrite($sipfile, $txt);																//-- add #include line in placeholder-sip
			
		echo "<tr><td  width=60% ><b  class='w3-text-blue w3-large' >  placeholder-sip.conf Updation</b></td><td class='w3-white w3-large w3-center'>";	
			if (!$sftp->put('/etc/asterisk/voip/placeholder-sip.conf',"./configfiles/placeholder-".$reg1_ip."-sip.conf", NET_SFTP_LOCAL_FILE)){   //-- copy placeholder-sip to Remote serv
				echo "<i class='fa fa-times w3-text-red ' aria-hidden='true'></i>";	
			} else {
				echo "<i class='fa fa-check w3-text-green ' aria-hidden='true'></i>";
			}
		echo "</td></tr>";
		
		echo "<tr><td  width=60% ><b  class='w3-text-blue w3-large' >  placeholder-exten.conf Updation</b></td><td class='w3-white w3-large w3-center'>";	
		if (!$sftp->put('/etc/asterisk/voip/placeholder-exten.conf',"./configfiles/placeholder-".$reg1_ip."-exten.conf", NET_SFTP_LOCAL_FILE)){ //-- copy placeholder-exten to Remote serv
			echo "<i class='fa fa-times w3-text-red ' aria-hidden='true'></i>";	
		} else {
			echo "<i class='fa fa-check w3-text-green ' aria-hidden='true'></i>";
		}
		echo "</td></tr>";
	//--------------- placeholder replacement ends------------------
	
	//--------------- Reload sip & dialplan in Remote server------------------	
	$ssh->exec('asterisk -rx "sip reload"');
		echo "<tr><td  width=60% ><b  class='w3-text-blue w3-large' >Serverside Conf Files Reload </b></td><td class='w3-white w3-large w3-center'>";
		if(!$ssh->exec('asterisk -rx "dialplan reload"')){
			echo "<i class='fa fa-times w3-text-red' aria-hidden='true'></i></td></tr>";
		} else { 
			echo "<i class='fa fa-check w3-text-green' aria-hidden='true'></i></td></tr>";
		}
	//--------------- Reload sip & dialplan ends--------------------

	echo "</table></centre>";
//----------------------------------------copy files & reload Remote server ENDS-----------------------		
	
	
	
	
	
	
	//---------------------- save committed time -------------------
		$q="UPDATE $regTable SET ";
		
		$q.="committed_on=NOW(),log_stamp=NOW() WHERE id = $registrar";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			//print "<b class='w3-large w3-text-green'>Text File Created !!</b> <br><a href='./".$reg1_name."_".$divn."_".$rly.".txt' download><b class='w3-button w3-blue w3-large w3-text-white'><i class='fa fa-download w3-text-white' aria-hidden='true'></i>  DOWNLOAD FILE </b> </a>";	
			echo "<br>";
			
		
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			print $retStr[0];
		}
		
	//----------------------------------------------------------- Committed Time save ends-------------------------------------------------------------------------//
	} else{      //-------------------------- Choose Server
			Print "<b class='w3-xlarge  w3-text-red'>Please choose a VOIP Server <a href='./index.html?page=reg&acc_type=reg' > From Here </a></b> ";
			}
			?>


</body>
