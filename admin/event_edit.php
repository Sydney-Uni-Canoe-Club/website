<?php
$titulo = "Trips Edit";
include_once './_top.php';



if (($_SESSION["tipo_usuario"] == 1) && isset($_GET["id"]) == false) {

    header('Location: ./events.php');

}

$sql = "select *  from eventos where id=" . $_GET["id"];

$result = mysqli_query($link, $sql);
$fila = mysqli_fetch_assoc($result);


if (is_null($fila) == true) {
    header('Location: ./events.php');

}
$id = $fila["id"];


?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?php echo $titulo . " - " . $fila["nombre"]; ?></h3>
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
                        <?php
                        if (isset($_SESSION["message"]) == true) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION["message"]; ?>
                            </div>
                            <?php
                            unset($_SESSION["message"]);
                        } ?>
                        <form method="post" enctype="multipart/form-data" action="./event_edit2.php">
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary"
                                        href="./mytrips_notify_email.php?redirect=event_edit.php?id=<?php echo $_GET['id']; ?>&id=<?php echo $_GET['id']; ?> "
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Promote
                                    </a>
                                </div>
                            </div>
                            <br> <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>

                                    <input type="hidden" class="form-control" id="id" name="id"
                                        value="<?php echo $fila["id"]; ?>">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $fila["nombre"]; ?>" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Description:</label>

                                    <textarea required id="description" class="form-control" name="description"
                                        rows="6"><?php echo $fila["descripcion"]; ?></textarea>

                                </div>
                                <div class="col-md-2">
                                    <label for="description" class="form-label">number of places:</label>
                                    <input type="number" class="form-control" id="coupons" name="coupons"
                                        value="<?php echo $fila["cupo_limite"]; ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label">Location:</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        value="<?php echo $fila["location"]; ?>" required>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">start date:</label>
                                    <input type="date" class="form-control" id="date1" name="date1"
                                        value="<?php echo $fila["fecha_inicio"]; ?>" required>

                                </div>

                                <div class="col-md-2">
                                    <label for="hour" class="form-label">hour</label>

                                    <input type="time" class="form-control" id="hour" name="hour" min="08:00"
                                        max="20:00" value="<?php echo $fila["hour"]; ?>" required />

                                </div>
                                <div class="col-md-2">
                                    <label for="hour" class="form-label">Hour to finish</label>

                                    <input type="time" class="form-control" id="hour_end" name="hour_end" min="08:00"
                                        max="20:00" value="<?php echo $fila["hour_end"]; ?>" required />

                                </div>
                                <div class="col-md-4">
                                    <label for="date2" class="form-label">final date: (optional date)</label>
                                    <input type="date" class="form-control" id="date2" name="date2"
                                        min="<?php echo $fila["fecha_fin"]; ?>"
                                        value="<?php echo $fila["fecha_fin"]; ?>" #date2placeholder="optional date">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="hcategory" class="form-label">Category:</label>
                                    <select name="hcategory" id="hcategory" class="form-control" required>


                                        <option value="">Select</option>
                                        <?php
                                        $sql = "select * from events_category where status=1 order by name";
                                        $result = mysqli_query($link, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row["id"]; ?>" <?php if ($fila["hcategory"] == $row["id"])

                                                   echo "selected"; ?>>
                                                <?php echo $row["name"]; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <input type="hidden" id="old_image_main" name="old_image_main"
                                        value="<?php echo $fila["img"]; ?>">
                                    <label for="avatar" class="form-label">Main Image:</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar"
                                        accept="image/png, image/jpeg" />
                                </div>
                                <div class="col-md-4">
                                    <label for="avatar" class="form-label">Main Image:</label>
                                    <br>
                                    <?php
                                    if ($fila['img'] != '') {
                                        echo "<img class='expand-img img-fluid rounded float-left ' width='40%' src='./uploads/trips/" . $fila['img'] . "' >";
                                        ?>
                                        <a class="btn btn-danger"
                                            href="./main_img_delete.php?id=<?php echo $fila['id']; ?>&redic=event_edit.php"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Delete Main Image
                                        </a>
                                        <?php
                                    } else
                                        echo "Main image Not Found"
                                            ?>

                                    </div>
                                </div>
                                <br>
                                <div class="row"></div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if ($fila["status"] == 1)
                                        echo "selected" ?>>Public
                                        </option>
                                        <option value="2" <?php if ($fila["status"] == 2)
                                        echo "selected" ?>>Draft
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-4">
                                    <label for="husuario" class="form-label">User:</label>
                                    <select name="husuario" id="husuario" class="form-control" required>


                                        <option value="" <?php /*if ($fila["status"] == 1)

echo "selected"*/ ?>>Select
                                    </option>
                                    <?php
                                    $sql = "select id, nombre, correo from usuarios where tipo_usuario in (1,3) order by nombre";
                                    $result = mysqli_query($link, $sql);
                                    while ($users = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $users["id"]; ?>" <?php if ($users["id"] == $fila["husuario"])

                                               echo "selected"; ?>>
                                            <?php echo $users["nombre"] . " ------ email:" . $users["correo"]; ?>
                                        </option>

                                    <?php } ?>
                                </select>

                            </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary mb-2">Save</button>

                            <a class="btn btn-warning mb-2" href="./events.php" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
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
<br>


<div class="row">


    <div class="col-6">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendes</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary"
                                        href="./email_trips.php?redirect=event_edit.php?id=<?php echo $_GET['id']; ?>&id=<?php echo $_GET['id']; ?> "
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Email everyone
                                    </a>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-12">
                                    <table id="users" name="users">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Phone</th>
                                            <th>Option</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT eu.id, eu.hevento, name_pre, eu.husuario, eu.cupos, u.nombre, u.correo, u.telefono, eu.type FROM evento_usuario eu 
                            INNER JOIN usuarios u on u.id=eu.husuario where eu.hevento=" . $_GET["id"];
                                        $result_attendes = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result_attendes)) {
                                            echo "<tr>";
                                            if ($fila["name_pre"] != '') {

                                                $name = explode(" ", $fila["nombre"]);


                                                $lastname = str_replace($name[0], "", $fila["nombre"]);


                                                $fila['nombre'] = $name[0] . ' "' . $fila["name_pre"] . '"' . $lastname;

                                            }
                                            echo "<td>";
                                            echo "<a target='_blank' href='../user_profile.php?id=" . $fila['husuario'] . "'>" . $fila['nombre'] . "</a>";
                                            echo "</td>";

                                            echo "<td>";
                                            // echo "<a href='mailto:" . $fila['correo'] . "'>" . $fila['correo'] . "</a>";
                                        
                                            echo "<a style='--bs-btn-color: #ffffff;' class='btn btn-info'  href='mailto:" . $fila['correo'] . "'role='button' aria-expanded='false'
                                        aria-controls='collapseExample'>Open default email client</a>";
                                            echo "</td>";

                                            echo "<td> ";
                                            ?>

                                            <select id="<?php echo $fila['id'] ?>" class="form-control type">

                                                <option <?php if ($fila["type"] == 1)
                                                    echo "selected"; ?> value="1">Interested
                                                </option>
                                                <option <?php if ($fila["type"] == 2)
                                                    echo "selected"; ?> value="2">Committed
                                                </option>
                                                <option <?php if ($fila["type"] == 3)
                                                    echo "selected"; ?> value="3">Going
                                                </option>
                                            </select>
                                            <?php
                                            echo "</td>";
                                            echo "<td> " . $fila['telefono'] . "</td>";
                                            echo '<td>   <a class="btn btn-warning" href="./mytrips_email_send.php?redirect=event_edit.php?id=' . $_GET['id'] . '&email=' . $fila['correo'] . '" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                       Send
                                    </a></td>';
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

    <div class="col-6">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gallery</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <form method="post" enctype="multipart/form-data" action="./event_gallery.php">

                                    <div class="row">
                                        <div class="col-12">

                                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                            <div class="col-md-12">
                                                <label for="gallery" class="form-label">Gallery Image:</label>
                                                <input type="file" required class="form-control" id="gallery"
                                                    name="gallery[]" accept="image/png, image/jpeg" multiple />
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary mb-2">Save</button>
                                        </div>
                                    </div>


                                </form>

                            </div>


                            <br><br><br>
                            <div class="row">
                                <div class="col-12">
                                    <table id="gallery_tb" name="gallery_tb">
                                        <thead>
                                            <th>image</th>
                                            <th>option</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT  * FROM events_galery WHERE hevent=" . $_GET["id"];
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td> <img class='img-fluid rounded float-left'   src='./uploads/trips/" . $fila['img'] . "' > </td>";
                                            ?>
                                            <td> <a class="btn btn-danger"
                                                    href="./event_gallery_delete.php?id=<?php echo $fila['id']; ?> "
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



</div> <!--end::App Content-->
<br>
<div class="row">


    <div class="col-6">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Comments</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <table id="comments" name="comments">
                                        <thead>
                                            <th>Name</th>
                                            <th>Comment</th>
                                            <th>Image</th>
                                            <th>Option</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT eb.*, u.nombre, u.correo FROM events_blog eb 
    INNER JOIN usuarios u on u.id=eb.husuario where eb.hevent=" . $_GET["id"];
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td> " . $fila['nombre'] . "</td>";
                                            echo "<td> " . $fila['comment'] . "</td>";
                                            echo "<td> <img class='img-fluid rounded float-left'   src='./uploads/comments/" . $fila['img'] . "' > </td>";
                                            echo "<td> ";
                                            ?>

                                            <select id="<?php echo $fila['id'] ?>" class="form-control comment-status">

                                                <option <?php if ($fila["status"] == 0)
                                                    echo "selected"; ?> value="">
                                                    Select</option>
                                                <option <?php if ($fila["status"] == 1)
                                                    echo "selected"; ?> value="1">
                                                    Hidden</option>
                                                <option <?php if ($fila["status"] == 2)
                                                    echo "selected"; ?>value="2">Show</option>
                                            </select>
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
    <div class="col-6">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Trip Leader's comments on attendees</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <table id="comments_trip" name="comments_trip">
                                        <thead>
                                            <th>User</th>
                                            <th>Comment</th>
                                        </thead>
                                        <?php mysqli_data_seek($result_attendes, 0);

                                        while ($fila = mysqli_fetch_assoc($result_attendes)) {
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

                                            $sql = "SELECT comment FROM usuarios WHERE  id=" . $fila['husuario'];
                                            $result = mysqli_query($link, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                                                                         
                                                $comment = $row["comment"];

                                            ?>


                                            <form method="post" enctype="multipart/form-data" action="./comments_atten.php">
                                                <input type="hidden" name="id" value="<?php echo $id_c; ?>">
                                                <input type="hidden" name="hevent" value="<?php echo $_GET["id"]; ?>">
                                                <input type="hidden" name="husuario"
                                                    value="<?php echo $fila['husuario']; ?>">
                                                <input type="hidden" name="redir" value="event_edit.php">

                                                
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


</div> <!--end::App Content-->

<script>
    $("#date1").change(function () {
        $("#date2").val('');
        $("#date2").attr("min", $("#date1").val());
    });

    $(function () {
        console.log("ready!");

        $(".type").change(function () {
            $.ajax({
                url: "./change_user_type.php",
                type: 'POST',
                data: { new_type: $(this).val(), id: $(this).attr('id') }
            }).done(function () {
                console.log('change type');

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Saved",
                    showConfirmButton: false,
                    timer: 1000
                });
            });
        });


        $(".comment-status").change(function () {
            if ($(this).val() != '') {
                $.ajax({
                    url: "./change_comment_status.php",
                    type: 'POST',
                    data: { new_status: $(this).val(), id: $(this).attr('id') }
                }).done(function () {
                    console.log('change comment');

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Saved",
                        showConfirmButton: false,
                        timer: 1000
                    });
                });
            }
        });


    });


    var comments = $('#comments').DataTable({
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
        }],
        "lengthMenu": [
            [2, 3, 4, 5, 6, -1],
            [2, 3, 4, 5, 6, "All"]
        ],

    });



    var comments_trip = $('#comments_trip').DataTable({
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
        }],
        "lengthMenu": [
            [2, 3, 4, 5, 6, -1],
            [2, 3, 4, 5, 6, "All"]
        ],

    });

    var users = $('#users').DataTable({
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
        }

        ],
        "lengthMenu": [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],

    });

    var gallery_tb = $('#gallery_tb').DataTable({
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
        }],
        "lengthMenu": [
            [2, 3, 4, 5, 6, -1],
            [2, 3, 4, 5, 6, "All"]
        ],

    });

</script>
<?php include_once './_bottom.php'; ?>