@extends('layouts.master')

@section('title', 'Tipo Documento Solicitud')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.css') }}">
@endsection
@section('content')
    @vite('resources/js/apply_document_type/apply_document_type.js')
    <x-page-title title="Tipo documento Solicitud" pagetitle="Registro de Tipo Documento Solicitud" />
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Tipo Documento Solicitud</h5>
                    <form class="row g-3" id="formApplyDocumentType">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ingrese Nombre del tipo de solicitud">
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-md-flex d-grid align-items-right justify-content-md-end gap-3">
                                <button type="submit" class="btn btn-primary px-4">guardar</button>
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
    <script src="{{ URL::asset('build/plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        let pathCreate = "{{ route('applydocumenttype.store') }}"
        let pathlist = "{{ route('applydocumenttype.index') }}"
    </script>
@endsection
