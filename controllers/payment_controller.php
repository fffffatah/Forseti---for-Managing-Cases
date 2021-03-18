<?php
    require_once '../providers/db_conn.php';

    $hasError=false;
    $due="";
    $due_date="";
    $payer_id="";
    $err_payer_id="";
    $err_due="";
    $err_due_date="";
    if(isset($_POST["add_payment_button"])){
        //DUE AMOUNT VALIDATION
        if(empty($_POST["due"])){
            $err_due="* Due Amount Required.";
            $hasError=true;
        }
        else{
            $due=htmlspecialchars($_POST["due"]);
        }
        //DUE DATE VALIDATION
        if(!isset($_POST["due_date"])){
            $err_due_date="* Due Date Required.";
            $hasError=true;
        }
        else{
            $due_date=$_POST["due_date"];
        }
        //PAYER VALIDATION
        if(!isset($_POST["payer_id"])){
            $err_payer_id="* Payer Required.";
            $hasError=true;
        }
        else{
            $payer_id=$_POST["payer_id"];
        }
        if(!$hasError){
            addPayment($due, "0", "0", $due_date, "0", $payer_id, $_COOKIE["id"]);
        }
    }
    //PAYMENT DATA ACCESS
    function getPaymentsForReceiver($receiver_id){
        $query="SELECT * FROM payments WHERE receiver_id=$receiver_id";
        return doQuery($query);
    }
    function addPayment($due, $paid, $balance, $due_date, $payment_date, $payer_id, $receiver_id){
        $query="INSERT INTO payments(id, due, paid, balance, due_date, payment_date, payer_id, receiver_id) VALUES (payments_id_seq.nextval, '$due', '$paid', '$balance', '$due_date', '$payment_date', $payer_id, $receiver_id)";
        doNoQuery($query);
    }
    function deletePayment($id){
        $query="DELETE FROM payments WHERE id=$id";
        doNoQuery($query);
    }
    function getPayment($id){
        $query="SELECT * FROM payments WHERE id=$id";
        return doQuery($query);
    }
?>