<!doctype html>
<!-- <html lang="fr" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="md" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed" > -->
<html lang="fr" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-layout-width="fluid" >

<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <!-- Layout config Js -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/mystyle.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- gridjs css -->

</head>

<body style="background-color:#f3f3f3;" >
    
    <?php $log = \App\Models\GiwuSociete::logoSoc(); ?>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.header')
        <!-- ========== App Menu ========== -->
        @include('layouts.menug')
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content" id="giwugeneral">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">{{ config('app.name') }}</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Accueil</a></li>
                                        <!-- <li class="breadcrumb-item active">Projects</li> -->
                                            @yield('path_content')
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row project-wrapper">
                        @yield('content')
                    </div><!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- Footer -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- confTemplate -->
    @include('layouts.confTemplate')

    @yield('JS_content')
    <!-- JAVASCRIPT -->
    <!-- <script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script> -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- projects js -->
    <script src="{{ asset('assets/js/pages/dashboard-projects.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
    <!-- App js -->
            <!-- gridjs js -->
    <!-- <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script> 
     <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script> -->
     <script src="{{asset('assets/js/pages/modal.init.js')}}"></script>
     <script src="{{asset('assets/js/pages/notifications.init.js')}}"></script>
     
     <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
     <script src="{{asset('assets/js/pages/sweetalerts.init.js')}}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.allselect').select2();
        });
    
        //Fonction sur la recherche
        function refreshEcole(){
            
            var etablis_id = document.getElementById('etablis_id').value;
            var filtreData = $("#formSearch").serialize();
            return $.ajax({
                url: '{{ url("/chargeEcole/")}}',data: filtreData,type: 'GET',
                success: function (e) {
                    if(etablis_id != '-1'){
                        
                        window.location.reload();
                    }
                },error: function (data) {},
            });
        };
    </script>
</body>

</html>