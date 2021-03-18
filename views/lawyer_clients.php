<?php
    include 'lawyer_header.php';
    require_once '../controllers/case_controller.php';
    require_once '../controllers/common_controller.php';
    require_once '../controllers/client_controller.php';
    $clients=getClients($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td align="center" style="padding-top:100px;">
            <form action="" method="POST" onsubmit="return addClientValidation()">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Add Client</div>
                    <div class="card-body">
                        <input class="form-control" type="number" name="client_nid" id="client_nid" placeholder="Client NID" value="<?php echo $client_nid; ?>">
                        <span id="err_client_nid" style="color:red;"><?php echo $err_client_nid;?></span>
                    </div>
                    <div class="card-footer"><input class="btn btn-success" type="submit" name="add_client_button" value="Add"></div>
            </div>
            </form>
        </td>
        <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:850px;">
                <div class="card-header">All Clients</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">NID</th>
                                <th scope="col">View</th>
                                <th scope="col">Remove</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($clients as $client){
                                    $my_client=getUserById($client["CLIENT_ID"]);
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$my_client[0]["FULLNAME"]."</td>";
                                    echo "<td>".$my_client[0]["PHONE"]."</td>";
                                    echo "<td>".$my_client[0]["NID"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"lawyer_view_client.php?id=".$my_client[0]["ID"]."\">View</a></td>";
                                    echo "<td><a class=\"btn btn-outline-danger\" href=\"lawyer_remove_client.php?id=".$my_client[0]["ID"]."\"target=\"_blank\" >Remove</a></td>";
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
<script src="../scripts/client_validation.js"></script>
<?php
    include 'lawyer_footer.php';
?>