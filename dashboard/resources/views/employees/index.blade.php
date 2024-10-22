@extends('layouts.master')

@section('title', 'Alternate')
@section('css')

@endsection
@section('content')
    <x-page-title title="Empleados" pagetitle="Registro de Empleados" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Empleados</h5>
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" class="form-control" id="nit" placeholder="Ingrese Nit">
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
                            <label for="cellphone" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"
                                placeholder="Ingrese Celular">
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
