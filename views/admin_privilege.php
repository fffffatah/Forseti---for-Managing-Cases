<?php
    include 'admin_header.php';
    require_once '../controllers/common_controller.php';
?>
<div style="padding-top:100px;">
<center>
    <table>
        <tr>
            <td align="center" style="padding:20px;">
            <div class="card border-warning mb3" style="height:300px;width:250px">
                <div class="card-header">Lock/Unlock Profile Update on Friday, Saturday and Sunday</div>
                    <div class="card-body">
                        <h1 align="center" style="color:orange; font-size:40px;" id="lockUserUpdate"></h1>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" onclick="lockUserUpdate()">Lock</button>
                            <button type="button" class="btn btn-primary" onclick="unlockUserUpdate()">Unlock</button>
                        </div>
                    </div>
            </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-info mb3" style="height:300px;width:250px">
                <div class="card-header">Lock/Unlock Payment</div>
                    <div class="card-body">
                        <h1 align="center" style="color:cyan; font-size:40px;" id="lockPayment"></h1>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" onclick="lockPayment()">Lock</button>
                            <button type="button" class="btn btn-primary" onclick="unlockPayment()">Unlock</button>
                        </div>
                    </div>
            </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-info mb3" style="height:300px;width:250px">
                <div class="card-header">Lock/Unlock Cases</div>
                    <div class="card-body">
                        <h1 align="center" style="color:cyan; font-size:40px;" id="lockCase"></h1>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" onclick="lockCase()">Lock</button>
                            <button type="button" class="btn btn-primary" onclick="unlockCase()">Unlock</button>
                        </div>
                    </div>
            </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-info mb3" style="height:300px;width:250px">
                <div class="card-header">Lock/Unlock Client Hiring</div>
                    <div class="card-body">
                        <h1 align="center" style="color:cyan; font-size:40px;" id="lockClient"></h1>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" onclick="lockClient()">Lock</button>
                            <button type="button" class="btn btn-primary" onclick="unlockClient()">Unlock</button>
                        </div>
                    </div>
            </div>
            </td>
        </tr>
    </table>
</center>
</div>
<script src="../scripts/admin_privilege_ajax.js"></script>
<?php
    include 'admin_footer.php';
?>