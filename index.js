
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
//alert (a+","+f+","+fv+","+s);
	if(a==1){ var fList=new Array('page'); }
	if(a==2){ var fList=new Array('page','search'); }
	if(a==3){ var fList=new Array('search'); }
	if(a==5){ var fList=new Array('page','rly','divn','reg','search'); }
	var argStr="./asteriskList.html?action="+a+"&f="+f;
	//alert(f+"="+fv);
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
			//alert(argStr);
		}
		if(a==3){ argStr+="&page=assets"; }
		if(s!=""){ argStr+="&"+f+"="+fv+"&acc_type="+s; }
	}
	else{
		argStr+="&page="+fv;
		if(s!=""){ argStr+="&acc_type="+s; }
		
	}
	//alert(argStr);
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
			//alert(retTxt);
				document.getElementById('main').innerHTML=retTxt;
			}
			//else{
			//	alert('data no change');
			//}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function addPages(a,type,page,id){
alert (a);
	var argStr="./addPageList.html?action="+page+"&type="+type;
	if (a==1){
		argStr+="&id="+id;
	}
	if (a==2){
		argStr+="&server=1";
	}
	if (a==3){
		argStr+="&server=2";
	}
	//alert(argStr);
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
				document.getElementById('id01').style.display='block';
				document.getElementById('popup').innerHTML=retTxt;
			}
			//else{
			//	alert('data no change');
			//}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function viewChange(a,f,fv,s){
