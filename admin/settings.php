<?php
$titulo = "Settings";
include_once './_top.php';

if ($_SESSION["tipo_usuario"] != 1) {

    header('Location: ./home.php');

}

$sql = "SELECT * FROM settings";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <div class="card-body"><?php
                    if (isset($_SESSION["tipo"]) == true) {
                        unset($_SESSION["tipo"]);
                        ?>
                            <div class="alert alert-success" role="alert">
                                Saved!
                            </div>
                            <?php
                    }
                    if (isset($_SESSION["message"]) == true) {

                        ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION["message"]; ?>
                            </div>
                            <?php unset($_SESSION["message"]);
                    } ?>

                        <form method="post" enctype="multipart/form-data" action="./settings2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="days_pay" class="form-label">Days before membership's renewal is
                                        possible:</label>
                                    <input type="number" class="form-control" id="days_pay" name="days_pay"
                                        value="<?php echo $row["days_pay"]; ?>" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="price_student" class="form-label">Membership price for students:</label>
                                    <input type="number" step=0.01 class="form-control" id="price_student"
                                        name="price_student" value="<?php echo $row["price_student"]; ?>" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="price_regu" class="form-label">Membership price for regulars:</label>
                                    <input type="number" step=0.01 class="form-control" id="price_regu"
                                        name="price_regu" value="<?php echo $row["price_regu"]; ?>" required>

                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="stripe_creden" class="form-label">Stripe's API Key:</label>
                                    <input type="text" class="form-control" id="stripe_creden" name="stripe_creden"
                                        value="<?php echo $row["stripe_creden"]; ?>" minlength="100" required>

                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="stripe_secret" class="form-label">Stripe's Secret:</label>
                                    <input type="text" class="form-control" id="stripe_secret" name="stripe_secret"
                                        value="<?php echo $row["stripe_secret"]; ?>" minlength="100" required>

                                </div>

                            </div>

                            <br>
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
    </div> <!--end::Container-->

    <br>
    <div class="col-12">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Homepage Carrusel</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <form method="post" enctype="multipart/form-data" action="./setting_gallery.php">

                                    <div class="row">
                                        <div class="col-12">


                                            <div class="col-md-12">
                                                <label for="gallery" class="form-label">Choose an image:</label>
                                                <input type="file" required class="form-control" id="gallery"
                                                    name="gallery[]" accept="image/png, image/jpeg" multiple />
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary mb-2">Add Slide</button>
                                        </div>
                                    </div>


                                </form>

                            </div>


                            <br><br><br>
                            <div class="row">
                                <div class="col-12">
                                    <table id="gallery_tb" class="table table-striped" name="gallery_tb">
                                        <thead>
                                            <th>Image</th>
                                            <th>Text</th>
                                            <th>Order</th>
                                            <th>Option</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT  * FROM gallery_home order by order_pic";
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <form method="post" enctype="multipart/form-data" action="./settings_gallery_text.php">
                                                <?php   
                                                echo "<tr>";

                                                echo "<td> <img class='img-fluid rounded float-left'   style='width:300px' src='./uploads/img/" . $fila['img'] . "' > </td>";
                                                ?>
                                                <td>Title:<textarea id="<?php echo $fila["id"]; ?>" name="text" rows="1"
                                                        cols="50" class="form-control txt-gallery">
                     <?php echo $fila["text"]; ?>
                    </textarea>
<input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                                                    Text:
                                                    <textarea id="text_2" name="text_2" rows="4" cols="50"
                                                        class="form-control txt-gallery2">
                     <?php echo $fila["text_2"]; ?>
                    </textarea><button type="submit" class="btn btn-primary mb-2">Save</button>
                                                </td>
                                                
                                            </form>
                                            <td>
                                                <input type="number" class="form-control order-pic"
                                                    id="<?php echo $fila["id"]; ?>" name="order_pic"
                                                    value="<?php echo $fila["order_pic"]; ?>">
                                            </td>
                                            <td> <a class="btn btn-danger"
                                                    href="./setting_gallery_delete.php?id=<?php echo $fila['id']; ?> "
                                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    delete
                                                </a></td>
                                            <?php

                                            echo "</tr>";
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>


                        </div>

                    </div> <!-- /.card -->

                </div>
            </div> <!--end::Row-->
        </div>
    </div>


    <br>
    <div class="col-12">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Email Templates </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    You can use variables Like:<br>
                                    <b>!name!</b> for adding the name of the menber<br>
                                    <b>!email!</b> gor adding the menber's email<br>
                                    <b>!name_eve!</b> for adding the event name (when it applies)<br>
                                    <b>!date!</b> for adding the event date (when it applies) <br>
                                    <b>!status!</b> for adding the event status of the user (when it applies)<br>
                                    <b>!cat_eve!</b> for adding the event category (when it applies)<br>
                                    <b>!url_pay!</b> for adding the link's payment from user (when it applies)<br>
                                    
                                    <b>!url_email!</b> for adding the activation email from user (when it applies)<br>
                                    

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <table id="email_tb" class="table table-striped" name="email_tb">
                                        <thead>
                                            <th>Type Email</th>

                                            <th>Email</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT * FROM `email_template`order by type_email";
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            ?>
                                            <td>
                                                <?php echo $fila["type_email"]; ?>
                                            </td>
                                            <td><form method="post" enctype="multipart/form-data" action="./settings_email.php">
                                            <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                                            Subject:<textarea id="subject" name="subject" rows="1"
                                                    cols="50"
                                                    class="form-control email-subject"><?php echo $fila["subject"]; ?></textarea>
                                                Message:
                                                <textarea id="msg" name="msg" rows="4" cols="50"
                                                    class="form-control email-msg"><?php echo $fila["msg"]; ?></textarea>
                                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                                    </form>
                                                </td>


                                            <?php

                                            echo "</tr>";
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>


                        </div>

                    </div> <!-- /.card -->

                </div>
            </div> <!--end::Row-->
        </div>
    </div>


</div> <!--end::App Content-->


<script>

    $(function () {
        console.log("readyss!");

        $(".order-pic").change(function () {
            $.ajax({
                url: "./settings_gallery_order.php",
                type: 'POST',
                data: { order: $(this).val(), id: $(this).attr('id') }
            }).done(function () {
                console.log('change order');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Saved",
                    showConfirmButton: false,
                    timer: 1000
                });
            });
        });



    });




    var email_tb = $('#email_tb').DataTable({
        "oPaginate": true,
        "bLengthChange": false,
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
        }],
        "lengthMenu": [
            [-1],
            ["All"]
        ],

    });


</script>



<?php include_once './_bottom.php'; ?>