<?php
    function makePlsqlStatement($query){
        $conn=oci_connect(getenv("ODB_USER",true), getenv("ODB_PASS",true), getenv("ODB_STRING",true));
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }       
        return oci_parse($conn, $query);
    }

    function onlyConn(){
        $conn=oci_connect(getenv("ODB_USER",true), getenv("ODB_PASS",true), getenv("ODB_STRING",true));
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        return $conn;
    }

    function doNoQuery($query){
        $conn=oci_connect(getenv("ODB_USER",true), getenv("ODB_PASS",true), getenv("ODB_STRING",true));
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }       
        $stid=oci_parse($conn, $query);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conn);
    }

    function doQuery($query){
        $conn=oci_connect(getenv("ODB_USER",true), getenv("ODB_PASS",true), getenv("ODB_STRING",true));
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $stid=oci_parse($conn, $query);
        oci_execute($stid);
        $data=array();
        while(($row = oci_fetch_assoc($stid)) != false){
            $data[]=$row;
        }
        oci_free_statement($stid);
        oci_close($conn);
        return $data;
    }
?>