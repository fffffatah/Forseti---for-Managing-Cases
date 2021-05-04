<?php
    require_once '../providers/db_conn.php';

    if(isset($_GET["client_search"])){
        searchLawyer($_GET["state"], $_GET["rating"], $_GET["keyword"]);
    }

    if(isset($_GET["admin_search"])){
        searchLawyerforAdmin($_GET["state"], $_GET["rating"], $_GET["keyword"]);
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
    function searchLawyerforAdmin($state, $rating, $keyword){
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
        echo "<th>View/Edit</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        $sr=1;
        foreach($lawyers as $lawyer){
            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$lawyer["FULLNAME"]."</td>";
            echo "<td>".$lawyer["NID"]."</td>";
            echo "<td>".$lawyer["PHONE"]."</td>";
            echo "<td><a class=\"btn btn-outline-primary\" href=\"admin_view_lawyer.php?id=".$lawyer["ID"]."\">View/Edit</a></td>";
            echo "<td><a class=\"btn btn-outline-danger\" href=\"delete_account.php?id=".$lawyer["ID"]."\"target=\"_blank\" >Delete</a></td>";
            echo "</tr>";
            $sr++;
        }
    }
?>