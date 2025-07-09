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
                        <div class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <span class="material-icons-outlined fs-5">more_vert</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-table mt-3">
                        <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>

                                        <th>Tipo Solicitud</th>
                                        {{-- <th>Identificación</th> --}}
                                        <th>Cliente</th>
                                        <th>Fecha Estimada Atención</th>
                                        <th>Prioridad</th>
                                        {{-- <th>Estado</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
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
                                            {{-- <td>
                                                Solicitud Inicial
                                            </td> --}}
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:;"
                                                        class="dropdown-toggle-nocaret options dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        <span class="material-icons-outlined fs-5">more_vert</span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:;">Something else
                                                                here</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>

                                        <td>
                                            Tarea
                                        </td>
                                        <td>Identificación</td>
                                        <td>Carlos Hoyos</td>
                                        <td>02-02-2024</td>
                                        <td class="text-danger">
                                            Alta
                                        </td>
                                        <td>
                                            Solicitud Inicial
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:;"
                                                    class="dropdown-toggle-nocaret options dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    <span class="material-icons-outlined fs-5">more_vert</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:;">Something else
                                                            here</a></li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>


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




@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/index2.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/fullcalendar/js/main.min.js') }}"></script>
    <script>
        window.applications = @json($applications);
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
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: window.applications.map(function(app) {
                    return {
                        title: app.apply_type_name + ' - ' + app.company_name,
                        start: app.created_at, // o la fecha que prefieras
                        // Puedes agregar más campos según tu modelo
                        end: app.estimated_delevery_date,
                        // url: '/application/' + app.application_id
                    };
                }),
            });
            calendar.render();
        });
    </script>
@endsection