//alert ("here");
	if(a==1){ var fList=new Array('page'); }
	if(a==2){ var fList=new Array('page','search'); }
	if(a==3){ var fList=new Array('search'); }
	var argStr="./asteriskList.html?action="+a+"&f="+f;
	//alert(f+"="+fv);
	if(a!=0){
		for(k=0;k<fList.length;k++){
			if(fList[k]==f){
				argStr+="&"+f+"="+fv;
			}
			else{
				v=document.getElementById(fList[k]).value;
				argStr+="&"+fList[k]+"="+encodeURIComponent(v);
			}
			//alert(argStr);
		}
		if(a==3){ argStr+="&page=assets"; }
		if(s!=""){ argStr+="&"+f+"="+fv+"&acc_type="+s; }
	}
	else{
		argStr+="&page="+fv;
		if(s!=""){ argStr+="&acc_type="+s; }
		
	}
	//alert(argStr);
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
			//alert(retTxt);
				document.getElementById('content').innerHTML=retTxt;
			}
			//else{
			//	alert('data no change');
			//}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function saveConf(){
 //alert (a+" User");
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
				//document.getElementById('main').innerHTML=retTxt;
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
 //alert (a+" User");
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
 //alert (a+" User");
	var id=document.getElementById('id').value;
	var updated_by=document.getElementById('updated_by').value;
	var argStr="./accSave.php?action="+a+"&id="+id+"&task="+t+"&updated_by="+updated_by;
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
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
			//alert(retTxt);
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
 //alert (a+"-"+i);
	var gw_id=document.getElementById('id').value;
	var server_id= document.getElementById("server_id").value;
	var p = document.getElementById("port_id"+i).value;
	var x = document.getElementById("port_name"+i).value;
	var y = document.getElementById("acc_id"+i).value;
	var z = document.getElementById("type").value;
	var updated_by=document.getElementById('updated_by').value;
	var argStr="./accSave.php?action="+a+"&server_id="+server_id+"&acc_id="+y+"&id="+p+"&type="+z+"&gw_id="+gw_id+"&port_name="+x+"&port_no="+i+"&updated_by="+updated_by;
	//alert (argStr);
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
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
			//alert(retTxt);
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
 //alert (a+" User");
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
	//alert ("here"+a); 
	if (a=="ip"){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","phone","mac","updated_by");}
	if (a=="analog"){var fList=new Array("page","id","server_id","acc_type","acc_name","icom_name","disp_name",
				"icom_no","secret1","rly_no","pstn_no","updated_by");}
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
	if (a=="reg"){var fList=new Array("page","id","rly","divn","location","reg1_name","reg1_ip","reg2_ip","reg1_user","reg1_root","rly_no_length","icom_no_length","pstn_no_length","rly_code","pstn_code","updated_by");}
	if (a=="icom"){var fList=new Array("page","id","server_id","icom_name","department","vlan","updated_by");}
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
	
	var gList=new Array("id","trans_no2","pstn_no" ,"pstn_code","serv_make" ,"reg2_ip" ,"transform2" ,"gw_id2","vlan","remark");
	var exList=new Array("id" ,"page" ,"rly" ,"divn" ,"acc_type" ,"server_id" ,"updated_by");
	var v=new Array();
	var argStr="";
	//------------------------------------------------------
	n=fList.length;
	//------------------------------------------------------
	// Checking whether all fields have valid entry
	//------------------------------------------------------
	argStr="./accSave.php?action="+a;
	//alert(argStr);
	for(k=0;k<n;k++){		
		v[k]=document.getElementById(fList[k]).value;
		//alert(argStr+" "+fList[k]+" "+v[k]);
		//if(fList[k]!="id" && fList[k]!="trans_no2" && fList[k]!="mac"  && fList[k]!="pstn_no"  &&  fList[k]!="pstn_code" && fList[k]!="serv_make"  && fList[k]!="reg2_ip"  && fList[k]!="transform2"  && fList[k]!="gw_id2"  && v[k].length<=0){
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
	if(f==""){
		return;
	}
	else{
		var v=document.getElementById(f).value;
		//var id=document.getElementById('id').value;
		var server_id=document.getElementById('server_id').value;
		//var register=document.getElementById('register').value;
		//var pg_no=document.getElementById('pg_no').value;
		//var code=document.getElementById('code').value;
	}
	var fList=new Array("id" ,"trans_no2" ,"mac","pstn_no","pstn_code" ,"serv_make","reg2_ip","transform2","gw_id2","trans_no1","trans_no2")
	/*if(f=="transform1" && c!="None"){ 
		document.getElementById('trans_no1').disabled=false;
		} else { 
			document.getElementById('trans_no1').disabled=true;
			document.getElementById('trans_no1').value="0";
		}
	if(f=="gw_id2" && c!="N.A"){ 
		document.getElementById('transform2').disabled=false;
		} else { 
			document.getElementById('transform2').disabled=true;
			document.getElementById('transform2').value=None;
			document.getElementById('trans_no2').value="";
			document.getElementById('trans_no2').disabled=true;
		}
	if(f=="transform2" && c!="None"){ 
		document.getElementById('trans_no2').disabled=false;
		} else { 
			document.getElementById('trans_no2').disabled=true;
		}*/
	if(!(fList.includes(f)) && v==""){
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Value Cannot Be Empty.</b>";
		return;
	}
	
	//-------------------------------------
	
		var a='match';
	
	//-------------------------------------
	
		argStr="./scanDatabase.php?action="+a+"&f="+f+"&"+f+"="+v+"&server_id="+server_id;
	
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

function checkFormat(f,c){
	//alert("here");
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
//alert("here directory");
	var fList=new Array('page','rly','divn','reg','search');
	var argStr="./numbList.html?";
	//alert(f+"="+fv);
	if(a!=0){
		for(k=0;k<fList.length;k++){
				v=document.getElementById(fList[k]).value;
				argStr+="&"+fList[k]+"="+encodeURIComponent(v);
			//alert(argStr);
		}
	}
	else{
		argStr+="&page="+fv;		
	}
	//alert(argStr);
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
			//alert(retTxt);
				document.getElementById('directory').innerHTML=retTxt;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function installRexcl(a,i){
 //alert (a+" User");
	document.getElementById('submit').style.display='none';
	document.getElementById('close').style.display='none';
	//var fList=new Array("connect","copyRexcl","installRexcl","gitClone");
	//n=fList.length;
	
	//alert(argStr);
	//for(k=0;k<n;k++){		
	argStr="./install2.php?action="+a+"&server="+i;
		//alert(argStr);
	
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
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				//alert(s[0].retMsg);
				document.getElementById(a+'1').innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				//alert(s[0].retValue);
				if(s[0].retValue!='exit'){
					//alert(s[0].retValue);
					document.getElementById(s[0].retValue).style.display="block";
				
					setTimeout(function (){
					installRexcl(s[0].retValue,i);	
					},2000);
				}
				else{
					document.getElementById('exit').style.display="block";
				}
			}
			else{
				document.getElementById(a+'1').innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				document.getElementById('exit').style.display="block";
				//alert(s[0].retMsg);
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}

function createRexcl(){
 //alert (a+" User");
	document.getElementById('save').style.display='none';
	document.getElementById('change').style.display='none';
	//var fList=new Array("connect","copyRexcl","installRexcl","gitClone");
	//n=fList.length;
	
	//alert(argStr);
	//for(k=0;k<n;k++){		
	argStr="./rexclConfig.php?action=create";
		//alert(argStr);
	
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
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				//alert(s[0].retMsg);
				document.getElementById('create1').innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				//alert(s[0].retValue);
				if(s[0].retValue!='exit'){
					//alert(s[0].retValue);
					document.getElementById(s[0].retValue).style.display="block";
					saveToServ(s[0].retValue,'1');	
					
				}
				else{
					document.getElementById('exit').style.display="block";
				}
			}
			else{
				document.getElementById('create1').innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				//alert(s[0].retMsg);
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}

function saveToServ(a,i){
 //alert (a+" User");
	//var fList=new Array("connect","copyRexcl","installRexcl","gitClone");
	//n=fList.length;
	
	//alert(argStr);
	//for(k=0;k<n;k++){		
	argStr="./saveToServ.php?action="+a+"&server="+i;
		//alert(argStr);
	
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
			//alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
				//alert(s[0].retMsg);
				document.getElementById(a+'1').innerHTML="<i class='fa fa-check w3-text-green' aria-hidden='true'></i> "+s[0].retMsg;
				//alert(s[0].retValue);
				if(s[0].retValue!='exit'){
					//alert(s[0].retValue);
					document.getElementById(s[0].retValue).style.display="block";
				
					setTimeout(function (){
						saveToServ(s[0].retValue,i);
					},50);
				}
				else{
					document.getElementById('completed').style.display="block";
				}
			}
			else{
				document.getElementById(a+'1').innerHTML="<b class='w3-text-red' ><i class='fa fa-times w3-text-red' aria-hidden='true'></i> "+s[0].retMsg+"</b>";
				document.getElementById('exit').style.display="block";
				//alert(s[0].retMsg);
				return;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();


}