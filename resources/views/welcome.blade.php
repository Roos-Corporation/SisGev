<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SisGev - Sistema Gerenciamento de Evento</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- End fonts -->
        <!-- core:css -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/core/core.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/flatpickr/flatpickr.min.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('../assets/fonts/feather-font/css/iconfont.css') }}">
        <link rel="stylesheet" href="{{ asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('../assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('../assets/vendors/font-awesome/css/font-awesome.min.css') }}">
        <!-- End plugin css for this page -->

        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('../assets/css/demo2/style.css') }}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('../assets/images/favicon.png') }}" />

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
        <!-- End plugin css for this page -->



        @vite('resources/css/app.css')
    </head>
    <body >
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>

    <!-- core:js -->
    <script src="{{ asset('../assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

	<script src="{{ asset('../assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/select2/select2.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/dropzone/dropzone.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/dropify/dist/dropify.min.js') }}"></script>
	<script src="{{ asset('../assets/vendors/moment/moment.min.js') }}"></script>

	<!-- Plugin js for this page -->
    <script src="{{ asset('../assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
	<!-- End plugin js for this page -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('../assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('../assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('../assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->

	<!-- Custom js for this page -->
    <script src="{{ asset('../assets/js/data-table.js') }}"></script>
    <!-- End custom js for this page -->

	<!-- Custom js for this page -->
	<script src="{{ asset('../assets/js/form-validation.js') }}"></script>
	<script src="{{ asset('../assets/js/bootstrap-maxlength.js') }}"></script>
	<script src="{{ asset('../assets/js/inputmask.js') }}"></script>
	<script src="{{ asset('../assets/js/select2.js') }}"></script>
	<script src="{{ asset('../assets/js/typeahead.js') }}"></script>
	<script src="{{ asset('../assets/js/tags-input.js') }}"></script>
	<!-- End custom js for this page -->

</html>
