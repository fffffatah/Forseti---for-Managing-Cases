<?php
    include 'lawyer_header.php';
    require_once '../controllers/case_controller.php';
    require_once '../controllers/common_controller.php';
    require_once '../controllers/client_controller.php';
    $cases=getCasesForLaywer($_COOKIE["id"]);
    $clients=getClients($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td align="center" style="padding-top:100px;">
            <form action="" method="POST"  enctype="multipart/form-data" onsubmit="return addCaseValidation()">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Add Case</div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>
                                <table>
                                    <tr>
                                        <td>
                                            <h7>Case Title:</h7>
                                            <input class="form-control" type="text" name="case_title" id="case_title" placeholder="Case Title" value="<?php echo $case_title;?>"><span id="err_case_title" style="color:red;"><?php echo $err_case_title;?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h7>Case Description:</h7>
                                            <textarea class="form-control" name="case_description" id="case_description" placeholder="Case Description" value="<?php echo $case_description;?>" cols="30" rows="4"></textarea><span id="err_case_description" style="color:red;"><?php echo $err_case_description;?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h7>Client:</h7>
                                            <div class="form-group">
                                                <select class="form-control" name="client_id" id="client_id">
                                                    <option value="" selected disabled>Client Name</option>
                                                    <?php
                                                        foreach($clients as $client){
                                                            $client_name=getUserById($client["CLIENT_ID"]);
                                                            echo "<option value=\"".$client_name[0]["ID"]."\">".$client_name[0]["FULLNAME"]."</option>";
                                                        }
                                                    ?>
                                                </select><span id="err_client_id" style="color:red;"><?php echo $err_client_id;?></span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                    <tr>
                                        <td>
                                            <h7>Hearing Date:</h7>
                                            <input class="form-control" type="date" name="hearing_date" id="hearing_date"><span id="err_hearing_date" style="color:red;"><?php echo $err_hearing_date;?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h7>Case Status:</h7>
                                            <div class="form-group">
                                                <select class="form-control" name="case_status" id="case_status">
                                                    <option value="" selected disabled>Case Status</option>
                                                    <option value="Running">Running</option>
                                                    <option value="Closed">Closed</option>
                                                    <option value="Won">Won</option>
                                                    <option value="Lost">Lost</option>
                                                </select><span id="err_case_status" style="color:red;"><?php echo $err_case_status;?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h7>Complainant NID:</h7>
                                            <input class="form-control" type="number" name="complainant_nid" id="complainant_nid" placeholder="Complainant NID" value="<?php echo $complainant_nid; ?>"><span id="err_complainant_nid" style="color:red;"><?php echo $err_complainant_nid;?></span>
                                        </td>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h7>Attach Document:</h7>
                                    <input class="form-control" type="file" name="document" id="document" accept="*/*"><span id="err_document" style="color:red;"><?php echo $err_document;?></span></td>
                                </td>
                            </tr>
                        </table>
                    </div>
                <div class="card-footer"><input class="btn btn-success" type="submit" name="add_case_button" id="add_case_button" value="Add"></div>
            </div>
            </form>
        </td>
        <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:850px;">
                <div class="card-header">All Cases</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Date Added/Updated</th>
                                <th scope="col">Title</th>
                                <th scope="col">Hearing Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">View/Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($cases as $case){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$case["DATE_ADDED"]."</td>";
                                    echo "<td>".$case["CASE_TITLE"]."</td>";
                                    echo "<td>".$case["HEARING_DATE"]."</td>";
                                    echo "<td>".$case["CASE_STATUS"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"lawyer_view_edit_case.php?id=".$case["ID"]."\">View/Edit</a></td>";
                                    echo "<td><a class=\"btn btn-outline-danger\" href=\"lawyer_delete_case.php?id=".$case["ID"]."\"target=\"_blank\" >Delete</a></td>";
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
<script src="../scripts/case_validation.js"></script>
<?php
    include 'lawyer_footer.php';
?>