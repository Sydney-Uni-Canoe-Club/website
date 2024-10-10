<?php


$titulo = "Send Email - " . $_GET["redirect"] . " - " . $_GET["email"];
include_once './_top.php';



?>

<script src="https://js.stripe.com/v3/"></script>
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-12">
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
                        <form method="post" enctype="multipart/form-data" action="./email_send2.php">
                            <div class="row">

                                <div class="col-md-12">
                                    <input required type="text" id="subject" class="form-control" name="subject"
                                        placeholder="subject">
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">

                                    <input type="hidden" id="redirect" name="redirect"
                                        value="<?php echo $_GET["redirect"]; ?>">

                                    <input type="hidden" id="email" name="email" value="<?php echo $_GET["email"]; ?>">

                                    <textarea required id="reply" class="form-control" placeholder="reply" name="reply"
                                        rows="6"></textarea>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Send email</button>
                                    <a class="btn btn-warning mb-2" href="./<?php echo $_GET["redirect"]; ?>.php"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Back
                                    </a>
                                </div>
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