@extends('layouts.master')

@section('title', 'Clientes')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Clientes" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NIT/identificacion</th>
                            <th>Nombre/Razón social</th>
                            <th>Tipo Persona</th>
                            <th>Dirección</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>
                                <div class="d-inline-flex gap-0">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-light raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#commentsModal">
                                        <i class="material-icons-outlined">add_comment</i>
                                    </button>
                                    <button type="button" onclick="confirmDelete()"
                                        class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>
                                <div class="d-inline-flex gap-0">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-light raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#commentsModal">
                                        <i class="material-icons-outlined">add_comment</i>
                                    </button>
                                    <button type="button" onclick="confirmDelete()"
                                        class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>
                                <div class="d-inline-flex gap-0">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-light raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#commentsModal">
                                        <i class="material-icons-outlined">add_comment</i>
                                    </button>
                                    <button type="button" onclick="confirmDelete()"
                                        class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>
                                <div class="d-inline-flex gap-0">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-light raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#commentsModal">
                                        <i class="material-icons-outlined">add_comment</i>
                                    </button>
                                    <button type="button" onclick="confirmDelete()"
                                        class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>
                                <div class="d-inline-flex gap-0">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-light raised d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#commentsModal">
                                        <i class="material-icons-outlined">add_comment</i>
                                    </button>
                                    <button type="button" onclick="confirmDelete()"
                                        class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>
                                </div>
                            </td>

                        </tr>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NIT/identificacion</th>
                            <th>Nombre/Razón social</th>
                            <th>Tipo Persona</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('clients.modals.edit')
    @include('clients.modals.comments')
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
