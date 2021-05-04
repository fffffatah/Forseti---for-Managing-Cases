<?php
    require_once '../providers/db_conn.php';

    if(isset($_GET["search_now"])){
        searchLawyer($_GET["state"], $_GET["rating"], $_GET["keyword"]);
    }

    function searchLawyer($state, $rating, $keyword){
        $query="Begin SearchLawyer(:state, :rating, :keyword, :refcur); End;";
        $stmt=makePlsqlStatement($query);
        oci_bind_by_name($stmt, ':state', $state, 500);
        oci_bind_by_name($stmt, ':rating', $rating, 500);
        oci_bind_by_name($stmt, ':keyword', $keyword, 500);
        $refcur = oci_new_cursor(onlyConn());
        oci_bind_by_name($stmt, ':REFCUR', $refcur, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($refcur, OCI_DEFAULT);
        oci_fetch_all($refcur, $lawyers, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        echo "<tr>";
        echo "<th>#SR</th>";
        echo "<th>Lawyer Name</th>";
        echo "<th>NID</th>";
        echo "<th>Phone</th>";
        echo "</tr>";
        $sr=1;
        foreach($lawyers as $lawyer){
            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$lawyer["FULLNAME"]."</td>";
            echo "<td>".$lawyer["NID"]."</td>";
            echo "<td>".$lawyer["PHONE"]."</td>";
            echo "</tr>";
            $sr++;
        }
    }
?>