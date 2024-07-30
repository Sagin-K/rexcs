<!DOCTYPE html>
<html>
  <head>
    <title>UPDATES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./w3.css">
	<link rel="stylesheet" href="./jquery/jquery-ui.css">
	<script src="./jquery/jquery-1.10.2.js"></script>
	<script src="./jquery/jquery-ui.js"></script>	<!--script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script-->
	<link rel="stylesheet" href="./jquery/style.css">
	<script src="./datepicker.js"></script>
	<script src="./index1.js"></script>
	<script>
	$(function() {
		$( "#date" ).datepicker({
			
			changeMonth:true,
			changeYear: true});
	});
	$(function() {
		$( "#in_date" ).datepicker({
			//minDate: 0,
			dateFormat: 'dd-mm-yy',
			changeMonth:true,
			changeYear: true});
	});


function formatDate(id){
	var d=document.getElementById(id).value;
	//alert("Note Date:"+d);
	if(d.indexOf('/')>=0){
		var tmp=d.split('/');
		x=tmp[2]+"-"+tmp[0]+"-"+tmp[1];
		document.getElementById(id).value=x;
	}
	return;
}
</script>
	<style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, label { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 12px;
      color: #666;
      line-height: 15px;
      }
      h1 {
      position: absolute;
      margin:0;
      font-size: 60px;
      color: #fff;
      z-index: 2;
      line-height: 83px;
      top:30px;
      }
      legend {
      padding: 10px;      
      font-family: Roboto, Arial, sans-serif;
      font-size: 18px;
	  capitalize;
      color: #18303c;
      }
      textarea {
      width: calc(80% - 12px);
      padding: 5px;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      //border: brown;
      background: #fff;
      //box-shadow: 0 0 8px #006622; 
      }
      .banner {
      position: relative;
      height: 250px;
      background-image: url("/uploads/media/default/0001/02/cc6bc584f236c7234947015b89151ab6d04c4cbf.jpeg");  
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: 30%;
      padding: 10px;
      }
      input[type="date"] {
      width: 100%;
      padding: 4px 5px;
      }
      textarea {
      width: calc(80% - 20px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color:  #006622;
      }
      .checkbox input[type=checkbox] {
      display:inline-block;
      height:15px;
      width:15px;
      margin-right:5px;
      vertical-align:text-top;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 3px 0  #006622;
      color: #006622;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      .item span {
      color: red;
      }
      .week {
      display:flex;
      justfiy-content:space-between;
      }
      .colums {
      display:flex;
      justify-content:space-between;
      flex-direction:row;
      flex-wrap:wrap;
      }
      .colums div {
      width:30%;
      }
      .columns2 {
      display:flex;
      justify-content:space-between;
      flex-direction:column;
      flex-wrap:wrap;
      }
      .colums2 div {
      width:50%;
      }
      input[type=radio], input[type=checkbox]  {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 15px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      .question-answer label {
      display: block;
      }
      label.radio:before {
      content: "";
      position: absolute;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      input[type=radio]:checked + label:before, label.radio:hover:before {
      border: 2px solid  #006622;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 6px;
      left: 5px;
      width: 8px;
      height: 4px;
      border: 3px solid  #006622;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .flax {
      display:flex;
      justify-content:space-around;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background:  #1c87c9;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background:  #0692e8;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .name-item div {
      width: calc(30% - 50px);
      }
      .name-item div input {
      width:80%;}
      .name-item div label {
      display:block;
      padding-bottom:25px;
      }
      }
    </style>
	
<?
	//include("./userAccess.php");
	include("./header.php");
	//session_start();
	//regTable();
	//icomTable();
	//gatewayTable();
	//accountTable();
	//routeTable();
	//phoneTable();

	//---------------------check whether Server is selected or not
//---------------------NEW-----------------------------------------
	$id="";
	$version="";
	$date="";
	$updates="";
	$updated_by="";
	$update_rexcl="";
	$update_rexcs="";
	$page="add";
	$mnth=date('n', time());
	$year=date('Y', time());
//------------------ON EDIT--------------------------------------------
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=$_GET['id'];
	$page="edit";
	$q="SELECT * FROM updates where id = $id ";
	$s=mysqli_query($conn,$q);
		//print mysqli_error($conn);
		if(!(!$s) || mysqli_num_rows($s)>0){
		while($d=mysqli_fetch_assoc($s)){ 
			$version=$d['version'];
			$updates=$d['updates'];
			$date=$d['date'];
			$updated_by=$d['updated_by'];
			$update_rexcl=$d['update_rexcl'];	
			$update_rexcs=$d['update_rexcs'];
	}}
}
?>
  </head>
  <body>
		<input type="hidden" id="id" value="<? print $id;?>">
		<input type="hidden" id="rly" value="<? print $rly;?>">
		<input type="hidden" id="divn" value="<? print $divn;?>">
		<input type="hidden" id="page" value="<? print $page;?>">
		
		
    <div class="testbox">
    <form>
			
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  UPDATE Details 
		  </div>
		</div>
		
        <!--legend> < ? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> < ? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
			<label for="date">Date <span>*</span></label>
			<input type="date" id="date" name="date" style="height:35px;padding:10px" value="<? print $date; ?>" onkeyup="scanDb(this.id,this.value);">
				<div id="date_msg" style="width:100%"></div>	
		  </div>
          <div class="item">
			<label for="version"> Version <span>*</span></label>
            <input type="text" id="version" name="version" value="<? print $version; ?>" onkeyup="scanDb(this.id,this.value);" placeholder="Designation">
			<div id="version_msg" style="width:100%"></div>
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="updates"> Key Changes <span>*</span></label>
            <input type="text" id="updates" name="updates" value="<? print $updates; ?>" onkeyup="scanDb(this.id,this.value);" placeholder="Designation">
			<div id="updates_msg" style="width:100%"></div>
          </div>
          <div class="item">
    
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="changes"> Changes In <span>*</span></label>
            <select id="update_rexcl" name="update_rexcl" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDb(this.id,this.value);">
					<? 	$catList=array(	'Yes','No');
						foreach($catList as $val) {
							if($val==$update_rexcl){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
					</select>
          </div>
          <div class="item">
            <label for="changes"> Changes In <span>*</span></label>
            <select id="update_rexcs" name="update_rexcs" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDb(this.id,this.value);">
					<? 	$catList=array(	'Yes','No');
						foreach($catList as $val) {
							if($val==$update_rexcs){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
					</select>
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="updated_by">Updated By <span>*</span></label>
            <input type="text" id="updated_by" name="updated_by" value="<? print $updated_by; ?>" onkeyup="scanDb(this.id,this.value);" placeholder="updated by">
			<div id="updated_by_msg" style="width:100%"></div>
          </div>
          <div class="item">
            
          </div>
		  <div class="item">
           
          </div>  
		</div>
		<div class="columns2">
				
			<div class="item w3-border-bottom w3-border-brown">
			</div>
		 		
		</div>
		 
      
      <div class="btn-block w3-right">
		<? if ($id!=""){ ?>
					<input id="delete" onclick="openWindow('./updateDel.html?action=ip&id=<? print $id;?>',500,500,'block');" value="Delete" class="w3-center w3-button w3-border w3-border-red w3-text-red w3-hover-light-blue" >
				<? } ?>
		<input id="submit" onclick="updateAdd('update');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
    
	
	
	</div>
 
<div id="msg" style="width:100%;"class="w3-text-red w3-center" >
    </div> 
  </body>
</html>