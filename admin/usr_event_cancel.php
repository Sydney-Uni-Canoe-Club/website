<?php




$titulo = "Cancel for the event";
include_once './_top.php';



$id = $_GET["id"];

$sql = "select * from eventos where status=1 and cupo_limite>cupos_usados and id=" . $id;
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
if (is_null($fila) == true) {
    header('Location: ./home.php');
die();
}


$sql ="SELECT id FROM evento_usuario WHERE hevento=$id and husuario=".$_SESSION["usr_id"];
$result = mysqli_query($link, $sql);
$exist = mysqli_fetch_assoc($result);


if (is_null($exist) == true) {
    header('Location: ./home.php');
die();
}


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
                        <h3 class="card-title">Do you want CANCEL for this event?</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION["err"]) == true) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["err"]; ?>
                            </div>
                            <?php unset($_SESSION["err"]);
                        } ?>
                        <form method="post" enctype="multipart/form-data" id="payment-form" action="./usr_event_cancel2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    Name: <?php echo $fila["nombre"]; ?>
                                    <input type="hidden" class="form-control" id="nombre" name="nombre" value=" <?php echo $fila["nombre"]; ?>">
                                </div>
                                <div class="col-md-4">

                                    Description: <?php echo $fila["descripcion"]; ?>

                                </div>
                                <div class="col-md-4">
                                <input type="hidden" class="form-control" id="fecha_inicio" name="fecha_inicio" value=" <?php echo $fila["fecha_inicio"]; ?>">
                                    Start date: <?php echo $fila["fecha_inicio"]; ?><br>
                                    <?php if ($fila["fecha_fin"] != '0000-00-00') { ?> end date:
                                        <?php echo $fila["fecha_fin"];
                                    } ?>

                                </div>
                            </div>
                            <br>
                           
                            <input type="hidden" id="id_evnt" name="id_evnt" value="<?php echo $id; ?>">
                            <div class="row">

                            </div>
                            <br><br>


                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Yes, Cancel</button>
                                    <a class="btn btn-warning mb-2" href="../trip.php?id=<?php echo $id; ?>" role="button"
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