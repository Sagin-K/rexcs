<?
include('./header.php');
function astUserTable(){
	$dbName="asterisk";
	$conn=@mysqli_connect("localhost","root","12345");
	$sql="CREATE DATABASE ".$dbName;
	if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
	}
	//--------------------------------------------------
//	createDatabase($dbName);
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="astusers";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				rly VARCHAR(30),	divn VARCHAR(41),
				email VARCHAR(30),	passwd VARCHAR(41),
				cug VARCHAR(15),
				name VARCHAR(40), 		desig VARCHAR(20),
				user_type VARCHAR(20) DEFAULT \"user\",
				access VARCHAR(20) DEFAULT \"self\",
				activationKey INT,
				accountStatus VARCHAR(20) DEFAULT \"inactive\",
				latest_action VARCHAR(25) DEFAULT \"User-Id Appl Submitted\",
				last_log DATETIME,
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
			$status=mysqli_query($conn,$query);
			print mysqli_error($conn);
			mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
			print mysqli_error($conn);
}

function regTable(){
	$dbName="asterisk";
	$conn=@mysqli_connect("localhost","root","12345");
	$sql="CREATE DATABASE ".$dbName;
	if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
	}
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="registrars";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				rly VARCHAR(50),	divn VARCHAR(50),	location VARCHAR(50),
				reg1_name  VARCHAR(50),
				reg2_name  VARCHAR(50),
				reg1_ip  VARCHAR(30),
				reg2_ip  VARCHAR(30),
				reg1_user VARCHAR(30),
				reg1_root VARCHAR(30),
				ntp_server VARCHAR(30),
				rly_no_length  VARCHAR(3),
				pstn_no_length  VARCHAR(3),
				icom_no_length  VARCHAR(3),
				rly_code  VARCHAR(5),
				pstn_code  VARCHAR(5),
				serv_make VARCHAR(100),
				updated_on DATETIME,
				committed_on DATETIME,
				installed1_on DATETIME,
				installed2_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				owner VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}

function icomTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="icoms";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(50),
				icom_name VARCHAR(30),
				department VARCHAR(50),
				vlan VARCHAR(10),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}


function gatewayTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="gateways";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(50),
				type VARCHAR(30),
				port VARCHAR(50),
				gw_ip VARCHAR(30),
				gw_name VARCHAR(50),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}


function gwportTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="gwports";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(50),
				type VARCHAR(30),
				port_no VARCHAR(10),
				port_name VARCHAR(50),
				acc_id VARCHAR(30),
				gw_id VARCHAR(30),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}


function accountTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="accounts";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(30),
				acc_type VARCHAR(10),
				acc_name VARCHAR(50),
				icom_name VARCHAR(30),
				disp_name VARCHAR(30),				
				icom_no VARCHAR(5),
				secret1 VARCHAR(50),
				rly_no VARCHAR(10),
				pstn_no VARCHAR(15),
				server2 VARCHAR(20),
				user_id2 VARCHAR(50),
				password2 VARCHAR(50),
				mac VARCHAR(50),
				phone VARCHAR(50),
				ps_no VARCHAR(10),
				ps_type VARCHAR(30),
				acc_vlan VARCHAR(5),
				gw_id VARCHAR(30),
				gw_port VARCHAR(5),
				gw_port_name VARCHAR(30),
				map_no VARCHAR(10),
				byte_no VARCHAR(10),
				hunt_no VARCHAR(10),
				remark VARCHAR(100),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}

function routeTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="routes";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(30),
				route_name VARCHAR(30),
				pattern VARCHAR(10),
				gw_id1 VARCHAR(30),
				gw_id2 VARCHAR(30),				
				transform1 VARCHAR(10), 
				transform2 VARCHAR(10), 
				trans_no1 VARCHAR(10),
				trans_no2 VARCHAR(10),
				remark VARCHAR(100),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}


function confTable(){
	$dbName="asterisk";
	//--------------------------------------------------
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="conferences";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				server_id VARCHAR(30),
				conf_name VARCHAR(30),
				conf_no VARCHAR(10),
				conf_admin VARCHAR(30),
				conf_type VARCHAR(30),				
				remark VARCHAR(100),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
	$status=mysqli_query($conn,$query);
	print mysqli_error($conn);
	mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
	print mysqli_error($conn);
}


function phoneTable(){
	$dbName="asterisk";
	//--------------------------------------------------
//	createDatabase($dbName);
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="phonelist";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				make VARCHAR(30),
				name VARCHAR(50),
				remark VARCHAR(100),
				updated_on DATETIME,
				updated_by VARCHAR(50),
				created_by VARCHAR(50),
				log VARCHAR(500),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
			$status=mysqli_query($conn,$query);
			print mysqli_error($conn);
			mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
			print mysqli_error($conn);
}


function astLogTable(){
	$dbName="asterisk";
	//--------------------------------------------------
//	createDatabase($dbName);
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="astusers_log";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				ref_id VARCHAR(30),	action VARCHAR(100),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
			$status=mysqli_query($conn,$query);
			print mysqli_error($conn);
			mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
			print mysqli_error($conn);
}

function featuresTable(){
	$dbName="asterisk";
	//--------------------------------------------------
//	createDatabase($dbName);
	$conn=@mysqli_connect("localhost","rexcsiriset","321rexcs789",$dbName);
	//--------------------------------------------------
	$tableName="features";
	$query="CREATE TABLE IF NOT EXISTS $tableName (
				id INT AUTO_INCREMENT PRIMARY KEY,
				date DATETIME,
				code VARCHAR(10),
				feature VARCHAR(100),
				status VARCHAR(30),
				remarks VARCHAR(100),
				log_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			)";
			$status=mysqli_query($conn,$query);
			print mysqli_error($conn);
			mysqli_query($conn,"ALTER TABLE $tableName AUTO_INCREMENT=100000");
			print mysqli_error($conn);
}


?>
