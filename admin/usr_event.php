<?php


$titulo = "Register for the event";
include_once './_top.php';



$id = $_GET["id"];

$sql = "select * from eventos where status=1 and cupo_limite>cupos_usados and id=" . $id;
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

?>

<script src="https://js.stripe.com/v3/"></script>
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
                        <h3 class="card-title">Do you want to register for this event?</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION["err"]) == true) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["err"]; ?>
                            </div>
                            <?php unset($_SESSION["err"]);
                        } ?>
                        <form method="post" enctype="multipart/form-data" id="payment-form" action="./usr_event2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    Name: <?php echo $fila["nombre"]; ?>
                                    <input type="hidden" class="form-control" id="nombre" name="nombre" value=" <?php echo $fila["nombre"]; ?>">
                                </div>
                                <div class="col-md-4">

                                    Description: <?php echo $fila["descripcion"]; ?>

                                </div>
                                <div class="col-md-4">
                                    Start date: <?php echo $fila["fecha_inicio"]; ?><br>
                                    <input type="hidden" class="form-control" id="fecha_inicio" name="fecha_inicio" value=" <?php echo $fila["fecha_inicio"]; ?>">
                                    <?php if ($fila["fecha_fin"] != '0000-00-00') { ?> end date:
                                        <?php echo $fila["fecha_fin"];
                                    } ?>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    Available places: <?php $diponible = $fila["cupo_limite"] - $fila["cupos_usados"];
                                    echo $diponible; ?>

                                </div>
                                <div class="col-md-4">

                                    <label for="places" class="form-label">I am..:</label>
                                    <input type="hidden" class="form-control" id="places" name="places" value="1"
                                        required>
                                    <?php if (isset($_GET["type"]) == true) $type_eve=$_GET["type"];else $type_eve=0; ?>
                                    <select required name="type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1" <?php if($type_eve==1) echo "selected" ?>>Interested</option>

                                        <option value="2"<?php if($type_eve==2) echo "selected" ?>>(I want to go) Committed</option>

                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <br>
                                    <div id="total">-</div>
                                    <input type="hidden" id="monto" name="monto">
                                </div>
                            </div>
                            <input type="hidden" id="id_evnt" name="id_evnt" value="<?php echo $id; ?>">
                            <div class="row">

                            </div>
                            <br><br>


                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                    <a class="btn btn-warning mb-2" href="../index.php" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        Back
                                    </a>
                                </div>
                            </div>


                        </form>

                    </div> <!-- /.card-body -->

                </div> <!-- /.card -->

            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->


</div> <!--end::App Content-->

<script>

    $("#places").change(function () {

        var precio = <?php echo $fila["precio"]; ?>;

        var places = $("#places").val();
        var monto = places * precio;

        //  $("#total").html( "Total to pay: <strong>"+monto+"</strong>" );
        //  $("#monto").val(monto);


    });
</script>
<?php include_once './_bottom.php'; ?>