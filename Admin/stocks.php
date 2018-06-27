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


/*if(isset($_POST["newIngredienteId"])){

}*/
//TODO ADD STOCKS
?>
<html>
<head>
    <?php include '../libraries.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >

    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
    <script>
        let table;
        $(document).ready(function() {
            let selected = ["something"];
            /*$('#tabelProduse').width('100%')*/
             table = $('#tabelProduse').DataTable( {
                "ajax": {
                    "url": "requests/selectIngrediente.php",
                    "type": "POST",
                    "dataSrc":""
                },
                "rowCallback": function (row, data) {
                    if ($.inArray(data.DT_RowId, selected) !== -1) {
                        $(row).addClass('selected');
                    } },
                "columns": [
                    { "data": "idIngredient" },
                    { "data": "nameIngredient" },
                    { "data": "categoryIngredient" },
                    { "data": "stockIngredient" },
                    { "data": "unitIngredient"},
                    { "data": "priceIngredient" },
                    {
                        "data": null,
                        "defaultContent": "<button>Edit</button>"
                    }
                ],
            } );
            //TODO Ingrediente inactive
            $('#tabelProduse tbody').on( 'click', 'button', function () {
                let data = table.row( $(this).parents('tr') ).data();

                setEditModal(data.idIngredient, data.nameIngredient, data.categoryIngredient, data.stockIngredient, data.priceIngredient);
            } );
            document.getElementById("tabelProduse_wrapper").style.width = '100%';
        } );

        function setEditModal(id, denumire, categorie, stocActual, pret){
            $("#editIngredienteId").val(id);
            $("#editIngredienteName").val(denumire);
            $("#editIngredienteCategory").val(categorie);
            $("#editIngredienteStocActual").val(stocActual);
            $("#editIngredientePretUnitar").val(pret);
            $("#editIngredientModal").modal('show');
        }

        function editIngredient(){
            id = $("#editIngredienteId").val();
            denumire = $("#editIngredienteName").val() ;
            categorie = $("#editIngredienteCategory").val();
            stocActual= $("#editIngredienteStocActual").val();
            pret = $("#editIngredientePretUnitar").val();
            alert(id);
            $.ajax({
                type: 'POST',
                url: 'requests/editIngrediente.php',
                data:{editID: id,
                    editDenumire: denumire,
                    editCategorie: categorie,
                    editStocActual:stocActual,
                    editPretUnitar:pret
                },
                success: function (result){
                    if(result === "Success"){
                        $("#editIngredientModal").modal('hide');
                        table.ajax.reload();
                    }
                    else{
                        alert("Ne cerem scuze, a apărut o erorare");
                        console.log("error");
                    }
                }
            });
        }

        /*function sanitizeInput(){
            id = document.getElementById("newIngredienteId").value;
            if(isNaN(parseFloat(n)) || !isFinite(n)){
                return false;
            }
            return true;
        }*/

        function insertIngredient(){
            /*if(!sanitizeInput()){
                return false;
            }*/
            $.ajax({
                type: 'POST',
                url: 'requests/insertIngrediente.php',
                data:{newIngredienteId: document.getElementById("newIngredienteId").value,
                    newIngredienteName: document.getElementById("newIngredienteName").value,
                    newIngredienteCategory: document.getElementById("newIngredienteCategory").value,
                    newIngredienteStocActual: document.getElementById("newIngredienteStocActual").value,
                    newIngredientePretUnitar: document.getElementById("newIngredientePretUnitar").value,
                    newIngredienteUnitateMasura: document.getElementById("newIngredienteUM").value
                },
                success: function (result){
                    if(result === "Success"){
                        alert(result);
                        table.ajax.reload();
                    }
                    else{
                        alert(result);
                        console.log(result);
                    }
                }
            });
        }


    </script>

</head>
<body>

<div class="wrapper">
    <?php
    include("adminSidebar.php");
    ?>

    <div class="container">
        <div id="addIngredientModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Adaugă Ingredient</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Cod de bare</label>
                                    <input type="number" id="newIngredienteId" class="form-control" pattern = "[0-9]{13}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Denumire</label>
                                    <input type="text" id="newIngredienteName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Categorie</label>
                                    <input type="text" id="newIngredienteCategory" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Stoc Actual</label>
                                    <input type="text" id="newIngredienteStocActual" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Preț Unitar</label>
                                    <input type="text" id="newIngredientePretUnitar" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Unitate de măsură</label>
                                    <input type="text" id="newIngredienteUM" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" onclick="insertIngredient()" class="btn btn-info"  name="submit" value="Încarcă">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="editIngredientModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editează Ingredient</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Cod de bare</label>
                                    <input type="number" id="editIngredienteId" class="form-control" pattern = "[0-9]{13}" required disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Denumire</label>
                                    <input type="text" id="editIngredienteName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Categorie</label>
                                    <input type="text" id="editIngredienteCategory" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Stoc Actual</label>
                                    <input type="text" id="editIngredienteStocActual" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Preț Unitar</label>
                                    <input type="text" id="editIngredientePretUnitar" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" onclick="editIngredient()" class="btn btn-info"  name="submit" value="Salvează">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <button type="button" id="sidebarCollapse" onclick="collapse()" class="btn btn-info navbar-btn">
            <i class="fas fa-align-left"></i>
            <span></span>
        </button>
        <form id="bonForm" method="POST" action="bonConsum.php">
            <div  class="btn btn-primary">
                <input type="date" name="dataBon" min="2018-01-01">
                <label onclick="document.getElementById('bonForm').submit();" for="dataBon">Emite Bon de Consum</label>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIngredientModal">
                Adaugă ingredient
            </button>
        </form>
        <hr>
        <div class="row">
            <table id="tabelProduse" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Cod Produs</th>
                    <th>Denumire Produs</th>
                    <th>Categorie</th>
                    <th>Stoc Actual</th>
                    <th>Unitate de măsură</th>
                    <th>Preț unitar</th>
                    <th>Buttons</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


</body>
</html>