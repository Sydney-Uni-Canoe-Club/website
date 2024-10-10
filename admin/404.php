<?php
session_start();
$titulo = "Home";
?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
  <script src="./dist/js/jquery-3.7.1.min.js"></script>
  <script src="./dist/js/dataTables.min.js"></script>
  <link href="./dist/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $titulo; ?></title><!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="title" content="AdminLTE 4 | Fixed Sidebar">
  <meta name="author" content="ColorlibHQ">
  <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
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
              data-bs-toggle="dropdown"> <img src="./dist/assets/img/avatar5.png"
                class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline"></span> </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
              <li class="user-header text-bg-primary"> <img src="./dist/assets/img/avatar5.png"
                  class="rounded-circle shadow" alt="User Image">
                <p>


                </p>
              </li> <!--end::User Image--> <!--begin::Menu Body-->

              <li class="user-footer"> <a href="./profile.php" class="btn btn-default btn-flat">Profile</a> <a
                  href="./logout.php" class="btn btn-default btn-flat float-end">Sign out</a> </li>
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
            class="brand-text fw-light">Trips</span> <!--end::Brand Text--> </a> <!--end::Brand Link-->
      </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item"> <a href="home.php" class="nav-link"> <i class="nav-icon bi bi-house-door-fill"></i>
                <p>Home</p>
              </a> </li>





          </ul> <!--end::Sidebar Menu-->
        </nav>
      </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
      <!-- Main content -->
      <section class="content">
        <div class="error-page">
          <h2 class="headline text-warning"> 404</h2>

          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

            <p>
              We could not find the page you were looking for.
              Meanwhile, you may <a href="./home.php">return to dashboard</a>
            </p>

          
          </div>
          <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
      </section>
    </main> <!--end::App Main--> <!--begin::Footer-->

  </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="./dist/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
      scrollbarTheme: "os-theme-light",
      scrollbarAutoHide: "leave",
      scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function () {
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
  </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
</body><!--end::Body-->

</html>