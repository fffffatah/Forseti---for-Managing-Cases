<?php
    require_once '../providers/db_conn.php';
    require_once '../providers/generate_pdf.php';
    require_once 'case_controller.php';
    require_once 'common_controller.php';
    require_once 'payment_controller.php';
    $monthly="";
    $weekly="";
    $transactions="";
    $date_generated="";
    $generator_id="";
    if(isset($_POST["generate_report_button"])){
        $monthly=generateMonthly();
        $weekly=generateWeekly();
        $transactions=generateTransactions();
        $date_generated=date("d/m/Y");
        $generator_id=$_COOKIE["id"];
        addReports($monthly, $weekly, $transactions, $date_generated, $generator_id);
    }

    function addReports($monthly, $weekly, $transactions, $date_generated, $generator_id){
        $query="INSERT INTO reports(id, monthly, weekly, transactions, date_generated, generator_id) VALUES (reports_id_seq.nextval, '$monthly', '$weekly', '$transactions', '$date_generated', $generator_id)";
        doNoQuery($query);
    }
    function getReports($generator_id){
        $query="SELECT * FROM reports WHERE generator_id=$generator_id";
        return doQuery($query);
    }
    function generateMonthly(){
        $my_profile=getUserById($_COOKIE["id"]);
        $current_date=strtotime(date("d/m/Y"));
        $one_month_before=strtotime(date('d/m/Y', strtotime('-1 month', $current_date)));
        $runningCases=0;
        $closedCases=0;
        $casesWon=0;
        $casesLost=0;
        $cases=getCasesForLaywer($_COOKIE["id"]);
        if(count($cases)>0){
            foreach($cases as $case){
                if(strcmp($case["CASE_STATUS"], "Running")==0 && ((strtotime($case["DATE_ADDED"])>=$one_month_before) && ($one_month_before<=strtotime($case["DATE_ADDED"])))){
                    $runningCases++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Closed")==0 && ((strtotime($case["DATE_ADDED"])>=$one_month_before) && ($one_month_before<=strtotime($case["DATE_ADDED"])))){
                    $closedCases++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Won")==0 && ((strtotime($case["DATE_ADDED"])>=$one_month_before) && ($one_month_before<=strtotime($case["DATE_ADDED"])))){
                    $casesWon++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Lost")==0 && ((strtotime($case["DATE_ADDED"])>=$one_month_before) && ($one_month_before<=strtotime($case["DATE_ADDED"])))){
                    $casesLost++;
                }
            }
        }
        $html_report="<html><head><center><h3>Report - Monthly</h3></center><h4>Laywer Name: ".$my_profile[0]["FULLNAME"]."</h4></head><body><h2>Cases Won: ".$casesWon."</h2><h2>Cases Lost: ".$casesLost."</h2><h2>Closed Cases: ".$closedCases."</h2><h2>Running Cases: ".$runningCases."</h2></body></html>";
        return getPdf($html_report, "../storage/docs/", $_COOKIE["id"], "MONTHLY_REPORT");
    }
    function generateWeekly(){
        $my_profile=getUserById($_COOKIE["id"]);
        $current_date=strtotime(date("d/m/Y"));
        $one_week_before=$current_date-18316800;
        $runningCases=0;
        $closedCases=0;
        $casesWon=0;
        $casesLost=0;
        $cases=getCasesForLaywer($_COOKIE["id"]);
        if(count($cases)>0){
            foreach($cases as $case){
                if(strcmp($case["CASE_STATUS"], "Running")==0 && ((strtotime($case["DATE_ADDED"])>=$one_week_before) && ($one_week_before<=strtotime($case["DATE_ADDED"])))){
                    $runningCases++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Closed")==0 && ((strtotime($case["DATE_ADDED"])>=$one_week_before) && ($one_week_before<=strtotime($case["DATE_ADDED"])))){
                    $closedCases++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Won")==0 && ((strtotime($case["DATE_ADDED"])>=$one_week_before) && ($one_week_before<=strtotime($case["DATE_ADDED"])))){
                    $casesWon++;
                }
                elseif(strcmp($case["CASE_STATUS"], "Lost")==0 && ((strtotime($case["DATE_ADDED"])>=$one_week_before) && ($one_week_before<=strtotime($case["DATE_ADDED"])))){
                    $casesLost++;
                }
            }
        }
        $html_report="<html><head><center><h3>Report - Weekly</h3></center><h4>Laywer Name: ".$my_profile[0]["FULLNAME"]."</h4></head><body><h2>Cases Won: ".$casesWon."</h2><h2>Cases Lost: ".$casesLost."</h2><h2>Closed Cases: ".$closedCases."</h2><h2>Running Cases: ".$runningCases."</h2></body></html>";
        return getPdf($html_report, "../storage/docs/", $_COOKIE["id"], "WEEKLY_REPORT");
    }
    function generateTransactions(){
        $my_profile=getUserById($_COOKIE["id"]);
        $my_payments=getPaymentsForReceiver($_COOKIE["id"]);
        $html_builder="<html><head><center><h3>Report - Transactions</h3></center><h4>Laywer Name: ".$my_profile[0]["FULLNAME"]."</h4></head><body><table border=\"2\"><tr><th>Due</th><th>Paid</th><th>Balance</th><th>Due Date</th><th>Payment Date</th><th>Payer ID</th></tr>";
        foreach($my_payments as $my_payment){
            $html_builder.="<tr>";
            $html_builder.="<td>".$my_payment["DUE"]."</td>";
            $html_builder.="<td>".$my_payment["PAID"]."</td>";
            $html_builder.="<td>".$my_payment["BALANCE"]."</td>";
            $html_builder.="<td>".$my_payment["DUE_DATE"]."</td>";
            $html_builder.="<td>".$my_payment["PAYMENT_DATE"]."</td>";
            $html_builder.="<td>".$my_payment["PAYER_ID"]."</td>";
            $html_builder.="</tr>";
        }
        $html_builder.="</table></body></html>";
        return getPdf($html_builder, "../storage/docs/", $_COOKIE["id"], "TRANSACTIONS_REPORT");
    }
?>