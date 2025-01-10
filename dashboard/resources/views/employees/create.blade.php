@extends('layouts.master')

@section('title', 'Alternate')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.css') }}">
@endsection
@section('content')
    @vite('resources/js/employees/employees.js')
    <x-page-title title="Empleados" pagetitle="Registro de Empleados" />
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Empleados</h5>
                    <form class="row g-3" id="formEmployee">
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Tipo Documento</label>
                            <select name="document_type_id" class="form-control" id=document_type_id"">
                                <option value="">Seleccione tipo documento</option>
                                @foreach ($document_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="identification" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identification" name="identification"
                                placeholder="Ingrese identificacion">
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Ingrese Nombres">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Ingrese Apellidos">
                        </div>
                        <div class="col-md-6">
                            <label for="job_title" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="job_title" name="job_title"
                                placeholder="Ingrese Cargo">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Seleccione Cargo</option>
                                <option value="ADMIN">ADMINISTRADOR</option>
                                <option value="CONTADOR">CONTADOR</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="cellphone" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"
                                placeholder="Ingrese Celular">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Ingrese Celular">
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="d-md-flex d-grid align-items-left  gap-3">
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
    <script src="{{ URL::asset('build/plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        let pathCreateEmployee = "{{ route('employee.store') }}"
        let pathlistEmployee = "{{ route('employee.index') }}"
    </script>
@endsection
