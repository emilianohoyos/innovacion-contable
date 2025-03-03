@extends('layouts.master')

@section('title', 'Alternate')
@section('css')
    <link href="{{ URL::asset('build/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet">
    {{-- <link href="{{ URL::asset('build/plugins/Drag-And-Drop/build/imageuploadify.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
    <x-page-title title="Solicitudes" pagetitle="Registro de Solicitudes" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Solicitudes</h5>
                    <form id="applicationForm" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="apply_type_id" class="form-label">Tipo Solicitud</label>
                            <select name="apply_type_id" id="apply_type_id" class="form-control">
                                @foreach ($applyTypes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="client_id" class="form-label">Seleccione Cliente</label>
                            <select name="client_id" id="client_id" class="form-control">

                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->nit }}-{{ $item->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="estimated_delevery_date" class="form-label">Fecha estimada de atencion</label>
                            <input type="date" class="form-control" id="estimated_delevery_date"
                                name="estimated_delevery_date">
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Seleccione Prioridad</label>
                            <select name="priority" id="priority" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="ALTA">ALTA</option>
                                <option value="MEDIA">MEDIA</option>
                                <option value="BAJA">BAJA</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="employee_id" class="form-label">Seleccione Responsable atención</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($employees as $item)
                                    <option value="{{ $item->id }}">{{ $item->firstname }}{{ $item->lastname }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="observation" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones." rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="observation" class="form-label">Cargar Adjuntos</label>
                            <input id="fancy-file-upload" type="file" name="files"
                                accept=".jpg, .png, image/jpeg, image/png" multiple>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-md-flex d-grid align-items-left gap-3">
                                <button type="submit" class="btn btn-primary px-4">Guardar</button>
                                <button type="button" class="btn btn-light px-4">Limpiar</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div><!--end row-->


@endsection
@section('scripts')

    <script src="{{ URL::asset('build/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/plugins/Drag-And-Drop/build/imageuploadify.min.js') }}"></script> --}}
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $('#fancy-file-upload').FancyFileUpload({
            params: {
                action: 'fileuploader'
            },
            maxfilesize: 1000000, // 1MB por archivo

            added: function(e, data) {
                // No subir automáticamente, solo agregar archivos a la memoria

                $('.ff_fileupload_start_upload')
                    .remove(); // 🔹 Elimina el botón de "Start Upload"

                console.log("Archivo agregado:", data.files);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#apply_type_id").change(function() {
                let applyTypeId = $(this).val();

                if (applyTypeId) {
                    $.ajax({
                        url: `/applytype/${applyTypeId}`,
                        type: "GET",
                        success: function(response) {
                            if (response.status) {
                                // $("#priority").val(response.priority);
                                // Obtener la fecha actual
                                let today = new Date();

                                // Sumar los días estimados que devuelve la API
                                today.setDate(today.getDate() + response.data.estimated_days);

                                // Formatear la fecha a YYYY-MM-DD para el input date
                                let formattedDate = today.toISOString().split('T')[0];

                                // Asignar la fecha al campo
                                $('#estimated_delevery_date').val(formattedDate);

                                $('#priority').val(response.data.priority).trigger('change');
                            } else {
                                console.error("Error:", response.message);
                            }
                        },
                        error: function(xhr) {
                            console.error("Error en la petición:", xhr);
                        }
                    });
                }
            });

            $("#applicationForm").submit(function(event) {
                event.preventDefault(); // Evitar el envío normal

                let formData = new FormData(this); // Crear FormData con los datos del formulario
                let files = $('#fancy-file-upload').FancyFileUpload('files'); // Obtener archivos

                if (files.length === 0) {
                    alert('no hay registros ')
                    console.warn("No hay archivos seleccionados en FancyFileUpload");
                }

                $.each(files, function(index, file) {
                    if (file.file) {
                        console.log("Añadiendo archivo:", file.file.name); // Verificar en consola
                        formData.append("files[]", file.file, file.file.name);
                    }
                });

                $.ajax({
                    url: "/application", // Ruta en el backend
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    },
                    data: formData,
                    contentType: false, // Necesario para enviar archivos
                    processData: false, // Evita que jQuery procese los datos
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Solicitud guardada!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href =
                                    "{{ route('application.index') }}"; // Limpiar el formulario
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message ||
                                    'No se pudo guardar la solicitud',
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en el servidor',
                            text: 'Hubo un problema al procesar la solicitud. Intenta de nuevo.',
                        });
                        console.error("Error en AJAX:", xhr.responseText);
                    }
                });
            });
        })
    </script>
@endsection
