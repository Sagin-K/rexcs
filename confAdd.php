		
    <div class="testbox">
    <form>
				<input type="hidden" id="acc_type" value="conf">
				
				
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?> Conference [ Server:<b class="w3-text-brown"> <? print $reg1_name; ?></b> ]
		  </div>
		</div>
		
        <!-- legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		
		  <div class="item">
				<label for="conf_name"> Name of Conference <span>*</span></label>
				<input type="text" id="conf_name" name="conf_name" value="<? print $conf_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Name">
				<div id="conf_name_msg"  style="width:100%"></div>
		  </div>
		  <div class="item">
				<label for="conf_type"> Conference Type <span>*</span></label>
				<select id="conf_type" name="conf_type" style="height:35px;padding:10px">
								<? 	$catList=array(	'default',
													'attended'
													);
								foreach($catList as $val) {
									if($val==$conf_type){
									print "<option value=\"{$val}\" selected>{$val}</option>";
									}else{
										print "<option value=\"{$val}\" >{$val}</option>";
										}
								}
							?>
				</select>
				<div id="conf_type_msg"  style="width:100%"></div>
		  </div>
           
          <div class="item">
				
		  </div>
		  
          <div class="item">
				<label for="conf_no"> Conference Number <span>*</span></label>
				<input type="text" id="conf_no" name="conf_no" value="<? print $conf_no; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Conf Number">
				<div id="conf_no_msg"  style="width:100%"></div>
				<div style="width:100%"> <i class="w3-text-grey w3-tiny">[ This number will be used to join the conference]</i></div>
		  </div>
		  
          <div class="item">
				<label for="conf_admin"> Conference Admin <span>*</span></label>
				<select id="conf_admin" name="conf_admin"  style="height:35px;padding:10px">
								<? 	$q="select * from $accTable WHERE server_id= $server_id ";
									$s=mysqli_query($conn,$q);
									//	print mysqli_error($conn);
										if(!(!$s) || mysqli_num_rows($s)>0){
										while($d=mysqli_fetch_assoc($s)){ 
									if($d['acc_name']==$conf_admin){
									print "<option value=\"{$d['acc_name']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
									}else{
										print "<option value=\"{$d['acc_name']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
										}
								}
								}
							?>
				</select>
				<div id="conf_admin_msg"  style="width:100%"></div>
				<div style="width:100%"> <i class="w3-text-grey w3-tiny">[ Conf. PIN could be set Only though this phone number / this number act as admin to add participients]</i></div>				
		  </div>
          <div class="item">
				
		  </div>
          <div class="item">
				<label for="remark"> Remarks </label>
				<input type="text" id="remark" name="remark" value="<? print $remark; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Remearks">
				<div id="remark_msg"  style="width:100%"></div>		
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
		<input id="delete" onclick="delPages('1','reg','<? print $action;?>','<? print $id;?>');" value="Delete" class="w3-center w3-button w3-border w3-border-red w3-text-red w3-hover-light-blue" >
		<? } ?>
		<input id="submit" onclick="accAdd('<? print $action; ?>');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
	</div>
 