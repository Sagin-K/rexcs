    <div class="testbox">
    <form>
				
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  Change Owner  [ Server:<b class="w3-text-brown"> <? print $reg1_name; ?></b> ]
		  </div>
		</div>
		
        <!-- legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="curr_owner"> Current Owner <span>*</span></label>
								<? 	$q="select name, desig from $userTable WHERE id=$owner ";
									$s=mysqli_query($conn,$q);
									//	print mysqli_error($conn);
										if(!(!$s) || mysqli_num_rows($s)>0){
										while($d=mysqli_fetch_assoc($s)){ 
									print "<input type='text' value='".$d['name'].", ".$d['desig']."' disabled>" ;
								}
								}
							?>
				
		  </div>
          <div class="item">
				<label for="owner"> Transfer To <span>*</span></label>
				<select id="owner" name="owner"  style="height:35px;padding:10px">
								<? 	$q="select * from $userTable WHERE rly='$rly' AND divn='$divn'  ";
									$s=mysqli_query($conn,$q);
									//	print mysqli_error($conn);
										if(!(!$s) || mysqli_num_rows($s)>0){
										while($d=mysqli_fetch_assoc($s)){ 
									if($d['id']==$id){
									print "<option value=\"{$d['id']}\" selected>{$d['name']} , {$d['desig']} </option>";
									}else{
										print "<option value=\"{$d['id']}\" > {$d['name']} , {$d['desig']} </option>";
										}
								}
								}
							?>
				</select>
				<div id="owner_msg"  style="width:100%"></div>		
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
		<input id="submit" onclick="accAdd('<? print $action; ?>');"  value="Save" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
		<input id="close" onclick="document.getElementById('id01').style.display='none';window.location.reload();"  value="Close" class="w3-center w3-button w3-blue w3-text-white w3-hover-light-blue" >
	</div>
    </form>
	</div>
