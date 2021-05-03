<?php
    require_once '../providers/db_conn.php';

    function deleteUser($id){
        $query="Begin DeleteUser(:userId); End;";
        $stmt=makePlsqlStatement($query);
        oci_bind_by_name($stmt, ':userId', $id, 500);
        oci_execute($stmt);
        oci_free_statement($stmt);
    }
?>