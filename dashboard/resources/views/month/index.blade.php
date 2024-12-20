@extends('layouts.master')

@section('title', 'Configuracion Mes')
@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Configuracion Mes" pagetitle="Configuracion Mes" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Configuracion Mes</h5>
                    <form class="row g-3">
                        @csrf
                        <div class="col-md-5">
                            <label for="year" class="form-label">Seleccione año</label>
                            <select name="year" id="year" class="form-control">
                                <option value="">Seleccione un año</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>

                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tbl-month" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Año</th>
                                            <th>Mes</th>
                                            {{-- <th>Fecha Inicial</th> --}}
                                            <th>Fecha Final</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" id="saveTable" class="btn btn-primary">Guardar Tabla</button>
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
            const tableBody = $("#tbl-month tbody");

            $('#year').on('change', function() {
                const selectedYear = $(this).val();

                if (selectedYear) {
                    // Limpiar la tabla
                    tableBody.empty();

                    // Generar las filas dinámicamente para los 12 meses
                    fetch(`/month-by-year/${selectedYear}`)
                        .then(response => response.json())
                        .then(data => {
                            // Limpiar la tabla
                            tableBody.empty();

                            if (data.length > 0) {
                                // Si hay datos, cargarlos en la tabla
                                data.forEach(row => {
                                    const minDate =
                                        `${row.year}-${String(row.month).padStart(2, '0')}-01`;
                                    const maxDate = new Date(row.year, row.month, 0);
                                    const maxDateFormatted = maxDate.toISOString().split('T')[
                                        0];

                                    const tr = `
                                <tr>
                                    <td>${row.year}</td>
                                    <td>${getMonthName(row.month)}</td>
                                    <td>
                                        <input type="date" class="form-control"
                                               value="${row.end_date || ''}"
                                               min="${minDate}" max="${maxDateFormatted}"
                                               data-id="${row.id}" data-year="${row.year}" data-month="${row.month}">
                                    </td>
                                </tr>`;
                                    tableBody.append(tr);
                                });
                            } else {
                                // Si no hay datos, generar filas vacías
                                for (let month = 1; month <= 12; month++) {
                                    const minDate =
                                        `${selectedYear}-${String(month).padStart(2, '0')}-01`;
                                    const maxDate = new Date(selectedYear, month, 0);
                                    const maxDateFormatted = maxDate.toISOString().split('T')[0];

                                    const tr = `
                                <tr>
                                    <td>${selectedYear}</td>
                                    <td>${getMonthName(month)}</td>
                                    <td>
                                        <input type="date" class="form-control"
                                               min="${minDate}" max="${maxDateFormatted}"
                                               data-year="${selectedYear}" data-month="${month}">
                                    </td>
                                </tr>`;
                                    tableBody.append(tr);
                                }
                            }
                        })
                        .catch(error => console.error('Error al cargar datos:', error));
                } else {
                    // Limpiar la tabla si no se selecciona un año
                    tableBody.empty();
                }
            });

            // Guardar toda la tabla
            $('#saveTable').on('click', function() {
                const rows = tableBody.find("tr");
                const tableData = [];

                rows.each(function() {
                    const input = $(this).find("input[type='date']");
                    tableData.push({
                        year: input.data("year"),
                        month: input.data("month"),
                        end_date: input.val() ||
                            null // Fecha seleccionada o null si está vacía
                    });
                });

                console.log("Datos a guardar:", tableData);

                // Enviar datos al servidor
                $.ajax({
                    url: '{{ route('month.store') }}',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    contentType: "application/json",
                    data: JSON.stringify({
                        table: tableData
                    }),
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(error) {
                        console.error("Error al guardar datos:", error);
                    }
                });
            });

            // Función para obtener el nombre del mes
            function getMonthName(month) {
                const months = [
                    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ];
                return months[month - 1];
            }

        });
    </script>
@endsection