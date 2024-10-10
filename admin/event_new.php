<?php
$titulo = "New Trip";
include_once './_top.php';

if ($_SESSION["tipo_usuario"] == 2) {
    header('Location: ./events.php');
}
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
            <div class="col-12"> <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">

                        <form method="post" enctype="multipart/form-data" action="./event_new2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Description:</label>                                 
                                        <textarea required  id="description" class="form-control" 
                                        name="description" rows="6"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="description" class="form-label">number of places:</label>
                                    <input type="number" class="form-control" id="coupons" name="coupons" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label">Location:</label>
                                    <input type="text" class="form-control" id="location" name="location"   required>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">start date:</label>
                                    <input type="date" class="form-control" id="date1"
                                        min="<?php echo date("Y-m-d"); ?>" name="date1" required>

                                </div>
                                <div class="col-md-2">
                                    <label for="hour" class="form-label">hour</label>

                                    <input type="time"  class="form-control" id="hour" name="hour" min="08:00" max="20:00" required />

                                </div>
                                <div class="col-md-2">
                                    <label for="hour_end" class="form-label"> Hour to finish</label>

                                    <input type="time"  class="form-control" id="hour_end" name="hour_end" min="08:00" max="20:00" required />

                                </div>
                                <div class="col-md-4">
                                    <label for="date2" class="form-label">final date: (optional date)</label>
                                    <input type="date" class="form-control" id="date2" name="date2"
                                        placeholder="optional date">

                                </div>
                            
                               
                                
                           


                            </div><br>
                            <div class="row">     <div class="col-md-4">
                                    <label for="hcategory" class="form-label">Category:</label>
                                    <select name="hcategory" id="hcategory" class="form-control" required>


                                        <option value="" <?php /*if ($fila["status"] == 1)

                      echo "selected"*/ ?>>Select</option>
                                        <?php
                                        $sql = "select * from events_category where status=1 order by name";
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $fila["id"]; ?>"><?php echo $fila["name"]; ?></option>

                                        <?php } ?>
                                    </select>

                                </div>
                            <div class="col-md-4">
                                <label for="husuario" class="form-label">User:</label>
                                <select name="husuario" id="husuario" class="form-control">


                                    <option value="" <?php /*if ($fila["status"] == 1)

                      echo "selected"*/ ?>>Select</option>
                                    <?php
                                    $sql = "select id, nombre, correo from usuarios where tipo_usuario in (1,3) order by nombre";
                                    $result = mysqli_query($link, $sql);
                                    while ($fila = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $fila["id"]; ?>" <?php if ($fila["id"] == $_SESSION["usr_id"])

                                               echo "selected"; ?>>
                                            <?php echo $fila["nombre"] . " ------ email:" . $fila["correo"]; ?></option>

                                    <?php } ?>
                                </select>

                                </div>  
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Public
                                            </option>
                                            <option value="2" >Draft
                                            </option>

                                        </select>

                                    </div>
                            
                            </div>  <br>
                            <div class="row">
                            <div class="col-md-4">
                                    <label for="avatar" class="form-label">Main Image:</label>
                                    <input type="file"  class="form-control" id="avatar" name="avatar"
                                        accept="image/png, image/jpeg" />
                                </div>
                                <div class="col-md-4">
                                    <label for="gallery" class="form-label">Gallery Image:</label>
                                    <input type="file"  class="form-control" id="gallery" name="gallery[]"
                                        accept="image/png, image/jpeg" multiple />
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
                    </div>

                    </form>

                </div> <!-- /.card-body -->

            </div> <!-- /.card -->

        </div>
    </div> <!--end::Row-->
</div> <!--end::Container-->


</div> <!--end::App Content-->




<script>
    $("#date1").change(function () {
        $("#date2").val('');
        $("#date2").attr("min", $("#date1").val());
    });
</script>

<?php include_once './_bottom.php'; ?>