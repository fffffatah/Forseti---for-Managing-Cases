<?php
    require_once '../controllers/payment_controller.php';
    $payment=getPayment($_GET["id"]);
?>
<center>
<table>
    <tr>
    <td align="center" style="padding-top:100px;">
            <form action="" method="POST"">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Mock Payment</div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="padding-bottom:10px;">Due Amount: <?php echo $payment[0]["DUE"];?></td>
                            </tr>
                            <tr>
                                <td style="padding-bottom:10px;">Payment Amount: </td>
                                <td style="padding-bottom:10px;"><input class="form-control" type="number" name="payAm" id="payAm" placeholder="Payment Amount" value="<?php echo $payAm; ?>"><span id="err_payAm" style="color:red;"><?php echo $err_payAm;?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer"><input class="btn btn-success" type="submit" name="pay_button" value="Pay"></div>
            </div>
            </form>
        </td>
    </tr>
</table>
</center>