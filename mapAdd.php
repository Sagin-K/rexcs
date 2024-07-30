   <div class="testbox">
    <form>
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  Short Code [in :<b class="w3-text-brown"> <? print $reg1_name; ?>]
		  </div>
		</div>
		
        <!--legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="map_no"> Short Code <span>*</span></label>
					<input type="text" id="map_no" name="map_no" value="<? print $map_no; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Short code for Number">
				<div id="map_no_msg" ></div>
		  </div>
          <div class="item">
				<label for="accID"> Phone Account <span>*</span></label>
					<select id="accID" name="accID" style="height:35px;padding:10px" >
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
											while($d=mysqli_fetch_assoc($s)){ 
										if($d['id']==$accID){
										print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
										}else{
											print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
											}
										}
										}
									?>
					</select>
					<div id="accID_msg" style="width:100%"></div>
					
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
		<input id="delete" onclick="delPages('1','reg','<? print $action;?>','<? print $id;?>');" value="Delete" class="w3-center w3-button w3-border w3-border-red w3-text-red w3-hover-light-blue" >
		<? } ?>
		<input id="submit" onclick="this.disabled=true; this.value='Saving…';accAdd('<? print $action; ?>');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
    
	
	
	</div>
