<?php
$titulo = "New User";
include_once './_top.php';






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
                        <h3 class="card-title">Import Users</h3>
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
                        <form method="post" enctype="multipart/form-data" action="./csv_users_import2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="csv" class="form-label">Select file . csv:</label>
                                    <input type="file" required class="form-control" id="csv" name="csv"
                                    accept=".csv"/>

                                </div>                            

                            </div>
                                                    
                          
                               <br>
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

                    html = '<div class="input-group mb-3"> <input required minlength="9" maxlength="9" type="text" class="form-control" name="number_id" placeholder="Student ID">';
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