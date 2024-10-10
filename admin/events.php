<?php

  
$titulo = "Trips";
include_once "./config.php";

if($_SESSION["tipo_usuario"]!=1){
  
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
            if (isset($_SESSION["tipo"]) == true) {
                unset($_SESSION["tipo"]);
                ?>
                <div class="alert alert-success" role="alert">
                Recorded trip!
                </div>
            <?php
            } ?>
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-primary" href="./event_new.php" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    New trip
                                </a>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-12">
                                <table id="tabla_eventos" name="tabla_eventos">
                                    <thead>


                                        <th>Name</th>
                                        <th>Description </th>
                                        <th>Category</th>
                                        <th>Status </th>
                                        <th>Start date </th>

                                        <th>Final date </th>
                                        <th>User limit </th>
                                        <th>Subscribed users</th>
                                        <th>Capacity</th>
                                        
                                        <th>Options</th>
                                    </thead>


                                    <?php

                                    $sql = "select *, (select name from events_category ec where ec.id=hcategory) as category from eventos";

                                    $result = mysqli_query($link, $sql);
                                    while ($fila = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td> " . $fila['nombre'] . "</td>";
                                        $fila["descripcion"] = strip_tags($fila["descripcion"]);
                                        $fila["descripcion"] = substr($fila["descripcion"], 0, 50);
                                        echo "<td> " . $fila['descripcion'] . "</td>";
                                        echo "<td> " . $fila['category'] . "</td>";
                                        if ($fila['status'] == 1)
                                            $fila['status'] = "Public";
                                        else
                                            $fila['status'] = " Draft";

                                        echo "<td> " . $fila['status'] . "</td>";
                                        echo "<td> " . $fila['fecha_inicio'] . "</td>";

                                        if ($fila['fecha_fin'] == '0000-00-00')
                                            $fila['fecha_fin'] = "not indicated";

                                        echo "<td> " . $fila['fecha_fin'] . "</td>";
                                        echo "<td> " . $fila['cupo_limite'] . "</td>";
                                        echo "<td> " . $fila['cupos_usados'] . "</td>";

                                        $progres=($fila['cupos_usados']*100)/$fila['cupo_limite'];
                                        ?>
                                        
                                        

                                        <td>
                                            <div class="progress mb-2" role="progressbar"
                                                aria-label="Default striped example" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div class="progress-bar" style="width: <?php echo $progres;?>%; border-radius: 0.375rem;">
                                                </div>

                                        </td>
                               
                                <?php
                      
                                echo '<td>   <a class="btn btn-warning" href="./event_edit.php?id='.$fila['id'].'" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Edit
                                </a>
                                <a class="btn btn-danger" href="./event_delete.php?id='.$fila['id'].'" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Delete
                                </a></td>';
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
        },
        {
            data: 'c8'
        },
        {
            data: 'c9'
        },
        {
            data: 'c10'
        }


        ],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });


</script>

<?php include_once './_bottom.php'; ?>