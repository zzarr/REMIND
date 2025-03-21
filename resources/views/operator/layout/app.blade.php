<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>


    <meta charset="utf-8" />
    <title>REMAIN | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    @vite(['resources/js/app.js'])



    <!-- App css -->

    @include('components.head-css')
    @stack('css')


</head>

<body id="body">
    <!-- leftbar-tab-menu -->
    @include('components.left-sidebar')
    <!-- end leftbar-tab-menu-->

    <!-- Top Bar Start -->
    <!-- Top Bar Start -->
    @include('components.topbar')
    <!-- Top Bar End -->
    <!-- Top Bar End -->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Operator</a>
                                    </li><!--end nav-item-->
                                    <li class="breadcrumb-item active"><a href="#">@yield('title')</a>
                                    </li><!--end nav-item-->
                                </ol>
                            </div>
                            <h4 class="page-title">@yield('title')</h4>
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div>
                @yield('content')

            </div><!-- container -->

            <!--Start Footer-->
            <!-- Footer Start -->
            <footer class="footer text-center text-sm-start">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> Metrica <span class="text-muted d-none d-sm-inline-block float-end">Crafted
                    with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
            </footer>
            <!-- end Footer -->
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->


    @include('components.script')
    @stack('script')
    <script>
        $(document).ready(function() {
            document.addEventListener("click", function(event) {
                let dropdownToggle = document.querySelector(
                ".nav-link.dropdown-toggle"); // Pilih elemen <a> sebagai toggle
                let dropdownMenu = document.querySelector(".dropdown-menu"); // Pilih menu dropdown

                // Jika klik terjadi di luar dropdown toggle dan dropdown menu, tutup dropdown
                if (dropdownToggle && dropdownMenu.classList.contains("show") &&
                    !event.target.closest(".nav-link.dropdown-toggle") &&
                    !event.target.closest(".dropdown-menu")) {

                    let dropdownInstance = bootstrap.Dropdown.getInstance(dropdownToggle);
                    if (dropdownInstance) {
                        dropdownInstance.hide();
                    }
                }
            });


        });
    </script>



</body>
<!--end body-->

</html>
