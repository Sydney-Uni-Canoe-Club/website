<?php


$titulo = "Trips Category";
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
            if (isset($_SESSION["message"]) == true) {
           
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION["message"];?>
                </div>
                <?php
                unset($_SESSION["message"]);
            } ?>
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Here you can rename the trip categories</h3>
                    </div>
                    <div class="card-body">

                     
                     
                        <div class="row">
                            <div class="col-12">
                                <table id="tabla_eventos" name="tabla_eventos">
                                    <thead>
                                        <th>Name</th>                                       
                                        <th>Status</th>                                       
                                        <th>Options</th>
                                    </thead>


                                    <?php

                                    $sql = "select * from events_category ec";

                                    $result = mysqli_query($link, $sql);
                                    while ($fila = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td> " . $fila['name'] . "</td>";
                                     

                                        if ($fila['status'] == 1)
                                            $fila['status'] = "Active";
                                        else
                                            $fila['status'] = "Inactive";

                                        echo "<td> " . $fila['status'] . "</td>";
                                    
                                   
                                        echo '<td>   <a class="btn btn-warning" href="./category_edit.php?id=' . $fila['id'] . '" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Edit
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
        }

        ],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });


</script>

<?php include_once './_bottom.php'; ?>