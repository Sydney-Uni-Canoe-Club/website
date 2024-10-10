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
                        <h3 class="card-title">New User</h3>
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
                        <form method="post" enctype="multipart/form-data" action="./new_user2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"  required>

                                </div>

                                <div class="col-md-4">
                                    <label for="description" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"  required>

                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"  required>

                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Emergency contact:</label>
                                    
                                    <textarea id="emerg_contact"class="form-control" name="emerg_contact" rows="4" cols="50"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Identification number:</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" 
                                        required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="date1" class="form-label">password:</label>
                                    <input type="password" class="form-control" id="pass" name="pass">

                                </div>
                              
                            </div><br> <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="tipo" class="form-label">Type of User:</label>
                                    <select class="form-control" name="tipo" id="tipo" required>
                                        <option value="2">User</option>
                                        <option value="1">Administrator</option>
                                    </select>
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


</div> <!--end::Container-->
</div> <!--end::App Content-->

<?php include_once './_bottom.php'; ?>