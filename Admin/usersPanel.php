<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'requests/dbConnectAdmin.php';


$sql = "Select * from user where emailUser = '" .$_SESSION["email"]."' LIMIT 1 ";
$result = mysqli_query($conn,$sql);
$row = $result ->fetch_assoc();
if($row["admin"] == 0){
    header("Location: adminLogin.php");
}

?>

<html>
<head>
    <?php include '../libraries.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function deleteUser(user){
            $.ajax({
                type: 'POST',
                url: 'requests/deleteUser.php',
                data:{userID: user.value},
                success: function (data){
                    if (data === "success"){
                        reloadUsers(data);
                    }
                    else
                        alert('Could not delete at this time!');
                }
            })
        }

        function reloadUsers(){
            $.ajax({
                type: 'POST',
                url: 'requests/selectUsers.php',
                data:{},
                success: function (d){
                    var myArray = JSON.parse(d);
                    table = document.getElementById("userTable");
                    head = "<thead><tr><th>#</th><th>Email</th><th>Last Login</th><th>Actions</th>  </tr></thead>";
                    ceva = '';
                    for(var i = 0; i < myArray.length; i++){
                        ceva = ceva + "<tr> <td>" + myArray[i].idUser + "</td> <td> " + myArray[i].emailUser + " </td> <td> " + myArray[i].lastLogin + " </td> <td>" +
                            " <button type=\"button\" class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#deleteModal\" value = " + myArray[i].idUser + " onclick=\"deleteUser(this)\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-target=\"\"  title=\"Delete\" >delete</i></button>\n" +
                            " </td>"
                    }
                    body = "<tbody>" + ceva + "</tbody>";
                    table.innerHTML = head + body;
                }
            });
        };

        reloadUsers();
    </script>
<!-- TODO Admin Management -->
</head>
<body>
<div class="wrapper">
    <?php
    include("adminSidebar.php");
    ?>
    <div class = "container" style="margin-top: 25px">
        <div class="row">
            <div class="col">
                <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
                    <i class="fas fa-align-left"></i>
                    <span></span>
                </button>
                <h3 class="text-left">
                    Users
                </h3>
                <table id="userTable" class="table">
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>