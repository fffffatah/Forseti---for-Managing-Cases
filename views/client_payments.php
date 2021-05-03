<?php
    include 'client_header.php';
    require_once '../controllers/payment_controller.php';
    $payments=getPaymentsForPayer($_COOKIE["id"]);
?>
<center>
    <table>
        <tr>
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
                                <th scope="col">Receiver ID</th>
                                <th scope="col">Receipt</th>
                                <th scope="col">Pay</th>
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
                                    echo "<td>".$payment["RECEIVER_ID"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-primary\" href=\"lawyer_mail_payment.php?id=".$payment["ID"]."\"target=\"_blank\" >Mail Me</a></td>";
                                    echo "<td><a class=\"btn btn-outline-danger\" href=\"client_mock_payment.php?id=".$payment["ID"]."\"target=\"_blank\" >Pay</a></td>";
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