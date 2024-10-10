<?php


$titulo = "Contact from ";
include_once './_top.php';



$id = $_GET["id"];

$sql = "select * from  contact where id=" . $id;
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);

?>

<script src="https://js.stripe.com/v3/"></script>
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-12">
                <h3 class="mb-0"><?php echo $titulo; ?><?php echo $fila["name"] . ". Email: " . $fila["email"]; ?></h3>
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
                        <h3 class="card-title">Message</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION["err"]) == true) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["err"]; ?>
                            </div>
                            <?php unset($_SESSION["err"]);
                        } ?>
                        <form method="post" enctype="multipart/form-data" id="payment-form" action="./contact_form_see2.php">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $fila["message"]; ?>
                                </div>
                            </div>
<br>
                            <div class="row">

                                <div class="row">
                                    <div class="col-md-12">
                                    <input type="hidden" id="id" name="id"
                                    value="<?php echo $fila["id"]; ?>">
                                        <input type="hidden" id="email" name="email"
                                            value="<?php echo $fila["email"]; ?>">
                                            Reply:
                                        <textarea required id="reply" class="form-control" placeholder="reply"
                                            name="reply" rows="6"> <?php echo $fila["reply"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                   <br>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary mb-2">Send reply</button>
                            <a class="btn btn-warning mb-2" href="./contact_form.php" role="button"
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