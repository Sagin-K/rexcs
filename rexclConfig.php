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
	//print $d1['icom_name']."<br>Dept:".$d1['department'];
	
	if((isset($_GET['action'])) && ($_GET['action']=="create")){						
//---------------------------------------- Create Rexcl file from DATABASE records ---------------------------------------
	
	$myfile = fopen("./configfiles/".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl", "w") or die("Unable to open file!".$reg1_name."_".$divn1."_".$rly1."_rexcl.rexcl");  //---open blank file
		
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
				$txt.=", ".$d['callgroup'].", ".$d['pickupgroup'];
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
	//------------------------------------------------------------- Parallel Num-----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $accTable where parallel_num1!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				
				$parallel_num1=$d['parallel_num1'];
							$q1="SELECT * FROM $accTable where id = $parallel_num1 ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$parallel_num1=$d1['rly_no'];
							}}
				$parallel_num2=$d['parallel_num2'];
				if ($parallel_num2 !=""){
							$q1="SELECT * FROM $accTable where id = $parallel_num2 ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$parallel_num2=$d1['rly_no'];
							}} 
				}
				$parallel_num3=$d['parallel_num3'];
				if ($parallel_num3 !=""){
							$q1="SELECT * FROM $accTable where id = $parallel_num3 ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$parallel_num3=$d1['rly_no'];
							}}
				}
				$parallel_num4=$d['parallel_num4'];
				if ($parallel_num4 !=""){
							$q1="SELECT * FROM $accTable where id = $parallel_num4 ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							$parallel_num4=$d1['rly_no'];
							}}
				}
							
				$txt.="parallel  ( ".$parallel_num1.",".$parallel_num2.",".$parallel_num3.",".$parallel_num4.",".$d['acc_name'];
				
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);	
		//----------------------------------------------------------- Parallel page ends-------------------------------------------------------------------------//
		//------------------------------------------------------------- Voicemail Page-----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $accTable where vm_pw!='' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				
				$txt.="vm (".$d['vm_pw'].",".$d['acc_name'];
				
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);	
		//----------------------------------------------------------- Voicemail Page ends-------------------------------------------------------------------------//
		//------------------------------------------------------------- Voicemail Page-----------------------------------------//			
			
		$txt="";	
		$q="SELECT * FROM $accTable where recording='Yes' and server_id= $registrar ";
		//$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
			
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				//--------------------------Write program should come here-------
				
				$txt.="rec (".$d['recording'].",".$d['acc_name'];
				
				$txt.=")\n";
				}
				}
		fwrite($myfile, $txt);	
		//----------------------------------------------------------- Voicemail Page ends-------------------------------------------------------------------------//
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
	$retStr=array(11,'connect','RExCL file Created');
	print "[{\"retCode\":\"{$retStr[0]}\", \"retValue\":\"{$retStr[1]}\", \"retMsg\":\"{$retStr[2]}\"}]";	
//----------------------------------------------Rexcl file save End -------------------------------------------------------------------------
	}
		
	//----------------------------------------------------------- Committed Time save ends-------------------------------------------------------------------------//
	} else{      //-------------------------- Choose Server
			Print "<b class='w3-xlarge  w3-text-red'>Please choose a VOIP Server <a href='./index.html?page=reg&acc_type=reg' > From Here </a></b> ";
			}
			?>



