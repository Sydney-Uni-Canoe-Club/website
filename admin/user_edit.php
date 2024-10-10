<?php
$titulo = "Edit User";
include_once './_top.php';


if ($_SESSION["tipo_usuario"] != 1 && isset($_GET["id"]) == false) {

    header('Location: ./admin_user.php');
}
$sql = "select *  from usuarios where id=" . $_GET["id"];
$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);
if (is_null($fila) == true) {
    header('Location: ./admin_user.php');
}
?>
<script src="https://js.stripe.com/v3/"></script>
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">

        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["err"]) == true) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["err"]; ?>
                            </div>
                            <?php unset($_SESSION["err"]);
                        }
                        ?>
                        <form method="post" enctype="multipart/form-data" action="./user_edit2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $fila["nombre"]; ?>" required>
                                    <input type="hidden" class="form-control" id="id" name="id"
                                        value="<?php echo $fila["id"]; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="name_pre" class="form-label">Preferred Name (optional):</label>
                                    <input type="text" class="form-control" id="name_pre" name="name_pre"
                                        value="<?php echo $fila["name_pre"]; ?>">

                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="<?php echo $fila["telefono"]; ?>" required>
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
                                <div class="col-md-4">
                                    <div class="mb-3"> <input class="form-check-input" <?php if ($fila["is_student"] == 1)
                                        echo "checked"; ?> type="checkbox" value="" id="student" name="student">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            &nbsp; Is a student? </div>
                                    <input type="hidden" name="is_student" id="is_student"
                                        value="<?php echo $fila["is_student"]; ?>">
                                </div>
                                <div class="col-md-4">
                                    <div id="div_student">
                                        <?php if ($fila["is_student"] == 1) { ?>
                                            <div class="input-group mb-3"> <input required
                                                    value="<?php echo $fila["id_numero"]; ?>" minlength="9" maxlength="9"
                                                    type="text" class="form-control" name="id_numero"
                                                    placeholder="Student ID">
                                                <div class="input-group-text"> <span class="bi bi-person-vcard-fill"></span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                <textarea   id="comment" class="form-control" placeholder="Message"
													name="comment" rows="6"><?php echo $fila["comment"]; ?></textarea>
                                                    </div>  </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="pass" class="form-label">password:</label>
                                    <input type="password" class="form-control" id="pass" name="pass">

                                </div>

                            </div><br> <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1" <?php if ($fila["status"] == 1)
                                            echo "selected"; ?>>Active
                                        </option>
                                        <option value="0" <?php if ($fila["status"] == 0)
                                            echo "selected"; ?>>inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="tipo" class="form-label">Type of User:</label>
                                    <select class="form-control" name="tipo" id="tipo" required>

                                        <option value="3" <?php if ($fila["tipo_usuario"] == 2)
                                            echo "selected"; ?>>Trips
                                            Manager</option>
                                        <option value="2" <?php if ($fila["tipo_usuario"] == 2)
                                            echo "selected"; ?>>User
                                        </option>
                                        <option value="1" <?php if ($fila["tipo_usuario"] == 1)
                                            echo "selected"; ?>>
                                            Administrator</option>


                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Payment expire date: (optional)</label>
                                    <input type="date" class="form-control" id="expire_date" name="expire_date"
                                        value="<?php echo $fila["fechalimite_suscripcion"]; ?>">

                                </div>
                            </div> <br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                    <a class="btn btn-warning mb-2" href="./home.php" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
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
    <br>
    <div class="row">
        <div class="col-6">
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-12"> <!-- Default box Trip Leaders' Comments on this User -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Comments about member</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <table id="comments_trip" name="comments_trip">
                                            <thead>
                                                <th>User</th>
                                                <th>Comment</th>
                                            </thead>
                                            <?php $sql = "SELECT *,(SELECT  name_pre FROM `usuarios` WHERE id=c.husuario) as name_pre,(SELECT  nombre FROM usuarios WHERE id=c.husuario) as nombre FROM coments c WHERE husuario=" . $_GET['id'];
                                            $result = mysqli_query($link, $sql);
                                            while ($fila = mysqli_fetch_assoc($result)) {
                                                /*
                                                                                            $sql = "SELECT eb.*, u.nombre, u.correo FROM events_blog eb 
                                                                                            INNER JOIN usuarios u on u.id=eb.husuario where eb.hevent=" . $_GET["id"];
                                                                                                                                $result = mysqli_query($link, $sql);*/
                                                echo "<tr>";
                                                if ($fila["name_pre"] != '') {

                                                    $name = explode(" ", $fila["nombre"]);


                                                    $lastname = str_replace($name[0], "", $fila["nombre"]);


                                                    $fila['nombre'] = $name[0] . ' "' . $fila["name_pre"] . '"' . $lastname;

                                                }
                                                echo "<td> " . $fila['nombre'] . "</td>";

                                                echo "<td> ";

                                          
                                                $id_c = $fila["id"];
                                                $comment = $fila["comment"];
                                                ?>


                                                <form method="post" enctype="multipart/form-data"
                                                    action="./comments_atten.php">
                                                    <input type="hidden" name="id" value="<?php echo $id_c; ?>">

                                                    <input type="hidden" name="redir" value="user_edit.php">

                                                    Message:
                                                    <textarea id="msg" name="msg" rows="4" cols="50"
                                                        class="form-control email-msg"><?php echo $comment; ?></textarea>
                                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                                </form>

                                                <?php
                                                echo "</td>";


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
    </div>

</div> <!--end::Container-->
</div> <!--end::App Content-->
<script>
    $(function () {
        console.log("ready!");
        $('#student').change(
            function () {
                //div_student
                if ($(this).is(':checked')) {
                    $("#is_student").val('1');

                    html = '<div class="input-group mb-3"> <input required minlength="9" maxlength="9" type="text" class="form-control" name="id_numero" placeholder="Student ID">';
                    html += '<div class="input-group-text"> <span class="bi bi-person-vcard-fill"></span> </div>';
                    html += '</div>';
                    $("#div_student").html(html);

                } else {
                    $("#is_student").val('0');

                    $("#div_student").html('');

                }
            });

    });


</script>
<?php include_once './_bottom.php'; ?>