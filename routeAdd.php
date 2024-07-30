	<!----------------------------- Route Add --------------------------------------------->
				
		
    <div class="testbox">
    <form>
				<input type="hidden" id="acc_type" value="route">
				
				
     <div class="sticky w3-bar w3-border-bottom w3-border-brown">
		  <div class="w3-bar-item w3-large" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">
		  <? print $page;?> Routes  :<b class="w3-text-brown"> <? print $reg1_name; ?></b> 
		  </div>
		</div>
		
        <table width=100% class="w3-padding">
				
				<tr>
					<td class="w3-border-bottom w3-border-bottom-brown" style="width:25%><label for="route_name"><i class="fa fa-modx" aria-hidden="true"></i>  Route Name <b class="w3-text-red">*</b></label></td>
					<td colspan=3 class="w3-border-bottom w3-border-bottom-brown" style="width:75%">
						<input type="text" id="route_name" name="route_name" value="<? print $route_name; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="Route Name">
						<div id="route_name_msg"  style="width:100%"></div>
					</td>
				</tr>
				
				<tr>
					<td class="w3-border-bottom w3-border-bottom-brown"><label for="pattern"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> pattern <b class="w3-text-red">*</b></label></td>
					<td colspan=1 class="w3-border-bottom w3-border-bottom-brown">
						<input type="text" class="w3-tooltip"  id="pattern" name="pattern" value="<? print $pattern; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="pattern (eg: 23X, 0X., X, Z, N)">
						<div id="pattern_msg"  style="width:100%"></div>
					</td>
					<td colspan=2 class="w3-border-bottom w3-border-bottom-brown w3-text-blue">
						<i class="fa fa-question-circle-o w3-tooltip  w3-large" aria-hidden="true">
						<b  class="w3-text w3-medium">
							X Match any number from 0-9.<br>
							Z Match any number from 1-9.<br>
							N Match any number from 2-9.<br>
							[2-5] Matches a single digit that is 2 or 3 or 4 or 5.<br>
							23X Matches any three digit number from 230 to 239.<br>
							0X. Matches any number of digits starting with a 0. The dot (.) matches
							any number of digits. This even matches a number starting from 00.<br>
							0Z. Matches any number of digits starting with a 0. The dot (.) matches
							any number of digits. This does not matches a number starting from
							00 but matches any number starting from 0.
						</b></i>
					</td>
				</tr>
				
				<tr>
					<td class="w3-border-bottom w3-border-bottom-brown" style="width:25%"><i class="fa fa-modx" aria-hidden="true"></i> Route 1 <b class="w3-text-red">*</b></td>
					<td class="w3-border-bottom w3-border-bottom-brown"  style="width:25%">
						<label class="w3-tiny w3-round w3-light-blue" for="gw_id1"> Gateway <b class="w3-text-red">*</b></label>
						<span>
							<select id="gw_id1" name="gw_id1" >
											<option value="" ></option>
											<? 	$q="select * from $gwTable  WHERE server_id=$server_id ";
												$s=mysqli_query($conn,$q);
												//	print mysqli_error($conn);
													if(!(!$s) || mysqli_num_rows($s)>0){
													while($d=mysqli_fetch_assoc($s)){ 
												if($d['id']==$gw_id1){
												print "<option value=\"{$d['id']}\" selected>{$d['gw_name']} </option>";
												}else{
													print "<option value=\"{$d['id']}\" >{$d['gw_name']}</option>";
													}
											}
											}
										?>
							</select>
						<div id="gw_id1_msg" ></div>
					</td>
					<td class="w3-border-bottom w3-border-bottom-brown"  style="width:25%">
						<label class="w3-tiny w3-round w3-light-blue" for="transform2"> Transformation</label>
						<select id="transform1" onchange="scanDatabase(this.id,this.value);" name="transform1" >
										<? 	$catList=array(	'None',
															'prefix',
															'suffix',
															'slice',
															'preslice');
										foreach($catList as $val) {
											if($val==$transform1){
											print "<option value=\"{$val}\" selected>{$val}</option>";
											}else{
												print "<option value=\"{$val}\" >{$val}</option>";
												}
										}
									?>
						</select>
						<div id="transform1_msg" ></div>
					</td>
					<td class="w3-border-bottom w3-border-bottom-brown"  style="width:25%">
						<label class="w3-tiny w3-round w3-light-blue" for="trans_no1"> Transf. Number/Offset</label>
						<input type="text" id="trans_no1" name="trans_no1" value="<? print $trans_no1; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="prefix/suffix/offset[:length]/prefix,offset[:length]" >
						</span>
						<div id="trans_no1_msg" ></div>
					</td>
				</tr>
				
				<tr>
					<td class="w3-border-bottom w3-border-bottom-brown"><i class="fa fa-modx" aria-hidden="true"></i> Route 2</td>
					<td class="w3-border-bottom w3-border-bottom-brown">
					
						<span>
						<label class="w3-tiny w3-round w3-light-blue" for="gw_id2"> Gateway </label>
							<select id="gw_id2" onchange="scanDatabase(this.id,this.value);" width="25%"  name="gw_id2"  >
										<option value="N.A" >N.A</option>
										<? 	$q="select * from $gwTable  WHERE server_id= $server_id ";
											$s=mysqli_query($conn,$q);
											//	print mysqli_error($conn);
												if(!(!$s) || mysqli_num_rows($s)>0){
												while($d=mysqli_fetch_assoc($s)){ 
											if($d['id']==$gw_id2){
											print "<option value=\"{$d['id']}\" selected>{$d['gw_name']} </option>";
											}else{
												print "<option value=\"{$d['id']}\" >{$d['gw_name']}</option>";
												}
										}
										}
									?>
							</select>
							<div id="gw_id2_msg" ></div>
					</td>
					<td class="w3-border-bottom w3-border-bottom-brown">
						<label class="w3-tiny w3-round w3-light-blue" for="transform2"> Transformation</label>
							<select id="transform2" onchange="scanDatabase(this.id,this.value);" width="25%" name="transform2"  >
									<? 	$catList=array(	'None',
														'prefix',
														'suffix',
														'slice',
														'preslice');
									foreach($catList as $val) {
										if($val==$transform2){
										print "<option value=\"{$val}\" selected>{$val}</option>";
										}else{
											print "<option value=\"{$val}\" >{$val}</option>";
											}
									}
								?>
							</select>
						<div id="transform2_msg" ></div>
					</td>
					<td class="w3-border-bottom w3-border-bottom-brown">
						<label class="w3-tiny w3-round w3-light-blue" for="trans_no2"> Transf. Number/Offset</label>
						<input type="text"  width="25%" id="trans_no2" name="trans_no2" value="<? print $trans_no2; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="prefix/suffix/offset[:length]/prefix,offset[:length]" >
						</span>
						<div id="trans_no2_msg" ></div>
					</td>
				</tr>
				
				<tr>
					<td class="w3-border-bottom w3-border-bottom-brown"><label for="remark"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Remarks</label></td>
					<td colspan=3 class="w3-border-bottom w3-border-bottom-brown">
						<input type="text" id="remark" name="remark" value="<? print $remark; ?>" onkeyup="scanDatabase(this.id,this.value);" placeholder="remark">
						<div id="remark_msg" ></div>
					</td>
				</tr>
				
				
		</table>
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
    
