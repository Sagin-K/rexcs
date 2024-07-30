<?
date_default_timezone_set('Asia/Kolkata');
include('./userAccess.php');
include('./header.php');
$v=0;

$action="";
///////////////////////////////////////////////////////////////

$retStr=array(99,'','');
$task="";

if(isset($_GET['page']) && $_GET['page']!="" ){
	$page=$_GET['page'];
}
if(isset($_GET['action'])){
	$action=$_GET['action'];
	//--------------------------
	if ($action=="update"){
	$fList	=array("version","updates","updated_by","update_rexcl","update_rexcs");
	$tableName= "updates"; 
	}
	//--------------------------
	if ($action=="features"){
	$fList	=array("feature","code","status","remarks");
	$tableName= "features"; 
	}
	//--------------------------
	$id=$_GET['id'];
	
	//------------------------INSERT NEW LINES ---------------------------
	
	if($id=='' && $page=="add"){
		$date=date('Y-m-d',strtotime($_GET['date']));
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
		$q1.=",date,log_stamp)";
		$q2.=",\"$date\",NOW())";
		
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
	
	elseif($id!='' && $page!="delete" ){
		$date=date('Y-m-d',strtotime($_GET['date']));
		
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
		$q.=",date=\"$date\",log_stamp=NOW() WHERE id=\"$id\"";
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
	
	elseif($id!='' && $page=="delete" ){
		
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
