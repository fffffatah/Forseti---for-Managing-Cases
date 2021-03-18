<?php
    require_once '../providers/db_conn.php';
    //ADD CASE VALIDATIONS
    $hasError=false;
    $case_title="";
    $err_case_title="";
    $case_description="";
    $err_case_description="";
    $complainant_nid="";
    $err_complainant_nid="";
    $lawyer_nid="";
    $err_lawyer_nid="";
    $document="";
    $err_document="";
    $date_added="";
    $hearing_date="";
    $err_hearing_date="";
    $case_status="";
    $err_case_status="";
    $client_id="";
    $err_client_id="";
    $complainant_id="";
    $lawyer_id="";
    //ADD CASE
    if(isset($_POST["add_case_button"])){
        //CASE TITLE VALIDATION
        if(empty($_POST["case_title"])){
            $err_case_title="* Title Required.";
            $hasError=true;
        }
        else{
            $case_title=htmlspecialchars($_POST["case_title"]);
        }
        //COMPLAINANT NID VALIDATION
        if(empty($_POST["complainant_nid"])){
            $err_complainant_nid="* NID Required.";
            $hasError=true;
        }
        else{
            $complainant_nid=htmlspecialchars($_POST["complainant_nid"]);
            $complainant=getComplainantByNid($complainant_nid);
            if(count($complainant)>0){
                $complainant_id=$complainant[0]["ID"];
            }
            else{
                $err_complainant_nid="* NID Invalid.";
                $hasError=true;
            }
        }
        //CASE DESCRIPTION VALIDATION
        if(empty($_POST["case_description"])){
            $err_case_description="* Description Required.";
            $hasError=true;
        }
        else{
            $case_description=htmlspecialchars($_POST["case_description"]);
        }
        //CLIENT ID VALIDATIONS
        if(!isset($_POST["client_id"])){
            $err_client_id="* Client Required.";
            $hasError=true;
        }
        else{
            $client_id=$_POST["client_id"];
        }
        //HEARING DATE VALIDATIONS
        if(!isset($_POST["hearing_date"])){
            $err_hearing_date="* Hearing Date Required.";
            $hasError=true;
        }
        else{
            $hearing_date=$_POST["hearing_date"];
        }
        //CASE STATUS VALIDATIONS
        if(!isset($_POST["case_status"])){
            $err_case_status="* Case Status Required.";
            $hasError=true;
        }
        else{
            $case_status=$_POST["case_status"];
        }
        //DOCUMENT VALIDATIONS
        if(empty($_FILES["document"]["name"])){
            $err_document="* Document Required.";
            $hasError=true;
        }
        else{
            $fileType=strtolower(pathinfo(basename($_FILES["document"]["name"]),PATHINFO_EXTENSION));
            $document="../storage/docs/".uniqid().".$fileType";
            move_uploaded_file($_FILES["document"]["tmp_name"],$document);
        }
        //ADD CASE
        if(!$hasError){
            $date_added=date("d/m/Y");
            $lawyer_id=$_COOKIE["id"];
            addCase($case_title, $case_description, $date_added, $hearing_date, $case_status, $document, $client_id, $complainant_id, $lawyer_id);
        }
    }

    //UPDATE CASE
    if(isset($_POST["update_case_button"])){
        //CASE TITLE VALIDATION
        if(empty($_POST["case_title"])){
            $err_case_title="* Title Required.";
            $hasError=true;
        }
        else{
            $case_title=htmlspecialchars($_POST["case_title"]);
        }
        //COMPLAINANT NID VALIDATION
        if(empty($_POST["complainant_nid"])){
            $err_complainant_nid="* NID Required.";
            $hasError=true;
        }
        else{
            $complainant_nid=htmlspecialchars($_POST["complainant_nid"]);
            $complainant=getComplainantByNid($complainant_nid);
            if(count($complainant)>0){
                $complainant_id=$complainant[0]["id"];
            }
            else{
                $err_complainant_nid="* NID Invalid.";
                $hasError=true;
            }
        }
        //CASE DESCRIPTION VALIDATION
        if(empty($_POST["case_description"])){
            $err_case_description="* Description Required.";
            $hasError=true;
        }
        else{
            $case_description=htmlspecialchars($_POST["case_description"]);
        }
        //CLIENT ID VALIDATIONS
        if(!isset($_POST["client_id"])){
            $err_client_id="* Client Required.";
            $hasError=true;
        }
        else{
            $client_id=$_POST["client_id"];
        }
        //HEARING DATE VALIDATIONS
        if(!isset($_POST["hearing_date"])){
            $err_hearing_date="* Hearing Date Required.";
            $hasError=true;
        }
        else{
            $hearing_date=$_POST["hearing_date"];
        }
        //CASE STATUS VALIDATIONS
        if(!isset($_POST["case_status"])){
            $err_case_status="* Case Status Required.";
            $hasError=true;
        }
        else{
            $case_status=$_POST["case_status"];
        }
        //DOCUMENT VALIDATIONS
        if(empty($_FILES["document"]["name"])){
            $err_document="* Document Required.";
            $hasError=true;
        }
        else{
            $fileType=strtolower(pathinfo(basename($_FILES["document"]["name"]),PATHINFO_EXTENSION));
            $document="../storage/docs/".uniqid().".$fileType";
            move_uploaded_file($_FILES["document"]["tmp_name"],$document);
        }
        //UPDATE CASE
        if(!$hasError){
            $date_added=date("d/m/Y");
            $lawyer_id=$_COOKIE["id"];
            updateCase($case_title, $case_description, $date_added, $hearing_date, $case_status, $document, $client_id, $complainant_id, $judge_id, $lawyer_id, $_GET["id"]);
        }

    }

    //CASES DATA ACCESS
    function addCase($case_title, $case_description, $date_added, $hearing_date, $case_status, $document, $client_id, $complainant_id, $lawyer_id){
        $query="INSERT INTO cases(id,case_title, case_description, date_added, hearing_date, case_status, document, client_id, complainant_id, lawyer_id) VALUES(case_id_seq.nextval,'$case_title', '$case_description', '$date_added', '$hearing_date', '$case_status', '$document', $client_id, $complainant_id, $lawyer_id)";
        doNoQuery($query);
    }
    function updateCase($case_title, $case_description, $date_added, $hearing_date, $case_status, $document, $client_id, $complainant_id, $lawyer_id, $id){
        $query="UPDATE cases SET case_title='$case_title', case_description='$case_description', date_added='$date_added', hearing_date='$hearing_date', case_status='$case_status', document='$document', client_id=$client_id, complainant_id=$complainant_id, lawyer_id=$lawyer_id WHERE id=$id";
        doNoQuery($query);
    }
    function getCaseById($id){
        $query="SELECT * FROM cases WHERE id=".$id;
        return doQuery($query);
    }
    function getCasesForLaywer($id){
        $query="SELECT * FROM cases WHERE lawyer_id=".$id;
        return doQuery($query);
    }
    function getCasesForClient($id){
        $query="SELECT * FROM cases WHERE client_id=".$id;
        return doQuery($query);
    }
    function deleteCase($id){
        $query="DELETE FROM cases WHERE id=".$id;
        doNoQuery($query);
    }
    function getComplainantByNid($complainant_nid){
        $query="SELECT * FROM users WHERE nid='$complainant_nid' AND type='client'";
        return doQuery($query);
    }
?>
