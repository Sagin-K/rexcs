
//------------------------------------------------------------
function formSubmit(){
	//alert("logUser");
	var id=		document.getElementById('uname').value;
	var pswd=	document.getElementById('upswd').value;
	//---------------------------------------------------------
	if(id.length==0){
		document.getElementById('uname').style.backgroundColor="#fcc";
		document.getElementById('logstatus').innerHTML="Please enter username";
		document.getElementById('uname').focus();
		return;
	}
	else if(pswd.length==0){
		document.getElementById('upswd').style.backgroundColor="#fcc";
		document.getElementById('logstatus').innerHTML="Please enter password";
		document.getElementById('upswd').focus();
		return;
	}
	else{
		//alert(id);
		logUser(id,pswd);
	}
}

function inputFocus(x){
	var str="";
	document.getElementById(x).style.backgroundColor="#ffc";
	if(x=="uname"){
		document.getElementById('logstatus').innerHTML="Please enter username";
	}
	else if(x=="upswd"){
		document.getElementById('logstatus').innerHTML="Please enter password";
	}
}

//------------------------------------------------------------
function inputBlur(x){
	var v=document.getElementById(x).value;
	if(v.length>0){
		document.getElementById(x).style.backgroundColor="#cfc";
	}
	else{
		document.getElementById(x).style.backgroundColor="#fcc";
	}
	document.getElementById('logstatus').innerHTML="<br>";
}

//------------------------------------------------------------
function logUser(u,p){
	getStr="action=login&u="+u+"&p="+p;
	//alert(getStr);
	var xmlhttp;
	if (window.XMLHttpRequest)  {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else  {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			txt=xmlhttp.responseText;
			//alert(txt);
			s=JSON.parse(txt);
			document.getElementById('logstatus').innerHTML=s[0].retMsg;
			if(s[0].retCode==11){
				window.location='./';
			}
			else{
				setTimeout(function(){
						document.getElementById('uname').focus();
						document.getElementById('upswd').value='';
					}
				,3000);
			}
		}
	}
	xmlhttp.open("GET","./loginCheck.php?"+getStr,true);
	xmlhttp.send();
}


function openWindow1(a,w,h,n){
			var popupWinWidth=w;
			var popupWinHeight=h;
			var left = (screen.width - popupWinWidth) / 2;
            var top = (screen.height - popupWinHeight) / 4;
	window.open(a, n,
                    'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes, width=' + popupWinWidth
                    + ', height=' + popupWinHeight + ', top='
                    + top + ', left=' + left);
}


function addPage(a,type,page,id){
//alert (a);
	var argStr="./userAdd2.html?action="+page;
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
			//alert(retTxt);
			document.getElementById('id01').style.display='block';
			document.getElementById('popup').innerHTML=retTxt;
			//else{
			//	alert('data no change');
			//}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function sendKey(prefix,email){
//alert (prefix);
	var argStr="http://10.187.1.2/testmail.php?"+prefix;
	
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
				//alert(s[0].retCode);
				//document.getElementById('msg').innerHTML=s[0].retMsg;
				//document.getElementById('exit').style.display="block";
				//document.getElementById('activate').style.display="block";
				divStr="<div id=\"signupdiv\" class=\"testbox w3-display-container\">";
				divStr+="<fieldset class='w3-bar-item w3-center w3-xlarge ' style=\"padding:5px;background-color:#fff;width:100%;\">";
				divStr+="<br><br><div> User Account Created </div><i class='fa fa-check w3-text-green' aria-hidden='true'></i><br><br></fieldset>";
				divStr+="<div id='mailmessage' class='w3-bar-item w3-large w3-center'>"
				divStr+="<br><br>Activation Key sent to your mail ID - <b>"+s[0].retValue+"</b> <br><br><br>";	//[fList.indexOf('username')]
				//divStr+="<p class='w3-bar-item w3-large w3-center' style=\"padding:5px;\">";
				//divStr+="Your Activation Key Mailed to "+s[0].retValue+"</b>";
				//divStr+="</p><br><br>";
				//divStr+="Please Use the Activation key to Activate your account<br><br> Or" 
				//divStr+="To activate your Account Please contact RExCS Admin: Ph:9000841246";
				divStr+="<br><br>";
				divStr+="</div>";
				divStr+="<input id='close' onclick='window.location.reload();'  value='Close' class='w3-right w3-button w3-border w3-border-blue w3-text-blue w3-hover-light-blue w3-small' >";
				divStr+="</div>"
				
				document.getElementById('popup').innerHTML=divStr;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}

