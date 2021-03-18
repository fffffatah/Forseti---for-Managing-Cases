<?php
    require_once '../providers/db_conn.php';
    $hasError=false;
    $client_nid="";
    $err_client_nid="";
    $client_id="";
    $lawyer_id="";
    $judge_id="";
    if(isset($_POST["add_client_button"])){
        if(empty($_POST["client_nid"])){
            $err_client_nid="* NID Required.";
            $hasError=true;
        }
        else{
            $client_nid=htmlspecialchars($_POST["client_nid"]);
            $client=getClientByNid($client_nid);
            if(count($client)>0){
                $client_id=$client[0]["ID"];
                $client_exists=getClientById($client_id,$_COOKIE["id"]);
                if(count($client_exists)>0){
                    $err_client_nid="* Client Already Exists.";
                    $hasError=true;
                }
            }
            else{
                $err_client_nid="* NID Invalid.";
                $hasError=true;
            }
        }
        if(!$hasError){
            $lawyer_id=$_COOKIE["id"];
            addClient($client_id, $lawyer_id);
        }
    }
    //CLIENT DATA ACCESS
    function addClient($client_id, $lawyer_id){
        $query="INSERT INTO clients(client_id, lawyer_id) VALUES ($client_id,$lawyer_id)";
        doNoQuery($query);
    }

    function getClients($id){
        $query="SELECT * FROM clients WHERE lawyer_id=".$id;
        return doQuery($query);
    }

    function getClientById($client_id, $lawyer_id){
        $query="SELECT * FROM clients WHERE client_id=$client_id AND judge_id=$judge_id";
        return doQuery($query);
    }

    function deleteClient($id){
        $query="DELETE FROM clients WHERE client_id=$id";
        doNoQuery($query);
    }
    function getClientByNid($client_nid){
        $query="SELECT * FROM users WHERE nid='$client_nid' AND type='client'";
        return doQuery($query);
    }
?>
