	<?
		$q="SELECT * FROM $accTable where parallel_num1!='' and server_id= $registrar ";
		$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
	?>
	<div >
		<div class="sticky w3-bar ">
		  <div class="w3-bar-item w3-xxlarge" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">Parallel Connections </b></div>
		</div>
		<div class="sticky w3-bar ">
		  <i class="w3-small w3-text-grey w3-padding" ><? print $regName." Exchange (IP: ". $primaryIP.")   / [". $divn1." division /". $rly1."]"; ?></i>
		  <!--div class="w3-bar-item w3-right" onclick="window.print()"><i class="fa fa-print w3-text-green  w3-large"></i></div-->
		  <div class="w3-bar-item w3-right w3-tiny" onclick="addPages('0','acc','<? print $_GET['acc_type'];?>','nil');"><button class="w3-button w3-border w3-round w3-border-green w3-text-green  w3-hover-green"><i class="fa fa-plus-circle w3-tiny " aria-hidden="true"> CREATE</i> </button></div>
		</div>
				
			<table class="w3-table w3-small w3-card w3-half" style="background:white;word-break:keep-all;">
				<tr class=" w3-small w3-text-blue w3-opacity w3-bold"  style="text-align:left;" valign="top">
					<th width="5%">S.N</th>
					<th width="15%" style="text-transform:uppercase;border-left:1px solid white">Main Number </th> 
					<th width="15%" style="text-transform:uppercase;border-left:1px solid white">Parallel Number</th>
					<th width="10%" style="text-transform:uppercase;border-left:1px solid white"><i class="fa fa-list-ul" aria-hidden="true"></i></th>
				</tr>
				<? 		
				$s=mysqli_query($conn,$q);
				//print mysqli_error($conn);
				if(!(!$s) || mysqli_num_rows($s)>0){
				while($d=mysqli_fetch_assoc($s)){ 
				?>
				<tr  valign="top"  class="w3-hover-light-grey" style="background:<? print $rowColor[$d["acc_type"]];?> ;text-align:left;height:50px;text-transform:capitalize;">
					<td width="5%">
						(<? print $sn;$sn++?>)</td>
		
					<td width="15%" style="text-transform:uppercase;border-left:1px solid #F8F9F9">
						<? print $d['acc_name'];?><br>
						<? print $d['rly_no']."<br>".$d['icom_no'];?>
					</td>
					
					
					<td width="15%" style="text-transform:uppercase;border-left:1px solid #F8F9F9">
						<? 	$parallel_num=$d['parallel_num1'];
							$q1="SELECT * FROM $accTable where id= $parallel_num ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							print $d1['acc_name']."--";
							print $d1['rly_no']; }}?> <br>
					<? 	if($d['parallel_num2']!=""){
							$parallel_num=$d['parallel_num2'];
							$q1="SELECT * FROM $accTable where id= $parallel_num ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							print $d1['acc_name']."--";
							print $d1['rly_no']; }}
							}?> <br>
					<? 	if($d['parallel_num3']!=""){
							$parallel_num=$d['parallel_num3'];
							$q1="SELECT * FROM $accTable where id= $parallel_num ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							print $d1['acc_name']."--";
							print $d1['rly_no']; }}
							}?> <br>
					<? 	if($d['parallel_num4']!=""){
							$parallel_num=$d['parallel_num4'];
							$q1="SELECT * FROM $accTable where id= $parallel_num ";
							$s1=mysqli_query($conn,$q1);
							if(!(!$s1) || mysqli_num_rows($s1)>0){
							while($d1=mysqli_fetch_assoc($s1)){ 
							print $d1['acc_name']."--";
							print $d1['rly_no']; }}
							}?> <br>
					
					</td>
					
					<td width="10%" style="text-transform:capitalize;border-left:1px solid #F8F9F9">
						<? if ($user_type=="admin" ||  $userid==$owner){ ?>
						<i class="fa fa-pencil-square-o w3-large w3-text-blue" aria-hidden="true" alt="Edit" title="Edit" onclick="addPages('1','acc','<? print $_GET['acc_type'];?>','<? print $d['id'];?>');"></i>
						<? } ?>
					</td>
				</tr>
	<?		}
		}
			 ?>
			</table>
		  </div>
		 <br><br>
