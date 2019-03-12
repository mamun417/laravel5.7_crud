<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>INSPINIA | Dashboard</title>

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-dropdownhover.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/jsTree/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom_style.css') }}" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    @include('admin.elments.sidebar')

    <div id="page-wrapper" class="gray-bg dashbard-1">

        @include('admin.elments.header')

        @yield('content')

        @include('admin.elments.footer')

    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('admin/js/jquery-3.1.1.min.js') }} "></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }} "></script>
<script src="{{ asset('admin/js/bootstrap-dropdownhover.min.js') }} "></script>
<script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }} "></script>
<script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }} "></script>

<!-- Flot -->
<script src="{{ asset('admin/js/plugins/flot/jquery.flot.js') }} "></script>
<script src="{{ asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js') }} "></script>
<script src="{{ asset('admin/js/plugins/flot/jquery.flot.spline.js') }} "></script>
<script src="{{ asset('admin/js/plugins/flot/jquery.flot.resize.js') }} "></script>
<script src="{{ asset('admin/js/plugins/flot/jquery.flot.pie.js') }} "></script>

<!-- Peity -->
<script src="{{ asset('admin/js/plugins/peity/jquery.peity.min.js') }} "></script>
<script src="{{ asset('admin/') }} js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('admin/js/inspinia.js') }} "></script>
<script src="{{ asset('admin/js/plugins/pace/pace.min.js') }} "></script>

<!-- jQuery UI -->
<script src="{{ asset('admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jsTree/jstree.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('admin/js/demo/sparkline-demo.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('admin/js/plugins/toastr/toastr.min.js') }}"></script>


<style>
    .jstree-open > .jstree-anchor > .fa-folder:before {
        content: "\f07c";
    }

    .jstree-default .jstree-icon.none {
        width: 0;
    }
</style>

<script>
    $(document).ready(function(){

        $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });

    });
</script>


</body>

</html>

