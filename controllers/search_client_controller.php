<?php
    require_once '../providers/db_conn.php';

    if(isset($_GET["admin_search"])){
        searchClientforAdmin($_GET["state"], $_GET["balance"], $_GET["keyword"]);
    }

    function searchClientforAdmin($state, $balance, $keyword){
        $query="Begin SearchClient(:state, :balance, :keyword, :refcur); End;";
        $stmt=makePlsqlStatement($query);
        oci_bind_by_name($stmt, ':state', $state, 500);
        oci_bind_by_name($stmt, ':balance', $balance, 500);
        oci_bind_by_name($stmt, ':keyword', $keyword, 500);
        $refcur = oci_new_cursor(onlyConn());
        oci_bind_by_name($stmt, ':REFCUR', $refcur, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($refcur, OCI_DEFAULT);
        oci_fetch_all($refcur, $clients, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        echo "<tr>";
        echo "<th>#SR</th>";
        echo "<th>Client Name</th>";
        echo "<th>NID</th>";
        echo "<th>Phone</th>";
        echo "<th>View/Edit</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        $sr=1;
        foreach($clients as $client){
            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$client["FULLNAME"]."</td>";
            echo "<td>".$client["NID"]."</td>";
            echo "<td>".$client["PHONE"]."</td>";
            echo "<td><a class=\"btn btn-outline-primary\" href=\"admin_view_client.php?id=".$client["ID"]."\">View/Edit</a></td>";
            echo "<td><a class=\"btn btn-outline-danger\" href=\"delete_account.php?id=".$client["ID"]."\"target=\"_blank\" >Delete</a></td>";
            echo "</tr>";
            $sr++;
        }
    }
?>