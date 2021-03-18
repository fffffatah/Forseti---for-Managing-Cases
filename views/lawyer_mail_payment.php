<?php
    if(!isset($_COOKIE["id"])){
        header("Location: landing.php");
    }
    require_once '../providers/mail_sender.php';
    require_once '../controllers/common_controller.php';
    require_once '../controllers/payment_controller.php';
    require_once '../providers/generate_pdf.php';

    if(isset($_GET["id"])){
        generateReceipt();
        echo  "<script type='text/javascript'>";
        echo "window.close();";
        echo "</script>";
    }

    function generateReceipt(){
        $my_profile=getUserById($_COOKIE["id"]);
        $payment=getPayment($_GET["id"]);
        $html_builder="<html><head><center><h3>Report - Transactions</h3></center><h4>Laywer Name: ".$my_profile[0]["FULLNAME"]."</h4></head><body><table border=\"2\"><tr><th>Due</th><th>Paid</th><th>Balance</th><th>Due Date</th><th>Payment Date</th><th>Payer ID</th></tr>";
        $html_builder.="<tr>";
        $html_builder.="<td>".$payment[0]["DUE"]."</td>";
        $html_builder.="<td>".$payment[0]["PAID"]."</td>";
        $html_builder.="<td>".$payment[0]["BALANCE"]."</td>";
        $html_builder.="<td>".$payment[0]["DUE_DATE"]."</td>";
        $html_builder.="<td>".$payment[0]["PAYMENT_DATE"]."</td>";
        $html_builder.="<td>".$payment[0]["PAYER_ID"]."</td>";
        $html_builder.="</tr>";
        $html_builder.="</table></body></html>";
        $filePath=getPdf($html_builder, "../storage/docs/", $_COOKIE["id"], "PAYMENT_RECEIPT");
        sendAttachment($_COOKIE["id"],$my_profile[0]["USERNAME"],$my_profile[0]["EMAIL"],$filePath,"Payment Receipt");
    }
?>