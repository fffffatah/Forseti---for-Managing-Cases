function getElement(id){
    return document.getElementById(id);
}
function searchValidation(){
    refreshSearch();
    var hasError=false;
    var search_box=getElement("search_box");
    if(search_box.value==""){
        hasError=true;
        search_box.focus();
        search_box.style.border="2px solid red";
    }
    return !hasError;
}
function refreshSearch(){
    var search_box=getElement("search_box");
    search_box.style.border="2px solid black";
}
function searchLawyer(){
    if(searchValidation()){
        var xhttp=new XMLHttpRequest();
	    xhttp.onreadystatechange=function()
	    {
    	    if(xhttp.readyState ==4 && xhttp.status==200){
                document.getElementById("search_lawyers_for_client").innerHTML=xhttp.responseText;
		    }
        }
        xhttp.open("GET","../controllers/search_lawyer_controller.php?state="+getElement("search_lawyer_by_state").value+"&rating="+getElement("search_lawyer_by_rating").value+"&keyword="+getElement("search_box").value+"&search_now=true",true);
	    xhttp.send();
    }
}