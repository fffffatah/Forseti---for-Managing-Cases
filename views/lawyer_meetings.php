<?php
    include 'lawyer_header.php';
    require_once '../controllers/client_controller.php';
    require_once '../controllers/meeting_controller.php';
    require_once '../controllers/common_controller.php';
    $clients=getClients($_COOKIE["id"]);
    $meetings=getMeetingsForOrganizer($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td align="center" style="padding-top:100px;">
        <form action="" method="POST" onsubmit="return addMeetingValidation()">
            <div class="card border-info mb3" style="height:600px;width:600px;">
                <div class="card-header">Schedule a Meeting</div>
                    <div class="card-body">
                    <table>
                        <tr>
                            <td>Meeting Title: </td>
                            <td style="padding-bottom:10px;"><input class="form-control" type="text" name="meeting_title" id="meeting_title" placeholder="Meeting Title" value="<?php echo $meeting_title;?>"><span id="err_meeting_title" style="color:red;"><?php echo $err_meeting_title;?></span></td>
                        </tr>
                        <tr>
                            <td>Meeting Description: </td>
                            <td style="padding-bottom:10px;"><input class="form-control" type="text" name="meeting_description" id="meeting_description" placeholder="Meeting Description" value="<?php echo $meeting_description;?>"><span id="err_meeting_description" style="color:red;"><?php echo $err_meeting_description;?></span></td>
                        </tr>
                        <tr>
                            <td>Meeting Date/Time: </td>
                            <td style="padding-bottom:10px;"><input class="form-control" type="datetime-local" name="meeting_time" id="meeting_time"><span id="err_meeting_time" style="color:red;"><?php echo $err_meeting_time;?></span></td>
                        </tr>
                        <tr>
                            <td>Attandee: </td>
                            <td style="padding-bottom:10px;">
                                <div class="form-group">
                                    <select class="form-control" name="attandee_id" id="attandee_id">
                                        <option value="" selected disabled>Client Name</option>
                                            <?php
                                                foreach($clients as $client){
                                                    $client_name=getUserById($client["CLIENT_ID"]);
                                                    echo "<option value=\"".$client_name[0]["ID"]."\">".$client_name[0]["FULLNAME"]."</option>";
                                                }
                                            ?>
                                    </select><span id="err_attandee_id" style="color:red;"><?php echo $err_attandee_id;?></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </div>
                <div class="card-footer"><input class="btn btn-success" type="submit" name="add_meeting_button" id="add_meeting_button" value="Schedule"></div>
            </div>
        </form>
        </td>
        <td align="center" style="padding-top:85px;">
            <div class="card border-info mb3" style="height:600px;width:850px;">
                <div class="card-header">All Meetings</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Attandee</th>
                                <th scope="col">Date/time</th>
                                <th scope="col">Delete</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($meetings as $meeting){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$meeting["MEETING_TITLE"]."</td>";
                                    echo "<td>".$meeting["MEETING_DESCRIPTION"]."</td>";
                                    echo "<td>".$meeting["ATTANDEE_NAME"]."</td>";
                                    echo "<td>".$meeting["MEETING_TIME"]."</td>";
                                    echo "<td><a class=\"btn btn-outline-danger\" href=\"lawyer_delete_meeting.php?id=".$meeting["ID"]."\"target=\"_blank\" >Delete</a></td>";
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
<script src="../scripts/meeting_validation.js"></script>
<?php
    include 'lawyer_footer.php';
?>