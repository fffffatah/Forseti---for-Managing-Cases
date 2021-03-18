function getElement(id){
    return document.getElementById(id);
}
function addCaseValidation(){
    refreshCase();
    var hasError=false;
    var case_title=getElement("case_title");
    var err_case_title=getElement("err_case_title");
    var case_description=getElement("case_description");
    var err_case_description=getElement("err_case_description");
    var complainant_nid=getElement("complainant_nid");
    var err_complainant_nid=getElement("err_complainant_nid");
    var att_document=getElement("document");
    var err_document=getElement("err_document");
    var hearing_date=getElement("hearing_date");
    var err_hearing_date=getElement("err_hearing_date");
    var case_status=getElement("case_status");
    var err_case_status=getElement("err_case_status");
    var client_id=getElement("client_id");
    var err_client_id=getElement("err_client_id");
    if(case_title.value==""){
        hasError=true;
        err_case_title.innerHTML="* Title Required.";
        case_title.focus();
        case_title.style.border="2px solid red";
    }
    if(case_description.value==""){
        hasError=true;
        err_case_description.innerHTML="* Description Required.";
        case_description.focus();
        case_description.style.border="2px solid red";
    }
    if(complainant_nid.value==""){
        hasError=true;
        err_complainant_nid.innerHTML="* NID Required.";
        complainant_nid.focus();
        complainant_nid.style.border="2px solid red";
    }
    if(lawyer_nid.value==""){
        hasError=true;
        err_lawyer_nid.innerHTML="* NID Required.";
        lawyer_nid.focus();
        lawyer_nid.style.border="2px solid red";
    }
    if(att_document.value==""){
        hasError=true;
        err_document.innerHTML="* Document Required.";
        att_document.focus();
        att_document.style.border="2px solid red";
    }
    if(hearing_date.value==""){
        hasError=true;
        err_hearing_date.innerHTML="* Hearing Date Required.";
        hearing_date.focus();
        hearing_date.style.border="2px solid red";
    }
    if(case_status.value==""){
        hasError=true;
        err_case_status.innerHTML="* Case Status Required.";
        case_status.focus();
        case_status.style.border="2px solid red";
    }
    if(client_id.value==""){
        hasError=true;
        err_client_id.innerHTML="* Client Required.";
        client_id.focus();
        client_id.style.border="2px solid red";
    }
    return !hasError;
}
function refreshCase(){
    var case_title=getElement("case_title");
    case_title.style.border="2px solid black";
    var err_case_title=getElement("err_case_title");
    err_case_title.innerHTML="";
    var case_description=getElement("case_description");
    case_description.style.border="2px solid black";
    var err_case_description=getElement("err_case_description");
    err_case_description.innerHTML="";
    var complainant_nid=getElement("complainant_nid");
    complainant_nid.style.border="2px solid black";
    var err_complainant_nid=getElement("err_complainant_nid");
    err_complainant_nid.innerHTML="";
    var lawyer_nid=getElement("lawyer_nid");
    lawyer_nid.style.border="2px solid black";
    var err_lawyer_nid=getElement("err_lawyer_nid");
    err_lawyer_nid.innerHTML="";
    var att_document=getElement("document");
    att_document.style.border="2px solid black";
    var err_document=getElement("err_document");
    err_document.innerHTML="";
    var hearing_date=getElement("hearing_date");
    hearing_date.style.border="2px solid black";
    var err_hearing_date=getElement("err_hearing_date");
    err_hearing_date.innerHTML="";
    var case_status=getElement("case_status");
    case_status.style.border="2px solid black";
    var err_case_status=getElement("err_case_status");
    err_case_status.innerHTML="";
    var client_id=getElement("client_id");
    client_id.style.border="2px solid black";
    var err_client_id=getElement("err_client_id");
    err_client_id.innerHTML="";
}
