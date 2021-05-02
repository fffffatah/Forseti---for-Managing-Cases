<?php
    include 'client_header.php';
    require_once '../controllers/case_controller.php';
    require_once '../controllers/common_controller.php';
    $case=getCaseById($_GET["id"]);
    $my_client="";
    $my_complainant="";
    if(count($case)>0){
        $my_client=getUserById($_COOKIE["id"]);
        $my_complainant=getUserById($case[0]["COMPLAINANT_ID"]);
    }
?>
<center>
    <table>
        <tr>
            <td align="left" style="padding-top:100px;">
            <div class="card" style="height:600px;width:1000px;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $case[0]["CASE_TITLE"];?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Status: <?php echo $case[0]["CASE_STATUS"];?></h6>
                <p class="card-text"><?php echo $case[0]["CASE_DESCRIPTION"];?></p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted"><b>Client Name: </b><?php echo $my_client[0]["FULLNAME"];?></h6></li>
                    <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted"><b>Client Phone: </b><?php echo $my_client[0]["PHONE"];?></h6></li>
                    <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted"><b>Complainant Name: </b><?php echo $my_complainant[0]["FULLNAME"];?></h6></li>
                    <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted"><b>Complainant Phone: </b><?php echo $my_complainant[0]["PHONE"];?></h6></li>
                </ul>
            </div>
                <div class="card-footer">
                    <center><a href="<?php echo $case[0]["DOCUMENT"];?>" class="card-link" download>Download Attachment</a></center>
                </div>
        </div>
            </td>
        </tr>
    </table>
</center>
<?php
    include 'client_footer.php';
?>