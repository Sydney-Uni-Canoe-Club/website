<?php 
$titulo = "New Category";
include_once './_top.php';

if($_SESSION["tipo_usuario"]!=1){   
    header('Location: ./home.php');  
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

                        <form method="post" enctype="multipart/form-data" action="./category_new2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>

                                </div>
                                

                            </div>
                            <br>
                        
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>

                                    <a class="btn btn-warning mb-2" href="./events.php" role="button"
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
    $("#date1").change(function(){
        $("#date2").val('');
        $("#date2").attr("min", $("#date1").val());
});
</script>

<?php include_once './_bottom.php'; ?>