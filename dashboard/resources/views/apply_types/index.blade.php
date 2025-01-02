@extends('layouts.master')

@section('title', 'Tipo Solicitud')
@section('css')
    <link href="{{ URL::asset('dist/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Tipo Solicitud" pagetitle="Tipo Solicitud" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <a href="{{ route('applytype.create') }}" class="btn btn-primary" type="button">
                    Crear Nuevo Tipo de Solicitud
                </a>
            </div>
            @if (!empty($applyType))
                <div class="table-responsive mt-3">
                    <table id="apply-type-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tipo Solicitud</th>
                                <th>Dias Estimados </th>
                                <th>Fecha Creacion </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Tipo Solicitud</th>
                                <th>Dias Estimados </th>
                                <th>Fecha Creacion </th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <p>No hay Datos.</p>
            @endif

        </div>
    </div>
    @include('apply_types.modals.add_document')

@endsection
@section('scripts')

    <script src="{{ URL::asset('dist/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#apply-type-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('applytype.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'estimated_days',
                        name: 'estimated_days'
                    },
                    {
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

        $('#addDocumentModal').on('shown.bs.modal', function() {
            const applyTypeId = $('#apply_type_id').val();

            if (!applyTypeId) {
                alert('El ID del tipo de aplicación no está definido.');
                return;
            }

            // Realizar una solicitud AJAX para obtener los documentos registrados
            $.ajax({
                url: `/apply-document-types/${applyTypeId}/documents`, // Endpoint para cargar los documentos registrados
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${doc.apply_document_type_id},${doc.id})">Eliminar</button>
                    </td>
                </tr>
            `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los documentos:', error);
                    alert('No se pudieron cargar los documentos registrados.');
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

        function addApplyDocumentType($id, $tipoDoc) {
            $('#addDocumentModal').modal('show');
            document.getElementById('nameTipodoc').textContent = `Tipo solicitud: ${$tipoDoc}`
            document.getElementById('apply_type_id').value = $id;

        }
        let items = [];

        function agregarItems() {
            // Obtener el valor seleccionado y su texto
            const documentType = $('#documentType').val(); // Valor único
            const documentTypeText = $('#documentType option:selected').text(); // Texto del tipo de documento
            const isRequired = $('#is_required').val(); // Valor del campo requerido
            const isRequiredText = isRequired === '1' ? 'Sí' : 'No';

            // Validar que haya seleccionado un tipo de documento
            if (!documentType) {
                alert('Por favor seleccione un tipo de documento.');
                return;
            }
            if (items.some(item => item.document_type_id == documentType)) {
                alert('El tipo de documento ya está agregado en la tabla.');
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${documentType},null)">Eliminar</button>
                    </td>
                </tr>
        `);

            // Limpiar los campos después de agregar
            $('#documentType').val(null).trigger('change');
            $('#is_required').val('1');
        }

        // Función para eliminar un ítem de la tabla y del array
        function eliminarItem(typeId, dbId) {
            if (!confirm('¿Estás seguro de que deseas eliminar este documento?')) {
                return;
            }
            // Filtrar el array para excluir el elemento eliminado
            items = items.filter(item => item.document_type_id != typeId);

            // Si el segundo parámetro (`dbId`) no es null, elimina también en la base de datos
            if (dbId !== null) {
                $.ajax({
                    url: `/apply-types-apply-document-type/${dbId}`, // Endpoint para eliminar en el backend
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Documento eliminado correctamente.');

                            // Eliminar del array y la vista después de confirmar la eliminación en la base de datos
                            $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${typeId},${dbId})'])`)
                                .remove();
                        } else {
                            alert('No se pudo eliminar el documento: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar el documento:', error);
                        alert('Ocurrió un error al intentar eliminar el documento.');
                    }
                });
            } else {
                // Solo eliminar de la vista si no es necesario eliminar en la base de datos
                $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${typeId},null)'])`).remove();
            }
        }


        function guardariItems() {
            const applyTypeId = $('#apply_type_id').val();

            if (!applyTypeId || items.length === 0) {
                alert('Por favor complete los datos antes de actualizar.');
                return;
            }

            // Enviar los datos al servidor vía AJAX
            $.ajax({
                url: "{{ route('apply-types-apply-document-type.store') }}",
                method: 'POST',
                data: {
                    apply_type_id: applyTypeId,
                    items: items
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function(response) {
                    if (response.status) {
                        alert('Datos guardados correctamente.');
                        $('#addDocumentModal').modal('hide');
                        location.reload(); // Recargar la página o actualizar la tabla principal
                    } else {
                        alert('Hubo un problema al guardar los datos: ' + response.message);
                    }
                }
            });
        }
    </script>

@endsection
