@extends('layouts.master')

@section('title', 'Alternate')
@section('css')
    <link href="{{ URL::asset('build/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <x-page-title title="Solicitudes" pagetitle="Registro de Solicitudes" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Solicitudes</h5>
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Tipo Solicitud</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="TAREA">TAREA</option>
                                <option value="SOLICITUD INICIAL">SOLICITUD INICIAL</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="client_id" class="form-label">Seleccione Cliente</label>
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="12345">1216715427- Carlos Hoyos </option>
                                <option value="12">1216715427- Carlos Hoyos </option>
                                <option value="12334556">1216715427- Carlos Hoyos </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="estimated_delevery_date" class="form-label">Fecha estimada de atencion</label>
                            <input type="date" class="form-control" id="estimated_delevery_date"
                                name="estimated_delevery_date">
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Seleccione Prioridad</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="Critica">Critica</option>
                                <option value="Alta">Alta</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="employee_id" class="form-label">Seleccione Responsable atencion</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="1">Andres Martinez</option>
                                <option value="2">Pablo lopez</option>
                                <option value="3">Luis Diaz</option>
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
                            <div class="d-md-flex d-grid align-items-right justify-content-md-end gap-3">
                                <button type="button" class="btn btn-primary px-4">guardar</button>
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
    <script src="{{ URL::asset('build/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    <script>
        $('#fancy-file-upload').FancyFileUpload({
            params: {
                action: 'fileuploader'
            },
            maxfilesize: 1000000
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#image-uploadify').imageuploadify();

        })
    </script>
@endsection