function checkUserId(id){
	var xmlhttp;
	var cug=document.getElementById('cug').value;
	var desig=document.getElementById('desig').value;
	var email=document.getElementById('email').value;
	//var dept=document.getElementById('dept').value;
	var name=document.getElementById('name').value;
	//var v=document.getElementById(id).value;
	//---------------------------------------
	//rly_divn=rly_divn.split('_');
	//rly=rly_divn[0];
	//divn=rly_divn[1];
	//---------------------------------------
	if(id=='cug'){
		if(cug.length<10){
			return;
		}
	}
	//---------------------------------------
	if(id=='name'){
		if(name==""){
			document.getElementById(id+"_msg").innerHTML="";
			document.getElementById(id+"_msg").style.backgroundColor="";
			return;
		}
	}
	//---------------------------------------

	argStr="./scanUserList.php?f="+id+"&cug="+cug+"&desig="+desig+"&email="+encodeURIComponent(email)+
			"&name="+name;
	//alert(argStr);
	//---------------------------------------
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//---------------------------------------
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			retTxt=xmlhttp.responseText;
			//alert(argStr+"\n"+retTxt);
			s=JSON.parse(retTxt);
			//alert(argStr + "\n\n" + s[0].err_no + "\n" + s[0].err + "\n\n" + retTxt);
			document.getElementById(xId).innerHTML="RetCode#" + s[0].err_no + " : <b>" + s[0].err + "</b>";
			document.getElementById(xId).style.backgroundColor="#ffc";
			if(s[0].err_no==10){
				document.getElementById('submit').innerHTML='submit';
				document.getElementById('submit').disabled=false;
			}
			else{
				document.getElementById('submit').innerHTML='------';
				document.getElementById('submit').disabled=true;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function userRegForm(a){
	var xmlhttp;
	//alert ("here");
	if( a=="add"){
	var fList=new Array("rly","divn","id","cug","desig","email","name","passwd","c_passwd","accountStatus","access","user_type");
}
else if (a=="edit"){
	var fList=new Array("rly","divn","id","cug","desig","email","name","accountStatus","access","user_type");
}
else if (a=="signup"){
	var fList=new Array("rly","divn","id","cug","desig","email","name","passwd","c_passwd");
}
else if (a=="change"){
	var fList=new Array("id","cur_passwd","passwd","c_passwd");
}
else if (a=="activate"){
	var fList=new Array("id","email","key");
}
else if (a=="reset"){
	var fList=new Array("id");
}
var exList=new Array("id","accountStatus","access","user_type");
	
	var v=new Array();
	var argStr="";
	//------------------------------------------------------
	n=fList.length;
	//------------------------------------------------------
	// Checking whether all fields have valid entry
	//------------------------------------------------------
	argStr="./saveUser.php?action="+a;
	//alert(argStr);
	for(k=0;k<n;k++){
		//alert(argStr+"here");
		v[k]=document.getElementById(fList[k]).value;
		//alert(v[k]+"here");
		if(fList[k]!="id" && v[k].length<=0){
			document.getElementById(fList[k]).style.backgroundColor="#fcc";
			document.getElementById(fList[k]).focus();
			document.getElementById('submit').value="submit";
			document.getElementById('submit').disabled=false;
			return;
		} 
		else if(fList[k]!="id" && v[k].length>0){
			document.getElementById(fList[k]).style.backgroundColor="white";
		}
		if(!(exList.includes(fList[k]))){
			v2=document.getElementById(fList[k]+"_msg").innerHTML;
			if ( v2 != " " && v2 != ""){
				document.getElementById(fList[k]).style.backgroundColor="#fcc";
				document.getElementById(fList[k]).focus();
				document.getElementById('submit').value="submit";
				document.getElementById('submit').disabled=false;
				return;
			}
		}
		argStr+="&"+fList[k]+"="+encodeURIComponent(v[k]);
		//alert(argStr);
	}
	//alert(argStr);
	//------------------------------------------------------
	//if(v[fList.indexOf('passwd')].localeCompare(v[fList.indexOf('c_passwd')])!=0){
	if( a!="edit"){

	if( a!="activate"){
	p=document.getElementById('passwd').value;
	cp=document.getElementById('c_passwd').value;
	if(p.length<8){
		document.getElementById('msg').innerHTML="Too small Password";
		document.getElementById('passwd').style.backgroundColor="#fcc";
		document.getElementById('passwd').focus();
		document.getElementById('submit').value="submit";
		document.getElementById('submit').disabled=false;
		return;
	}
	else if(p!=cp){
		document.getElementById('msg').innerHTML="Passwords Mismatch";
		document.getElementById('passwd').style.backgroundColor="#fcc";
		document.getElementById('passwd').focus();
		document.getElementById('submit').value="submit";
		document.getElementById('submit').disabled=false;
		return;
	}
	else {
		var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
		if(!(p.match(passw)))
		{ 
		document.getElementById('msg').innerHTML="[Password should be of minimum 8 characters which contain at least one numeric digit, one uppercase and one lowercase letter]";
		document.getElementById('passwd').style.backgroundColor="#fcc";
		document.getElementById('passwd').focus();
		document.getElementById('submit').value="submit";
		document.getElementById('submit').disabled=false;
		return;
		}
		
	}
	}
	}
	//------------------------------------------------------
	//alert(argStr);
	//------------------------------------------------------
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
				//document.getElementById('exit').style.display="block";
				//document.getElementById('activate').style.display="block";
				divStr="<div id=\"signupdiv\" class=\"testbox w3-display-container\">";
				divStr+="<fieldset class='w3-center w3-xlarge ' style=\"padding:5px;background-color:#fff;\">";
				divStr+="<br><br><div> User Account Updated </div><i class='fa fa-check w3-text-green' aria-hidden='true'></i><br><br></fieldset>";
				divStr+="<div id='mailmessage' class='w3-bar w3-large w3-center  w3-animate-opacity'>"
				divStr+="<br><br> <b>"+s[0].retMsg+"</b> <br><br><br>";	//[fList.indexOf('username')]sset
				//divStr+="<p class='w3-bar-item w3-large w3-center' style=\"padding:5px;\">";
				//divStr+="Your Activation Key Mailed to "+s[0].retValue+"</b>";
				//divStr+="</p><br><br>";
				//divStr+="Please Use the Activation key to Activate your account<br><br> Or" 
				//divStr+="To activate your Account Please contact RExCS Admin: Ph:9000841246";
				divStr+="<input id=\"close\" onclick=\"window.location.reload();\"  value=\"Close\" class=\"w3-center w3-button w3-blue w3-text-white w3-hover-light-blue\">";
				divStr+="<br><br>";
				divStr+="</div>";
				divStr+="</div>"
				
				document.getElementById('popup').innerHTML=divStr;
				sendKey(s[0].retValue, s[0].retMsg);
				
			}
			else if(s[0].retCode==12){
				//alert(s[0].retCode);
				document.getElementById('msg').innerHTML=s[0].retMsg;
				document.getElementById('exit').style.display="block";
				divStr="<br><div id=\"signupdiv\" class=\"testbox w3-display-container\">";
				divStr+="<div class='w3-bar w3-border-bottom w3-border-brown w3-large' width='100%'>";
				divStr+="<div class='w3-bar-item ' style='text-transform:uppercase;color:#18303c;text-transform:bold;font-family: 'Trebuchet MS';'>";
				divStr+="Activate  User";
				divStr+="</div>";
				divStr+="</div><br>";
				divStr+="<div class='w3-bar w3-large w3-center w3-adding' width='100%'>";
				divStr+="<br><br>";	//[fList.indexOf('username')]
				divStr+="<p class='w3-bar-item w3-large w3-center' style=\"padding:5px;\">";
				divStr+="<b class='w3-text-green'  >Your Account is Activated </b>";
				divStr+="<br><br>";
				divStr+="You may Login with the email id as username <br><br> and with the password created";
				divStr+="</p><br><br>";
				divStr+="</div>";
				divStr+="</div>";
				//alert("here");
				document.getElementById('signupdiv').innerHTML=divStr;
				
			}
			else{
				document.getElementById('msg').innerHTML="Error#"+s[0].retCode+" : "+s[0].retMsg;
				document.getElementById('msg').style.backgroundColor="#f88";
				document.getElementById('msg').style.color="#ffc";
				document.getElementById('submit').value="submit";
				document.getElementById('submit').disabled=false;
			}
		}
	}
	xmlhttp.open("GET",argStr,true);
	xmlhttp.send();
}


