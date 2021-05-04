function getElement(id){
    return document.getElementById(id);
}
function searchClientforAdmin(){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
   	    if(xhttp.readyState ==4 && xhttp.status==200){
            document.getElementById("search_clients_for_admin").innerHTML=xhttp.responseText;
	    }
    }
    xhttp.open("GET","../controllers/search_client_controller.php?state="+getElement("search_client_by_state").value+"&balance="+getElement("search_client_by_balance").value+"&keyword="+getElement("search_box").value+"&admin_search=true",true);
    xhttp.send();
}