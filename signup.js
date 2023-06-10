function checkUserId(id,xId){
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
			document.getElementById(xId).innerHTML="";
			document.getElementById(xId).style.backgroundColor="";
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
	document.getElementById('delete').style.display='none';
	document.getElementById('submit').style.display='none';
	document.getElementById('close').style.display='none';
	
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
	//alert ("here");
	var fList=new Array("id","cur_passwd","passwd","c_passwd");
}
else if (a=="reset" || a=="delete"){
	//alert ("here");
	var fList=new Array("id");
}
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
			return;
		}
		argStr+="&"+fList[k]+"="+encodeURIComponent(v[k]);
	}
	//alert(argStr);
	//------------------------------------------------------
	//if(v[fList.indexOf('passwd')].localeCompare(v[fList.indexOf('c_passwd')])!=0){
	if( a!="edit" && a!="delete"){
	p=document.getElementById('passwd').value;
	cp=document.getElementById('c_passwd').value;
	if(p.length<4){
		document.getElementById('msg').innerHTML="Too small Password";
		document.getElementById('passwd').focus();
		return;
	}
	else if(p!=cp && p!='' && p.length>4){
		document.getElementById('msg').innerHTML="Passwords Mismatch";
		document.getElementById('passwd').focus();
		return;
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
			alert(retTxt);
			s=JSON.parse(retTxt);
			if(s[0].retCode==11){
			if(s[0].retValue!=""){
				//alert(s[0].retCode);
				//document.getElementById('msg').innerHTML=s[0].retMsg;
				//document.getElementById('msg').style.backgroundColor="green";
				//document.getElementById('msg').style.color="#ffc";
				//document.getElementById('main').style.backgroundColor="#ddd";
				divStr="<br>";
				divStr+="<fieldset style=\"padding:5px;border:1px solid #aaa;color:#00d;\" class=\"w3-center\">";
				divStr+="<br><br>"+s[0].retMsg+"<br><br><br>";	//[fList.indexOf('username')]
				divStr+="<p style=\"padding:5px;border:1px solid #aaa;border-radius:3px;color:#c00;\">";
				divStr+="Your Activation Key: <b>"+s[0].retValue+"</b>";
				divStr+="</p><br><br>";
				divStr+="Please contact REXCS System Administrator.<br><br>";
				divStr+="IRISET: 9000841246<br><br>";
				divStr+="</fieldset><br><br>";
				} else {
				divStr="<br>";
				divStr+="<fieldset style=\"padding:5px;border:1px solid #aaa;color:#00d;\" class=\"w3-center\">";
				divStr+="<br><br>"+s[0].retMsg+"<br><br><br>";	//[fList.indexOf('username')]
				divStr+="</fieldset><br><br>";	
				}
				document.getElementById('mainForm').innerHTML=divStr;
				document.getElementById('exit').style.display="block";
				//document.getElementById('submit').value=s[0].retMsg;
				//document.getElementById('submit').value=s[0].retMsg;
				//document.getElementById('footerInstr').innerHTML="<br><br>";
				//alert("here");
				setTimeout(function (){
					opener.location.reload();
					window.close();
				},5000);
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


function cleanStr(str){
	s=str.replace(/[\W_]+/g,"");
	return s;
	//s=str.replace(/[^a-z0-9]|\s+|\r?\n|\r/gmi).join('');
	//s=str.split("/").join('');
	//s=s.replace("/-/g","");
	//s=s.replace("/./g","");
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
