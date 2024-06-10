<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("location:login.php");  // Redirect if not logged in
}

$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE Id='$id'");

// 1. Check for results before accessing $res_id:
if (mysqli_num_rows($query) > 0) {
    while ($result = mysqli_fetch_assoc($query)) {
        // Fetch user details within the loop
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];  // Assign $res_id here
    }
   // header("location:changeprofile.php?Id=$res_id");

    echo "<a href='changeprofile.php'
     style='margin-right:10px;color:#D9D9D9;text-decoration:none;font-weight:bold;position:fixed;right:0;
    '>change profile</a>";
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-z ORaIWNpAAzY9wa8cO0znIDfg17NqpGkYf7Yr+qFFqaTvHqhSIt32ErC9ekgFWPfhEyZc//y17GUgfsl0zPDvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="jquery.js"></script>
</head>
<body>
<div class="insuparts">
<div class="spc">
<div class="menu">
        <div><img src="name2.png" class="nameimg"></div>
        <div class="middlesection">
        <div class="dd"><p class="mainmenu"><b>Mainmenu</b></p></div>
        <div class="dd"><a href="insuranceinfo.html" class="da">Insurance information</a></div>
        <div class="dd"><a href="insuranceclaim.html" class="da">claim outcome</a></div>
        <div class="dd"><a href="insurancepolicies.html" class="da">insurance policies</a></div>
        <div class="dd"><a href="insuranceoutcome.html" class="da1">insurance claim</a></div>
</div>
        <div><img src="umugongo1.png" class="umugongoimg"></div>
    </div>
</div>
    <div class="mainpart">
<a href="logout.php" class="logout">logout</a>
    <div class="container">
        <div class="alerts">
            <div class="alert alert-success">gg</div>
            <div class="alert alert-danger">ee</div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <h1 class="heading">claims from insurance customer</h1>
            <input type="text" id="live_search" placeholder="Search your insurance claim">
            <div id="searchresult"></div>
           <p>view insurance claims</p>
           <br>
            <div class="table-responsive" id="pagination_data"></div>  
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="counter">claims ( <span id="total"></span> )</h4>
                    <button class="btn btn-primary" id="create">Create</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Insurance problem</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th><button name="btn_delete" id="btn_delete" >delete selected</button></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                   
                </tbody>
            </table>
        </div>
    </div>

    <!-- create client model -->

    <!-- <div class="container"> -->
    <div class="modal" id="create-client">
        <div class="modal-body">
            <h3>Create client</h3>
            <div class="form-group">
                <label for=""><b>Enter your Name</b></label>
                <input type="text" placeholder="Enter your name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for=""><b>Enter the year </b></label>
                <input type="number" placeholder="Enter the year" id="age" class="form-control">
            </div>
            <div class="form-group">
                <label for=""><b>Enter the insurance problem</b></label>
                <select type="text" id="country" class="form-control">
                    <option>Select the insurance problem</option>
                    <option value="Home insurance">Home insurance</option>
                    <option value="Auto insurance">Auto insurance</option>
                    <option value="Health insurance">Health insurance</option>
                    <option value="Life insurance">Life insurance</option>
</select>
            </div>
            <div class="form-group buttons">
                <button class="btn btn-success" type="submit" id="save">Save</button>
                <button class="btn btn-danger" type="submit" id="close">Close</button>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <!-- edit client -->
    <div class="modal" id="update-client">
        <div class="modal-body">
            <h3>Update client</h3>
            <div class="form-group">
                <label for=""><b>Enter your Name</b></label>
                <input type="text" placeholder="Enter your name" id="edit_name" class="form-control">
                <input type="hidden" placeholder="Id" id="id" class="form-control">
            </div>
            <div class="form-group">
                <label for=""><b>Enter the year</b></label>
                <input type="number" placeholder="Enter the year " id="edit_age" class="form-control">
            </div>
            <div class="form-group">
                <label for=""><b>Enter the insurance problem</b></label>
                <input type="text" placeholder="Enter the insurance problem" id="edit_country" class="form-control">
            </div>
            <div class="form-group buttons">
                <button class="btn btn-success" id="update" type="submit">Update</button>
                <button class="btn btn-danger" type="submit" id="update_close">Close</button>
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    </div>
    </div>

</body>

</html>
