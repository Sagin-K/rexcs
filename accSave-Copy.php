<?
date_default_timezone_set('Asia/Kolkata');
include('./userAccess.php');
include('./header.php');
$v=0;

$action="";
///////////////////////////////////////////////////////////////
$accList	=array("id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","phone","mac","updated_by"); //-- IP phone
$accList4	=array("id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","updated_by");  //-- Analogue Phone
$accList2	=array("server2","user_id2","password2","updated_by"); //-- IP2
$accList3	=array("ps_no","ps_type","updated_by"); //-- Boss-secy
$regList	=array("rly","divn","location","reg1_name","reg1_ip","reg2_ip",
				"rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","serv_make","updated_by");
$icomList	=array("server_id","icom_name","department","vlan","updated_by");
$gwList	=array("type","port","gw_ip","gw_name","updated_by");
$routeList	=array("server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
$phoneList	=array('id',"make","name","remark","updated_by");
$mapList	=array("map_no","updated_by");
$byteList	=array("byte_no","updated_by");
$fxsList	=array("gw_id","gw_port","gw_port_name","updated_by");
$fList5	=array('id', 'status','updated_by');

///////////////////////////////////////////////////////////////
$retStr=array(99,'','');
$task="";
if(isset($_GET['task']) && $_GET['task']!="" ){
	$task=$_GET['task'];
}
$accID="";
if(isset($_GET['accID']) && $_GET['accID']!="" ){
	$accID=$_GET['accID'];
}
$page="";
if(isset($_GET['page']) && $_GET['page']!="" ){
	$page=$_GET['page'];
}

if(isset($_GET['action'])){
	$action=$_GET['action'];
	//--------------------------
	if($action=="ip"){ 
						$fList	=array("id","server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","phone","mac","updated_by");
						$tableName= $accTable; 
					}
	if($action=="analog"){ 
						$fList	=array("id","server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","updated_by");
						$tableName= $accTable; 
					}
	if($action=="ip2"){ 
						$fList	=array("server2","user_id2","password2","updated_by");
						$tableName= $accTable; 
					}
	if($action=="bs"){ 
						$fList	=array("ps_no","ps_type","updated_by");
						$tableName= $accTable; 
					}
	if($action=="reg"){ 
						$fList	=array("rly","divn","location","reg1_name","reg1_ip","reg2_ip","rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","serv_make","updated_by");
						$tableName= $regTable; 
					}
	if($action=="icom"){ 
						$fList	=array("server_id","icom_name","department","vlan","updated_by");
						$tableName= $icomTable; 
					}
	if($action=="gw"){ 
						$fList	=array("type","port","gw_ip","gw_name","updated_by");
						$tableName= $gwTable; 
					}
	if($action=="route"){ 
						$fList	=array("server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
						$tableName= $routeTable; 
					}
	if($action=="phone"){ 
						$fList	=array('id',"make","name","remark","updated_by");
						$tableName= $accTable; 
					}
	if($action=="map"){ 
						$fList	=array("map_no","updated_by");
						$tableName= $accTable; 
					}
	if($action=="byte"){ 
						$fList	=array("byte_no","updated_by");
						$tableName= $accTable; 
					}
	if($action=="fxs"){ 
						$fList	=array("gw_id","gw_port","gw_port_name","updated_by");
						$tableName= $accTable; 
					}


	//--------------------------
	$id=$_GET['id'];
	
	//$accID=$_GET['accID'];
	if($id=='' && $action=="ip"){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ IP phone Add - INSERT DATA INTO TABLE ---------------------
		$action="add";
		$k=0;
		
		$q1="INSERT INTO $accTable (";
		$q2="VALUES (";
		foreach($accList as $f){
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'IP Number Added.');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id=='' && $action!=""){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ Analogue Phone Add - Insert ---------------------
		$k=0;
		
		$q1="INSERT INTO $tableName (";
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Analogue Number Added.');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id=='' && $action=="reg"){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ Registrar Add - Insert Data---------------------
		$action="add";
		$k=0;
		
		$q1="INSERT INTO $regTable (";
		$q2="VALUES (";
		foreach($regList as $f){
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Registrar Added');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id=='' && $action=="icom"){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ ICOM Add - Insert Data---------------------
		$action="add";
		$k=0;
		
		$q1="INSERT INTO $icomTable (";
		$q2="VALUES (";
		foreach($icomList as $f){
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Intercom Added');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id=='' && $action=="gw"){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ ICOM Add - Insert Data---------------------
		$action="add";
		$k=0;
		
		$q1="INSERT INTO $gwTable (";
		$q2="VALUES (";
		foreach($gwList as $f){
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Gateway Added');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}
	elseif($id=='' && $action=="route"){
		//$updated_on=date('Y-m-d',strtotime($_GET['reqd_date']));
		//------------ ICOM Add - Insert Data---------------------
		$action="add";
		$k=0;
		
		$q1="INSERT INTO $routeTable (";
		$q2="VALUES (";
		foreach($routeList as $f){
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
		$q1.=",updated_on,log_stamp)";
		$q2.=",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Route Added');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($accID!='' && $action=="ip2"){
		//------------ IP2 - Update table-------------------------
		$accID=$_GET['accID'];
		$action="ip2";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList2 as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$accID\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Secondary Account Added');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($accID!='' && $action=="bs"){
		//------------ Boss Secy - Update table  -------------------------
		$accID=$_GET['accID'];
		$action="bs";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList3 as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$accID\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Boss- Secy Connection Added');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($accID!='' && $action=="map"){
		//------------ Boss Secy - Update table  -------------------------
		$accID=$_GET['accID'];
		$action="map";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($mapList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$accID\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Short Code Added');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	elseif($accID!='' && $action=="byte"){
		//------------ Boss Secy - Update table  -------------------------
		$accID=$_GET['accID'];
		$action="map";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($byteList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$accID\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Byte - Intercom Number Added');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
//-------------------------------------------------------edit ----------------------//	
	elseif($id!="" && $page=="edit" && $action=="ip"){
		//------------ IP Phone Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'IP Phone account details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $page=="edit" && $action=="analog"){
		//------------ Analogue Phone Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList4 as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Analogue Phone details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id!="" && $page=="edit" && $action=="reg"){
		//------------ Registrar Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $regTable SET ";
		$k=0;
		foreach($regList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Server details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $page=="edit" && $action=="icom"){
		//------------ ICOM Edit  -------------------------
		//$accID=$_GET['accID'];
		$q="UPDATE $icomTable SET ";
		$k=0;
		foreach($icomList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Intercom updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id!="" && $page=="edit" && $action=="gw"){
		//------------ GW Edit  -------------------------
		//$accID=$_GET['accID'];
		$q="UPDATE $gwTable SET ";
		$k=0;
		foreach($gwList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Gateways updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	
	elseif($id!="" && $page=="edit" && $action=="route"){
		//------------ RouteEdit  -------------------------
		//$accID=$_GET['accID'];
		$q="UPDATE $gwTable SET ";
		$k=0;
		foreach($gwList as $f){
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
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Route updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	

//----------------------------------delete -----------------------------------//
	
	elseif($id!='' && ($action=="ip" || $action=="analog") && $task=="delete"){
		//------------ Delete Account -------------------------
		$action="delete";
		$q="DELETE FROM $accTable WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Account Deleted');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!='' && $action=="reg" && $task=="delete"){
		//------------ Delete registrar -------------------------
		$action="delete";
		
		$q="select * FROM $icomTable WHERE server_id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s) || mysqli_num_rows($s)>0){
			
			$retStr=array(90,$id,'Intercoms are available in this Registrar/Server');
		}
		else{
			$q="DELETE FROM $regTable WHERE id=\"$id\"";
			//print $q;
			$s=mysqli_query($conn,$q);
			if(!(!$s)){
				$retStr=array(11,$id,'Registrar Deleted');
			}
			else{
				$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			}
		}
	}


	elseif($id!='' && $action=="icom" && $task=="delete"){
		//------------ Delete icom -------------------------
		$action="delete";
		$q="DELETE FROM $icomTable WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$q="DELETE FROM $accTable WHERE icom_name=\"$id\"";
			//print $q;
			$s=mysqli_query($conn,$q);
			if(!(!$s)){
				$retStr=array(11,$id,'Intercom  And All numbers in it Deleted');
			}
			else{
				$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			}
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $action=="ip2" && $task=="delete"){
		//------------ IP2 Edit Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList2 as $f){
			if($f!="updated_by"){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Secondary Account details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $action=="bs" && $task=="delete"){
		//------------ BS Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($accList3 as $f){
			if($f!="updated_by"){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Boss-Secy details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $action=="map" && $task=="delete"){
		//------------ BS Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($mapList as $f){
			if($f!="updated_by"){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Short Code Deleted');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

	elseif($id!="" && $action=="byte" && $task=="delete"){
		//------------ BS Edit  -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($byteList as $f){
			if($f!="updated_by"){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Byte-Intercom number Deleted');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	elseif($id!="" && $action=="gw" && $task=="delete"){
	//------------ GW Delete  -------------------------
		$q="SELECT * FROM $gwTable WHERE id = \"$id\" ";
		$s=mysqli_query($conn,$q);
		if(!(!$s) || mysqli_num_rows($s)>0){
		while($d=mysqli_fetch_assoc($s)){
			$type=$d['type'];
		}}	
		//----FXS/FXO
		
		if ($type=="fxs" || $type=="fxo"){
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($fxsList as $f){
			if($_GET[$f]!=''){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE gw_id=\"$id\" ";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Cleared GW ports in Accounts');
			$q="DELETE FROM $gwTable WHERE id=\"$id\"";
			$s=mysqli_query($conn,$q);		
			if(!(!$s)){
				$retStr=array(11,$id,'Gateway All Numbers associated in it Deleted');
			}
			else{
				$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			}
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
		}
		//----SIP/PRI
		elseif ($type=="sip" || $type=="pri"){
			$q="SELECT * FROM $routeTable WHERE ( gw_id1 = \"$id\" OR gw_id2 = \"$id\" )";
			$s=mysqli_query($conn,$q);
			if(!(!$s) || mysqli_num_rows($s)>0){
				$retMsg="The Gateway is assigned in Following Routes \n";
			while($d=mysqli_fetch_assoc($s)){
				$retMsg.=$d['route_name']." \n";
		}
		$retStr=array(12,'',$retMsg);
		}
		else{
			$q="DELETE FROM $gwTable WHERE id=\"$id\"";
			$s=mysqli_query($conn,$q);
			
			if(!(!$s)){
				$retStr=array(11,$id,'Gateway Deleted');
			}
			else{
				$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			}
		}
		}
	}

	
	elseif($id!="" && $action=="fxs" ){
		//------------ FXS port add -------------------------
		//$accID=$_GET['accID'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($fxsList as $f){
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
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'FXS port Assigned for Analogue number');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	elseif($id=="" && $action=="fxs"){
		//------------ FXS clear -------------------------
		$gw_id=$_GET['gw_id'];
		$gw_port=$_GET['gw_port'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($fxsList as $f){
			if($_GET[$f]!=''){
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			}
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE gw_id=\"$gw_id\" AND gw_port=\"$gw_port\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Cleared FXS port');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
//----------if(action) ends -------------
}    	









//------------file upload save--------here 
if (isset($_POST['uploadBtn']) && $_POST['id']!="")
{
	if($_POST['uploadBtn'] == 'Upload'){ $doc="docs";}
	if($_POST['uploadBtn'] == 'UploadPO'){ $doc="po";}
	if($_POST['uploadBtn'] == 'UploadLOA'){ $doc="loa";}
	$id=$_POST['id'];
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
	// get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension; 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc','pdf');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $newFileName;
 
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
        $q="UPDATE $reqTable SET $doc=CONCAT(ifnull($doc,''),':',\"$dest_path\")";
		//update tablename set col1name = concat(ifnull(col1name,""), 'a,b,c');
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'File uploaded');
			$location=$_SERVER['HTTP_REFERER'];
			header("Location:".$location);
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
      }
      else
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
	

//--------------------------------------------------
	print "[{\"retCode\":\"{$retStr[0]}\", \"retValue\":\"{$retStr[1]}\", \"retMsg\":\"{$retStr[2]}\"}]";
//--------------------------------------------------

?>
