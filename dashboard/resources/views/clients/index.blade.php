@extends('layouts.master')

@section('title', 'Clientes')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Clientes">
        <a href="{{ route('client.create') }}" class="btn btn-primary" type="button">
            Nuevo
        </a>
    </x-page-title>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-client" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo Persona</th>
                            <th>Tipo Documento</th>
                            <th>Identificación</th>
                            <th>Razón social</th>
                            <th>Correo Corporativo</th>
                            <th>Dirección Corporativa</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @include('clients.modals.edit')
    @include('clients.modals.comments')
    @include('clients.modals.add_folder')
    @include('clients.modals.see-client')
@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tbl-client').DataTable({
                language: {
                    url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('client.data') }}',
                columns: [{
                        data: 'person_type',
                        name: 'person_type'
                    },
                    {
                        data: 'document_type',
                        name: 'document_type'
                    },
                    {
                        data: 'nit',
                        name: 'nit'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },

                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
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

        function addFolder(id, nameClient) {
            console.log('ID:', id, 'Nombre:', nameClient);
            document.getElementById('nameClientFolder').textContent = `Agregar Carpeta al Cliente ${nameClient}`;
            document.getElementById('client_id').value = id;
            $('#addFolderModal').modal('show');
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
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'El comentario no puede estar vacío',
                });
                return
            }
            try {
                const response = await fetch(`client/comment/${clientId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'applcation/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
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
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Comentario guardado exitosamente.',
                    confirmButtonText: 'Aceptar'
                });

                // Limpiar el campo de comentario
                document.getElementById('comment').value = '';

                // Actualizar los comentarios en la tabla
                await loadComments(clientId);
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al guardar el comentario',
                });
            }

        }
        async function loadComments(clientId) {
            try {
                // Obtener los comentarios desde la API
                const response = await fetch(`client/comment/${clientId}`);

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


        $('#addFolderModal').on('shown.bs.modal', function() {
            const clientId = $('#client_id').val();
            if (!clientId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'El ID del cliente no está definido.',
                    confirmButtonText: 'Aceptar'
                });
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudieron cargar los documentos registrados.',
                        });
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
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Por favor seleccione una carpeta.',
                });
                return;
            }
            if (items.some(item => item.folder_id == folder)) {
                Swal.fire({
                    icon: 'info',
                    title: 'Información',
                    text: 'El folder ya está agregado en la tabla.',
                    confirmButtonText: 'Aceptar'
                });
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
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Carpeta eliminada correctamente.',
                                confirmButtonText: 'Aceptar'
                            });

                            // Eliminar del array y la vista después de confirmar la eliminación en la base de datos
                            $(`#itemsTable tbody tr:has(button[onclick='eliminarItem(${folderId},${dbId})'])`)
                                .remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar la carpeta: ' + response.message,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar la carpeta:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al intentar eliminar la carpeta.',
                            confirmButtonText: 'Aceptar'
                        });
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
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos incompletos',
                    text: 'Por favor complete los datos antes de actualizar.',
                    confirmButtonText: 'Aceptar'
                });
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
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Datos guardados correctamente.',
                            confirmButtonText: 'Aceptar'
                        });
                        $('#addFolderModal').modal('hide');
                        location.reload(); // Recargar la página o actualizar la tabla principal
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al guardar los datos: ' + response.message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
        }

        function seeClient(id) {
            const url = `/client/all/${id}`;
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los datos del cliente');
                    }
                    return response.json();
                })
                .then(clientData => {
                    console.log(clientData)
                    // Asigna los datos al modal
                    document.getElementById('clientType').textContent = clientData.person_type.name;
                    document.getElementById('documentType').textContent = clientData.document_type.name;
                    document.getElementById('clientName').textContent = clientData.company_name;
                    document.getElementById('clientId').textContent = clientData.nit;
                    document.getElementById('clientAddress').textContent = clientData.address;
                    document.getElementById('clientEmail').textContent = clientData.email;
                    document.getElementById('clientCategory').textContent = clientData.category;
                    document.getElementById('clientAgent').textContent = clientData.employees[0].employee.firstname +
                        ' ' + clientData.employees[0].employee.lastname;
                    document.getElementById('clientReview').textContent = clientData.review ?? 'No hay review';
                    document.getElementById('clientObservation').textContent = clientData.observation ??
                        'No hay Observaciones';

                    document.getElementById('is_simple_taxation_regimen').textContent = clientData.client_responsible
                        .is_simple_taxation_regime ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_simple_taxation_regimen == 1) {
                        document.getElementById('simple_taxation_regime_advances').style.display = 'flex'
                        document.getElementById('simple_taxation_regime_advances_lbl').style.display = 'flex'
                        document.getElementById('simple_taxation_regime_consolidated_annual').style.display = 'flex'
                        document.getElementById('simple_taxation_regime_consolidated_annual_lbl').style.display = 'flex'

                        document.getElementById('simple_taxation_regime_advances').textContent = clientData
                            .client_responsible.simple_taxation_regime_advances ?? 'No aplica';
                        document.getElementById('simple_taxation_regime_consolidated_annual').textContent = clientData
                            .client_responsible.simple_taxation_regime_consolidated_annual ?? 'No aplica';
                    } else {
                        document.getElementById('simple_taxation_regime_advances').style.display = 'none'
                        document.getElementById('simple_taxation_regime_advances_lbl').style.display = 'none'
                        document.getElementById('simple_taxation_regime_consolidated_annual').style.display = 'none'
                        document.getElementById('simple_taxation_regime_consolidated_annual_lbl').style.display = 'none'

                    }




                    document.getElementById('is_industry_commerce').textContent = clientData.client_responsible
                        .is_industry_commerce ? 'Si' : 'No';
                    document.getElementById('industry_commerce_periodicity').textContent = clientData
                        .client_responsible.industry_commerce_periodicity ?? 'No aplica';
                    if (clientData.client_responsible
                        .is_industry_commerce == '1' && clientData.client_responsible
                        .industry_commerce_places) {
                        const table = document.getElementById("industry_commerce_places_table");
                        const tbody = table.querySelector("tbody");
                        tbody.innerHTML = "";

                        function addRow(deparment, city) {
                            let row = document.createElement("tr");

                            row.innerHTML = `
                            <td>${deparment}</td>
                            <td>${city}</td>
                            `;

                            tbody.appendChild(row);
                            table.style.display = "table"; // Mostrar la tabla si está oculta
                        }
                        JSON.parse(clientData.client_responsible
                            .industry_commerce_places).forEach(item => addRow(item.deparment, item.city));

                    } else {
                        document.getElementById('industry_commerce_periodicity').style.display = 'none'
                        document.getElementById('industry_commerce_places_table').style.display = 'none'
                        document.getElementById('industry_commerce_periodicity_lbl').style.display = 'none'

                    }

                    document.getElementById('is_industry_commerce_retainer').textContent = clientData.client_responsible
                        .is_industry_commerce_retainer ? 'Si' : 'No';
                    document.getElementById('industry_commerce_retainer_periodicity').textContent = clientData
                        .client_responsible.industry_commerce_retainer_periodicity ?? 'No aplica';
                    if (clientData.client_responsible
                        .is_industry_commerce_retainer == '1' && clientData.client_responsible
                        .industry_commerce_retainer_places) {
                        const table = document.getElementById("industry_commerce_retainer_places_table");
                        const tbody = table.querySelector("tbody");
                        tbody.innerHTML = "";

                        function addRow(deparment, city) {
                            let row = document.createElement("tr");

                            row.innerHTML = `
                            <td>${deparment}</td>
                            <td>${city}</td>
                            `;

                            tbody.appendChild(row);
                            table.style.display = "table"; // Mostrar la tabla si está oculta
                        }
                        JSON.parse(clientData.client_responsible
                            .industry_commerce_retainer_places).forEach(item => addRow(item.deparment, item.city));

                    } else {
                        document.getElementById('industry_commerce_retainer_periodicity').style.display = 'none'
                        document.getElementById('industry_commerce_retainer_places_table').style.display = 'none'
                        document.getElementById('industry_commerce_retainer_periodicity_lbl').style.display = 'none'

                    }

                    document.getElementById('is_industry_commerce_selfretaining').textContent = clientData
                        .client_responsible
                        .is_industry_commerce_selfretaining ? 'Si' : 'No';
                    document.getElementById('industry_commerce_selfretaining_periodicity').textContent = clientData
                        .client_responsible.industry_commerce_selfretaining_periodicity ?? 'No aplica';
                    if (clientData.client_responsible
                        .is_industry_commerce_selfretaining == '1' && clientData.client_responsible
                        .industry_commerce_retainer_places) {
                        const table = document.getElementById("industry_commerce_selfretaining_places_table");
                        const tbody = table.querySelector("tbody");
                        tbody.innerHTML = "";

                        function addRow(deparment, city) {
                            let row = document.createElement("tr");

                            row.innerHTML = `
                            <td>${deparment}</td>
                            <td>${city}</td>
                            `;

                            tbody.appendChild(row);
                            table.style.display = "table"; // Mostrar la tabla si está oculta
                        }
                        JSON.parse(clientData.client_responsible
                            .industry_commerce_retainer_places).forEach(item => addRow(item.deparment, item.city));

                    } else {
                        document.getElementById('industry_commerce_selfretaining_periodicity').style.display = 'none'
                        document.getElementById('industry_commerce_selfretaining_places_table').style.display = 'none'
                        document.getElementById('industry_commerce_selfretaining_periodicity_lbl').style.display =
                            'none'
                    }

                    document.getElementById('vat_responsibles').textContent = clientData.client_responsible
                        .vat_responsible ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .vat_responsible == 1) {
                        document.getElementById('vat_responsible_periodicity_lbl').style.display = 'flex'
                        document.getElementById('vat_responsible_observation_lbl').style.display = 'flex'
                        document.getElementById('vat_responsible_periodicity').style.display = 'flex'
                        document.getElementById('vat_responsible_observation').style.display = 'flex'
                        document.getElementById('vat_responsible_periodicity').textContent = clientData
                            .client_responsible.vat_responsible_periodicity ?? 'No aplica';
                        document.getElementById('vat_responsible_observation').textContent = clientData
                            .client_responsible.vat_responsible_observation ?? 'No aplica';
                    } else {
                        document.getElementById('vat_responsible_periodicity_lbl').style.display = 'none'
                        document.getElementById('vat_responsible_observation_lbl').style.display = 'none'
                        document.getElementById('vat_responsible_periodicity').style.display = 'none'
                        document.getElementById('vat_responsible_observation').style.display = 'none'

                    }

                    document.getElementById('is_rent').textContent = clientData.client_responsible
                        .is_rent ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_rent == 1) {
                        document.getElementById('rent_periodicity_lbl').style.display = 'flex'
                        document.getElementById('rent_periodicity').style.display = 'flex'

                        document.getElementById('rent_periodicity').textContent = clientData
                            .client_responsible.rent_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('rent_periodicity_lbl').style.display = 'none'
                        document.getElementById('rent_periodicity').style.display = 'none'

                    }

                    document.getElementById('is_supersociety').textContent = clientData.client_responsible
                        .is_supersociety ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_supersociety == 1) {
                        document.getElementById('supersociety_periodicity_lbl').style.display = 'flex'
                        document.getElementById('supersociety_periodicity').style.display = 'flex'

                        document.getElementById('supersociety_periodicity').textContent = clientData
                            .client_responsible.supersociety_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('supersociety_periodicity_lbl').style.display = 'none'
                        document.getElementById('supersociety_periodicity').style.display = 'none'
                    }

                    document.getElementById('is_supertransport').textContent = clientData.client_responsible
                        .is_supertransport ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_supertransport == 1) {
                        document.getElementById('supertransport_periodicity_lbl').style.display = 'flex'
                        document.getElementById('supertransport_periodicity').style.display = 'flex'
                        document.getElementById('supertransport_observation_lbl').style.display = 'flex'
                        document.getElementById('supertransport_observation').style.display = 'flex'

                        document.getElementById('supertransport_periodicity').textContent = clientData
                            .client_responsible.supertransport_periodicity ?? 'No aplica';
                        document.getElementById('supertransport_observation').textContent = clientData
                            .client_responsible.supertransport_observation ?? 'No aplica';

                    } else {
                        document.getElementById('supertransport_periodicity_lbl').style.display = 'none'
                        document.getElementById('supertransport_periodicity').style.display = 'none'
                        document.getElementById('supertransport_observation_lbl').style.display = 'none'
                        document.getElementById('supertransport_observation').style.display = 'none'
                    }


                    document.getElementById('is_superfinancial').textContent = clientData.client_responsible
                        .is_superfinancial ? 'Si' : 'No';

                    if (clientData.client_responsible
                        .is_superfinancial == 1) {
                        document.getElementById('superfinancial_periodicity_lbl').style.display = 'flex'
                        document.getElementById('superfinancial_periodicity').style.display = 'flex'

                        document.getElementById('superfinancial_periodicity').textContent = clientData
                            .client_responsible.superfinancial_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('superfinancial_periodicity_lbl').style.display = 'none'
                        document.getElementById('superfinancial_periodicity').style.display = 'none'
                    }

                    document.getElementById('is_source_retention').textContent = clientData.client_responsible
                        .is_source_retention ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_source_retention == 1) {
                        document.getElementById('source_retention_periodicity_lbl').style.display = 'flex'
                        document.getElementById('source_retention_periodicity').style.display = 'flex'

                        document.getElementById('source_retention_periodicity').textContent = clientData
                            .client_responsible.source_retention_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('source_retention_periodicity_lbl').style.display = 'none'
                        document.getElementById('source_retention_periodicity').style.display = 'none'
                    }
                    document.getElementById('is_dian_exogenous_information').textContent = clientData.client_responsible
                        .is_dian_exogenous_information ? 'Si' : 'No';

                    if (clientData.client_responsible
                        .is_dian_exogenous_information == 1) {
                        document.getElementById('dian_exogenous_information_periodicity_lbl').style.display = 'flex'
                        document.getElementById('dian_exogenous_information_periodicity').style.display = 'flex'

                        document.getElementById('dian_exogenous_information_periodicity').textContent = clientData
                            .client_responsible.dian_exogenous_information_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('dian_exogenous_information_periodicity_lbl').style.display = 'none'
                        document.getElementById('dian_exogenous_information_periodicity').style.display = 'none'
                    }



                    document.getElementById('is_municipal_exogenous_information').textContent = clientData
                        .client_responsible
                        .is_municipal_exogenous_information ? 'Si' : 'No';
                    document.getElementById('municipal_exogenous_information_periodicity').textContent = clientData
                        .client_responsible.municipal_exogenous_information_periodicity ?? 'No aplica';
                    if (clientData.client_responsible
                        .is_municipal_exogenous_information == '1' && clientData.client_responsible
                        .industry_commerce_retainer_places) {
                        const table = document.getElementById("municipal_exogenous_information_places_table");
                        const tbody = table.querySelector("tbody");
                        tbody.innerHTML = "";

                        function addRow(deparment, city) {
                            let row = document.createElement("tr");

                            row.innerHTML = `
                            <td>${deparment}</td>
                            <td>${city}</td>
                            `;

                            tbody.appendChild(row);
                            table.style.display = "table"; // Mostrar la tabla si está oculta
                        }
                        JSON.parse(clientData.client_responsible
                            .industry_commerce_retainer_places).forEach(item => addRow(item.deparment, item.city));

                    } else {
                        document.getElementById('municipal_exogenous_information_periodicity').style.display = 'none'
                        document.getElementById('municipal_exogenous_information_places_table').style.display = 'none'
                        document.getElementById('municipal_exogenous_information_periodicity_lbl').style.display =
                            'none'
                    }

                    document.getElementById('is_wealth_tax').textContent = clientData.client_responsible
                        .is_wealth_tax ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_wealth_tax == 1) {
                        document.getElementById('wealth_tax_periodicity_lbl').style.display = 'flex'
                        document.getElementById('wealth_tax_periodicity').style.display = 'flex'

                        document.getElementById('wealth_tax_periodicity').textContent = clientData
                            .client_responsible.wealth_tax_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('wealth_tax_periodicity_lbl').style.display = 'none'
                        document.getElementById('wealth_tax_periodicity').style.display = 'none'
                    }

                    document.getElementById('is_radian').textContent = clientData.client_responsible
                        .is_radian ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_radian == 1) {
                        document.getElementById('radian_periodicity_lbl').style.display = 'flex'
                        document.getElementById('radian_periodicity').style.display = 'flex'

                        document.getElementById('radian_periodicity').textContent = clientData
                            .client_responsible.radian_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('radian_periodicity_lbl').style.display = 'none'
                        document.getElementById('radian_periodicity').style.display = 'none'
                    }



                    document.getElementById('is_e_payroll').textContent = clientData.client_responsible
                        .is_e_payroll ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_e_payroll == 1) {
                        document.getElementById('e_payroll_periodicity_lbl').style.display = 'flex'
                        document.getElementById('e_payroll_periodicity').style.display = 'flex'

                        document.getElementById('e_payroll_periodicity').textContent = clientData
                            .client_responsible.e_payroll_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('e_payroll_periodicity_lbl').style.display = 'none'
                        document.getElementById('e_payroll_periodicity').style.display = 'none'
                    }


                    document.getElementById('is_single_registry_final_benefeciaries').textContent = clientData
                        .client_responsible
                        .is_single_registry_final_benefeciaries ? 'Si' : 'No';

                    if (clientData.client_responsible
                        .is_single_registry_final_benefeciaries == 1) {
                        document.getElementById('single_registry_final_benefeciaries_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('single_registry_final_benefeciaries_periodicity').style.display =
                            'flex'

                        document.getElementById('single_registry_final_benefeciaries_periodicity').textContent =
                            clientData
                            .client_responsible.single_registry_final_benefeciaries_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('single_registry_final_benefeciaries_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('single_registry_final_benefeciaries_periodicity').style.display =
                            'none'
                    }


                    document.getElementById('is_renovacion_esal').textContent = clientData
                        .client_responsible
                        .is_renovacion_esal ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_renovacion_esal == 1) {
                        document.getElementById('renovacion_esal_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('renovacion_esal_periodicity').style.display =
                            'flex'

                        document.getElementById('renovacion_esal_periodicity').textContent =
                            clientData
                            .client_responsible.renovacion_esal_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('renovacion_esal_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('renovacion_esal_periodicity').style.display =
                            'none'
                    }
                    document.getElementById('is_assets_abroad').textContent = clientData
                        .client_responsible
                        .is_assets_abroad ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_assets_abroad == 1) {
                        document.getElementById('assets_abroad_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('assets_abroad_periodicity').style.display =
                            'flex'

                        document.getElementById('assets_abroad_periodicity').textContent =
                            clientData
                            .client_responsible.assets_abroad_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('assets_abroad_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('assets_abroad_periodicity').style.display =
                            'none'
                    }

                    document.getElementById('is_single_registry_proposers').textContent = clientData
                        .client_responsible
                        .is_single_registry_proposers ? 'Si' : 'No';
                    document.getElementById('single_registry_proposers_periodicity').textContent = clientData
                        .client_responsible.single_registry_proposers_periodicity ?? 'No aplica';
                    if (clientData.client_responsible
                        .is_single_registry_proposers == '1' && clientData.client_responsible
                        .single_registry_proposers_places) {
                        const table = document.getElementById("single_registry_proposers_places_table");
                        const tbody = table.querySelector("tbody");
                        tbody.innerHTML = "";

                        function addRow(deparment, city) {
                            let row = document.createElement("tr");

                            row.innerHTML = `
                            <td>${deparment}</td>
                            <td>${city}</td>
                            `;

                            tbody.appendChild(row);
                            table.style.display = "table"; // Mostrar la tabla si está oculta
                        }
                        JSON.parse(clientData.client_responsible
                            .single_registry_proposers_places).forEach(item => addRow(item.deparment, item.city));

                    } else {
                        document.getElementById('single_registry_proposers_periodicity').style.display = 'none'
                        document.getElementById('single_registry_proposers_places_table').style.display = 'none'
                        document.getElementById('single_registry_proposers_periodicity_lbl').style.display =
                            'none'
                    }

                    document.getElementById('is_renewal_commercial_registration')
                        .textContent = clientData
                        .client_responsible
                        .is_renewal_commercial_registration ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_renewal_commercial_registration == 1) {
                        document.getElementById('renewal_commercial_registration_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('renewal_commercial_registration_periodicity').style.display =
                            'flex'

                        document.getElementById('renewal_commercial_registration_periodicity').textContent =
                            clientData
                            .client_responsible.renewal_commercial_registration_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('renewal_commercial_registration_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('renewal_commercial_registration_periodicity').style.display =
                            'none'
                    }

                    document.getElementById('is_national_tourism_fund')
                        .textContent = clientData
                        .client_responsible
                        .is_national_tourism_fund ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_national_tourism_fund == 1) {
                        document.getElementById('national_tourism_fund_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('national_tourism_fund_periodicity').style.display =
                            'flex'

                        document.getElementById('national_tourism_fund_periodicity').textContent =
                            clientData
                            .client_responsible.national_tourism_fund_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('national_tourism_fund_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('national_tourism_fund_periodicity').style.display =
                            'none'
                    }

                    document.getElementById('is_special_tax_regime')
                        .textContent = clientData
                        .client_responsible
                        .is_special_tax_regime ? 'Si' : 'No';


                    document.getElementById('is_national_tourism_registry')
                        .textContent = clientData
                        .client_responsible
                        .is_national_tourism_registry ? 'Si' : 'No';
                    if (clientData.client_responsible
                        .is_national_tourism_registry == 1) {
                        document.getElementById('national_tourism_registry_periodicity_lbl').style.display =
                            'flex'
                        document.getElementById('national_tourism_registry_periodicity').style.display =
                            'flex'

                        document.getElementById('national_tourism_registry_periodicity').textContent =
                            clientData
                            .client_responsible.national_tourism_registry_periodicity ?? 'No aplica';

                    } else {
                        document.getElementById('national_tourism_registry_periodicity_lbl').style.display =
                            'none'
                        document.getElementById('national_tourism_registry_periodicity').style.display =
                            'none'
                    }



                    // Actualiza la tabla de contactos
                    const contactTableBody = document.getElementById('contactTableBody');
                    contactTableBody.innerHTML = ''; // Limpia la tabla
                    clientData.contact_info.forEach(contact => {
                        const row = `
                    <tr>
                        <td>${contact.document_type.name}</td>
                        <td>${contact.identification}</td>
                        <td>${contact.firstname}</td>
                        <td>${contact.lastname}</td>
                        <td>${contact.birthday??'-'}</td>
                        <td>${contact.job_title}</td>
                        <td>${
                            (() => {
                                try {
                                    if (!contact.channel_communication) return 'Ninguno'; // Manejo de null o undefined

                                    let parsed = JSON.parse(contact.channel_communication.replace(/\\"/g, '"'));
                                    return Array.isArray(parsed) ? parsed.join(', ') : parsed;
                                } catch (e) {
                                    return contact.channel_communication.replace(/[\[\]"]/g, '') || 'Ninguno';
                                }
                            })()
                        }</td>
                        <td>${contact.email}</td>
                        <td>${contact.cellphone}</td>
                        <td>${contact.observation??''}</td>
                    </tr>`;
                        contactTableBody.insertAdjacentHTML('beforeend', row);
                    });

                    // Actualiza la tabla de comentarios
                    if (Array.isArray(clientData.comments_client) && clientData.comments_client.length > 0) {
                        clientData.comments_client.forEach(comment => {
                            const row = `
                            <tr>
                                <td>${comment.description}</td>
                                <td>${new Date(comment.created_at).toLocaleString('es-CO', { timeZone: 'America/Bogota' })}</td>
                                <td>${comment.created_by.name}</td>
                            </tr>`;
                            commentsTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        // Si no hay comentarios, agrega una fila indicando que no hay datos
                        commentsTableBody.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center">No hay comentarios disponibles</td>
                        </tr>`;
                    }

                    let foldersTableBody = document.getElementById('foldersTableBody');
                    // Actualiza la tabla de carpetas del cliente
                    if (Array.isArray(clientData.folders) && clientData.folders.length > 0) {
                        clientData.folders.forEach(folder => {
                            const row = `
                            <tr>
                                <td>${folder.name}</td>
                                <td>${folder.periodicity}</td>
                            </tr>`;
                            foldersTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        // Si no hay comentarios, agrega una fila indicando que no hay datos
                        foldersTableBody.innerHTML = `
                        <tr>
                            <td colspan="2" class="text-center">No hay Carpetas asignadas</td>
                        </tr>`;
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cargar la información del cliente.',
                        confirmButtonText: 'Aceptar'
                    });
                });

            var myModal = new bootstrap.Modal(document.getElementById('seeClientModal'));
            // Mostrar el modal
            myModal.show();

        }
    </script>

@endsection
