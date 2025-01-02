@extends('layouts.master')

@section('title', 'Carpeta')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.css') }}">
@endsection
@section('content')
    @vite('resources/js/folders/folder.js')
    <x-page-title title="Carpeta" pagetitle="Carpeta" />
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Carpeta</h5>
                    <form class="row g-3" id="formFolder">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ingrese Nombre de la carpeta">
                        </div>
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Tipo Persona</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="">Seleccione...</option>
                                @foreach ($person_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-md-flex d-grid align-items-left gap-3">
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
    <script src="{{ URL::asset('dist/plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        let pathCreate = "{{ route('folder.store') }}"
        let pathlist = "{{ route('folder.index') }}"
    </script>
@endsection
