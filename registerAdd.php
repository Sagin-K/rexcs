   <div class="testbox">
    <form>
			<input type="hidden" id="acc_type" value="reg">
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  Registrar 
		  </div>
		</div>
		
        <!--legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="location">Location <span>*</span></label>
				<input type="text" id="location" name="location" value="<? print $location; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Location / Div or Station">
				<div id="location_msg" style="width:100%"></div>
		  </div>
          <div class="item">
				<label for="reg1_name"> Name of Registrar/Exchange <span>*</span></label>
				<input type="text" id="reg1_name" name="reg1_name" value="<? print $reg1_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Unique name for this Server">
				<div id="reg1_name_msg" style="width:100%"></div>
		  </div>
          <div class="item">
           
          </div>
          
          <div class="item">
            <label for="reg1_ip"> Primary Server IP address <span>*</span></label>
            <input type="text" id="reg1_ip" name="reg1_ip" value="<? print $reg1_ip; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="IPv4 Address [xx.xx.xx.xx]">
				<div id="reg1_ip_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="reg2_ip"> Redundant Server IP address </label>
            <input type="text" id="reg2_ip" name="reg2_ip" value="<? print $reg2_ip; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="IPv4 Address [xx.xx.xx.xx]">
				<div id="reg2_ip_msg" style="width:100%"></div>
          </div>
          <div class="item">
            
          </div>
          
          <div class="item">
            <label for="rly_code"> Railway STD code <span></span></label>
            <input type="text" id="rly_code" name="rly_code" value="<? print $rly_code; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="STD Code [ Numbers Only ]">
				<div id="rly_code_msg" style="width:100%"></div>
		  </div>
          <div class="item">
            <label for="rly_no_length"> Length Of Railway Number <span>*</span></label>
            <input type="text" id="rly_no_length" name="rly_no_length" value="<? print $rly_no_length; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Number of Digits Omitting STD code">
				<div id="rly_no_length_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="icom_no_length"> Length Of Intercom Number <span>*</span></label>
            <input type="text" id="icom_no_length" name="icom_no_length" value="<? print $icom_no_length; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Number of Digits">
				<div id="icom_no_length_msg" style="width:100%"></div>
          </div>
		  
          <div class="item">
            <label for="pstn_code"> PSTN STD Code [if BSNL is connected ]</label>
            <input type="text" id="pstn_code" name="pstn_code" value="<? print $pstn_code; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="PSTN STD code of the area [ Numbers Only ]">
				<div id="pstn_code_msg"  style="width:100%"></div>
          </div>
          <div class="item">
            <label for="pstn_no_length"> Length Of PSTN Number [Expected]<span>*</span></label>
            <input type="text" id="pstn_no_length" name="pstn_no_length" value="<? print $pstn_no_length; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Number of Digits Omitting STD code">
				<div id="pstn_no_length_msg"  style="width:100%"></div>
          </div>
		  <div class="item">
           
          </div>
		  
          <div class="item">
            <label for="reg1_user"> SSH Root Username</label>
			<input type="text" id="reg1_user" name="reg1_user" value="<? print $reg1_user; ?>"  placeholder="Username with Root Privilege">
				<div id="reg1_user_msg"  style="width:100%"></div>
          </div>
		  <div class="item">
            <label for="reg1_root">SSH Root Password</label>
            <input type="text" id="reg1_root" name="reg1_root" value="<? print $reg1_root; ?>"  placeholder="password">
				<div id="reg1_root_msg"  style="width:100%"></div>
          </div>
		  <div class="item">
            
          </div>
		  
		  <div class="item">
            <label for="ntp_server"> NTP Server</label>
			<input type="text" id="ntp_server" name="ntp_server" value="<? print $ntp_server; ?>"  placeholder="NTP Server">
				<div id="ntp_server_msg"  style="width:100%"></div>
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
		<input id="close" onclick="window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	  </div>
    </form>
    </div>
	
