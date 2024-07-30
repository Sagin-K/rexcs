 <div class="testbox">
    <form>
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  Parallel Connections [in :<b class="w3-text-brown"> <? print $reg1_name; ?>]
		  </div>
		</div>
		
        <!--legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="accID"> Main Account <span>*</span></label>
					<? if($accID!=""){ ?>
					<input type="hidden" id="accID" value="<? print $accID; ?>">
					<input type="text" id="accname" name="accname" value="<? print $acc_name; ?>" disabled>
					<? } else { ?>
					
					<select id="accID" name="accID" style="height:35px;padding:10px" >
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
											while($d=mysqli_fetch_assoc($s)){ 
													print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
										}
										}
									?>
					</select>
					<? } ?>
					<div id="accID_msg" style="width:100%"></div>
					
		  </div>
          <div class="item">
				<label for="parallel_num1"> Parallel Number 1 <span>*</span></label>
					<select id="parallel_num1" name="parallel_num1" style="height:35px;padding:10px" onchange="scanDatabase(this.id,1)">
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
													if($d['id']==$parallel_num1){
														print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
													}else{
														print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
														}
												}
											}
									?>
					</select>
					<div id="parallel_num1_msg" style="width:100%"></div>
					
		  </div>
		  <div class="item">
		  </div>
          <div class="item">
					
		  </div>
          <div class="item">
				<label for="parallel_num2"> Parallel Number 2<span></span></label>
					<select id="parallel_num2" name="parallel_num2" style="height:35px;padding:10px" onchange="scanDatabase(this.id,2)" disabled>
					<option value="" ></option>
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
													if($d['id']==$parallel_num2){
														print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
													}else{
														print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
														}
												}
											}
									?>
					</select>
					<div id="parallel_num2_msg" style="width:100%"></div>
					
		  </div>
		  <div class="item">
		  <? if($page=="edit"){ ?>
		  <i class="fa fa-pencil-square-o w3-large w3-text-blue" aria-hidden="true" alt="enable" title="enable" onclick="toggle('parallel_num2');"></i>
			<? } ?>
			</div>
		  
          <div class="item">
					
		  </div>
          <div class="item">
				<label for="parallel_num3"> Parallel Number 3<span></span></label>
					<select id="parallel_num3" name="parallel_num3" style="height:35px;padding:10px" onchange="scanDatabase(this.id,3)" disabled>
					<option value="" ></option>
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
													if($d['id']==$parallel_num3){
														print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
													}else{
														print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
														}
												}
											}
									?>
					</select>
					<div id="parallel_num3_msg" style="width:100%"></div>
					
		  </div>
		  <div class="item">
		  <? if($page=="edit"){ ?>
		  <i class="fa fa-pencil-square-o w3-large w3-text-blue" aria-hidden="true" alt="Edit" title="Edit" onclick="toggle('parallel_num3');"></i>
			<? } ?>
			</div>
		  
          <div class="item">
					
		  </div>
          <div class="item">
				<label for="parallel_num4"> Parallel Number 4<span></span></label>
					<select id="parallel_num4" name="parallel_num4" style="height:35px;padding:10px" onchange="scanDatabase(this.id,4)" disabled>
								<option value="" ></option>
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
													if($d['id']==$parallel_num4){
														print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
													}else{
														print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
														}
												}
											}
									?>
					</select>
					<div id="parallel_num4_msg" style="width:100%"></div>
					
		  </div>
		  <div class="item">
		  <? if($page=="edit"){ ?>
		  <i class="fa fa-pencil-square-o w3-large w3-text-blue" aria-hidden="true" alt="Edit" title="Edit" onclick="toggle('parallel_num4');"></i>
			<? } ?>
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
   