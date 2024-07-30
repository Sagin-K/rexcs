    <div class="testbox">
    <form>
				<input type="hidden" id="acc_type" value="gw">
				<input type="hidden" id="port" value="0" >
				<input type="hidden" id="type" value="exch" >
				<input type="hidden" id="port_msg" value="" >
				<input type="hidden" id="type_msg" value="" >
				
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?> SIP Gateway  [ Server:<b class="w3-text-brown"> <? print $reg1_name; ?></b> ]
		  </div>
		</div>
		
        <!-- legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="gw_name"> Name of Gateway <span>*</span></label>
				<input type="text" id="gw_name" name="gw_name" value="<? print $gw_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Name">
				<div id="gw_name_msg" style="width:100%"></div>
		  </div>
          <div class="item">
				<label for="gw_ip"> IP Address of Gateway <span>*</span></label>
				<input type="text" id="gw_ip" name="gw_ip" value="<? print $gw_ip; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="IP">
				<div id="gw_ip_msg" style="width:100%"></div>		
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
		<input id="submit" onclick="accAdd('gw');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
	</div>
    
	
