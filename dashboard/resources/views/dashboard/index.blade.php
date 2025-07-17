@extends('layouts.master')

@section('title', 'Dashboard')
$@section('css')
    <link href="{{ URL::asset('build/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    <x-page-title title="Dashboard" pagetitle="Alternate" />

    <div class="row align-items-stretch row-cols-1 row-cols-xl-4">
        <div class="col">
            <div class="card border-primary border-bottom rounded-4">
                <div class="card-body h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Solicitudes</p>
                        {{-- <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">{{ $total_solicitudes }}</h4>
                            {{-- <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">100%</p>
                            </div> --}}
                        </div>
                        {{-- <div id="chart1"></div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Pendientes</p>
                        {{-- <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">{{ $total_solicitudes_pendientes }}</h4>
                            {{-- <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">50%</p>
                            </div> --}}
                        </div>
                        {{-- <div id="chart2"></div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Atendidas</p>
                        {{-- <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">{{ $total_solicitudes_atendidas }}</h4>
                            {{-- <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">25%</p>
                            </div> --}}
                        </div>
                        {{-- <div id="chart3"></div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Cancelados</p>
                        {{-- <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>

                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">{{ $total_solicitudes_canceladas }}</h4>
                            {{-- <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">25%</p>
                            </div> --}}
                        </div>
                        {{-- <div id="chart4"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row align-items-stretch">
        <div class="col-12 col-xl-6">
            <div class="card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="mb-0 fs-6">Solicitudes Pendientes </h3>
                        {{-- <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="product-table mt-3">
                        <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle" id="applicationsTable">
                                <thead class="table-light">
                                    <tr>

                                        <th>Tipo Solicitud</th>
                                        {{-- <th>Identificación</th> --}}
                                        <th>Cliente</th>
                                        <th>Fecha Estimada Atención</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Fecha Creación</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        {{-- @dd($application) --}}
                                        <tr>

                                            <td>
                                                {{ $application->apply_type_name }}
                                            </td>
                                            {{-- <td>Identificación</td> --}}
                                            <td>{{ $application->company_name }}</td>
                                            <td>{{ $application->estimated_delevery_date }}</td>
                                            <td class="text-danger">
                                                {{ $application->priority }}
                                            </td>
                                            <td>
                                                {{ $application->state_name }}
                                            </td>
                                            <td>
                                                {{ $application->created_at->format('Y-m-d') }}
                                            <td>
                                                <button type='button'
                                                    class='btn btn-primary raised d-inline-flex align-items-center justify-content-center'
                                                    onClick='seeApplicationModal({{ $application->application_id }})'>
                                                    <i class='material-icons-outlined'>visibility</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card rounded-4 h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    @include('applications.modals.see-application')


@endsection
@section('scripts')

    {{-- <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('build/js/index2.js') }}"></script> --}}
    <script src="{{ URL::asset('build/plugins/fullcalendar/js/main.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        window.applications = @json($applications);

        $('#applicationsTable').DataTable({
            "language": {
                url: "{{ URL::asset('build/plugins/datatable/js/es.json') }}"
            },
            "order": [
                [2, "asc"]
            ],
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100],
        });

        FullCalendar.globalLocales.push(function() {
            'use strict';

            var es = {
                code: "es",
                week: {
                    dow: 1, // Monday is the first day of the week.
                    doy: 4 // The week that contains Jan 4th is the first week of the year.
                },
                buttonText: {
                    prev: "Ant",
                    next: "Sig",
                    today: "Hoy",
                    month: "Mes",
                    week: "Semana",
                    day: "Día",
                    list: "Agenda"
                },
                weekText: "Sm",
                allDayText: "Todo el día",
                moreLinkText: "más",
                noEventsText: "No hay eventos para mostrar"
            };

            return es;

        }());
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                locale: 'es',
                initialView: 'dayGridMonth',
                navLinks: true,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true,
                editable: true,
                businessHours: true,
                events: window.applications.map(function(app) {
                    return {
                        id: app.application_id,
                        title: app.apply_type_name + ' - ' + app.company_name,
                        start: app.created_at,
                        end: app.estimated_delevery_date
                    };
                }),
                eventClick: function(info) {
                    if (info.event.id) {
                        seeApplicationModal(info.event.id);
                    }
                }
            });
            calendar.render();
        });

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
                            button.className =
                                "btn btn-danger px-4 raised d-flex gap-2 align-items-center";
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
    </script>
@endsection