function cleanStr(str){
	s=str.replace(/[\W_]+/g,"");
	return s;
	
}

function checkPswd(){
	p=document.getElementById('passwd').value;
	cp=document.getElementById('c_passwd').value;
	if(cp.length>p.length && p.localeCompare(cp)!=0){
		document.getElementById('msg').innerHTML="Passwords Mismatch";
		document.getElementById('c_passwd').style.backgroundColor="fcc";
		//document.getElementById('c_passwd').focus();
	}
	else{
		document.getElementById('c_passwd').style.backgroundColor="ffc";
	}
	return;
}

function checkBlank(i,v){
	if(v==' '){
		document.getElementById(i).value='';
		//document.getElementById(i).style.backgroundColor='#fdd';
		document.getElementById('msg').innerHTML="Blank Not Allowed.";
	}
	return;
}

function containsSpecialChars(str) {
  const specialChars =
    /[`!@#$%^&*()+\-=\[\]{};':"\\|,.<>?~]/;
  return specialChars.test(str);
}

function scanDb(f){
	var xmlhttp;
	if(f==""){
		return;
	}
	else{
		var v=document.getElementById(f).value;
	}
	var fList=new Array("id")
	var exList=new Array("id","email","passwd","c_passwd","cur_passwd")
	if(!(fList.includes(f)) && v==""){
		document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Value Cannot Be Empty.</b>";
		return;
	}
	if (!(exList.includes(f)) && containsSpecialChars(v)) {
	  document.getElementById(f+'_msg').innerHTML="<b class='w3-text-red'>* Some special Characters in this text is not allowed </b>";
		return;
	}
	//-------------------------------------
	
		var a='match';
	
	//-------------------------------------
	
		argStr="./scanUserList.php?action="+a+"&f="+f+"&"+f+"="+v;
	
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
