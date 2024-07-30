
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
	var argStr="./userAdd.html?action="+page;
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