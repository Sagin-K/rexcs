    <div class="testbox">
    <form>
			<input type="hidden" id="acc_type" value="ip">
			<!--input type="hidden" id="pstn_no" value="">
			<input type="hidden" id="pstn_no_msg" value=""-->
			<input type="hidden" id="phone_msg" value="">
			<input type="hidden" id="mac_msg" value="">
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  IP Phone  [ in Server:<b class="w3-text-brown"> <? print $reg1_name; ?> ]
		  </div>
		</div>
		
        <!--legend> < ? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> < ? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="icom_name">Intercom <span>*</span></label>
					<select id="icom_name" name="icom_name" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDatabase(this.id,this.value);">
									<? 	$q="select * from $icomTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
											while($d=mysqli_fetch_assoc($s)){ 
										if($d['id']==$icom_name){
										print "<option value=\"{$d['id']}\" selected>{$d['icom_name']}</option>";
										}else{
											print "<option value=\"{$d['id']}\" >{$d['icom_name']}</option>";
											}
									}
									}
								?>
					</select>
					<div id="icom_name_msg"></div>
					
		  </div>
          <div class="item">
           
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="acc_name"> Designation <span>*</span></label>
            <input type="text" id="acc_name" name="acc_name" value="<? print $acc_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Designation">
			<div id="acc_name_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="disp_name">Display Name (Designation) <span>*</span></label>
            <input type="text" id="disp_name" name="disp_name" value="<? print $disp_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Name To be Displayed">
					<div id="disp_name_msg" style="width:100%"></div>
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="rly_no"> Railway Phone Number <span>*</span></label>
            <input type="text" id="rly_no" name="rly_no" value="<? print $rly_no; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="<? print $rly_no_length; ?> digit Number">
					<div id="rly_no_msg" style="width:100%"></div>
					<div style="width:100%"> <i class="w3-text-grey w3-tiny">[ This will be used as Username in IP phone/ FXS to add account]</i></div>
          </div>
          <div class="item">
            <label for="icom_no">Intercom Number <span>*</span></label>
            <input type="text" id="icom_no" name="icom_no" value="<? print $icom_no; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="<? print $icom_no_length; ?> digit Number">
					<div id="icom_no_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="pstn_no">PSTN Number </label>
            <input type="text" id="pstn_no" name="pstn_no" value="<? print $pstn_no; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="<? print $pstn_no_length; ?> digit Number">
					<div id="pstn_no_msg" style="width:100%"></div>
          </div>
          
		  
          <div class="item">
            <label for="secret1">Password <span>*</span></label>
            <input type="text" id="secret1" name="secret1" value="<? print $secret1; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Account password for this IP No.">
					<div id="secret1_msg" style="width:100%"></div>
					<div style="width:100%"> <i class="w3-text-grey w3-tiny">[ This will be used as PW in IP phone/ FXS to add account]</i></div>
          </div>
          <div class="item">
            
          </div>
		  <div class="item">
           
          </div>
		<? if($page!="add"){ ?>
		
          <!--div class="item">
            <label for="phone">IP Phone Model</label>
			<select id="phone" name="phone" style="height:35px;padding:10px" >
									< ? 	$catList=array(	'',
														'Yealink-T23G',
														'Yealink-T27G',
														'Mitel-6865i');
									foreach($catList as $val) {
										if($val==$phone){
										print "<option value=\"{$val}\" selected>{$val}</option>";
										}else{
											print "<option value=\"{$val}\" >{$val}</option>";
											}
									}
								?>
					</select>
					<div id="phone_msg" style="width:100%"></div>
          </div>
		  <div class="item">
            <label for="mac">MAC Adress</label>
            <input type="text" id="mac" name="mac" value="< ? print $mac; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="xx-xx-xx-xx-xx-xx">
					<div id="mac_msg" style="width:100%"></div>
          </div>
		  <div class="item">
            
          </div-->
		<div class="item">
            <label for="callgroup"> Call Group no.</label>
			<!--input type="text" id="callgroup" name="callgroup" value="< ? print $callgroup; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Call group Number"-->
			<select id="callgroup" name="callgroup" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDatabase(this.id,this.value);">
					<? 	$catList=array(	'','1','2','3','4','5','6','7');
						foreach($catList as $val) {
							if($val==$callgroup){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
			</select>
			<div id="callgroup_msg" style="width:100%"></div>
          </div>
		  <!-- div class="item">
            <label for="callgroup2"> Call Group no.2</label>
			<!--input type="text" id="callgroup" name="callgroup" value="< ? print $callgroup; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Call group Number">
			<select id="callgroup2" name="callgroup2" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDatabase(this.id,this.value);">
					< ? 	$catList=array(	'','1','2','3','4','5','6','7');
						foreach($catList as $val) {
							if($val==$callgroup2){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
			</select>
			<div id="callgroup2_msg" style="width:100%"></div>
          </div>
		  <div class="item">
            <label for="callgroup3"> Call Group no.3</label>
			<!--input type="text" id="callgroup" name="callgroup" value="< ? print $callgroup; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Call group Number">
			<select id="callgroup3" name="callgroup3" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDatabase(this.id,this.value);">
					< ? 	$catList=array(	'','1','2','3','4','5','6','7');
						foreach($catList as $val) {
							if($val==$callgroup3){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
			</select>
			<div id="callgroup3_msg" style="width:100%"></div>
          </div-->
		  <div class="item">
            <label for="pickupgroup">Pickup Group No</label>
            <select id="pickupgroup" name="pickupgroup" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDatabase(this.id,this.value);">
					<? 	$catList=array(	'','1','2','3','4','5','6','7');
						foreach($catList as $val) {
							if($val==$pickupgroup){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
			</select>
			<div id="pickupgroup_msg" style="width:100%"></div>
          </div>
		  <div class="item">
            <!--label for="recording"> Voice recording <span>*</span></label>
            <select id="recording" name="recording" style="height:35px;padding:10px"  style="w3-padding" onchange="scanDb(this.id,this.value);">
					< ? 	$catList=array(	'No','Yes');
						foreach($catList as $val) {
							if($val==$recording){
							print "<option value=\"{$val}\" selected>{$val}</option>";
							} else{
							print "<option value=\"{$val}\" >{$val}</option>";
							}
						}
					?>
					</select-->
          </div>
		<? } ?>  
		</div>
		<div class="columns2">
				
			<div class="item w3-border-bottom w3-border-brown">
			</div>
		 		
		</div>
		 
      
      <div class="btn-block w3-right">
		<? if ($id!=""){ ?>
			<input id="delete" onclick="delPages('1','ip','<? print $action;?>','<? print $id;?>');" value="Delete" class="w3-center w3-button w3-border w3-border-red w3-text-red w3-hover-light-blue" >
		<? } ?>
		<input id="submit" onclick="this.disabled=true; this.value='Saving…';accAdd('<? print $action; ?>');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
    
	
	
	</div>
