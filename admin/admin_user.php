<?php
$titulo = "Users";
include_once "./config.php";
if ($_SESSION["tipo_usuario"] != 1) {

    header('Location: ./home.php');

}
include_once './_top.php';

?>

<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?php echo $titulo; ?></h3>
            </div>

        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">

            <?php
            if (isset($_SESSION["success"]) == true) {

                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION["success"]; ?>
                </div>
                <?php
                unset($_SESSION["success"]);
            } ?>
            <?php
            if (isset($_SESSION["success_email"]) == true) {

                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION["success_email"]; ?>
                </div>
                <?php
                unset($_SESSION["success_email"]);
            } ?>
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-primary" href="./new_user.php" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    New user
                                </a>
                                <a class="btn btn-warning" href="./email_users.php" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Email everyone
                                </a>
                                <a class="btn btn-info" href="./csv_users_export.php" role="button"
                                    aria-expanded="false" target="_blank" aria-controls="collapseExample">
                                    Export all users CSV 
                                </a>
                                <a class="btn btn-info" href="./csv_users_import.php" role="button"
                                    aria-expanded="false"  aria-controls="collapseExample">
                                   Import CSV 
                                </a>
                            </div>

                            <div class="col-6">

                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-4">
                                <label for="user_type" class="form-label">User type:</label>
                                <select name="user_type" id="user_type" class="form-control" >
<option value="0">All</option>
  <option value="1"<?php if(@$_GET["type"]==1) echo "selected" ?> >Administrator</option>
    <option value="3" <?php if(@$_GET["type"]==3) echo "selected" ?> >Trips Manager</option>
  <option value="2" <?php if(@$_GET["type"]==2) echo "selected" ?> >User</option>
    
</select>
<script>

$("#user_type").change(function () {
    if($("#user_type").val()!='0')
    window.location.href = './admin_user.php?type='+$("#user_type").val();
 else
 window.location.href = './admin_user.php';

});
</script>                          
</div>  </div>  
                        <br><br><br>
                        <div class="row">
                            <div class="col-12">
                                <table id="tabla_eventos" name="tabla_eventos">
                                    <thead>


                                        <th>Name</th>
                                        <!-- <th>Phone </th> -->
                                        <th>Email </th>
                                        <!-- <th>id_numero </th> -->
                                        <!-- <th>emergency_contact </th> -->
                                        <th>User Type </th>
                                        <th>status</th>
                                        <th>Date last payment:</th>
                                        <th>Payment due date</th>
                                        <th>Options</th>
                                    </thead>


                                    <?php

                                    $sql = "select *  from usuarios";
if(isset($_GET["type"])==true)
$sql.=" where tipo_usuario=".$_GET["type"];
                                    $result = mysqli_query($link, $sql);
                                    while ($fila = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        if ($fila["name_pre"] != '') {

                                            $name = explode(" ", $fila["nombre"]);


                                            $lastname = str_replace($name[0], "", $fila["nombre"]);


                                            $fila['nombre'] = $name[0] . ' "' . $fila["name_pre"] . '"' . $lastname;

                                        }


                                        echo "<td> " . $fila['nombre'] . "</td>";
                                        //  echo "<td> " . $fila['telefono'] . "</td>";
                                    
                                        echo "<td> " . $fila['correo'] . "</td>";
                                        // echo "<td> " . $fila['id_numero'] . "</td>";
                                    

                                        // echo "<td> " . $fila['emergency_contact'] . "</td>";
                                    
                                        if ($fila['tipo_usuario'] == 1)
                                            $fila['tipo_usuario'] = "Administrator";
                                        else if ($fila['tipo_usuario'] == 2)
                                            $fila['tipo_usuario'] = "User";
                                        else if ($fila['tipo_usuario'] == 3)
                                            $fila['tipo_usuario'] = "Trips Manager";
                                        echo "<td> " . $fila['tipo_usuario'] . "</td>";

                                        
                                        if ($fila['status'] == 1)
                                            $fila['status'] = "Active";
                                        else
                                            $fila['status'] = "No Active";
                                        echo "<td> " . $fila['status'] . "</td>";


                                        echo "<td> " . $fila['fecha_pago'] . "</td>";

                                        echo "<td> " . $fila['fechalimite_suscripcion'] . "</td>";


                                        echo '<td>   <a class="btn btn-warning" href="./user_edit.php?id=' . $fila['id'] . '" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Edit
                                </a>
                                <a class="btn btn-warning" href="./mytrips_email_send.php?redirect=admin_user.php&email=' . $fila['correo'] . '" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                       Send
                                    </a>';
                                        if ($fila['id'] != 1)
                                            echo '&nbsp;<a class="btn btn-danger" href="./user_delete.php?id=' . $fila['id'] . '" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Delete
                                </a>';
                                        echo '</td>';
                                        echo "</tr>";
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>


                    </div> <!-- /.card-body -->

                </div> <!-- /.card -->

            </div>

        </div> <!--end::Row-->


    </div> <!--end::Container-->


</div> <!--end::App Content-->



<script>
    //     let table = new DataTable('#tabla_eventos');


    var producto = $('#tabla_eventos').DataTable({
        "oPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [],
        "bInfo": true,
        "bAutoWidth": true,

        columns: [{
            data: 'c1'
        },
        {
            data: 'c2'
        },
        {
            data: 'c3'
        },
        {
            data: 'c4'
        },
        {
            data: 'c5'
        },
        {
            data: 'c6'
        },
        {
            data: 'c7'
        }/*,
        {
            data: 'c8'
        },
        {
            data: 'c9'
        },
        {
            data: 'c10'
        }
*/

        ],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });


</script>

<?php include_once './_bottom.php'; ?>