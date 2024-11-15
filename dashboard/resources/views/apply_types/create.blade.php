@extends('layouts.master')

@section('title', 'Tipo Solicitud')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.css') }}">
@endsection
@section('content')
    @vite('resources/js/applytype/applytype.js')
    <x-page-title title="Tipo Solicitud" pagetitle="Registro de tipo de solicitud" />
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario tipo de solicitud</h5>
                    <form class="row g-3" id="formApplyType">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Ingrese Nombre del tipo de solicitud"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="estimated_days" class="form-label">Días Estimados para la atención</label>
                            <input type="text" class="form-control @error('estimated_days') is-invalid @enderror"
                                id="estimated_days" name="estimated_days" placeholder="Ingrese Días Estimados"
                                value="{{ old('estimated_days') }}">
                            @error('estimated_days')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-md-flex d-grid align-items-right justify-content-md-end gap-3">
                                <button type="submit" class="btn btn-primary px-4">Guardar</button>
                                <button type="reset" class="btn btn-light px-4">Limpiar</button>
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
        let pathCreate = "{{ route('applytype.store') }}"
        let pathlist = "{{ route('applytype.index') }}"
    </script>
@endsection
