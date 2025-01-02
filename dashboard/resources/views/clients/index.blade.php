@extends('layouts.master')

@section('title', 'Clientes')
@section('css')
    <link href="{{ URL::asset('dist/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Clientes" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-client" class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>NIT/identificacion</th>
                            <th>Nombre/Razón social</th>
                            <th>Tipo Persona</th>
                            <th>Correo</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>

                            <th>NIT/identificacion</th>
                            <th>Nombre/Razón social</th>
                            <th>Tipo Persona</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('clients.modals.edit')
    @include('clients.modals.comments')
    @include('clients.modals.add_folder')
@endsection
@section('scripts')

    <script src="{{ URL::asset('dist/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tbl-client').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('client.data') }}',
                columns: [{
                        data: 'nit',
                        name: 'nit'
                    }, {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'person_type',
                        name: 'person_type'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },


                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });
        let items = [];

        function addFolder($id, $nameClient) {
            $('#addFolderModal').modal('show');
            document.getElementById('nameClient').textContent = `Nombre Cliente ${$nameClient}`;
            document.getElementById('client_id').value = $id;
        }

        function addComment(id, nameClient) {
            $('#commentsModal').modal('show');
            document.getElementById('nameClient').textContent = `Agregar comentario al Cliente ${nameClient}`;
            document.getElementById('client_id').value = id;
            loadComments(id)
        }

        async function saveComment() {
            const clientId = document.getElementById('client_id').value
            const comment = document.getElementById('comment').value
            if (!comment.trim()) {
                alert('El comentario No puede estar vacio')
                return
            }
            try {
                const response = await fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'applcation/json'
                    },
                    body: JSON.stringify({
                        client_id: clientId,
                        comment: comment
                    })
                })
                if (!response.ok) {
                    throw new Error('Error al guardar el comentario')
                }

                const result = await response.json()
                alert('Comentario guardado exitosamente');

                // Limpiar el campo de comentario
                document.getElementById('comment').value = '';

                // Actualizar los comentarios en la tabla
                await loadComments(clientId);
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un problema al guardar el comentario');
            }

        }
        async function loadComments(clientId) {
            try {
                // Obtener los comentarios desde la API
                const response = await fetch(`/api/comments/${clientId}`);

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
                <td>${comment.text}</td>
                <td>${comment.date}</td>
                <td>${comment.author}</td>
            `;

                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un problema al cargar los comentarios');
            }
        }


        $('#addFolderModal').on('shown.bs.modal', function() {
            const clientId = $('#client_id').val();
            if (!clientId) {
                alert('El Id del cliente no esta definido.');
                return;
            }
            $.ajax({
                    url: `/clients/${clientId}/folders`,
                    method: 'GET',
                    success: function(response) {
                        $('#itemsTable tbody').empty();
                        items = []

                        response.forEach(doc => {
                            items.push({
                                folder_id: doc.folder_id
                            });
                            // Agregar fila a la tabla
                            $('#itemsTable tbody').append(`
                            <tr data-id="${doc.id}">
                                <td>${doc.name}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${doc.folder_id},${doc.id})">Eliminar</button>
                                </td>
                            </tr>
                        `);

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los documentos:', error);
                        alert('No se pudieron cargar los documentos registrados.');
                    }
                }),
                $('#folders').select2({
                    theme: 'bootstrap-5',
                    placeholder: "Seleccione una opción",
                    allowClear: true,
                    dropdownParent: $('#addFolderModal'),
                    ajax: {
                        url: "{{ route('folders') }}", // Endpoint del recurso
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term // Parámetro de búsqueda
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
        })
        $('#addFolderModal').on('hidden.bs.modal', function() {
            // Destruir Select2
            $('#folders').select2('destroy');

        });

        function agregarItems() {
            const folder = $('#folders').val()
            const folderText = $('#folders option:selected').text()

            if (!folder) {
                alert('Por favor seleccione una carpeta.');
                return;
            }
            if (items.some(item => item.folder_id == folder)) {
                alert('El folder ya está agregado en la tabla.');
                return;
            }
            items.push({
                folder_id: folder
            });

            $('#itemsTable tbody').append(`
                <tr>
                    <td>${folderText}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${folder},null)">Eliminar</button>
                    </td>
                </tr>
            `);
            // Limpiar los campos después de agregar
            $('#folders').val(null).trigger('change');


        }

        function eliminarItem(folderId, dbId) {
            if (!confirm('¿Estás seguro de que deseas eliminar esta carpeta?')) {
                return;
            }
            // Filtrar el array para excluir el elemento eliminado
            items = items.filter(item => item.folder_id != folderId);

            // Si el segundo parámetro (`dbId`) no es null, elimina también en la base de datos
            if (dbId !== null) {
                $.ajax({
                    url: `/client-folder/${dbId}`, // Endpoint para eliminar en el backend
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    success: function(response) {
                        if (response.status) {
                            alert('Carpeta eliminada correctamente.');

                            // Eliminar del array y la vista después de confirmar la eliminación en la base de datos
                            $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${folderId},${dbId})'])`)
                                .remove();
                        } else {
                            alert('No se pudo eliminar la carpeta: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar la carpeta:', error);
                        alert('Ocurrió un error al intentar eliminar la carpeta.');
                    }
                });
            } else {
                // Solo eliminar de la vista si no es necesario eliminar en la base de datos
                $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${folderId},null)'])`).remove();
            }
        }

        function guardariItems() {
            const clientId = $('#client_id').val();

            if (!clientId || items.length === 0) {
                alert('Por favor complete los datos antes de actualizar.');
                return;
            }

            // Enviar los datos al servidor vía AJAX
            $.ajax({
                url: "{{ route('client-folder.store') }}",
                method: 'POST',
                data: {
                    client_id: clientId,
                    items: items
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function(response) {
                    if (response.status) {
                        alert('Datos guardados correctamente.');
                        $('#addFolderModal').modal('hide');
                        location.reload(); // Recargar la página o actualizar la tabla principal
                    } else {
                        alert('Hubo un problema al guardar los datos: ' + response.message);
                    }
                }
            });
        }
    </script>

@endsection
