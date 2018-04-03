<?php

require_once 'dbconnect.php';

function console_log($data){
    echo '<script>';
    echo 'console.log('. $data .')';
    echo '</script>';
}

$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
if(!$result){
    echo'No result';
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
}

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="http://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

    <link href="css/merveilleuseSideBar.css" rel="stylesheet">
    <script src="js/merveilleuseSideBar.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <?php
    include('navbar.php');
    ?>

    <div class = "container-fluid">
        <div class="row">
            <div class="col-sm-2 content side-bar">
                <div class="brand" >
                    Merveilleuse
                    <div class = "toggle-button">
                        <img id="sidebarButon" src="res/menu_icon.png" alt="Mountain View">
                    </div>
                </div>
                <div id="sidebarID" class="menu-list active">
                    <ul class="menu-content">
                        <li>
                            <span href="#"> <span class="glyphicon glyphicon-stats"></span> Dashboard </span>
                        </li>
                        <li>
                            <a href="productListPanel.php"><span href="#"> <span class="glyphicon glyphicon-th-list"></span> Product List </span></a>
                        </li>
                        <li>
                            <a href = usersPanel.php><span href="#"> <span class="glyphicon glyphicon-user"></span> Users </span> </a>
                        </li>
                        <li>
                            <span href="#"> <span class="glyphicon glyphicon-tags"></span> Orders </span>
                        </li>
                        <li>
                            <span href="#"> <span class="glyphicon glyphicon-camera"></span> Gallery </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <h3 class="text-left">
                    Users
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            username
                        </th>
                        <th>
                            Last Login
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                            
                                            <td>'. $row["id"] .'</td>
                                            <td>'. $row["username"] . '</td>
                                            <td>'. $row["lastLogin"] .'</td>
                                            <td>
            
                                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Edit">&#xE254;</i></button>
                                                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="material-icons" data-toggle="tooltip" data-target="" title="Delete">delete</i></button>
                                            </td>
                                        </tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-left">
                    h3. Lorem ipsum dolor sit amet.
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Product
                        </th>
                        <th>
                            Payment Taken
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Default
                        </td>
                    </tr>
                    <tr class="table-active">
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Approved
                        </td>
                    </tr>
                    <tr class="table-success">
                        <td>
                            2
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            02/04/2012
                        </td>
                        <td>
                            Declined
                        </td>
                    </tr>
                    <tr class="table-warning">
                        <td>
                            3
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            03/04/2012
                        </td>
                        <td>
                            Pending
                        </td>
                    </tr>
                    <tr class="table-danger">
                        <td>
                            4
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            04/04/2012
                        </td>
                        <td>
                            Call in to confirm
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>