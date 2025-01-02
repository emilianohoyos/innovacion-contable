@extends('layouts.master')

@section('title', 'Dashboard')
$@section('css')
    <link href="{{ URL::asset('dist/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    <x-page-title title="Dashboard" pagetitle="Alternate" />

    <div class="row align-items-stretch row-cols-1 row-cols-xl-4">
        <div class="col">
            <div class="card border-primary border-bottom rounded-4">
                <div class="card-body h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Solicitudes</p>
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
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">1254</h4>
                            <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">100%</p>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Pendientes</p>
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
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">600</h4>
                            <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">50%</p>
                            </div>
                        </div>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Atendidas</p>
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
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">300</h4>
                            <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">25%</p>
                            </div>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6">Total Pendiente Asignar</p>
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
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="">
                            <h4 class="mb-0 fw-bold">300</h4>
                            <div class="d-flex align-items-center justify-content-start gap-1 text-success mt-3">
                                <span class="material-icons-outlined fs-6">north</span>
                                <p class="mb-0 fs-6">25%</p>
                            </div>
                        </div>
                        <div id="chart4"></div>
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
                                        <th>Identificación</th>
                                        <th>Cliente</th>
                                        <th>Fecha Estimada Atención</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
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

    <script src="{{ URL::asset('dist/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/index2.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/fullcalendar/js/main.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: '2020-09-12',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: [{
                    title: 'All Day Event',
                    start: '2020-09-01',
                }, {
                    title: 'Long Event',
                    start: '2020-09-07',
                    end: '2020-09-10'
                }, {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-09T16:00:00'
                }, {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-16T16:00:00'
                }, {
                    title: 'Conference',
                    start: '2020-09-11',
                    end: '2020-09-13'
                }, {
                    title: 'Meeting',
                    start: '2020-09-12T10:30:00',
                    end: '2020-09-12T12:30:00'
                }, {
                    title: 'Lunch',
                    start: '2020-09-12T12:00:00'
                }, {
                    title: 'Meeting',
                    start: '2020-09-12T14:30:00'
                }, {
                    title: 'Happy Hour',
                    start: '2020-09-12T17:30:00'
                }, {
                    title: 'Dinner',
                    start: '2020-09-12T20:00:00'
                }, {
                    title: 'Birthday Party',
                    start: '2020-09-13T07:00:00'
                }, {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2020-09-28'
                }]
            });
            calendar.render();
        });
    </script>
@endsection
