<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.head')
        @stack('style')
    </head>
    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('include.sidebar')

            <!-- top navigation -->
            @include('include.navbar')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
               @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Library - developed by <a href="http://ranowar.herokuapp.com/">rabbialrabbi@gmail.com</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    @include('include.script')
    @stack('js')
    </body>
</html>
