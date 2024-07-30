    <div class="testbox">
    <form>
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  Secondary Account  [in :<b class="w3-text-brown"> <? print $reg1_name; ?>]
		  </div>
		</div>
		
        <!--legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="accID"> Main Account <span>*</span></label>
					<select id="accID" name="accID" style="height:35px;padding:10px" >
									<? 	$q="SELECT * FROM $accTable where server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
											while($d=mysqli_fetch_assoc($s)){ 
										if($d['id']==$accID){ ?>
										<option value="<? print $d['id']; ?>" selected><? print $d['acc_name']." , [ Rly No 1:".$d['rly_no']."]" ; ?></option>
										<? } else{ ?>
										<option value="<? print $d['id']; ?>" ><? print $d['acc_name']." , [ Rly No:".$d['rly_no']."]" ; ?></option>
										<?	}
										}
										}
									?>
					</select>
					<div id="accID_msg" style="width:100%"></div>
					
		  </div>
          <div class="item">
           
          </div>
          <div class="item">
            
          </div>
		  
          <div class="item">
            <label for="server2"> Secondary SIP Server Address<span>*</span></label>
            <input type="text" id="server2" name="server2" value="<? print $server2; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="IP address xx.xx.xx.xx">
			<div id="server2_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="user_id2"> User ID <span>*</span></label>
            <input type="text" id="user_id2" name="user_id2" value="<? print $user_id2; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="User ID in Second SIP Serv">
				<div id="user_id2_msg" style="width:100%"></div>
          </div>
          <div class="item">
            <label for="password2"> Password <span>*</span></label>
            <input type="text" id="password2" name="password2" value="<? print $password2; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Password for Second SIP Serv">
				<div id="password2_msg" style="width:100%"></div>
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
