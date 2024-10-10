<?php




include_once "./config.php";

if (isset($_SESSION['usr_id'])==TRUE)
header('Location: ./home.php');



?>



<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->
<head>
<script src="./dist/js/jquery-3.7.1.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Register Page</title><!--begin::Primary Meta Tags-->
    <link rel="icon" href="../img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Forgot Password">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="register-page bg-body-secondary">
    <div class="register-box">
        <div class="register-logo"> Register </div> <!-- /.register-logo -->
        <div class="card">
       <?php if (isset($_SESSION["err"]) == true) {
             
                ?>
                <div class="alert alert-danger" role="alert">
               <?php echo $_SESSION["err"];?>
                </div>
            <?php
   unset($_SESSION["err"]);

            } ?>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form action="./registering.php" method="post">
                    <div class="input-group mb-3"> <input required type="text" name="import_field1" class="form-control" placeholder="Full Name" onkeypress="return not_numbers(event)">
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                     
                    <div class="input-group mb-3"> <input type="text" name="import_field2" class="form-control" placeholder="Preferred Name (optional)" onkeypress="return not_numbers(event)">
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-3"> <input required type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    </div>
                    <div class="input-group mb-3"> <input required type="password"  name="pass" class="form-control" placeholder="Password">
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div>
                   
                    
                    <div class="input-group mb-3"> <input required type="text" name="phone" class="form-control" placeholder="Phone" onkeypress="return numbers(event)">
                        <div class="input-group-text"> <span class="bi bi-phone-fill"></span> </div>
                    </div>

                    <div class="input-group mb-3"> <input required type="text" name="emerg_contact_name" class="form-control" placeholder="Emergency contact name" onkeypress="return not_numbers(event)">
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-3"> <input required type="text" name="emerg_contact_phone" class="form-control" placeholder="Emergency contact Phone" onkeypress="return numbers(event)">
                        <div class="input-group-text"> <span class="bi bi-phone-fill"></span> </div>
                    </div>
                    <div class="mb-3"> <input class="form-check-input" type="checkbox" value="" id="student" name="student"> <label class="form-check-label" for="flexCheckDefault">
                    &nbsp; Are you a student?  </div>
                    <input type="hidden" name="is_student"  id="is_student" value="0">
                    <div id="div_student"></div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                    I agree to the <a href="#">terms</a> </label> </div>
                        </div> <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2"> <button disabled type="submit" id="singin" class="btn btn-primary">Sign In</button> </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
        
                <p class="mb-0"> <a href="./login.php" class="text-center">
                        I already have a membership
                    </a> </p>
            </div> <!-- /.register-card-body -->
        </div>
    </div> <!-- /.register-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>


    $(function() {
    console.log( "ready!" );
    $('#student').change(
    function(){
        //div_student
        if ($(this).is(':checked')) {
            $("#is_student").val('1');
            
            html='<div class="input-group mb-3"> <input required type="text" class="form-control" name="number_id" placeholder="Student ID">';
            html+=       '<div class="input-group-text"> <span class="bi bi-person-vcard-fill"></span> </div>';
            html+=     '</div>';
            $( "#div_student" ).html( html );
           
        }else{
            $("#is_student").val('0');
          
            $( "#div_student" ).html('');

        }
    });

    


    $('#flexCheckDefault').change(
    function(){
      
        if ($(this).is(':checked')) {
            $('#singin').prop("disabled", false);
           
        }else{
            $('#singin').prop("disabled", true);
        }});


});


        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });

        function numbers(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789+";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}


function not_numbers(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnopqrstuvwxyz ";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}



    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
</body><!--end::Body-->

</html>