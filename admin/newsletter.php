<?php
$titulo = "Newsletter";
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
            <div class="col-md-8"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                    <div class="row">
                            <div class="col-12">
                                <a class="btn btn-primary" href="./newsletter_email.php" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Email everyone
                                </a>
                            </div>
                        </div>
<br>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tabla" class="table" name="tabla">
                                    <thead>
                                        <th>date</th>
                                        <th>Email </th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $sql = "select *  from newsletter";

                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td> " . $fila['date'] . "</td>";
                                            echo "<td> " . $fila['email'] . "</td>";
                                            echo '<td>   <a class="btn btn-warning" href="./email_send.php?redirect=newsletter&email='. $fila['email'] . '" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                   Send
                                </a>';
                                echo '   <a class="btn btn-danger" href="./newsletter_delete.php?id='. $fila['id'].'" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                               Delete
                            </a></td>';
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
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


    var producto = $('#tabla').DataTable({
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
        }],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });


</script>

<?php include_once './_bottom.php'; ?>