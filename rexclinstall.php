<?	//----------------------------- RExCL Install---------------------------------------------
		$server="1";
		if((isset($_GET['server'])) && ($_GET['server']=="2")){
				$server=$_GET['server'];
				$reg1_ip=$reg2_ip;
			}	
 //print $server;			
		?>
    <div class="testbox">
    <form>
		<div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		   Install Asterisk and Related Softwares in VOIP Server :<b class="w3-text-brown"> <? print $reg1_name; ?> (IP Address: <? print $reg1_ip; ?> )</b>
		  </div>
		</div>
		<div class="columns2 w3-panel w3-medium ">
		<br>
				Before continue with installation, PLease check the following <br>
				* Ensure the VOIP server is reachable <br>
				* Confirm the ssh root access and its username and passsword <br>
				<b class="w3-panel w3-text-red "> Warning!! - Exchange data if any already available in VOIP server will be deleted . </b>		
				
		</div>	
		<div class="columns2">
				
			<div class="item w3-border-bottom w3-border-brown">
			</div>
		 		
		</div>  
          
      
      <div class="btn-block w3-right">
	  
		<input id="submit" onclick="document.getElementById('connect').style.display='block';installRexcl('connect',<? print $server; ?>,<? print $server_id; ?>);"  value="Install" class="w3-center w3-button w3-red w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
	</div>
    
	<div id="connect" class="w3-twothird w3-large"  style="display:none">
	<div class="sticky w3-bar w3-padding">
		<div class="w3-bar-item w3-meduim w3-border-bottom w3-border-brown " style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		   Installation Status</b>
		</div>
	</div>
		
	<div  class="w3-panel w3-padding w3-animate-opacity" > 
	  <div class="w3-twothird w3-medium" >
		(1) Connect to Registrar
	  </div>
	  <div id="connect1" class="w3-third w3-medium w3-text-blue w3-animate-opacity">
		Connecting... <i class="fa fa-spinner w3-spin w3-text-blue"></i>
	  </div>
	</div>
	<div id="copyRexcl" class="w3-panel w3-padding w3-animate-opacity"  style="display:none"> 
	  <div class=" w3-twothird w3-medium" >
		(2) Copy Rexcl File
	  </div>
	  <div id="copyRexcl1" class=" w3-third w3-medium w3-text-blue w3-animate-opacity" >
		Copying... <i class="fa fa-spinner w3-spin w3-text-blue"></i>
	  </div>
	</div>
	<div id="installRexcl" class="w3-panel w3-padding w3-animate-opacity"  style="display:none"> 
	  <div class=" w3-twothird w3-medium" >
		(3) Install Asterisk , Asterisk-Config, Git & apache2 
	  </div>
	  <div id="installRexcl1" class=" w3-third w3-medium w3-text-blue w3-animate-opacity" >
		Installing Softwares... <i class="fa fa-spinner w3-spin w3-text-blue"></i>
	  </div>
	</div>
	<div id="gitClone" class="w3-panel  w3-padding w3-animate-opacity"  style="display:none"> 
	  <div class=" w3-twothird w3-medium" >
		(4) Install RExCL Tool
	  </div>
	  <div id="gitClone1" class=" w3-third w3-medium w3-text-blue w3-animate-opacity" >
		Loading RExCL... <i class="fa fa-spinner w3-spin w3-text-blue"></i>
	  </div>
	</div>
	
	</div>

	<div class="w3-panel  w3-padding"  > 
	  <input id="exit" style="display:none" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class=" w3-right w3-button w3-text-blue w3-hover-light-blue w3-border  w3-border-blue" >
	
	</div>
