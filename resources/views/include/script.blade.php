<!-- jQuery -->
<script src="{{asset('/asset/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/asset/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/asset/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('/asset/plugins/iCheck/icheck.min.js')}}"></script>
<!-- Sweetalert2 -->
<script src="{{asset('asset/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('/asset/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/asset/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Data table -->
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('/asset/js/custom.min.js')}}"></script>

<script>
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000
        });

        @if(Session::has('success'))
        Toast.fire({
            icon: 'success',
            title: `{{Session::get('success')}}`
        })
        @elseif(Session::has('warning'))
        Toast.fire({
            icon: 'warning',
            title: `{{Session::get('warning')}}`
        })
        @elseif(Session::has('error'))
        Toast.fire({
            icon: 'error',
            title: `{{Session::get('error')}}`
        })
        @elseif(Session::has('info'))
        Toast.fire({
            icon: 'info',
            title: `{{Session::get('info')}}`
        })
        @endif

        // / Side navbar active start /
        // add active class and stay opened when selected
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function () {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function () {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        // / End side navbar active /

        //Initialize Select2 Elements
        // $('.select2').select2();
    })
</script>
