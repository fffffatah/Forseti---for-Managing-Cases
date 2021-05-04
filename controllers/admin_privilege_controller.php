<?php
    require_once '../providers/db_conn.php';

    if(isset($_GET["lockUserUpdate"])){
        lockUserUpdate();
    }
    if(isset($_GET["unlockUserUpdate"])){
        unlockUserUpdate();
    }

    if(isset($_GET["lockPayment"])){
        lockPayment();
    }
    if(isset($_GET["unlockPayment"])){
        unlockPayment();
    }

    if(isset($_GET["lockCase"])){
        lockCase();
    }
    if(isset($_GET["unlockCase"])){
        unlockCase();
    }

    if(isset($_GET["lockClient"])){
        lockClient();
    }
    if(isset($_GET["unlockClient"])){
        unlockClient();
    }


    function lockUserUpdate(){
        $query="ALTER TRIGGER RestrictedProfileUpdate ENABLE";
        doNoQuery($query);
        echo "Locked";
    }
    function unlockUserUpdate(){
        $query="ALTER TRIGGER RestrictedProfileUpdate DISABLE";
        doNoQuery($query);
        echo "Unlocked";
    }

    function lockPayment(){
        $query="ALTER TRIGGER RestrictedPayment ENABLE";
        doNoQuery($query);
        echo "Locked";
    }
    function unlockPayment(){
        $query="ALTER TRIGGER RestrictedPayment DISABLE";
        doNoQuery($query);
        echo "Unlocked";
    }

    function lockCase(){
        $query="ALTER TRIGGER RestrictedCase ENABLE";
        doNoQuery($query);
        echo "Locked";
    }
    function unlockCase(){
        $query="ALTER TRIGGER RestrictedCase DISABLE";
        doNoQuery($query);
        echo "Unlocked";
    }

    function lockClient(){
        $query="ALTER TRIGGER RestrictedClient ENABLE";
        doNoQuery($query);
        echo "Locked";
    }
    function unlockClient(){
        $query="ALTER TRIGGER RestrictedClient DISABLE";
        doNoQuery($query);
        echo "Unlocked";
    }
?>