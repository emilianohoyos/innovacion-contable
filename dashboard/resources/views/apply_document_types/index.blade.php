@extends('layouts.master')

@section('title', 'Tipo Documento Solicitud')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Tipo Solicitud" pagetitle="Tipo Documento Solicitud" />
    <div class="card">
        <div class="card-body">
            <div class="d-grid">
                <a href="{{ route('applydocumenttype.create') }}" class="btn btn-primary btn-block" type="button">
                    Crear Nuevo Tipo Documento Solicitud
                </a>
            </div>
            <div class="table-responsive mt-3">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo Documento Solicitud</th>
                            <th>Tipo Solicitud</th>
                            <th>Es requerido?</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applyDocumentType as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->document_type }}</td>
                                <td>{{ $item->apply_type }}</td>
                                <td>{{ $item->is_required == 1 ? 'SI' : 'NO' }}</td>
                                <td>
                                    <div class="d-inline-flex gap-0">
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button>

                                        <button type="button" onclick="confirmDelete()"
                                            class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                            <i class="material-icons-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        @endforeach



                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tipo Documento Solicitud</th>
                            <th>Tipo Solicitud</th>
                            <th>Es requerido?</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('employees.modals.edit')

@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function confirmDelete() {
            Swal.fire({
                title: '¿Estás seguro de Eliminar el cliente?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario de eliminación
                    // document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    {{-- <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script> --}}
@endsection
