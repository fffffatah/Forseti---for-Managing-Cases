<?php
    include 'client_header.php';
    require_once '../controllers/case_controller.php';
    $runningCases=0;
    $closedCases=0;
    $casesWon=0;
    $casesLost=0;
    $cases=getCasesForClient($_COOKIE["id"]);
    if(count($cases)>0){
        foreach($cases as $case){
            if(strcmp($case["CASE_STATUS"], "Running")==0){
                $runningCases++;
            }
            elseif(strcmp($case["CASE_STATUS"], "Closed")==0){
                $closedCases++;
            }
            elseif(strcmp($case["CASE_STATUS"], "Won")==0){
                $casesWon++;
            }
            elseif(strcmp($case["CASE_STATUS"], "Lost")==0){
                $casesLost++;
            }
        }
    }
?>

<div style="padding-top:100px;">
<center>
    <table>
        <tr>
            <td align="center" style="padding:20px;">
            <div class="card border-warning mb3" style="height:300px;width:250px">
                <div class="card-header">Running Cases</div>
                    <div class="card-body">
                        <h1 align="center" style="color:orange; font-size:130px;"><?php echo $runningCases;?></h1>
                    </div>
                </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-info mb3" style="height:300px;width:250px">
                <div class="card-header">Closed Cases</div>
                    <div class="card-body">
                        <h1 align="center" style="color:cyan; font-size:130px;"><?php echo $closedCases;?></h1>
                    </div>
                </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-success mb3" style="height:300px;width:250px">
                <div class="card-header">Cases Won</div>
                    <div class="card-body">
                        <h1 align="center" style="color:green; font-size:130px;"><?php echo $casesWon;?></h1>
                    </div>
                </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-danger mb3" style="height:300px;width:250px">
                <div class="card-header">Cases Lost</div>
                    <div class="card-body">
                        <h1 align="center" style="color:red; font-size:130px;"><?php echo $casesLost;?></h1>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</center>
</div>

<?php
    include 'client_footer.php';
?>