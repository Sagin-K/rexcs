		
    <div class="testbox">
    <form>
		
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?>  Boss- Secretary Numbers [in :<b class="w3-text-brown"> <? print $reg1_name; ?>]
		  </div>
		</div>
		
        <!--legend> <? print $page;?>  IP Phone in Server:<b class="w3-text-blue"> <? print $reg1_name; ?></legend-->
        <div class="colums"> 
		  <div class="item">
				<label for="accID"> Boss Phone Account <span>*</span></label>
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
          <!--div class="item">
            <label for="board">Control Board <span>*</span></label>
			<input type="text" list="boardsList" id="board" name="board" value="<? print $board; ?>"  placeholder="Board">
				<datalist id="boardsList">
				 < ? $q="SELECT DISTINCT board FROM stations where rly=\"$rly\" AND division=\"$divn\" ";
					$q.=" ORDER BY order_no";
					print $q;
					$s=mysqli_query($conn1,$q);
					if(!(!$s) || mysqli_num_rows($s)>0){
					$sn=1;
						while($d=mysqli_fetch_assoc($s)){
							print "<option value='".$d['board']."'>";
				  } }
				  ?>
				</datalist>
            
					<div id="board_msg" style="width:100%"></div>
		  </div-->
          <div class="item">
				<label for="accID">  B-S Type <span>*</span></label>
					<select id="ps_type" name="ps_type" style="height:35px;padding:10px" >
								<? 	$catList=array(	'default',
													'only_secy');
								foreach($catList as $val) {
									if($val==$ps_type){
										print "<option value=\"{$val}\" selected>{$val}</option>";
									}else{
										print "<option value=\"{$val}\" >{$val}</option>";
										}
								}
							?>
					</select>
					<div id="ps_type_msg" style="width:100%"></div>
					
		  </div>
          <div class="item">
				<label for="ps_no"> PS Phone Account <span>*</span></label>
					<select id="ps_no" name="ps_no" style="height:35px;padding:10px" >
									<? 	$q="select * from $accTable WHERE server_id= $server_id ";
										$s=mysqli_query($conn,$q);
										//	print mysqli_error($conn);
											if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
													if($d['id']==$ps_no){
														print "<option value=\"{$d['id']}\" selected>{$d['acc_name']} , [ Rly No: {$d['rly_no']}]</option>";
													}else{
														print "<option value=\"{$d['id']}\" >{$d['acc_name']} , [Rly No: {$d['rly_no']}]</option>";
														}
												}
											}
									?>
					</select>
					<div id="ps_no_msg" style="width:100%"></div>
					
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
