<?php
    require_once '../providers/db_conn.php';

    function getReviewsForReviewee($reviewee_id){
        $query="SELECT * FROM reviews WHERE reviewee_id=$reviewee_id";
        return doQuery($query);
    }
?>
