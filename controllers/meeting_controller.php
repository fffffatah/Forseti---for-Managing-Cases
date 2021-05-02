<?php
    require_once '../providers/db_conn.php';

    $hasError=false;
    $attandee_name="";
    $organizer_name="";
    $attandee_id="";
    $err_attandee_id="";
    $organizer_id="";
    $meeting_title="";
    $err_meeting_title="";
    $meeting_description="";
    $err_meeting_description="";
    $meeting_time="";
    $err_meeting_time="";
    if(isset($_POST["add_meeting_button"])){
        //MEETING TITLE VALIDATIONS
        if(empty($_POST["meeting_title"])){
            $err_meeting_title="* Title Required.";
            $hasError=true;
        }
        else{
            $meeting_title=htmlspecialchars($_POST["meeting_title"]);
        }
        //MEETING DESCRIPTION VALIDATIONS
        if(empty($_POST["meeting_description"])){
            $err_meeting_description="* Description Required.";
            $hasError=true;
        }
        else{
            $meeting_description=htmlspecialchars($_POST["meeting_description"]);
        }
        //MEETING DATE TIME VALIDATIONS
        if(!isset($_POST["meeting_time"])){
            $err_meeting_time="* Meeting Date Required.";
            $hasError=true;
        }
        else{
            $meeting_time=$_POST["meeting_time"];
        }
        //ATTANDEE ID VALIDATIONS
        if(!isset($_POST["attandee_id"])){
            $err_attandee_id="* Attandee Required.";
            $hasError=true;
        }
        else{
            $attandee_id=$_POST["attandee_id"];
            $attandee_name_temp=getOrganizerAttandeeName($attandee_id);
            if(count($attandee_name_temp)>0){
                $attandee_name=$attandee_name_temp[0]["FULLNAME"];
            }
            else{
                $err_attandee_id="* Attandee Does Not Exist";
                $hasError=true;
            }
        }
        //ORGANIZER ID VALIDATIONS
        $organizer_name_temp=getOrganizerAttandeeName($_COOKIE["id"]);
        if(count($organizer_name_temp)>0){
            $organizer_name=$organizer_name_temp[0]["FULLNAME"];
            $organizer_id=$_COOKIE["id"];
        }
        else{
            $hasError=true;
        }
        if(!$hasError){
            addMeeting($attandee_name, $organizer_name, $meeting_title, $meeting_description, $meeting_time, $attandee_id, $organizer_id);
        }
    }
    //MEETINGS DATA ACCESS
    function addMeeting($attandee_name, $organizer_name, $meeting_title, $meeting_description, $meeting_time, $attandee_id, $organizer_id){
        $query="INSERT INTO meetings(id, attandee_name, organizer_name, meeting_title, meeting_description, meeting_time, attandee_id, organizer_id) VALUES (meetings_id_seq.nextval, '$attandee_name', '$organizer_name', '$meeting_title', '$meeting_description', '$meeting_time', $attandee_id, $organizer_id)";
        doNoQuery($query);
    }
    function deleteMeeting($id){
        $query="DELETE FROM meetings WHERE id=$id";
        doNoQuery($query);
    }
    function getMeetingsForOrganizer($id){
        $query="SELECT * FROM meetings WHERE organizer_id=$id";
        return doQuery($query);
    }
    function getOrganizerAttandeeName($id){
        $query="SELECT * FROM users WHERE id=$id";
        return doQuery($query);
    }
    function getMeetingsForAttandee($id){
        $query="SELECT * FROM meetings WHERE attandee_id=$id";
        return doQuery($query);
    }
?>