	<?
		$q="SELECT * FROM $accTable where recording='Yes' and server_id= $registrar ";
		$q.=$search;
		$q.=" ORDER BY rly_no DESC";
		//print $q;
		$sn=1; 
	?>
	<div >
		<div class="sticky w3-bar">
		  <div class="w3-bar-item w3-xxlarge" style="text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';">Call Recording Enabled Accounts </b></div>
		</div>
		<div class="sticky w3-bar ">
		  <i class="w3-small w3-text-grey w3-padding" ><? print $regName." Exchange (IP: ". $primaryIP.")   / [". $divn1." division /". $rly1."]"; ?></i>
		  <!--div class="w3-bar-item w3-right" onclick="window.print()"><i class="fa fa-print w3-text-green  w3-large"></i></div-->
		</div>
				
			<table class="w3-table w3-small w3-card w3-half" style="background:white;word-break:keep-all;">
				<tr class=" w3-small w3-text-blue w3-opacity w3-bold"  style="text-align:left;" valign="top">
					<th width="5%">S.N</th>
					<th width="15%" style="text-transform:uppercase;border-left:1px solid white"> Account </th> 
					
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
					
					
					
				</tr>
	<?		}
		}
			 ?>
			</table>
		  </div>
		 <br><br>
