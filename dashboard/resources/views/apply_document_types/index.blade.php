@extends('layouts.master')

@section('title', 'Tipo Documento')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <x-page-title title="Tipo Documento"><a href="{{ route('applydocumenttype.create') }}" class="btn btn-primary btn-block"
            type="button">
            Nuevo
        </a>
    </x-page-title>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo Documento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applyDocumentType as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="d-inline-flex gap-0">
                                        <!-- Button trigger modal -->
                                        {{-- <button type="button"
                                            class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button> --}}

                                        <button type="button"
                                            onclick="confirmDelete({{ $item->id }},'{{ $item->name }}')"
                                            class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                            <i class="material-icons-outlined">delete</i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
            });
        });

        function confirmDelete(document_type_id, document_type_name) {
            Swal.fire({
                title: `¿Estás seguro de Eliminar el tipo de documento: ${document_type_name}?`,
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/applydocumenttype/${document_type_id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw err;
                                });
                            }
                            return response.json();
                        })
                        .then(result => {
                            isLoading(false)
                            Swal.fire({
                                icon: 'success',
                                title: 'Se ha eliminado el tipo de solicitud',
                                text: 'El tipo de solicitud se ha eliminado exitosamente.',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                // Redirigir a la página de creación de empleado
                                window.location.href = '/applydocumenttype';

                            });
                        })
                        .catch(error => {
                            isLoading(false)
                            if (error.errors) {
                                // Muestra los errores de validación al usuario
                                console.error('Errores de validación:', error.errors);
                                alert('Errores de validación: ' + JSON.stringify(error.errors));
                            } else {
                                alert('Error al registrar tipo de solicitud');
                            }
                        });
                }
            });
        }
    </script>

@endsection
