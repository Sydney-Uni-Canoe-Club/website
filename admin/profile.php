<?php
$titulo = "Profile";
include_once './_top.php';


$sql = "select id, avatar,nombre, name_pre,telefono, correo, id_numero,is_student, emergency_contact_name, emergency_contact_phone, tipo_usuario, status, 
fecha_pago, fechalimite_suscripcion from usuarios where id=" . $_SESSION["usr_id"];
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
    <?php
    if (isset($_SESSION["err"]) == true) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION["err"]; ?>
        </div>
        <?php unset($_SESSION["err"]);
    }

    if (isset($_SESSION["success"]) == true) {
        ?>
        <div class="alert alert-success" role="alert">
            Saved!
        </div>
        <?php unset($_SESSION["success"]);
    }
    if (isset($_SESSION["success_pay"]) == true) {
        ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION["success_pay"]; ?>

        </div>
        <?php unset($_SESSION["success_pay"]);
    } ?>
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->

        <?php

        if ($dias < $_SESSION["set_days_pay"] && $_SESSION["tipo_usuario"] == 2) {

            ?>

            <?php
            $sql = "SELECT stripe_creden, price_student, price_regu FROM settings";

            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);

            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <?php 
           
            if ((isset($_SESSION["question"]) == false) &&  $_SESSION["is_student"]==1) { ?>
                <script>
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        title: "Are you Student?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                       
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //yes

                            var type = 1;
                        } else {
                            //no

                            var type = 0;


                        }

                        $.ajax({
                            url: "./profile_student.php",
                            type: 'POST',
                            data: { is_student: type }
                        }).done(function () {

                            window.location.href = './profile.php';
                        });

                    });
                <?php } ?> 
            </script>
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="./pay_subs.php" id="payment-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Membership:</label>
                                        <select class="form-control" name="meses" id="meses" required>
                                            <option value="">select</option>

                                            <?php if ($fila["is_student"] == 1) { ?>
                                                <option value="<?php echo $row["price_student"]; ?>">12 months Student</option>
                                            <?php } else { ?>

                                                <option value="<?php echo $row["price_regu"]; ?>">12 months Regulars</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        Price:
                                        <br>
                                        <div id="total">----</div>
                                        <input type="hidden" id="monto" name="monto">
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="card-element">
                                            Tarjeta de crédito o débito:
                                        </label>
                                        <div id="card-element">
                                            <!-- Elemento de tarjeta de Stripe -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                </div>
                                <br> <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" id="pay_button" class="btn btn-primary mb-2">Pay</button>
                                        <div class="sendered"></div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div>
            </div> <!--end::Row-->
        <?php } ?>
        <br>
        <div class="row">
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">


                        <form method="post" enctype="multipart/form-data" action="./profile2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Member ID:</label>
                                    <input type="text" class="form-control" id="" name=""
                                        value="<?php echo $fila["id"]; ?>" readonly disabled>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $fila["nombre"]; ?>" required>

                                </div>
                                <div class="col-md-3">
                                    <label for="description" class="form-label">Preferred name:</label>
                                    <input type="text" class="form-control" id="name_pre" name="name_pre"
                                        value="<?php echo $fila["name_pre"]; ?>">

                                </div>
                                <div class="col-md-3">
                                    <label for="description" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="<?php echo $fila["telefono"]; ?>" required>

                                </div>
                                <div class="col-md-3">

                                    <div class="col-md-12">
                                        <input type="hidden" id="filename_avatar" name="filename_avatar"
                                            value="<?php echo $fila["avatar"]; ?>">

                                        <label for="avatar" class="form-label">Avatar Image:</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                            accept="image/png, image/jpeg" />
                                    </div>

                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?php echo $fila["correo"]; ?>" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="emerg_contact_name" class="form-label">Emergency contact name:</label>
                                    <input type="text" class="form-control" id="emerg_contact_name"
                                        name="emerg_contact_name" value="<?php echo $fila["emergency_contact_name"]; ?>"
                                        required>

                                </div>
                                <div class="col-md-4">
                                    <label for="emerg_contact_phone" class="form-label">Emergency contact phone:</label>
                                    <input type="text" class="form-control" id="emerg_contact_phone"
                                        name="emerg_contact_phone"
                                        value="<?php echo $fila["emergency_contact_phone"]; ?>" required>

                                </div>

                            </div><br>
                            <div class="row">
                                <input type="hidden" name="is_student" id="is_student"
                                    value="<?php echo $fila["is_student"]; ?>">
                                <?php if ($fila["is_student"] == 1) { ?>
                                    <div class="col-md-4">
                                        <label for="id_number" class="form-label">Student ID:</label>
                                        <input type="text" minlength="9" maxlength="9" class="form-control" id="id_number"
                                            name="id_number" value="<?php echo $fila["id_numero"]; ?>" required>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">password:</label>
                                    <input type="password" class="form-control" id="pass" name="pass">

                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Repeat password:</label>
                                    <input type="password" class="form-control" id="pass2" name="pass2">

                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date_last" class="form-label">Date last payment:</label>
                                    <input type="text" class="form-control" id="date_last" name="date_last"
                                        value="<?php echo $fila["fecha_pago"]; ?>" disabled>

                                </div>
                                <div class="col-md-4">
                                    <label for="due_date" class="form-label">Payment due date</label>
                                    <input type="text" class="form-control" id="due_date" name="due_date"
                                        value="<?php echo $fila["fechalimite_suscripcion"]; ?>" disabled>
                                </div>


                                <?php
                                $interval = date_diff(date_create(date('Y-m-d')), date_create($fila["fechalimite_suscripcion"]));
                                $dias = $interval->format('%R%a');
                                if ($dias < 0)
                                    $dias = 0
                                        ?>
                                    <div class="col-md-4">
                                        <label for="Remaining days" class="form-label">Remaining days</label>
                                        <input type="text" class="form-control" id="Remaining days" name="Remaining days"
                                            value="<?php echo $dias; ?>" disabled>
                                </div>

                            </div> <br> <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>

                                </div>
                            </div>
                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div> <!--end::Row-->
        <br>
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<script>


    var stripe = Stripe('<?php echo $row["stripe_creden"] ?>');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    });


    $("#meses").change(function () {



        var monto = parseFloat($("#meses").val());

        monto = monto.toFixed(2)
        $("#total").html("Total to pay: <strong>" + monto + "</strong>");
        $("#monto").val(monto);




    });


    $(document).ready(function () {


        $("form").submit(function () {
            displayError = document.getElementById('card-errors')
if(displayError.textContent=='')
{
            $('#pay_button').prop("disabled", true);

            $(".sendered").html("Loading...");
}   var refreshInterval =  window.setInterval(function(){
            $('#pay_button').prop("disabled", false);

$(".sendered").html("");



   }, 3000);
        });
        // true para desactivarlo o false para volverlo a activar

   
    }); 
</script>

<?php include_once './_bottom.php'; ?>