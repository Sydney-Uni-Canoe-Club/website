<?php 
$titulo = "Category edit";
include_once './_top.php';

if($_SESSION["tipo_usuario"]!=1){   
    header('Location: ./home.php');  
  } 


  $sql = "select *  from events_category where id=".$_GET["id"];

  $result = mysqli_query($link, $sql);
 $fila = mysqli_fetch_assoc($result);


if(is_null($fila)==true)
{
    header('Location: ./category.php');

}


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
                    <div class="card-body">
                    <?php
                        if (isset($_SESSION["message"]) == true) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION["message"]; ?>
                            </div>
                            <?php unset($_SESSION["message"]);
                        }                     
                        ?>
                        <form method="post" enctype="multipart/form-data" action="./category_edit2.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="hidden"  id="id" name="id" value="<?php echo $fila["id"];?>">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $fila["name"];?>" required>

                                </div>
                                <div class="col-md-4">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" class="form-control" >
  <option value="1" <?php if($fila["status"]==1) echo "selected" ?>>Active</option>
  <option value="0" <?php if($fila["status"]==0) echo "selected" ?> >Inactive</option>

</select>
                                 
                                </div>    

                            </div>
                            <br>
                        
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>

                                    <a class="btn btn-warning mb-2" href="./category.php" role="button"
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

    <br>
    <div class="col-12">
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12"> <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Default image</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <form method="post" enctype="multipart/form-data" action="./category_gallery.php">

                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" name="id" value="<?php echo $fila['id'];?>" />
                                        
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
                                            
                                            <th>Order</th>
                                            <th>Option</th>
                                        </thead>
                                        <?php
                                        $sql = "SELECT  * FROM events_category_img where hcategory=".$fila['id']." order by type";
                                        $result = mysqli_query($link, $sql);
                                        while ($fila = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";


                                            echo "<td> <img class='img-fluid rounded float-left'   style='width:300px' src='./uploads/trips/" . $fila['img'] . "' > </td>";
                                            ?>
                      
                                            <td>
                                            <label for="hcategory" class="form-label">Type:</label>
                                    <select name="<?php echo $fila['id']; ?>" id="<?php echo $fila['id']; ?>" class="form-control type">


                                      
                                        <option value="1" <?php if ($fila["type"] == 1) echo "selected"; ?> >Main</option>
                                        <option value="2" <?php if ($fila["type"] == 2) echo "selected"; ?> >Gallery</option>
                   
                                    </select>
                                            </td>
                                            <td> <a class="btn btn-danger"
                                                    href="./category_delete_img.php?id=<?php echo $fila['id']; ?> "
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




<script>  
    $("#date1").change(function(){
        $("#date2").val('');
        $("#date2").attr("min", $("#date1").val());
});

$(function () {
        console.log("ready!");

        $(".type").change(function () {
            $.ajax({
                url: "./change_img__category_type.php",
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
    });
</script>

<?php include_once './_bottom.php'; ?>