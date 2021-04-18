<?php
    include 'client_header.php';
    require_once '../controllers/client_controller.php';
    require_once '../controllers/common_controller.php';
    $my_profile=getUserById($_COOKIE["id"]);
?>
<center>
<table>
    <tr>
        <td style="padding-top:100px;">
        <div class="card" style="height:600px;width:600px;">
            <img class="card-img-top" src="<?php echo $my_profile[0]["PP"];?>" alt="Card image cap" style="height:100px;width:100px">
            <div class="card-body">
                <h5 class="card-title"><?php echo $my_profile[0]["FULLNAME"];?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Username: <?php echo $my_profile[0]["USERNAME"];?></li>
                <li class="list-group-item">Email: <?php echo $my_profile[0]["EMAIL"];?></li>
                <li class="list-group-item">Phone: <?php echo $my_profile[0]["PHONE"];?></li>
                <li class="list-group-item">NID: <?php echo $my_profile[0]["NID"];?></li>
                <li class="list-group-item">Address: <?php echo $my_profile[0]["ADDRESS"];?></li>
                <li class="list-group-item">State: <?php echo $my_profile[0]["STATE"];?></li>
                <li class="list-group-item">City: <?php echo $my_profile[0]["CITY"];?></li>
                <li class="list-group-item">ZIP Code: <?php echo $my_profile[0]["ZIP"];?></li>
                <li class="list-group-item">Date of Birth: <?php echo $my_profile[0]["DOB"];?></li>
            </ul>
        </div>
        </td>
        <td style="padding-top:100px;">
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return registrationValidation()" style="padding:20px;">
                <table>
                    <tr>
                        <td align="center">
                            <div class="card border-success mb3 dropshadow">
                                <div class="card-header">Update Profile</div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">Profile Picture: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="file" name="pp" id="pp" accept="image/*"><span id="err_pp" style="color:red;"><?php echo $err_pp;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">Full Name: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="text" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo $my_profile[0]["FULLNAME"]; ?>"><span id="err_fullname" style="color:red;"><?php echo $err_fullname;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">Birthday: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="date" name="dob" id="dob"><span id="err_dob" style="color:red;"><?php echo $err_dob;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">Address: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="text" name="address" id="address" placeholder="Address" value="<?php echo $my_profile[0]["ADDRESS"]; ?>"><span id="err_address" style="color:red;"><?php echo $err_address;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">City: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="text" name="city" id="city" placeholder="City" value="<?php echo $my_profile[0]["CITY"]; ?>"><span id="err_city" style="color:red;"><?php echo $err_city;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">State: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="text" name="state" id="state" placeholder="State" value="<?php echo $my_profile[0]["STATE"]; ?>"><span id="err_state" style="color:red;"><?php echo $err_state;?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-bottom:10px;">Zip/Postal: </td>
                                            <td align="left" style="padding-bottom:10px;"><input class="form-control" type="text" name="zip" id="zip" placeholder="Postal/Zip-Code" value="<?php echo $my_profile[0]["ZIP"]; ?>"><span id="err_zip" style="color:red;"><?php echo $err_zip;?></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><input class="btn btn-outline-success" type="submit" name="update_button" value="Update"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
</center>
<script src="../scripts/lawyer_validation.js"></script>
<?php
    include 'client_footer.php';
?>
