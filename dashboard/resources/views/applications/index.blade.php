@extends('layouts.master')

@section('title', 'Solicitudes')
@section('css')

@endsection
@section('content')
    <x-page-title title="Solicitudes" pagetitle="Solicitudes" />

    <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-medium flex-wrap font-text1">
        <a href="javascript:;"><span class="me-1">Todo</span><span class="text-secondary">(100)</span></a>
        <a href="javascript:;"><span class="me-1">Solicitud incial</span><span class="text-secondary">(10)</span></a>
        <a href="javascript:;"><span class="me-1">Tarea en Ejecucion</span><span class="text-secondary">(17)</span></a>
        <a href="javascript:;"><span class="me-1">Finalizada</span><span class="text-secondary">(88754)</span></a>
    </div>

    <div class="row g-3">
        <div class="col-auto">
            <div class="position-relative">
                <input class="form-control px-5" type="search" placeholder="Buscar Solicitud">
                <span
                    class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
            </div>
        </div>
        <div class="col-auto flex-grow-1 overflow-auto">
            <div class="btn-group position-static">
                <div class="btn-group position-static">
                    <button type="button" class="btn btn-filter dropdown-toggle px-4" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Estado
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Solicitud Inicial</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Tarea en Ejecución</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Finalizada</a></li>
                    </ul>
                </div>
                <div class="btn-group position-static">
                    <button type="button" class="btn btn-filter dropdown-toggle px-4" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Tipo Solicitud
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Tarea</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Solicitud Inicial</a></li>
                    </ul>
                </div>
                <div class="btn-group position-static">
                    <button type="button" class="btn btn-filter dropdown-toggle px-4" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Prioridad
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Critica</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Alta</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Normal</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a href="{{ route('application.create') }}" class="btn btn-primary px-4"><i
                        class="bi bi-plus-lg me-2"></i>Realizar Nueva solicitud</a>
            </div>
        </div>
    </div><!--end row-->

    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>id</th>
                                <th>Tipo Solicitud</th>
                                <th>Identificación</th>
                                <th>Cliente</th>
                                <th>Fecha Estimda solicitud</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Tarea
                                </td>
                                <td>Identificación</td>
                                <td>Carlos Hoyos</td>
                                <td>02-02-2024</td>
                                <td>
                                    Alta
                                </td>
                                <td>
                                    <select name="" class="form-control" id="">
                                        <option value="Solicitud Inicial">Solicitud Inicial</option>
                                        <option value="Tarea en Ejecución">Tarea en Ejecución</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                </td>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('applications.modals.edit')
    @include('applications.modals.comments')
@endsection
@section('scripts')

    <script src="{{ URL::asset('dist/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
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
