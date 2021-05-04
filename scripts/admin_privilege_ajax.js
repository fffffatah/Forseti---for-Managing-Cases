function getElement(id){
    return document.getElementById(id);
}

function lockUserUpdate(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockUserUpdate").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?lockUserUpdate=true",true);
    xhttp.send();
}
function unlockUserUpdate(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockUserUpdate").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?unlockUserUpdate=true",true);
    xhttp.send();
}

function lockPayment(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockPayment").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?lockPayment=true",true);
    xhttp.send();
}
function unlockPayment(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockPayment").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?unlockPayment=true",true);
    xhttp.send();
}

function lockCase(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockCase").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?lockCase=true",true);
    xhttp.send();
}
function unlockCase(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockCase").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?unlockCase=true",true);
    xhttp.send();
}

function lockClient(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockClient").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?lockClient=true",true);
    xhttp.send();
}
function unlockClient(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("lockClient").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/admin_privilege_controller.php?unlockClient=true",true);
    xhttp.send();
}