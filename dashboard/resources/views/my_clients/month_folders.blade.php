@extends('layouts.master')

@section('title', 'Carpeta del Cliente')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <x-page-title title="Carpeta del Cliente" pagetitle="Carpeta del Cliente" />


    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carpetas Mensuales</h5>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="yearFilter" class="form-label">Año</label>
                            <select id="yearFilter" class="form-select">
                                <option value="">Todos</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="monthFilter" class="form-label">Mes</label>
                            <select id="monthFilter" class="form-select">
                                <option value="">Todos</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="monthlyFoldersTable">
                            <thead>
                                <tr>
                                    <th>Carpeta</th>
                                    <th>Archivos Nuevos?</th>
                                    <th>Año</th>
                                    <th>Mes</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('my_clients.modals.comments-folder')
    @include('my_clients.modals.documents')
    @include('my_clients.modals.upload-documents')
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#monthlyFoldersTable').DataTable({
                "language": {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('client-monthly-accounting-data', ['clientId' => $clientId]) }}",
                    data: function(d) {
                        d.year = $('#yearFilter').val();
                        d.month = $('#monthFilter').val();
                    }
                },
                columns: [{
                        data: 'client_folder.folder.name',
                        name: 'client_folder.folder.name'
                    },
                    {
                        data: 'is_new',
                        name: 'is_new',
                        render: function(data) {
                            return data ? 'Sí' : 'No';
                        }
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'month_year',
                        name: 'month_year',
                        render: function(data) {
                            const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                                'Diciembre'
                            ];
                            let mesNum = parseInt(data, 10);
                            return meses[mesNum - 1] || data;
                        }
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data) {
                            return data ? 'Activo' : 'Desactivado';
                        }
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#yearFilter, #monthFilter').on('change', function() {
                table.ajax.reload();
            });
        });


        function downloadFile(id) {
            // Define la URL del endpoint
            const url = "{{ route('file.download') }}";

            // Realiza la solicitud POST
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        id: id
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error ${response.status}: ${response.statusText}`);
                    }
                    return response.blob(); // Obtiene el contenido como un Blob
                })
                .then(blob => {
                    // Crea un enlace para descargar el archivo
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = id; // Nombre del archivo descargado
                    link.click();
                })
                .catch(error => {
                    console.error('Error al descargar el archivo:', error);
                });
        }

        // Cambia el estado de la carpeta mensual (activo/desactivado)
        function toggleFolderStatus(id) {
            fetch('/monthly-accounting-folder/toggle-status/' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Estado actualizado',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                        $('#monthlyFoldersTable').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'No se pudo cambiar el estado.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cambiar el estado.'
                    });
                });
        }

        function openCommentsModal(id, nameClient) {
            $('#commentsModal').modal('show');
            document.getElementById('nameClient').textContent = `Agregar comentario al Folder ${nameClient}`;
            document.getElementById('monthly_accounting_folder_id').value = id;
            loadComments(id)
        }

        async function saveComment() {
            const monthly_accounting_folder_id = document.getElementById('monthly_accounting_folder_id').value
            const comment = document.getElementById('comment').value
            if (!comment.trim()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'El comentario no puede estar vacío',
                });
                return
            }
            try {
                const response = await fetch(`/monthly-accounting-folder/comment/${monthly_accounting_folder_id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'applcation/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        monthly_accounting_folder_id: monthly_accounting_folder_id,
                        comment: comment
                    })
                })
                if (!response.ok) {
                    throw new Error('Error al guardar el comentario')
                }

                const result = await response.json()
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Comentario guardado exitosamente.',
                    confirmButtonText: 'Aceptar'
                });

                // Limpiar el campo de comentario
                document.getElementById('comment').value = '';

                // Actualizar los comentarios en la tabla
                await loadComments(monthly_accounting_folder_id);
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al guardar el comentario',
                });
            }

        }
        async function loadComments(monthly_accounting_folder_id) {
            try {
                // Obtener los comentarios desde la API
                const response = await fetch(`/monthly-accounting-folder/comment/${monthly_accounting_folder_id}`);

                if (!response.ok) {
                    throw new Error('Error al cargar los comentarios');
                }

                const comments = await response.json();

                // Referencia al cuerpo de la tabla
                const tableBody = document.querySelector('#commentsModal table tbody');

                // Limpiar las filas existentes
                tableBody.innerHTML = '';

                // Insertar las nuevas filas
                comments.forEach(comment => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                <td>${comment.description}</td>
                <td>${new Date(comment.created_at).toLocaleString()}</td>
                <td>${comment.author}</td>
            `;

                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al cargar los comentarios',
                });
            }
        }


        function openDocumentsModal(monthlyAccountingFolderId) {
            $('#documentsModal').modal('show');
            // Inicializa o recarga el DataTable con AJAX
            if ($.fn.DataTable.isDataTable('#documentsTable')) {
                $('#documentsTable').DataTable().destroy();
            }
            $('#documentsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `/monthly-accounting-folder/${monthlyAccountingFolderId}/documents`,

                },
                columns: [{
                        data: 'tipo_documento',
                        name: 'tipo_documento'
                    },
                    {
                        data: 'is_new',
                        name: 'is_new'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'path',
                        name: 'path',
                    }
                ],
                language: {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
                destroy: true
            });
        }

        function openUploadResponseModal(monthlyAccountingFolderId) {
            $('#uploadDocumentsModal').modal('show');
            document.getElementById('monthly_accounting_folder_id').value = id;
        }
    </script>
@endsection
