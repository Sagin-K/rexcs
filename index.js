
var f="page";
var fv=document.getElementById(f).value;
var c="";
window.setInterval(function(){
	filterData('1',f,fv);
},11000);

function selectField(id){
	var v1=document.getElementById(id).value;
	if(f!=id){
		f=id;
		fv=v1;
		filterData('1',f,fv);
	}
	else if(f==id && v1!=fv){
		fv=v1;
		filterData('1',f,fv);
	}
}

function filterData(a,f,fv,s){
	if(a==1){ var fList=new Array('page'); }
	if(a==2){ var fList=new Array('page','search'); }
	if(a==3){ var fList=new Array('page','search'); }
	if(a==5){ var fList=new Array('page','rly','divn','reg','search'); }
	var argStr="./asteriskList.html?action="+a+"&f="+f;
	if(a==4){ argStr="./asteriskList.html?action="+a+"&page=reg&acc_type=reg&rly="+fv+"&divn="+s; }
	else if(a!=0){
		for(k=0;k<fList.length;k++){
			if(fList[k]==f){
				argStr+="&"+f+"="+fv;
			}
			else{
				v=document.getElementById(fList[k]).value;
				argStr+="&"+fList[k]+"="+encodeURIComponent(v);
			}
		}
		if(s!=""){ argStr+="&"+f+"="+fv+"&acc_type="+s; }
	}
	else{
		argStr+="&page="+fv;
		if(s!=""){ argStr+="&acc_type="+s; }
		
	}
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
				document.getElementById('main').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function addPages(a,type,page,id){
	var argStr="./addPageList.html?action="+page+"&type="+type;
	if (a==1){
		argStr+="&id="+id;
	}
	if (page==2){
		argStr+="&server=1";
	}
	if (a==3){
		argStr+="&server=2";
	}
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
			
				document.getElementById('id01').style.display='block';
				document.getElementById('exit').style.display='block';
				document.getElementById('popup').innerHTML=retTxt;
			}
			
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function IPstatus(id){
	document.getElementById(id+'_status').innerHTML="<i class='fa fa-spinner w3-spin w3-text-grey w3-medium'></i>";
	document.getElementById(id+'_status').disabled = true;
	var argStr="./pingtest.php?id="+id;
	document.getElementById(id+'_1').innerHTML="<i class='fa fa-spinner w3-spin w3-text-blue w3-medium'></i>";
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById(id+'_status').disabled = false;
				document.getElementById(id+'_status').innerHTML="Check Status";
				if(s[0].reg1_ip!=''){
				document.getElementById(id+'_1').innerHTML=s[0].reg1_ip;
				}
				if(s[0].reg2_ip!=''){
				document.getElementById(id+'_2').innerHTML=s[0].reg2_ip;
				}
			}
			
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function viewChange(a,f,fv,s){
	if(a==1){ var fList=new Array('page'); }
	if(a==2){ var fList=new Array('page','search'); }
	if(a==3){ var fList=new Array('search'); }
	var argStr="./asteriskList.html?action="+a+"&f="+f;
	if(a!=0){
		for(k=0;k<fList.length;k++){
			if(fList[k]==f){
				argStr+="&"+f+"="+fv;
			}
			else{
				v=document.getElementById(fList[k]).value;
				argStr+="&"+fList[k]+"="+encodeURIComponent(v);
			}
		}
		if(a==3){ argStr+="&page=assets"; }
		if(s!=""){ argStr+="&"+f+"="+fv+"&acc_type="+s; }
	}
	else{
		argStr+="&page="+fv;
		if(s!=""){ argStr+="&acc_type="+s; }
		
	}
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
				document.getElementById('id01').style.display='block';
				document.getElementById('popup').innerHTML=retTxt;
			}
			
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function saveConf(){
	var argStr="./saveConfig.php";
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
			alert(retTxt);
			}
			else{
				alert('data no change');
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function quickAction(a,id){
	var argStr="./saveUser.php?action="+a+"&id="+id;
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
			
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				alert(s[0].retMsg);
				window.location.reload();	
			}
			}
			else{
				alert('data no change');
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function accDel(a,t){
 	var id=document.getElementById('id').value;
	var updated_by=document.getElementById('updated_by').value;
	var argStr="./accSave.php?action="+a+"&id="+id+"&task="+t+"&updated_by="+updated_by;
	//-------------------------------------------
	//alert(argStr);
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById('msg').innerHTML=s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="green";
				document.getElementById('msg').style.color="#ffc";
				document.getElementById('main').style.backgroundColor="#ddd";
				divStr="<br>";
				divStr+="<fieldset style=\"padding:5px;border:1px solid #aaa;color:#00d;background-color:#eee;\">";
				divStr+="<br><br>"+s[0].retMsg+"<br><br><br>";	//[fList.indexOf('username')]
				document.getElementById('main').innerHTML=divStr;
				setTimeout(function (){
					opener.location.reload();
					window.close();
				},2000);
			}
			else{
				alert(s[0].retMsg);
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function fxSave(a,i){
	var gw_id=document.getElementById('id').value;
	var server_id= document.getElementById("server_id").value;
	var p = document.getElementById("port_id"+i).value;
	var x = document.getElementById("port_name"+i).value;
	var y = document.getElementById("acc_id"+i).value;
	var z = document.getElementById("type").value;
	var updated_by=document.getElementById('updated_by').value;
	var argStr="./accSave.php?action="+a+"&server_id="+server_id+"&acc_id="+y+"&id="+p+"&type="+z+"&gw_id="+gw_id+"&port_name="+x+"&port_no="+i+"&updated_by="+updated_by;
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				alert(s[0].retMsg);
				window.location.reload();
			}
			else{
				alert('data no change');
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function selectReg(a,b){
 	var argStr="./setSession.php?variable="+a+"&value="+b;
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
			alert(retTxt);
				window.location.reload();
			}
			else{
				alert('data no change');
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function winReaload(a){
	var v1=document.getElementById("page").value;
	var v2=document.getElementById("department").value;
	var dep=encodeURIComponent(v2);
	document.location="directory.html?page="+v1+"&department="+dep;
}


function openWindow(a,w,h,n){
			var popupWinWidth=w;
			var popupWinHeight=h;
			var left = (screen.width - popupWinWidth) / 2;
            var top = (screen.height - popupWinHeight) / 4;
	window.open(a, n,
                    'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes, width=' + popupWinWidth
                    + ', height=' + popupWinHeight + ', top='
                    + top + ', left=' + left);
}

function dropDwn(dd) {
  var x = document.getElementById(dd);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

function toggle(a) {
	//alert("toggle");
  var x = document.getElementById("port_name"+a);
  var y = document.getElementById("acc_id"+a);
  var z = document.getElementById("save"+a);
  if (x.disabled == false) {
    x.disabled = true;
    y.disabled = true;
    z.style.display = "none";
  } else {
    x.disabled = false;
    y.disabled = false;
	z.style.display = "block";
  }
}


function secret(a) {
	//alert("toggle");
  var x = document.getElementById(a+"-secret");
  var y = document.getElementById(a+"-dot");
  if (x.style.display == "none") {
    x.style.display == "block";
    y.style.display == "none";
  } else {
   x.style.display == "none";
   y.style.display == "block";
  }
}


$(function() {
	$( "#from_date" ).datepicker({
		changeMonth:true,
		changeYear: true});
});

$(function() {
	$( "#to_date" ).datepicker({
		changeMonth:true,
		changeYear: true});
});
$(function() {
		$( "#date" ).datepicker({
			
			changeMonth:true,
			changeYear: true});
	});
	

function formatDate(id){
	var d=document.getElementById(id).value;
	//alert("Note Date:"+d);
	if(d.indexOf('/')>=0){
		var tmp=d.split('/');
		x=tmp[2]+"-"+tmp[0]+"-"+tmp[1];
		document.getElementById(id).value=x;
	}
	return;
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function accAdd(a){
	var xmlhttp;
	var page=document.getElementById("page").value;
	//alert(a);			
	if (a=="ip"){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","updated_by");}
	if (a=="ip" && page=="edit"){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","phone","mac","callgroup","pickupgroup","updated_by");}
	if (a=="analog"){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","updated_by");}
	if (a=="analog" && page=="edit" ){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","callgroup","pickupgroup","updated_by");}
	if (a=="ip2"){var fList=new Array("page","id","accID","server2","user_id2","password2","updated_by");}
	if (a=="map"){var fList=new Array("page","id","accID","map_no","updated_by");}
	if (a=="byte"){var fList=new Array("page","id","accID","byte_no","updated_by");}
	if (a=="bs"){
			var fList=new Array("page","id","accID","ps_no","ps_type","updated_by");
			var accID=document.getElementById("accID").value;
			var ps_name=document.getElementById("ps_no").value;
			if(accID==ps_name){
				alert("boss & Secy names/Nos should not be same");
				document.getElementById("ps_name").style.backgroundColor="#fcc";
				document.getElementById("ps_name").focus();
				return;
	}}
	if (a=="vm"){var fList=new Array("page","id","accID","vm_pw","updated_by");}
	if (a=="parallel"){
			var fList=new Array("page","id","accID","parallel_num","updated_by");
			var accID=document.getElementById("accID").value;
			var parallel_num=document.getElementById("parallel_num").value;
			if(accID==parallel_num){
				alert("Main & parallel should not be same");
				document.getElementById("parallel_num").style.backgroundColor="#fcc";
				document.getElementById("parallel_num").focus();
				return;
	}}
	if (a=="reg"){var fList=new Array("page","id","rly","divn","location","reg1_name","reg1_ip","reg2_ip","reg1_user","reg1_root","rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","updated_by");}
	if (a=="icom"){var fList=new Array("page","id","server_id","icom_name","department","vlan","updated_by");}
	if (a=="own"){var fList=new Array("page","id","updated_by","owner");}
	if (a=="gw"){var fList=new Array("page","id","server_id","gw_ip","gw_name","updated_by","port","type");}
	if (a=="route"){var fList=new Array("page","id","server_id","route_name","pattern","gw_id1","gw_id2","transform1","transform2","trans_no1","trans_no2","remark","updated_by");
		var tr1=document.getElementById("transform1");
		var tn1=document.getElementById("trans_no1");
		if(tr1.value!="None" && tn1.value==""){ 
		tn1.focus();
			return;
		}
		var tr2=document.getElementById("transform2");
		var tn2=document.getElementById("trans_no2");
		if(tr2.value!="None" && tn2.value==""){ 
		tn2.focus();
			return;
		}
	}
	if (a=="conf"){var fList=new Array("page","id","server_id","conf_name","conf_no","conf_type","conf_admin","remark","updated_by");}
	var gList=new Array("id","trans_no2","pstn_no" ,"pstn_code","serv_make" ,"reg2_ip" ,"transform2" ,"gw_id2","vlan","remark","phone","mac","callgroup","pickupgroup","recording");
	var exList=new Array("id" ,"page" ,"rly" ,"divn" ,"acc_type" ,"server_id" ,"recording","updated_by");
	var v=new Array();
	var argStr="";
	//------------------------------------------------------
	n=fList.length;
	//------------------------------------------------------
	// Checking whether all fields have valid entry
	//------------------------------------------------------
	argStr="./accSave.php?action="+a;
	for(k=0;k<n;k++){		
		v[k]=document.getElementById(fList[k]).value;
		if(!(gList.includes(fList[k])) && v[k].length<=0 ){
			document.getElementById(fList[k]).style.backgroundColor="#fcc";
			document.getElementById(fList[k]).focus();
			return;
		}
		if(!(exList.includes(fList[k]))){
			v2=document.getElementById(fList[k]+"_msg").innerHTML;
		if ( v2 != " " && v2 != ""){
			document.getElementById(fList[k]).style.backgroundColor="#fcc";
			document.getElementById(fList[k]).focus();
			return;
		}}
		argStr+="&"+fList[k]+"="+encodeURIComponent(v[k]);
		//alert(argStr);
	}
	//alert(argStr);
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//------------------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				//alert(s[0].retCode);
				document.getElementById('msg').innerHTML=s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="blue";
				document.getElementById('msg').style.color="white";
				document.getElementById('main').style.backgroundColor="#ddd";
				divStr="<br>";
				divStr+="<fieldset class='w3-center w3-xlarge ' style=\"padding:5px;background-color:#fff;width:100%;\">";
				divStr+="<br><br><div >"+s[0].retMsg+"</div><i class='fa fa-check w3-text-green' aria-hidden='true'></i><br><br></fieldset>";	
				document.getElementById('popup').innerHTML=divStr;
				setTimeout(function (){
					location.reload();
					window.close();
				},2000);
			}
			else{
				document.getElementById('msg').innerHTML="Error#"+s[0].retCode+" : "+s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="#f88";
				document.getElementById('msg').style.color="#ffc";
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function showPass(pw) {
  var x = document.getElementById(pw);
  if (x.type == "password") {
    x.type = "text";
  } else {
    x.type = "password";
	
  }
}


function hideport(value) {
  var x = document.getElementById('port');
  if (value == "sip") {
    x.value = "0";
    x.disabled = true;
  } else {
   x.disabled = false;
	
  }
}


function scanDatabase(f,c){
	//alert("here");
	var xmlhttp;
	if(f=="icom_name"){
		f="icom_no";
	}
	if(f==""){
		return;
	}
	else{
		var v=document.getElementById(f).value;
		
		var server_id=document.getElementById('server_id').value;
	
	}
	var fList=new Array("id" ,"trans_no2" ,"mac","pstn_no","pstn_code" ,"serv_make","reg2_ip","transform2","gw_id2","trans_no1","trans_no2","vlan","callgroup","pickupgroup","phone","remark")
	
	if(!(fList.includes(f)) && v==""){
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Value Cannot Be Empty.</b>";
		return;
	}
	
	//-------------------------------------
	
		var a='match';
	
	//-------------------------------------
	
		argStr="./scanDatabase.php?action="+a+"&f="+f+"&"+f+"="+v+"&server_id="+server_id;
	if (f=="icom_no"){
		var icom_name=document.getElementById('icom_name').value;
		argStr+="&icom_name="+icom_name;
		
	}
	if (f=="icom_name"){
		var icom_no=document.getElementById('icom_no').value;
		argStr+="&icom_no="+icom_no;
		
	}
	
	//alert(argStr);
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(retTxt==''){
				document.getElementById(f+'_msg').innerHTML="";
			}	
			else{
				
				document.getElementById(f+'_msg').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function scanDb(f,c){
	var xmlhttp;
	if(f==""){
		return;
	}
	else{
		var v=document.getElementById(f).value;
	
	}
	var fList=new Array("id" ,"trans_no2" ,"mac","pstn_no","pstn_code" ,"serv_make","reg2_ip","transform2","gw_id2","trans_no1","trans_no2","vlan","callgroup","pickupgroup","phone")
	
	if(!(fList.includes(f)) && v==""){
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Value Cannot Be Empty.</b>";
		return;
	}
	
	//-------------------------------------
	
		var a='match';
	
	//-------------------------------------
	
		argStr="./scanDatabase.php?action="+a+"&f="+f+"&"+f+"="+v;
	
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(retTxt==''){
				document.getElementById(f+'_msg').innerHTML="";
			}	
			else{
				
				document.getElementById(f+'_msg').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function checkFormat(f,c){
	var xmlhttp;
	if(f==""){
		return;
	}
	else{
		var v=document.getElementById(f).value;
		var server_id=document.getElementById('server_id').value;
		
	}
		if(f!="pstn_no" && v==""){
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Value Cannot Be Empty.</b>";
		return;
	}
	
	//-------------------------------------
	var a='search';
	if(c!=0){
		var a='match';
	}
	//-------------------------------------
	
		argStr="./formatCheck.php?action="+a+"&f="+f+"&"+f+"="+v;
	
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			//alert(retTxt);
			if(retTxt==''){
				document.getElementById(f+'_msg').innerHTML="";
			}	
			else{
				
				document.getElementById(f+'_msg').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function checkBlank(f,v){
	if(v!=''){
		document.getElementById(f+'_msg').innerHTML="";
	} else {
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>** Value Cannot Be Empty.</b>";
	}
	return;
}

function directory(a){
	var fList=new Array('page','rly','divn','reg','search');
	var argStr="./numbList.html?";
	if(a!=0){
		for(k=0;k<fList.length;k++){
				v=document.getElementById(fList[k]).value;
				argStr+="&"+fList[k]+"="+encodeURIComponent(v);
		}
	}
	else{
		argStr+="&page="+fv;		
	}
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			if(c!=retTxt){
				c=retTxt;
				document.getElementById('directory').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function installRexcl(a,i,reg){
 //alert (a+" User");
	document.getElementById('submit').style.display='none';
	document.getElementById('close').style.display='none';
	argStr="./install2.php?action="+a+"&server="+i+"&reg="+reg;
	
	if(reg!=''){
		argStr+="&reg="+reg;
	}
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById(a+'1').innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				if(s[0].retValue!='exit'){
					document.getElementById(s[0].retValue).style.display="block";
				
					setTimeout(function (){
					installRexcl(s[0].retValue,i,reg);	
					},2000);
				}
				else{
					document.getElementById('exit').style.display="block";
				}
			}
			else{
				document.getElementById(a+'1').innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				document.getElementById('exit').style.display="block";
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}

function createRexcl(){
 	document.getElementById('save').style.display='none';
	document.getElementById('change').style.display='none';
	argStr="./rexclConfig.php?action=create";
		
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById('create1').innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				if(s[0].retValue!='exit'){
					document.getElementById(s[0].retValue).style.display="block";
					moveBar('1','0');
					saveToServ(s[0].retValue,'1','1');	
					
				}
				else{
					document.getElementById('exit').style.display="block";
				}
			}
			else{
				document.getElementById('create1').innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}

function saveToServ(a,i,v){
 	argStr="./saveToServ.php?action="+a+"&server="+i;
	
	//-------------------------------------------
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//-------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById(a+i).innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				moveBar(i,v);
				if(s[0].retValue!='exit'){
					if(s[0].retValue!='connect2'){
						document.getElementById(s[0].retValue).style.display="block";
						
						setTimeout(function (){
							saveToServ(s[0].retValue,i,'1');
						},50);
					}
					else{
						setTimeout(function (){
							saveToServ(s[0].retValue,'2','0');
						},50);
					}
				}else{
					document.getElementById('completed').style.display="block";
				}
			}
			else if (s[0].retCode==44){
				document.getElementById(a+i).innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				setTimeout(function (){
							saveToServ('connect2','2');
						},50);
			}
			else{
				document.getElementById(a+i).innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				document.getElementById('exit').style.display="block";
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}

function moveBar(i,a) {
  var elem = document.getElementById("progBar"+i);
  var val = document.getElementById("progBarValue"+i);
  var width= 0;
  if (i=='2'){  width =  15; }
  if (a!='0'){  width =  parseInt(val.innerHTML); }
  var end = width+15;
  var id = setInterval(frame,1);
  function frame() {
    if (width >= end || width >= 100) {
      clearInterval(id);
	  return;
    } else {
      width++; 
      elem.style.width = width + '%'; 
      val.innerHTML = width * 1 ;
    }
  }
}


function RegMenu(i) {
	  var x = document.getElementById("regEdit_"+i);
	  if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
	  } else { 
		x.className = x.className.replace(" w3-show", "");
	  }
	}
	
function updateAdd(a){
	var xmlhttp;
	var fList=new Array("page","id","version","date","updates","updated_by","update_rexcl","update_rexcs");
	var gList=new Array("id" ,"page" ,"rly" ,"divn");
	var exList=new Array("id" ,"page" ,"rly" ,"divn","update_rexcl","update_rexcs");
	var v=new Array();
	var argStr="";
	//------------------------------------------------------
		n=fList.length;
	//------------------------------------------------------
	argStr="./updateSave.php?action="+a;
	for(k=0;k<n;k++){		
		v[k]=document.getElementById(fList[k]).value;
		if(!(gList.includes(fList[k])) && v[k].length<=0 ){
			document.getElementById(fList[k]).style.backgroundColor="#fcc";
			document.getElementById(fList[k]).focus();
			return;
		}
		if(!(exList.includes(fList[k]))){
			v2=document.getElementById(fList[k]+"_msg").innerHTML;
			//alert(v2);
		if ( v2 != " " && v2 != ""){
			document.getElementById(fList[k]).style.backgroundColor="#fcc";
			document.getElementById(fList[k]).focus();
			return;
		}}
		argStr+="&"+fList[k]+"="+encodeURIComponent(v[k]);
	}
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//------------------------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				document.getElementById('msg').innerHTML=s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="blue";
				document.getElementById('msg').style.color="white";
				document.getElementById('main').style.backgroundColor="#ddd";
				divStr="<br>";
				divStr+="<fieldset class='w3-center w3-xlarge ' style=\"padding:5px;background-color:#fff;width:100%;\">";
				divStr+="<br><br><div >"+s[0].retMsg+"</div><i class='fa fa-check w3-text-green' aria-hidden='true'></i><br><br></fieldset>";	
				document.getElementById('popup').innerHTML=divStr;
				setTimeout(function (){
					location.reload();
					window.close();
				},2000);
			}
			else{
				document.getElementById('msg').innerHTML="Error#"+s[0].retCode+" : "+s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="#f88";
				document.getElementById('msg').style.color="#ffc";
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}
