
<?
//include("./createTables.php");
include("./userAccess.php");
include("./header.php");
		
		if((isset($_GET['reg'])) && ($_GET['reg']!="")){
			$registrar=$_GET['reg'];
		}
		else if(isset($_SESSION['registrar'])){
			$registrar=$_SESSION['registrar'];
		}
			$q1="SELECT * FROM $regTable where id = $registrar";
			$s1=mysqli_query($conn,$q1);
			if(!(!$s1) || mysqli_num_rows($s1)>0){
			while($d1=mysqli_fetch_assoc($s1)){ 
				$rly1=$d1['rly'];
				$divn1=$d1['divn'];
				$reg1_name=$d1['reg1_name'];
				$reg_ip=$d1['reg1_ip'];
				$reg2_ip=$d1['reg2_ip'];
				$reg1_user=$d1['reg1_user'];
				$reg1_root=$d1['reg1_root'];
				$location=$d1['location'];
			}}
		
			$retStr=array(99,'','');
			$server="1";
			if((isset($_GET['server'])) && ($_GET['server']=="2")){
				$server=$_GET['server'];
				$reg_ip=$reg2_ip;
			}
	//----------------------------------------copy files & reload Remote server -----------------------
			set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
			include('Net/SSH2.php');
			include('Net/SFTP.php');
			//-------------------------------- Sftp Connect ------
				$sftp = new Net_SFTP($reg_ip);
				if (!$sftp->login($reg1_user, $reg1_root)) {
					$retStr=array(99,'0','Failed to Connect');
					
				}
			//-------------------------------- SSH Connect ------	
				$ssh = new Net_SFTP($reg_ip);
				if (!$ssh->login($reg1_user, $reg1_root)) {
					$retStr=array(99,'0','Failed to Connect');
					
					
				}
			//----------------------------------- Connection Test ------------------
				if((isset($_GET['action'])) && ($_GET['action']=="connect")){
					if (!$ssh->exec('mkdir /usr/local/share/AstInst')){
							$retStr=array(22,'exit','Not able To connect');
						} else {
							$retStr=array(11,'copyRexcl','Connected');
					}
					
				}
			//----------------------------------- Copy RExCL ------------------	
				if((isset($_GET['action'])) && ($_GET['action']=="copyRexcl")){
					if (!$sftp->put('/usr/local/share/AstInst/install', "./rexcl/install", NET_SFTP_LOCAL_FILE)){
							$retStr=array(33,'exit','Not able To Copy');
						} else {
							$retStr=array(11,'installRexcl','Copied');
					}
					
					
				}
			//----------------------------------- Change folder access and run Install script  ------------------	
				if((isset($_GET['action'])) && ($_GET['action']=="installRexcl")){
					$ssh->exec('cd /usr/local/share && chmod -R 777 AstInst'); 
					$ssh->exec('cd /usr/local/share/AstInst && ./install'); 
					if (!$ssh->exec('cd /etc/asterisk/voip')){
							$retStr=array(11,'gitClone','Asterisk Installation Completed');
						} else {
							$retStr=array(44,'exit','Installation Failed');
					}
					
					
				}
			//----------------------------------- Run command to Git clone Rexcl  ------------------	
				if((isset($_GET['action'])) && ($_GET['action']=="gitClone")){
					if (!$ssh->exec('cd /usr/local/share/Asterisk')){
						$ssh->exec('rm -R /usr/local/share/Asterisk'); 
					}
					$ssh->exec('cd /usr/local/share && git clone https://github.com/ptiriset/Asterisk.git'); 
					if (!$ssh->exec('cp /usr/local/share/Asterisk/rexcl/rexclconf /usr/local/bin')){
							
							if (!$ssh->exec('chmod +x /usr/local/bin/rexclconf')){
								
									//---------------------- save installed time -------------------
									$q="UPDATE $regTable SET ";
									$q.="installed".$server."_on=NOW(),log_stamp=NOW() WHERE id = $registrar ";
									//print $q;
									$s=mysqli_query($conn,$q);
									if(!(!$s)){
										}
										else{
											$retStr=array(91,'',mysqli_error($conn)."<br>".$q);
											//print $retStr[0];
										}
			
									//-------------------update Installed date --------------
								
									$retStr=array(11,'exit','RExCL installation Completed');
								} else {
									$retStr=array(55,'exit','Rexcl copying failed');
							}
						} else {
							$retStr=array(55,'exit','Rexcl copying failed');
					}
					
					
					
				}
			print "[{\"retCode\":\"{$retStr[0]}\", \"retValue\":\"{$retStr[1]}\", \"retMsg\":\"{$retStr[2]}\"}]";	
					
		
		
		?>