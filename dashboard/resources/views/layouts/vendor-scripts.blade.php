<script src="{{ URL::asset('dist/js/bootstrap.bundle.min.js') }}"></script>

<!--plugins-->
<script src="{{ URL::asset('dist/js/jquery.min.js') }}"></script>
<!--plugins-->
<script src="{{ URL::asset('dist/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ URL::asset('dist/plugins/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('dist/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('dist/js/main.js') }}"></script>
<script src="{{ URL::asset('dist/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('select').select2({
            theme: 'bootstrap-5',
            width: 'resolve',
            allowClear: true,
            closeOnSelect: true, // No cierra el menú al seleccionar una opción
            // Contenedor del paso actual
        });
    });

    window.isLoading = function(show) {
        const spinner = document.getElementById('loadingSpinner');
        if (show) {
            spinner.style.display = 'flex'; // Muestra el spinner
        } else {
            spinner.style.display = 'none'; // Oculta el spinner
        }
    };
</script>
