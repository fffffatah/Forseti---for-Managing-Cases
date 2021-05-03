<?php
    include 'lawyer_header.php';
    require_once '../controllers/review_controller.php';
    $avgRating=0;
    $reviews=getReviewsForReviewee($_COOKIE["id"]);
    foreach($reviews as $review){
        $avgRating+=(int)$review["RATING"];
    }
    $avgRating=$avgRating/count($reviews);
?>
<center>
    <table>
        <tr>
        <td align="center" style="padding-top:100px;">
            <div class="card border-info mb3" style="height:600px;width:1500px;">
                <div class="card-header">All Meetings : Average Rating <?php echo $avgRating;?></div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Review</th>
                                <th scope="col">Rating</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($reviews as $review){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$review["REVIEW"]."</td>";
                                    echo "<td>".$review["RATING"]."</td>";
                                    echo "</tr>";
                                    $sr++;
                                }
                            ?>
                        </table>
                    </div>
                    </div>
                <div class="card-footer"></div>
            </div>
        </td>
        </tr>
    </table>
</center>
<?php
    include 'lawyer_footer.php';
?>