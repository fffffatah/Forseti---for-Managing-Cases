<?php
    include 'client_header.php';
    require_once '../controllers/meeting_controller.php';
    $meetings=getMeetingsForAttandee($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
    <td align="center" style="padding-top:100px;">
            <div class="card border-info mb3" style="height:600px;width:1500px;">
                <div class="card-header">All Meetings</div>
                    <div class="card-body scroll-box">
                    <div class="overflow-auto">
                        <table class="table table-striped">
                            <tr>
                                <th scope="col">#SR</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Organizer</th>
                                <th scope="col">Date/time</th>
                            </tr>
                            <?php
                                $sr=1;
                                foreach($meetings as $meeting){
                                    echo "<tr>";
                                    echo "<th>".$sr."</th>";
                                    echo "<td>".$meeting["MEETING_TITLE"]."</td>";
                                    echo "<td>".$meeting["MEETING_DESCRIPTION"]."</td>";
                                    echo "<td>".$meeting["ORGANIZER_NAME"]."</td>";
                                    echo "<td>".$meeting["MEETING_TIME"]."</td>";
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