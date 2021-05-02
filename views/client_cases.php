<?php
    include 'client_header.php';
    require_once '../controllers/case_controller.php';
    $casesFiled=getFiledCases($_COOKIE["id"]);
    $casesFiledAgainstMe=getFiledAgainstMeCases($_COOKIE["id"]);
?>
<center>
    <table>
        <tr>
            <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:750px;">
                <div class="card-header">Filed Cases</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Date Added/Updated</th>
                                <th scope="col">Title</th>
                                <th scope="col">Hearing Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($casesFiled as $case){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$case["DATE_ADDED"]."</td>";
                                    echo "<td>".$case["CASE_TITLE"]."</td>";
                                    echo "<td>".$case["HEARING_DATE"]."</td>";
                                    echo "<td>".$case["CASE_STATUS"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"lawyer_view_edit_case.php?id=".$case["ID"]."\">View</a></td>";
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
            <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:750px;">
                <div class="card-header">Cases Filed Against Me</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Date Added/Updated</th>
                                <th scope="col">Title</th>
                                <th scope="col">Hearing Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($casesFiledAgainstMe as $case){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$case["DATE_ADDED"]."</td>";
                                    echo "<td>".$case["CASE_TITLE"]."</td>";
                                    echo "<td>".$case["HEARING_DATE"]."</td>";
                                    echo "<td>".$case["CASE_STATUS"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"client_view_case.php?id=".$case["ID"]."\">View</a></td>";
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
    include 'client_footer.php';
?>