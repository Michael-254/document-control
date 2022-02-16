<!DOCTYPE html>
<html lang="en">

<head>
    <title>BGF | Document Control</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/dist/img/logo.png')}}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Select2 -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- dropzonejs -->
    @yield('styles')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    @livewireStyles
    <style>
        .success {
            background-color: #006400;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav text-sm">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light success">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="{{asset('assets/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-white">Dashboard <i class="fas fa-caret-down"></i></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{route('dashboard')}}" class="dropdown-item">My Uploaded Docs</a></li>
                                <li><a href="{{route('my.access')}}" class="dropdown-item">My Accessible Docs</a></li>
                                <li><a href="{{route('document.create')}}" class="dropdown-item">Upload Document</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-white">HOD Review <i class="fas fa-caret-down"></i></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{route('hod.it')}}" class="dropdown-item">IT</a></li>
                                <li><a href="{{route('hod.me')}}" class="dropdown-item">M&E</a></li>
                                <li><a href="{{route('hod.Forestry')}}" class="dropdown-item">Forestry</a></li>
                                <li><a href="{{route('hod.Accounts')}}" class="dropdown-item">Accounts</a></li>
                                <li><a href="{{route('hod.Operations')}}" class="dropdown-item">Operations</a></li>
                                <li><a href="{{route('hod.MITI')}}" class="dropdown-item">Miti Magazine</a></li>
                                <li><a href="{{route('hod.Communications')}}" class="dropdown-item">Communications</a></li>
                                <li><a href="{{route('hod.HR')}}" class="dropdown-item">Human Resources</a></li>
                                <li class="dropdown-divider"></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('qc.table')}}" class="text-white nav-link">QC/WP Review</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('md.table')}}" class="text-white nav-link">QC&MGT Review/Approval</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('imp.table')}}" class="text-white nav-link">Implementation</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-white">Docs Management <i class="fas fa-caret-down"></i></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{route('document.logs')}}" class="dropdown-item">Doc Logs</a></li>
                                <li class="dropdown-divider"></li>
                            </ul>
                        </li>

                    </ul>

                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="far fa-user text-white"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <div class="p-2 rounded-md flex justify-between font-bold">
                                    <p>{{auth()->user()->job_title ?? ''}}</p>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="hover:text-blue-600 font-bold cursor-pointer" :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i>
                                        </a>
                                    </form>
                                </div>
                        </li>
                    </ul>
                </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="text-green-800 font-bold">Document Control App</h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{Request::segment(1)}}</a></li>
                                <li class="breadcrumb-item active">{{Request::segment(2)}}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            {{$slot}}
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Better Globe Forestry
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 <a href="https://document.betterglobeforestry.co.ke">Document Control App</a>.</strong> All rights reserved.
        </footer>
    </div>
    @livewireScripts
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    {!! Toastr::message() !!}
    @yield('scripts')
    <!-- Page specific script -->
</body>

</html>