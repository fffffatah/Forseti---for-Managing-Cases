<?php
    $uname=getenv('MYSQLCONNSTR_dbUser');
    $server=getenv('MYSQLCONNSTR_dbHost');
    $pass=getenv('MYSQLCONNSTR_dbPass');

    function doNoQuery($query){
        global $uname, $server, $pass;
        $conn=oci_connect($uname, $pass, $server);
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
        global $uname, $server, $pass;
        $conn=oci_connect($uname, $pass, $server);
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