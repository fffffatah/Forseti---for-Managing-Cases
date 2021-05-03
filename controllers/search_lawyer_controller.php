<?php
    require_once '../providers/db_conn.php';

    if(isset($_GET["search_now"])){
        searchLawyer($_GET["state"], $_GET["rating"], $_GET["keyword"]);
    }

    function searchLawyer($state, $rating, $keyword){
        echo "<tr><td>bruh</td></tr>";
    }
?>