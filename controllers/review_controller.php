<?php
    require_once '../providers/db_conn.php';
    $review="";
    $err_review="";
    $rating="";
    $hasError=false;
    if(isset($_POST["submit_review"])){
        if(empty($_POST["review"])){
			$err_review="* Review Required";
			$hasError =true;
		}
		else{
			$review = htmlspecialchars($_POST["review"]);
		}
        $rating=$_POST["rating"];
        if(!$hasError){
            addReview($review, $rating, $_COOKIE["id"], $_GET["id"]);
        }
    }
    function addReview($review, $rating, $reviewer_id, $reviewee_id){
        $query="Begin AddReview(:review, :rating, :reviewerid, :revieweeid); End;";
        $stmt=makePlsqlStatement($query);
        oci_bind_by_name($stmt, ':review', $review, 500);
        oci_bind_by_name($stmt, ':rating', $rating, 500);
        oci_bind_by_name($stmt, ':reviewerid', $reviewer_id, 500);
        oci_bind_by_name($stmt, ':revieweeid', $reviewee_id, 500);
        if (false===@oci_execute($stmt)) {
            echo "<script>alert('Only One Review Can be Submitted Per Lawyer!')</script>";
        }
        oci_free_statement($stmt);
    }
    function getReviewsForReviewee($reviewee_id){
        $query="SELECT * FROM reviews WHERE reviewee_id=$reviewee_id";
        return doQuery($query);
    }
?>
