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
        //todo with plsql
    }
    function getReviewsForReviewee($reviewee_id){
        $query="SELECT * FROM reviews WHERE reviewee_id=$reviewee_id";
        return doQuery($query);
    }
?>
