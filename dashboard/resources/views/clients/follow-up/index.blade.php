@extends('layouts.master')

@section('title', 'Seguimiento')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Siguimiento" pagetitle="Seguimiento" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Seguimiento</h5>
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="year" class="form-label">Año Seguimiento</label>
                            <select name="year" id="year" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tbl-client-follow-up" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>

                                            <th>Año</th>
                                            <th>Mes</th>
                                            <th>Fecha Final</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Mes</th>
                                            <th>Fecha Final</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div><!--end row-->


@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let table
            let clientId = {{ $client_id }}
            // Manejar el evento de cambio
            $('#year').on('change', function() {
                let selectedYear = $(this).val();
                if ($.fn.dataTable.isDataTable('#tbl-client-follow-up')) {
                    // Si está inicializado, recargar datos
                    table.ajax.url(`/clients-follow-up/${clientId}/${selectedYear}`).load();
                } else {
                    table = $('#tbl-client-follow-up').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: `/clients-follow-up/${clientId}/${selectedYear}`,
                        columns: [{
                                data: 'year',
                                name: 'year'
                            }, {
                                data: 'month',
                                name: 'month'
                            },

                            {
                                data: 'end_date',
                                name: 'end_date'
                            },
                            {
                                data: 'state',
                                name: 'state'
                            },


                            {
                                data: 'acciones',
                                name: 'acciones',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });
                }
            });
        });
    </script>
@endsection
