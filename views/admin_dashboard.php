<?php
    include 'admin_header.php';
    require_once '../controllers/common_controller.php';
    $users=getAllUser();
    $lawyerNo=0;
    $clientNo=0;
    foreach($users as $user){
        if($user["TYPE"]=="lawyer"){
            $lawyerNo++;
        }
        elseif($user["TYPE"]=="client"){
            $clientNo++;
        }
    }
?>
<div style="padding-top:100px;">
<center>
    <table>
        <tr>
            <td align="center" style="padding:20px;">
            <div class="card border-warning mb3" style="height:300px;width:250px">
                <div class="card-header">Lawyers in the System</div>
                    <div class="card-body">
                        <h1 align="center" style="color:orange; font-size:130px;"><?php echo $lawyerNo;?></h1>
                    </div>
                </div>
            </td>
            <td align="center" style="padding:20px;">
            <div class="card border-info mb3" style="height:300px;width:250px">
                <div class="card-header">Clients in the System</div>
                    <div class="card-body">
                        <h1 align="center" style="color:cyan; font-size:130px;"><?php echo $clientNo;?></h1>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</center>
</div>
<?php
    include 'admin_footer.php';
?>