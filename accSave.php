<?
date_default_timezone_set('Asia/Kolkata');
include('./userAccess.php');
include('./header.php');
$v=0;

$action="";
///////////////////////////////////////////////////////////////
/*$accList	=array("id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","phone","mac","updated_by"); //-- IP phone
$accList4	=array("id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","updated_by");  //-- Analogue Phone
$accList2	=array("server2","user_id2","password2","updated_by"); //-- IP2
$accList3	=array("ps_no","ps_type","updated_by"); //-- Boss-secy
$regList	=array("rly","divn","location","reg1_name","reg1_ip","reg2_ip","reg1_user","reg1_root",
				"rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","updated_by");
$icomList	=array("server_id","icom_name","department","vlan","updated_by");
$gwList	=array("type","port","gw_ip","gw_name","updated_by");
$routeList	=array("server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
$phoneList	=array('id',"make","name","remark","updated_by");
$mapList	=array("map_no","updated_by");
$byteList	=array("byte_no","updated_by");
$fxsList	=array("server_id","gw_id","acc_id","port_no","port_name","updated_by");
$fList5	=array('id', 'status','updated_by');*/

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
						$fList	=array("server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","updated_by");
						$tableName= $accTable; 
					}
	if($action=="ip" && $page!="add"){ 
						$fList	=array("server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","phone","mac","callgroup","pickupgroup","updated_by");
						$tableName= $accTable; 
					}
	if($action=="analog"){ 
						$fList	=array("server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","updated_by");
						$tableName= $accTable; 
					}
	if($action=="analog" && $page!="add"){ 
						$fList	=array("server_id","acc_type","acc_name","icom_name","disp_name","icom_no","secret1","rly_no","pstn_no","callgroup","pickupgroup","updated_by");
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
	if($action=="parallel"){ 
						$fList	=array("parallel_num1","parallel_num2","parallel_num3","parallel_num4","updated_by");
						$tableName= $accTable; 
					}
	if($action=="vm"){ 
						$fList	=array("vm_pw","updated_by");
						$tableName= $accTable; 
					}
	if($action=="reg"){ 
						$fList	=array("rly","divn","location","reg1_name","reg1_ip","reg2_ip","reg1_user","reg1_root","rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","ntp_server","updated_by");
						$tableName= $regTable; 
					}
	if($action=="icom"){ 
						$fList	=array("server_id","icom_name","department","vlan","updated_by");
						$tableName= $icomTable; 
					}
	if($action=="own"){ 
						$fList	=array("updated_by","owner");
						$tableName= $regTable; 
					}
	if($action=="gw"){ 
						$fList	=array("server_id","type","port","gw_ip","gw_name","updated_by");
						$tableName= $gwTable; 
					}
	if($action=="route"){ 
						$fList	=array("server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
						$tableName= $routeTable; 
					}
	if($action=="conf"){ 
						$fList	=array("server_id","conf_name","conf_no","conf_type","conf_admin","remark","updated_by");
						$tableName= $confTable; 
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
	if($action=="fxs" || $action=="fxo"){ 
						$fList	=array("type","server_id","acc_id","gw_id","port_no","port_name","updated_by");
						$tableName= $gwportTable; 
					}
	if($action=="updates"){ 
						$fList	=array("version","date","updates","updated_by","update_rexcl","update_rexcs");
						$tableName= $updateTable; 
					}
	

	//--------------------------
	$id=$_GET['id'];
	
	//------------------------INSERT NEW LINES ---------------------------
	
	if($id=='' && ( $action=="ip" || $action=="analog" || $action=="reg" || $action=="icom" || $action=="route"|| $action=="gw"|| $action=="fxo"|| $action=="fxs"|| $action=="conf"|| $action=="updates")){
		
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
		if($action=="reg"){ 
			$q1.=",owner";
			$q2.=",".$_GET['updated_by'];
		}
		$q1.=",created_by,updated_on,log_stamp)";
		$q2.=",".$_GET['updated_by'].",NOW(),NOW())";
		
		$q="$q1 $q2";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$id=mysqli_insert_id($conn);
			$retStr=array(11,$id,'Added.');
		}
		else{
			$retStr=array(90,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	//-----------------------UPDATE DATA------------------------
	
	elseif($accID!='' && $action!="" ){
		
		$q="UPDATE $tableName SET ";
		$k=0;
		foreach($fList as $f){
				if($k>0){
					$q.=", $f=\"".$_GET[$f]."\"";
				}
				else{
					$q.="$f=\"".$_GET[$f]."\"";
				}
				$k++;
			
		}
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$accID\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

//--------------------------- EDIT EXISTING DATA ( UPDATE LINE ) ----------------------------------------------------------------------------------
	
	elseif($id!="" && ($action=="fxs" || $action=="fxo" || $action=="conf" || ($page=="edit" && $action!="")) && $task!="delete" ){
		
		$q="UPDATE $tableName SET ";
		$k=0;
		foreach($fList as $f){
			
				if($k>0){
					$q.=", $f=\"".$_GET[$f]."\"";
				}
				else{
					$q.="$f=\"".$_GET[$f]."\"";
				}
				$k++;
			
		}
		$q.=",updated_on=NOW(),log_stamp=NOW() WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

//---------------------------------- Delete Line ------------------------------------------------------------------------------------------------
	
	elseif($id!='' && ($action=="ip" || $action=="analog" || $action=="route") && $task=="delete"){
		
		$action="delete";
		$q="DELETE FROM $tableName WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,' Deleted');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}

//------------ Check ICOM and Delete Registrar ----------------------------------------------------------------------------------------------------
		
	elseif($id!='' && $action=="reg" && $task=="delete"){
		
		$q="SELECT * FROM $accTable WHERE server_id=\"$id\" ";
		//print $q;
		$result=mysqli_query($conn,$q);
		if($result && mysqli_num_rows($result)>0){
			$retStr=array(90,$id,'Not deleted.!! Accounts are available in this Registrar');
		}
		else{
		$q="SELECT * FROM $icomTable WHERE server_id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if($s && mysqli_num_rows($s)>0 ){
			
			$retStr=array(90,$id,'Not deleted.!! ICOMS are created in this Registrar');
		}
		else{
			$q="DELETE FROM $regTable WHERE id=\"$id\"";
			//print $q;
			$s=mysqli_query($conn,$q);
			if($s){
				if(isset($_SESSION['registrar']) && ($_SESSION['registrar']==$id)){ unset($_SESSION['registrar']);
				$retStr=array(11,$id,'Registrar Deleted');
			}
			else{
				$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
			}
		}
		}
	}
}
//------------ Check Accounts and Delete ICOM ---------------------------------------------------------------------------------------------------------------

	elseif($id!='' && $action=="icom" && $task=="delete"){
		
			$q="select * FROM $accTable WHERE icom_name=\"$id\" ;";
			//print $q;
			$result=mysqli_query($conn,$q);
			if($result && mysqli_num_rows($result)>0){
				$retStr=array(90,$id,'Not deleted.!! Accounts are available  in this ICOM');
			}
			else{
				$q="DELETE FROM $icomTable WHERE id=\"$id\"";
						//print $q;
						$s=mysqli_query($conn,$q);
						if(!(!$s)){
							$retStr=array(11,$id,'ICOM Deleted');
						}
						else{
							$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
						}
			}
					
	}
	

//------------ Delete Conf ---------------------------------------------------------------------------------------------------------------

	elseif($id!='' && $action=="conf" && $task=="delete"){
		//------------ Delete icom -------------------------
		$action="delete";
		$q="DELETE FROM $confTable WHERE id=\"$id\"";
		//print $q;
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
				$retStr=array(11,$id,'Conference Deleted');
			
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}


//----------------CLEAR COLUMNS ------------------------------------------------------------------------------------------------------------

	elseif($id!="" && ($action=="ip2" || $action=="bs" || $action=="map" || $action=="byte" || $action=="parallel"|| $action=="vm") && $task=="delete"){
		
		$q="UPDATE $tableName SET ";
		$k=0;
		foreach($fList as $f){
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
			$retStr=array(11,$id,'Account Details updated');
		}
		else{
			$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
		}
	}
	
	
//---------- GW DELETE -------------------------------------------------------------------------------------------------------
 
	elseif($id!="" && ($action=="gw" || $action=="sip") && $task=="delete"){

		$q="SELECT * FROM $gwTable WHERE id = \"$id\" ";
		$s=mysqli_query($conn,$q);
		if(!(!$s) || mysqli_num_rows($s)>0){
		while($d=mysqli_fetch_assoc($s)){
			
			$type=$d['type'];
		}}	
		//----FXS/FXO
		
		if ($type=="fxs" || $type=="fxo"){
		$q="DELETE FROM $gwportTable WHERE gw_id=\"$id\"";
		$s=mysqli_query($conn,$q);
		if(!(!$s)){
			$retStr=array(11,$id,'Cleared GW ports in Accounts');
			$q="DELETE FROM $gwTable WHERE id=\"$id\"";
			$s=mysqli_query($conn,$q);		
			if(!(!$s)){
				$retStr=array(11,$id,'Gateway and All Numbers associated in it Deleted');
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
		elseif ($type=="sip" || $type=="pri" || $type=="exch"){
			$q="SELECT * FROM $routeTable WHERE ( gw_id1 = \"$id\" OR gw_id2 = \"$id\" )";
			$s=mysqli_query($conn,$q);
			if(!(!$s) && mysqli_num_rows($s)>0){
				$retMsg="The Gateway is assigned in Following Routes : ";
			while($d=mysqli_fetch_assoc($s)){
				$retMsg.=$d['route_name']." .";
		}
		$retStr=array(90,'',$retMsg);
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

//------------ FXS clear -----------------------------------------------------------------------------------------------------------------
		
	elseif($accID=="" && $action=="fxs"){
		
		$gw_id=$_GET['gw_id'];
		$gw_port=$_GET['gw_port'];
		$action="update";
		$postDate="";
		$q="UPDATE $accTable SET ";
		$k=0;
		foreach($fxsList as $f){
		
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			
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
//----------if(action) ends ---------------------------------------------------------------------------------------------------------------
//----------if(action) ends ---------------------------------------------------------------------------------------------------------------
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
