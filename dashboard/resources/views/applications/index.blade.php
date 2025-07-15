@extends('layouts.master')

@section('title', 'Solicitudes')

@section('content')
    <x-page-title title="Solicitudes" pagetitle="Solicitudes" />


    <div class="row g-3">
        <div class="col-auto flex-grow-1 overflow-auto">
            <div class="btn-group position-static">
                <div class="btn-group position-static">
                    <button id="estadoDropdown" type="button" class="btn btn-filter dropdown-toggle px-4"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Estado
                    </button>
                    <ul class="dropdown-menu" id="estadoOptions">
                        <li><a class="dropdown-item" href="javascript:;" data-value="">Todos</a></li>
                        @foreach ($status as $statuItem)
                            <li>
                                <a class="dropdown-item" href="javascript:;"
                                    data-value="{{ $statuItem->id }}">{{ $statuItem->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group position-static">
                    <button id="tipoDropdown" type="button" class="btn btn-filter dropdown-toggle px-4"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tipo Solicitud
                    </button>
                    <ul class="dropdown-menu" id="tipoOptions">
                        <li><a class="dropdown-item" href="javascript:;" data-value="">Todos</a></li>
                        @foreach ($applyTypes as $applyType)
                            <li>
                                <a class="dropdown-item" href="javascript:;"
                                    data-value="{{ $applyType->id }}">{{ $applyType->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="btn-group position-static">
                    <button id="prioridadDropdown" type="button" class="btn btn-filter dropdown-toggle px-4"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Prioridad
                    </button>
                    <ul class="dropdown-menu" id="prioridadOptions">
                        <li><a class="dropdown-item" href="javascript:;" data-value="">Todos</a></li>
                        <li><a class="dropdown-item" href="javascript:;" data-value="ALTA">ALTA</a></li>
                        <li><a class="dropdown-item" href="javascript:;" data-value="MEDIA">MEDIA</a></li>
                        <li><a class="dropdown-item" href="javascript:;" data-value="BAJA">BAJA</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button id="clearFilters" class="btn btn-outline-secondary px-4" type="button" style="display:none;">
                    <i class="bi bi-x-circle me-2"></i>Limpiar filtros
                </button>
                <a href="{{ route('application.create') }}" class="btn btn-primary px-4"><i
                        class="bi bi-plus-lg me-2"></i>Realizar Nueva solicitud</a>
            </div>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive white-space-nowrap">
                <table id="tbl-application" class="table ">
                    <thead class="table-light">
                        <tr>
                            <th>id</th>
                            <th>Tipo Solicitud</th>
                            <th>Cliente</th>
                            <th>Fecha creación</th>
                            <th>Fecha Estimada atención</th>
                            <th>Dias Transcurridos</th>
                            <th>Empleado que atiende</th>
                            <th>Prioridad</th>
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
    @include('applications.modals.see-application')
    @include('applications.modals.status')
    @include('applications.modals.employee')
    @include('applications.modals.comments')
@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        var estado = '';
        var tipo = '';
        var prioridad = '';
        var applicationDataUrl = "{{ route('application.datatable') }}";

        function updateClearButton() {
            if (estado || tipo || prioridad) {
                $('#clearFilters').show();
            } else {
                $('#clearFilters').hide();
            }
        }
        // Variable global para guardar el valor anterior del select estado
        var previousState = {};
        $(document).ready(function() {
            var table = $('#tbl-application').DataTable({
                language: {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: applicationDataUrl,
                    data: function(d) {
                        d.estado = estado;
                        d.tipo = tipo;
                        d.prioridad = prioridad;
                    }
                },
                columns: [{
                        data: 'application_id',
                        name: 'application_id'
                    },
                    {
                        data: 'apply_type_name',
                        name: 'apply_type_name'
                    },

                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            if (!data) return '';
                            const fecha = new Date(data);
                            return fecha.getFullYear() + '-' +
                                String(fecha.getMonth() + 1).padStart(2, '0') + '-' +
                                String(fecha.getDate()).padStart(2, '0');
                        }
                    },
                    {
                        data: 'estimated_delevery_date',
                        name: 'estimated_delevery_date',
                        render: function(data, type, row) {
                            if (!data) return '';
                            const fecha = new Date(data);
                            return fecha.getFullYear() + '-' +
                                String(fecha.getMonth() + 1).padStart(2, '0') + '-' +
                                String(fecha.getDate()).padStart(2, '0');
                        }
                    },
                    {
                        data: 'dias_transcurridos',
                        name: 'dias_transcurridos',
                        render: function(data, type, row) {
                            return parseInt(data, 10);
                        }
                    },
                    {
                        data: 'employee',
                        name: 'employee'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'state_name',
                        name: 'state_name'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            // Filtros personalizados
            $('#estadoOptions a').on('click', function() {
                estado = $(this).data('value');
                // Resalta la opción seleccionada
                $(this).addClass('active').siblings().removeClass('active');
                // Actualiza el texto del botón
                var text = $(this).text();
                $('#estadoDropdown').text(estado ? 'Estado: ' + text : 'Estado');
                table.ajax.reload();
                updateClearButton();
            });
            $('#tipoOptions a').on('click', function() {
                tipo = $(this).data('value');
                $(this).addClass('active').siblings().removeClass('active');
                var text = $(this).text();
                $('#tipoDropdown').text(tipo ? 'Tipo: ' + text : 'Tipo Solicitud');
                table.ajax.reload();
                updateClearButton();
            });
            $('#prioridadOptions a').on('click', function() {
                prioridad = $(this).data('value');
                $(this).addClass('active').siblings().removeClass('active');
                var text = $(this).text();
                $('#prioridadDropdown').text(prioridad ? 'Prioridad: ' + text : 'Prioridad');
                table.ajax.reload();
                updateClearButton();
            });
            // Limpiar filtros
            $('#clearFilters').on('click', function() {
                estado = '';
                tipo = '';
                prioridad = '';
                $('#estadoOptions a[data-value=""]').addClass('active').siblings().removeClass('active');
                $('#tipoOptions a[data-value=""]').addClass('active').siblings().removeClass('active');
                $('#prioridadOptions a[data-value=""]').addClass('active').siblings().removeClass('active');
                $('#estadoDropdown').text('Estado');
                $('#tipoDropdown').text('Tipo Solicitud');
                $('#prioridadDropdown').text('Prioridad');
                table.ajax.reload();
                updateClearButton();
            });
            // Inicializa los botones con la opción "Todos"
            $('#estadoDropdown').text('Estado');
            $('#tipoDropdown').text('Tipo Solicitud');
            $('#prioridadDropdown').text('Prioridad');
            updateClearButton();
        });

        // Evento click para interceptar el cambio antes de que ocurra
        // Evento change para manejar todos los estados, incluyendo Cancelado
        $(document).on('focusin', '.estado-select', function() {
            // Guardar el estado anterior antes del cambio
            $(this).data('prev', $(this).val());
        });

        $(document).on('change', '.estado-select', function() {
            var $select = $(this);
            var applicationId = $select.data('id');
            var newState = $select.val();
            var prevState = $select.data('prev');
            var isCancelado = $select.find('option:selected').data('cancelado') === 1;
            if (isCancelado) {
                // Mostrar SweetAlert para motivo de cancelación
                Swal.fire({
                    title: 'Motivo de cancelación',
                    input: 'text',
                    inputLabel: 'Por favor ingresa el motivo de la cancelación',
                    inputPlaceholder: 'Motivo...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    inputValidator: (value) => {
                        if (!value || value.trim() === '') {
                            return 'El motivo es obligatorio';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            state_id: newState,
                            motivo_cancelacion: result.value,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url: '/application/state/' + applicationId,
                            method: 'POST',
                            data: data,
                            success: function(response) {
                                $('#tbl-application').DataTable().ajax.reload();
                                previousState[applicationId] = newState;
                            }
                        });
                    } else {
                        // Revertir el select al estado anterior si se cancela
                        $select.val(prevState);
                    }
                });
            } else {
                var data = {
                    state_id: newState,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: '/application/state/' + applicationId,
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        $('#tbl-application').DataTable().ajax.reload();
                        previousState[applicationId] = newState;
                    }
                });
            }
        });

        // ...evento change para SweetAlert y revertido ya implementado arriba...


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

        function seeApplicationModal(application_id) {
            fetch(`/application/${application_id}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Error en la petición");
                    }
                    return response.json();
                })
                .then(
                    data => {

                        console.log(data.data.apply_type_name);
                        document.getElementById('applyType').textContent = data.data.apply_type_name
                        document.getElementById('nit').textContent = data.data.nit
                        document.getElementById('clientName').textContent = data.data.company_name
                        const fechaEntrega = new Date(data.data.estimated_delevery_date);
                        document.getElementById('estimated_delevery_date').textContent =
                            fechaEntrega.getFullYear() + '-' +
                            String(fechaEntrega.getMonth() + 1).padStart(2, '0') + '-' +
                            String(fechaEntrega.getDate()).padStart(2, '0');
                        document.getElementById('employee').textContent = data.data.employee
                        document.getElementById('priority').textContent = data.data.priority
                        document.getElementById('state_name').textContent = data.data.state_name
                        document.getElementById('observation').textContent = data.data.observations
                        const fecha = new Date(data.data.created_at);
                        document.getElementById('created_at').textContent =
                            fecha.getFullYear() + '-' +
                            String(fecha.getMonth() + 1).padStart(2, '0') + '-' +
                            String(fecha.getDate()).padStart(2, '0');


                        let adjuntosContainer = document.getElementById('adjuntos')
                        adjuntosContainer.innerHTML = "";
                        console.log('Datos recibidos:', data);
                        data.attachment.forEach((attachment, index) => {
                            let div = document.createElement("div");
                            div.className = "col-md-3 mb-2";

                            // Crear el span para el tipo documental
                            let tipoDoc = document.createElement("span");
                            tipoDoc.className = "badge bg-info mb-1";
                            tipoDoc.textContent = attachment.apply_document_type?.name ?? 'Sin tipo';

                            // Crear el botón de descarga
                            let button = document.createElement("a");
                            button.href = `/storage/${attachment.url}`; // Ruta del archivo
                            let nameFile = attachment.url.split('/').pop();
                            button.download = nameFile // Nombre del archivo
                            button.className = "btn btn-danger px-4 raised d-flex gap-2 align-items-center";
                            button.innerHTML =
                                `<i class="material-icons-outlined">download</i> Ver ${nameFile} `;

                            // Agregar el span y el botón al div
                            div.appendChild(tipoDoc);
                            div.appendChild(button);
                            adjuntosContainer.appendChild(div);
                        })

                        let statusTableBody = document.getElementById('statusTableBody');

                        console.log('Estado de la solicitud:', data.historyState);
                        // Actualiza la tabla de carpetas del cliente
                        if (Array.isArray(data.historyState) && data.historyState.length > 0) {
                            data.historyState.forEach(state => {
                                const row = `
                            <tr>
                              
                                 <td>${new Date(state.created_at).toLocaleString('es-CO', { timeZone: 'America/Bogota' })}</td>
                                <td>${state.state.name}</td>
                                <td>${state.user.name}</td>
                                <td>${state.observation??''}</td>
                            </tr>`;
                                statusTableBody.insertAdjacentHTML('beforeend', row);
                            });
                        } else {
                            // Si no hay comentarios, agrega una fila indicando que no hay datos
                            statusTableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center">No estados</td>
                        </tr>`;
                        }
                    })
            $('#seeApplicationModal').modal('show')
        }

        function commentsModal(id) {

            document.getElementById('application_id').value = id;
            loadComments(id)
            $('#commentsModal').modal('show');
        }

        async function saveComment() {
            const applicationId = document.getElementById('application_id').value
            const comment = document.getElementById('comment').value
            if (!comment.trim()) {
                alert('El comentario No puede estar vacio')
                return
            }
            try {
                const response = await fetch(`application/comment/${applicationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'applcation/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        application_id: applicationId,
                        comment: comment
                    })
                })
                if (!response.ok) {
                    throw new Error('Error al guardar el comentario')
                }

                const result = await response.json()
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Comentario guardado exitosamente',
                    confirmButtonText: 'OK'
                });

                // Limpiar el campo de comentario
                document.getElementById('comment').value = '';

                // Actualizar los comentarios en la tabla
                await loadComments(applicationId);
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al guardar el comentario',
                    confirmButtonText: 'OK'
                });

            }

        }
        async function loadComments(applicationId) {
            // Referencia al cuerpo de la tabla
            const tableBody = document.querySelector('#commentsModal table tbody');

            // Limpiar las filas existentes
            tableBody.innerHTML = '';
            try {
                // Obtener los comentarios desde la API
                const response = await fetch(`application/comment/${applicationId}`);

                if (!response.ok) {
                    throw new Error('Error al cargar los comentarios');
                }

                const comments = await response.json();



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
                alert('Hubo un problema al cargar los comentarios');
            }
        }

        function statusModal(application_id) {
            document.getElementById('application_id').value = application_id;
            fetch(`/application/${application_id}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Error en la petición");
                    }
                    return response.json();
                })
                .then(data => {
                    $('#status_id').val(data.data.state_id).trigger('change')
                })
            $('#statusModal').modal('show')
        }

        async function updateState() {
            const applicationId = document.getElementById('application_id').value
            const status_id = $('#status_id').val()

            try {
                const response = await fetch(`application/state/${applicationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        application_id: applicationId,
                        state_id: status_id
                    })
                })
                if (!response.ok) {
                    throw new Error('Error al guardar el comentario')
                }

                const result = await response.json()
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Estado Actualizado exitosamente',
                    confirmButtonText: 'OK'
                });
                // Limpiar el campo de comentario
                document.getElementById('application_id').value = '';
                $('#tbl-application').DataTable().ajax.reload();
                $('#statusModal').modal('hide')
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al guardar el comentario',
                    confirmButtonText: 'OK'
                });
            }

        }

        function employeeModal(application_id) {
            document.getElementById('application_id').value = application_id;
            fetch(`/application/${application_id}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Error en la petición");
                    }
                    return response.json();
                })
                .then(data => {
                    $('#status_id').val(data.data.employee_id).trigger('change')
                })
            $('#employeeModal').modal('show')
        }

        async function updateEmployee() {
            const applicationId = document.getElementById('application_id').value;
            const employee_id = $('#employee_id').val();
            const razon_cambio = document.getElementById('razon_cambio') ? document.getElementById('razon_cambio')
                .value : '';

            try {
                const response = await fetch(`application/employee/${applicationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        application_id: applicationId,
                        employee_id: employee_id,
                        razon_cambio: razon_cambio
                    })
                });
                if (!response.ok) {
                    throw new Error('Error al guardar el comentario');
                }

                const result = await response.json();
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Empleado Actualizado exitosamente',
                    confirmButtonText: 'OK'
                });
                // Limpiar el campo de comentario y razón
                document.getElementById('application_id').value = '';
                if (document.getElementById('razon_cambio')) {
                    document.getElementById('razon_cambio').value = '';
                }
                $('#tbl-application').DataTable().ajax.reload();
                $('#employeeModal').modal('hide');
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al guardar el comentario',
                    confirmButtonText: 'OK'
                });
            }
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
