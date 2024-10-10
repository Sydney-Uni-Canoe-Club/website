

<?php
$titulo="Home";


include_once './_top.php';
  


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
                        <?php
                    if (isset($_SESSION["tipo"]) == true) {
                unset($_SESSION["tipo"]);
                ?>
                <div class="alert alert-success" role="alert">
                
                <?php if(isset($_SESSION["msg"]) == true) echo $_SESSION["msg"];else echo "Recorded event!"; ?>
                </div>
            <?php
            } ?>
                        <div class="col-12"> <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <div class="card-body">
                                    Welcome to the system, the side menu will take you wherever you want.
                                </div> <!-- /.card-body -->
                            
                            </div> <!-- /.card -->
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->


                </div> <!--end::App Content-->
       

                <?php include_once './_bottom.php';  ?>