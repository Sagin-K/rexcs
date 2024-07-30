<?
date_default_timezone_set('Asia/Kolkata');
include("./createTables.php");
include("./header.php");
require './AstConf/AstParserN.php';
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
		}}
							//print $d1['icom_name']."<br>Dept:".$d1['department'];
	$myfile = fopen("./configfiles/".$reg1_name."_".$divn1."_".$rly1.".txt", "w") or die("Unable to open file!");
		
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
				
				}
				}
		fwrite($myfile, $txt);
//----------------------------------------------------------- Registrar page ends------------------------------------------------//
		
		
//------------------------------------------------------------------------ Neighbour Registrar List -----------------------------------------//			
			
		$q="SELECT * FROM $gwTable where type='exch' AND server_id='$registrar'";
		
		$q.=" ORDER BY gw_name DESC";
		//print $q;
		$sn=1; 
	 		$txt="";
				$s=mysqli_query($conn,$q);
				print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				
				//--------------------------Write program should come here-------
				$txt.="registrar ".$d['gw_name']."(".$d['gw_ip'];
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);
//----------------------------------------------------------- Neighbour Registrar page ends------------------------------------------------//
		
//------------------------------------------------------------------------ STD Code List -----------------------------------------//			
			
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
				if($d['rly_code']!=""){ $txt.="rly_std_code ".$d['rly_code']." \n"; }
				if($d['pstn_code']!=""){ $txt.="pstn_std_code ".$d['pstn_code']." \n"; }
				
				}
				}
		fwrite($myfile, $txt);
//----------------------------------------------------------- STD Code page ends------------------------------------------------//
		
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
		$q="SELECT * FROM $gwTable WHERE server_id = $registrar AND type!='exch' ";
		//$q.=$search;
		$q.=" ORDER BY gw_name DESC";
		//print $q;
		$sn=1; 

			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here----------------------------
				$txt.="gateway ".$d['gw_name']." (".$d['type'].", ".$d['port'].", ".$d['gw_ip'].")\n";
				}
				}
		fwrite($myfile, $txt);		
//----------------------------------------------------------- gateway page ends------------------------------------------------//

//------------------------------------------------------------------------ ipphone -----------------------------------------//			
		$txt="";	
		$q="SELECT * FROM $accTable where acc_type = 'ip' and server_id= $registrar";
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
				$txt.="ipphone ".$d['acc_name']." (".$d1['icom_name'].", ".$d['disp_name'].", ".$d['mac'].", ".$d['phone'].", ".$d['icom_no'].", ".$d['secret1'].", ".$d['rly_no'].", ";
				$txt.=($d['pstn_no']!="")?$d['pstn_no']:"-1";
				$txt.=")\n";
							}}
				}
				}
		
		fwrite($myfile, $txt);	
//----------------------------------------------------------- ipphone1 page ends------------------------------------------------//


//------------------------------------------------------------- Analogue Phone  -----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $accTable where acc_type = 'analog' and server_id= $registrar ";
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
				$txt.="aphone ".$d['acc_name']." (".$d1['icom_name'].", ".$d['disp_name'].", ".$d['icom_no'].", ".$d['secret1'].",  ".$d['rly_no'].", ";
				$txt.=($d['pstn_no']!="")?$d['pstn_no']:"-1";
				$txt.=")\n";
							}}
				}
				}
		fwrite($myfile, $txt);
		//------------------------------------------------------------- Analogue Phone  Ends-----------------------------------------//				

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
		$q="SELECT * FROM $accTable where acc_type = 'ip' AND ps_no!='' and server_id= $registrar ";
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
				$txt.="boss_secy ".$d['acc_name']." (".$icom_name.", ".$d['ps_type'].", ".$ps_name.")\n";
				}
				}
		fwrite($myfile, $txt);	
//----------------------------------------------------------- Boss-Secy page ends-------------------------------------------------------------------------//
//------------------------------------------------------------- FXS port Phone  -----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $gwportTable where server_id=$registrar";
		//$q.=$search;
		$q.=" ORDER BY port_no DESC";
		//print $q;
		$sn=1; 
	
				$s=mysqli_query($conn,$q);
				print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
							$gw_id=$d['gw_id'];
							$acc_id=$d['acc_id'];
							$q1="SELECT gw_name FROM $gwTable where id = $gw_id AND type!='sip' AND type!='pri'";	
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$gw_name=$d1['gw_name'];
							}}
							
							$q2="SELECT acc_name FROM $accTable where id = $acc_id ";	
							$s2=mysqli_query($conn,$q2);
							if(!(!$s2) || mysqli_num_rows($s2)>0){
							while($d2=mysqli_fetch_assoc($s2)){ 
							$acc_name=$d2['acc_name'];
							}}
							
							$txt.=$d['type']."port ".$d['port_name']." (".$gw_name.", ".$d['port_no'].", ".$acc_name.")\n";
				}
				}
				
			//print $txt;
		fwrite($myfile, $txt);
		//------------------------------------------------------------- FXS port Ends-----------------------------------------//			
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
					/*if ($d['gw_id2']!=""){
						$q1="SELECT * FROM $gwTable WHERE id =".$d['gw_id2'];
						//$q.=$search;
						$q1.=" ORDER BY gw_name DESC";
						$s1=mysqli_query($conn,$q1);
						//print mysqli_error($conn);
						if(!(!$s1) || mysqli_num_rows($s1)>0){
						while($d1=mysqli_fetch_assoc($s1)){ 
							$gw_type2=$d1['type'];
							$gw_name2=$d1['gw_name'];
						}
						}
					}*/
					$txt.="route ".$d['route_name']."(".$reg1_name.", ".$d['pattern'].", ".$gw_type1.":".$gw_name1;
						//if($d['conf_type']=="attended"){ $txt.=", attended"; }
						$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);		
		//----------------------------------------------------------- Route lines ends------------------------------------------------//
			
				
	fclose($myfile);
	
	//---------------------- save committed time -------------------
		$q="UPDATE $regTable SET ";
		
		$q.="committed_on=NOW(),log_stamp=NOW()";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			//print "<b class='w3-large w3-text-green'>Text File Created !!</b> <br><a href='./".$reg1_name."_".$divn."_".$rly.".txt' download><b class='w3-button w3-blue w3-large w3-text-white'><i class='fa fa-download w3-text-white' aria-hidden='true'></i>  DOWNLOAD FILE </b> </a>";	
			main("./configfiles/".$reg1_name."_".$divn1."_".$rly1.".txt",$reg1_user,$reg1_root,$reg1_name);
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
