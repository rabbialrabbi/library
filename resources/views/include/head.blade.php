<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="app-url" content="{{url('/')}}">
<link rel="icon" href="images/favicon.ico" type="image/ico" />

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Bootstrap -->
<link href="{{asset('/asset/plugins/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{asset('/asset/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('/asset/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!-- NProgress -->
<link href="{{asset('/asset/plugins/nprogress/nprogress.css')}}" rel="stylesheet">
<!-- iCheck -->
<link href="{{asset('/asset/plugins/iCheck/skins/flat/green.css')}}" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="{{asset('/asset/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="{{asset('/asset/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<!-- Sweetalert2 -->
<link rel="stylesheet" href="{{asset('asset/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/plugins/select2/css/select2.min.css')}}">

<!-- Custom Theme Style -->
<link href="{{asset('/asset/css/custom.css')}}" rel="stylesheet">
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
