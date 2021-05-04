<?php
    include 'admin_header.php';
?>
<center>
<table>
    <tr>
    <td align="center" style="padding-top:100px;">
        <div class="card border-info mb3" style="height:600px;width:1500px;">
                <div class="card-header">Search Lawyers</div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand">Filters</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    State: <select name="search_lawyer_by_state" id="search_lawyer_by_state">
                        <option value="Dhaka" selected>Dhaka</option>
                        <option value="Chittagong">Chittagong</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Barishal">Barishal</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Mymensingh">Mymensingh</option>
                        <option value="Rangpur">Rangpur</option>
                    </select>
                </li>
                <li class="nav-item dropdown" style="padding-left:20px">
                    Rating: <select name="search_lawyer_by_rating" id="search_lawyer_by_rating">
                        <option value="5" selected>5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </li>
                </ul>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search_box" name="search_box">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="searchLawyerforAdmin()">Search</button>
                </div>
                </nav>
                    <div class="card-body scroll-box">
                    <div class="table-responsive">
                        <table class="table" table-borderless id="search_lawyers_for_client">
                            
                        </table>
                    </div>
                    </div>
                    <div class="card-footer"></div>
            </div>
        </td>
    </tr>
</table>
</center>
<script src="../scripts/search_lawyer_ajax.js"></script>
<?php
    include 'admin_footer.php';
?>