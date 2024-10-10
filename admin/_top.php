<?php
include_once "./config.php";



if (isset($_SESSION["usr_id"]) == false) {
    $_SESSION["redirect"] = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    unset($_SESSION['usr_id']);
    header('Location: ./login.php');

} else {

    //status 1 
    if ($_SESSION["status"] == 0) {
        ///need activation
        $_SESSION["waiting"] = "You need to activate your user, check your inbox.";
        unset($_SESSION['usr_id']);
        header('Location: ./login.php');
    }
    //status pay

    $interval = date_diff(date_create(date('Y-m-d')), date_create($_SESSION["fecha_limite"]));
    $dias = $interval->format('%R%a');
    $array = explode('/', $_SERVER['REQUEST_URI']);

    if (isset($_SESSION["set_days_pay"]) == false) {
        $sql = "SELECT * FROM settings";

        $result = mysqli_query($link, $sql);
        $settings = mysqli_fetch_assoc($result);
        $_SESSION["set_days_pay"] = $settings["days_pay"];
    }

   // if (((end($array) != 'profile.php') && (end($array) != 'home.php')) && $_SESSION["tipo_usuario"] == 2)
        if ((end($array) != 'profile.php') && $_SESSION["tipo_usuario"] == 2) {
            if ($dias < $_SESSION["set_days_pay"]) {
                $_SESSION["err"] = "Payment Required";
                header('Location: ./profile.php');
            }
        }


    /*
    //status pay
    $interval = date_diff( date_create(date('Y-m-d')), date_create($fila["fechalimite_suscripcion"]));
    $dias= $interval->format('%R%a');
        
        if($dias<5)
        {
            $_SESSION["err"]="you need to make a single payment";
            header('Location: ./profile.php');
        }
        */
}




?>


<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <script src="./dist/js/jquery-3.7.1.min.js"></script>
    <script src="./dist/js/dataTables.min.js"></script>
    <link href="./dist/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $titulo; ?></title><!--begin::Primary Meta Tags-->
    <link rel="icon" href="../img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Fixed Sidebar">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->

    <!-- DataTables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <?php if(end($array) != 'profile.php') {?>
    
    <script>
        $(document).ready(function ($) {

            $('textarea').summernote({
                height: 150,   // Altura del editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ]
            });

        });

    </script>
    <?php }?>

</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                                class="bi bi-list"></i> </a> </li>

                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->


                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"> <img <?php
                            if ($_SESSION["avatar"] == '') {
                                ?>src="./dist/assets/img/avatar5.png" <?php } else { ?>
                                    src="./uploads/avatar/<?php echo $_SESSION["avatar"]; ?>" <?php } ?>
                                class="user-image rounded-circle shadow" alt="User Image"> <span
                                class="d-none d-md-inline"><?php echo $_SESSION['usr_nombre'] ?></span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->


                            <li class="user-header text-bg-primary"> <img <?php
                            if (is_null($_SESSION["avatar"]) == '') {
                                ?>src="./dist/assets/img/avatar5.png" <?php } else { ?>
                                        src="./uploads/avatar/<?php echo $_SESSION["avatar"]; ?>" <?php } ?>
                                    class="rounded-circle shadow" alt="User Image">
                                <p>


                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->

                            <li class="user-footer"> <a href="./profile.php"
                                    class="btn btn-default btn-flat">Profile</a> <a href="./logout.php"
                                    class="btn btn-default btn-flat float-end">Sign out</a> </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../index.php" class="brand-link">
                    <!--begin::Brand Image--> <img src="../img/logo2.png" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                        class="brand-text fw-light">Sydney Uni Canoe Club</span> <!--end::Brand Text--> </a>
                <!--end::Brand Link-->
            </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item"> <a href="home.php" class="nav-link"> <i
                                    class="nav-icon bi bi-house-door-fill"></i>
                                <p>Guidelines</p>
                            </a> </li>

                        <li class="nav-item"> <a href="../index.php#trips" class="nav-link"> <i
                                    class="nav-icon bi bi-calendar-event-fill"></i>
                                <p>Trip Calendar</p>
                            </a> </li>


                        <?php

                        if ($_SESSION["tipo_usuario"] == 1 || $_SESSION["tipo_usuario"] == 3) {
                            ?>
                            <li class="nav-item"> <a href="mytrips.php" class="nav-link"> <i
                                        class="nav-icon bi bi-calendar-event-fill"></i>
                                    <p>Trips Editor</p>
                                </a> </li>
                            <!--
                                <li class="nav-item"> <a href="blog.php" class="nav-link"> <i
                                        class="nav-icon bi bi-calendar-event-fill"></i>
                                    <p>Trips Blog</p>
                                </a> </li>-->
                            <?php

                        }
                        ?>
                        <li class="nav-item"> <a href="my_events.php" class="nav-link"> <i
                                    class="nav-icon bi bi-house-door-fill"></i>
                                <p>My Trips</p>
                            </a> </li>
                        <?php

                        if ($_SESSION["tipo_usuario"] == 1) {
                            ?>


                            <li class="nav-item menu-close"> <a href="#" class="nav-link active"> <i
                                        class="nav-icon bi bi-speedometer"></i>
                                    <p>
                                        Administrator
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"> <a href="contact_form.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Contact Form</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="newsletter.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Newsletter</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="settings.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Settings</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="events.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Trips</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="category.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Trips category</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="admin_user.php" class="nav-link"> <i
                                                class="nav-icon bi bi-calendar-event-fill"></i>
                                            <p>Users</p>
                                        </a> </li>






                                </ul>
                            </li>


                            <?php

                        } ?>




                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->