<?php
    include 'lawyer_header.php';
    require_once '../controllers/report_controller.php';
    require_once '../controllers/review_controller.php';
    $reports=getReports($_COOKIE["id"]);
    $reviews=getReviewsForReviewee($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td align="center" style="padding-top:100px;">
            <form action="" method="POST">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Reports</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Date Generated</th>
                                <th scope="col">Download</th>
                                <th scope="col">Download</th>
                                <th scope="col">Download</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($reports as $report){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$report["DATE_GENERATED"]."</td>";
                                    echo "<td><a class=\"btn btn-primary\" href=\"".$report["MONTHLY"]."\" download>Monthly</a></td>";
                                    echo "<td><a class=\"btn btn-primary\" href=\"".$report["WEEKLY"]."\" download>Weekly</a></td>";
                                    echo "<td><a class=\"btn btn-primary\" href=\"".$report["TRANSACTIONS"]."\" download>Transactions</a></td>";
                                    echo "</tr>";
                                    $sr++;
                                }
                            ?>
                        </table>
                    </div>
                    </div>
                <div class="card-footer">
                    <input class="btn btn-success" type="submit" name="generate_report_button" value="Generate">
                </td>
                </div>
            </div>
            </form>
        </td>
        <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:850px;">
                <div class="card-header">All Reviews</div>
                    <div class="card-body">
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