<?
date_default_timezone_set('Asia/Kolkata');
include('./userAccess.php');
include('./header.php');
$v=0;

$action="";
///////////////////////////////////////////////////////////////
$icomList	=array("server_id","icom_name","department","vlan","updated_by");
$gwList	=array("type","port","gw_ip","gw_name","updated_by");
$routeList	=array("server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
$phoneList	=array('id',"make","name","remark","updated_by");
$fxsList	=array("gw_id","gw_port","gw_port_name","updated_by");
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
	$id=$_GET['id'];
	$action=$_GET['action'];
	//$accID=$_GET['accID'];
	
if($id!="" && $action=="gw" && $task=="delete"){
	//------------ GW Delete  -------------------------
	$retStr=array(99,'Here','');
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
				if($k>0){
					$q.=", $f=\"\"";
				}
				else{
					$q.="$f=\"\"";
				}
				$k++;
			
		}
		$q.=",updated_by=\"".$_GET['updated_by']."\",log_stamp=NOW() WHERE gw_id=\"$id\" ";
		$retStr=array(99,$q,'');
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
		elseif ($type=="SIP" || $type=="PRI"){
			$retStr=array(99,$type,'');
			$q="SELECT * FROM $routeTable WHERE ( gw_id1 = \"$id\" OR gw_id2 = \"$id\" )";
			$s=mysqli_query($conn,$q);
			if(!(!$s) && mysqli_num_rows($s)>0){
				$retMsg="The Gateway is assigned in Following Routes : ";
			while($d=mysqli_fetch_assoc($s)){
				$retMsg.=$d['route_name']." .";
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



	//------------- action ends -----------
}

//--------------------------------------------------
	print "[{\"retCode\":\"{$retStr[0]}\", \"retValue\":\"{$retStr[1]}\", \"retMsg\":\"{$retStr[2]}\"}]";
//--------------------------------------------------

?>