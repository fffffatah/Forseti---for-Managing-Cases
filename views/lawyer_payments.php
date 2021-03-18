<?php
    include 'lawyer_header.php';
    require_once '../controllers/payment_controller.php';
    require_once '../controllers/client_controller.php';
    require_once '../controllers/common_controller.php';
    $clients=getClients($_COOKIE["id"]);
    $payments=getPaymentsForReceiver($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td align="center" style="padding-top:100px;">
            <form action="" method="POST" onsubmit="return addPaymentValidation()">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Add Payment for a Client</div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="padding-bottom:10px;">Due Amount: </td>
                                <td style="padding-bottom:10px;"><input class="form-control" type="number" name="due" id="due" placeholder="Due Amount" value="<?php echo $due; ?>"><span id="err_due" style="color:red;"><?php echo $err_due;?></span></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom:10px;">Due Date: </td>
                                <td style="padding-bottom:10px;"><input class="form-control" type="date" name="due_date" id="due_date"><span id="err_due_date" style="color:red;"><?php echo $err_due_date;?></span></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom:10px;">Payer (Clients): </td>
                                <td style="padding-bottom:10px;">
                                    <div class="form-group">
                                        <select class="form-control" name="payer_id" id="payer_id">
                                            <option value="" selected disabled>Client Name</option>
                                            <?php
                                                foreach($clients as $client){
                                                    $client_name=getUserById($client["CLIENT_ID"]);
                                                    echo "<option value=\"".$client_name[0]["ID"]."\">".$client_name[0]["FULLNAME"]."</option>";
                                                }
                                            ?>
                                        </select><span id="err_payer_id" style="color:red;"><?php echo $err_payer_id;?></span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer"><input class="btn btn-success" type="submit" name="add_payment_button" value="Add"></div>
            </div>
            </form>
        </td>
        <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:850px;">
                <div class="card-header">All Payments</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Due</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Payer ID</th>
                                <th scope="col">Receipt</th>
                                <th scope="col">Delete</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($payments as $payment){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$payment["DUE"]."</td>";
                                    echo "<td>".$payment["PAID"]."</td>";
                                    echo "<td>".$payment["BALANCE"]."</td>";
                                    echo "<td>".$payment["DUE_DATE"]."</td>";
                                    echo "<td>".$payment["PAYMENT_DATE"]."</td>";
                                    echo "<td>".$payment["PAYER_ID"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"lawyer_mail_payment.php?id=".$payment["ID"]."\"target=\"_blank\" >Mail Me</a></td>";
                                    echo "<td><a class=\"btn btn-outline-danger\" href=\"lawyer_delete_payment.php?id=".$payment["ID"]."\"target=\"_blank\" >Delete</a></td>";
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
<script src="../scripts/payment_validation.js"></script>
<?php
    include 'lawyer_footer.php';
?>