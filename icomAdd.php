    <div class="testbox">
    <form>
		<input type="hidden" id="acc_type" value="icom">
				
				
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?> Intercom  [ Server:<b class="w3-text-brown"> <? print $reg1_name; ?></b> ]
		  </div>
		</div>
		
        <!-- legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="icom_name"> Name of the Intercom <span>*</span></label>
				<input type="text" id="icom_name" name="icom_name" value="<? print $icom_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Unique Name of Intercome">
				<div id="icom_name_msg"   style="width:100%"></div>
		  </div>
          <div class="item">
				<label for="department"> Department <span>*</span></label>
				<input type="text" id="department" name="department" value="<? print $department; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Department">
				<div id="department_msg"  style="width:100%"></div>
		  </div>
          <div class="item">
				<label for="vlan"> Intercom Voice VLAN</label>
				<input type="text" id="vlan" name="vlan" value="<? print $vlan; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Voice VLAN no of this Intercom">
				<div id="vlan_msg" style="width:100%"></div>
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
