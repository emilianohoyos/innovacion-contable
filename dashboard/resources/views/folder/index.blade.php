@extends('layouts.master')

@section('title', 'Carpetas')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Carpetas" pagetitle="Carpetas"><a href="{{ route('folder.create') }}" class="btn btn-primary"
            type="button">
            Nueva
        </a></x-page-title>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start">

            </div>
            <div class="table-responsive mt-3">
                <table id="tbl-folder" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre Carpeta</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('folder.modals.add_document')

@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tbl-folder').DataTable({
                language: {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('folders.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'created_at',
                        name: 'created_at'
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

        // function confirmDelete() {
        //     Swal.fire({
        //         title: '¿Estás seguro de Eliminar el cliente?',
        //         text: "Esta acción no se puede deshacer.",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#3085d6',
        //         confirmButtonText: 'Sí, eliminar',
        //         cancelButtonText: 'Cancelar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Enviar el formulario de eliminación
        //             // document.getElementById('delete-form-' + id).submit();
        //         }
        //     });
        // }
        let items = [];

        function addApplyDocumentType($id, $tipoDoc) {
            $('#addDocumentModal').modal('show');
            document.getElementById('nameTipodoc').textContent = `Tipo solicitud: ${$tipoDoc}`
            document.getElementById('folder_id').value = $id;
        }

        $('#addDocumentModal').on('shown.bs.modal', function() {
            const folderId = $('#folder_id').val();

            if (!folderId) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "El ID de la carpeta no está definido.",

                });
                return;
            }

            // Realizar una solicitud AJAX para obtener los documentos registrados
            $.ajax({
                url: `/folders/${folderId}/documents`, // Endpoint para cargar los documentos registrados
                method: 'GET',
                success: function(response) {
                    // Limpiar la tabla y el array antes de cargar nuevos datos
                    $('#itemsTable tbody').empty();
                    items = []; // Reiniciar el array de items

                    response.forEach(doc => {
                        // Agregar cada documento al array
                        items.push({
                            document_type_id: doc.apply_document_type_id,
                            is_required: doc.is_required
                        });

                        // Agregar fila a la tabla
                        $('#itemsTable tbody').append(`
                            <tr data-id="${doc.id}">
                                <td>${doc.name}</td>
                                <td>${doc.is_required === 1 ? 'Sí' : 'No'}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${doc.apply_document_type_id},${doc.id})">Desvincular</button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "No se pudieron cargar los documentos registrados.",

                    });
                }
            });
            // Inicializar Select2 con AJAX
            $('#documentType').select2({
                theme: 'bootstrap-5',
                placeholder: "Seleccione una opción",
                allowClear: true,
                dropdownParent: $('#addDocumentModal'),
                ajax: {
                    url: "{{ route('apply-document-types') }}", // Endpoint del recurso
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
        });

        // Evento al cerrar el modal
        $('#addDocumentModal').on('hidden.bs.modal', function() {
            // Destruir Select2
            $('#documentType').select2('destroy');

        });


        function agregarItems() {
            // Obtener el valor seleccionado y su texto
            const documentType = $('#documentType').val(); // Valor único
            const documentTypeText = $('#documentType option:selected').text(); // Texto del tipo de documento
            const isRequired = $('#is_required').val(); // Valor del campo requerido
            const isRequiredText = isRequired === '1' ? 'Sí' : 'No';

            // Validar que haya seleccionado un tipo de documento
            if (!documentType) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Por favor seleccione un tipo de documento.",

                });

                return;
            }
            if (items.some(item => item.document_type_id == documentType)) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "El tipo de documento ya está agregado en la tabla.",

                });
                return;
            }

            // Agregar los datos al array
            items.push({
                document_type_id: documentType,
                is_required: isRequired
            });

            // Agregar fila a la tabla
            $('#itemsTable tbody').append(`
                <tr>
                    <td>${documentTypeText}</td>
                    <td>${isRequiredText}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${documentType},null)">Desvincular</button>
                    </td>
                </tr>
            `);

            // Limpiar los campos después de agregar
            $('#documentType').val(null).trigger('change');
            $('#is_required').val('1');
        }
        // Función para eliminar un ítem de la tabla y del array
        function eliminarItem(typeId, dbId) {
            Swal.fire({
                title: `¿Estás seguro de que deseas eliminar este documento?`,
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Filtrar el array para excluir el elemento eliminado
                    items = items.filter(item => item.document_type_id != typeId);

                    // Si el segundo parámetro (`dbId`) no es null, elimina también en la base de datos
                    if (dbId !== null) {
                        $.ajax({
                            url: `/apply-document-type-folder/${dbId}`, // Endpoint para eliminar en el backend
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Documento eliminado correctamente.",
                                        icon: "success",
                                        draggable: true
                                    });

                                    // Eliminar del array y la vista después de confirmar la eliminación en la base de datos
                                    $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${typeId},${dbId})'])`)
                                        .remove();
                                } else {
                                    alert('No se pudo eliminar el documento: ' + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error al eliminar el documento:', error);
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: 'Ocurrió un error al intentar eliminar el documento.',

                                });
                            }
                        });
                    } else {
                        // Solo eliminar de la vista si no es necesario eliminar en la base de datos
                        $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${typeId},null)'])`).remove();
                    }
                }
            });
        }

        function guardariItems() {
            const folderId = $('#folder_id').val();

            if (!folderId || items.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Por favor complete los datos antes de actualizar.",

                });
                return;
            }

            // Enviar los datos al servidor vía AJAX
            $.ajax({
                url: "{{ route('apply-document-type-folder.store') }}",
                method: 'POST',
                data: {
                    folder_id: folderId,
                    items: items
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: "Datos guardados correctamente.",
                            icon: "success",
                            draggable: true
                        });
                        $('#addDocumentModal').modal('hide');
                        location.reload(); // Recargar la página o actualizar la tabla principal
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al guardar los datos: " + response.message,

                        });

                    }
                }
            });
        }
    </script>

@endsection
