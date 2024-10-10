<?php


$titulo = "My Trips";
include_once "./config.php";



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

            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <table id="tabla_eventos" name="tabla_eventos">
                                    <thead>


                                        <th>Name</th>
                                        <th>Category </th>

                                        <th>Start date </th>

                                        <th>Final date </th>
                                        <th>Type</th>
                                        <th>Option</th>
                                    </thead>


                                    <?php
                             

$sql = "SELECT cupos, eve.*,(select name from events_category ec where ec.id=eve.hcategory) as category, eve_usu.type FROM evento_usuario eve_usu, eventos eve WHERE eve_usu.hevento=eve.id and eve_usu.husuario=".$_SESSION["usr_id"];

                                    $result = mysqli_query($link, $sql);
                                    while ($fila = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td> " . $fila['nombre'] . "</td>";
                                        echo "<td> " . $fila['category'] . "</td>";
                                        if ($fila['status'] == 1)
                                            $fila['status'] = "Public";
                                        else
                                            $fila['status'] = " No Public";


                                        echo "<td> " . $fila['fecha_inicio'] . "</td>";

                                        if ($fila['fecha_fin'] == '0000-00-00')
                                            $fila['fecha_fin'] = "not indicated";

                                        echo "<td> " . $fila['fecha_fin'] . "</td>";

                                        if($fila['type']==1 )$fila['type']="Interested";
                                       else if($fila['type']==2 )$fila['type']="Committed";
                                       else if($fila['type']==3 )$fila['type']="Going"; 

                                        
                                        echo "<td> " . $fila['type'] . "</td>";
                                        echo '<td>   <a class="btn btn-warning" href="../trip.php?id='.$fila['id'].'" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   View
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
        }


        ],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });


</script>

<?php include_once './_bottom.php'; ?>