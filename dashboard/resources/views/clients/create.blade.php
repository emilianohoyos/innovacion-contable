@extends('layouts.master')

@section('title', 'Alternate')
@section('css')
    <link href="{{ URL::asset('build/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet">
@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Registro de Clientes" />
    <!--start stepper one-->
    <div id="stepper1" class="bs-stepper">
        <div class="card">

            <div class="card-header">
                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                    <div class="step" data-target="#test-l-1">
                        <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                            <div class="bs-stepper-circle">1</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Informacion cliente</h5>
                                <p class="mb-0 steper-sub-title">Ingrese la informacion del clientes</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Datos de contacto</h5>
                                <p class="mb-0 steper-sub-title">Agrega los datos de contacto</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-body">

                <div class="bs-stepper-content">
                    <form onSubmit="return false">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <h5 class="mb-1">Informacion cliente</h5>
                            <p class="mb-4">Ingrese la información del cliente</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="person_type_id" class="form-label">Tipo Persona</label>
                                    <select name="person_type_id" id="person_type_id" class="form-control">
                                        <option value="NATURAL">NATURAL</option>
                                        <option value="JURIDICA">JURIDICA</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nit" class="form-label">NIT/Identificacion</label>
                                    <input type="text" class="form-control" id="nit" placeholder="Ingrese Nit">
                                </div>
                                <div class="col-md-6">
                                    <label for="company_name" class="form-label">Razon social/Nombre</label>
                                    <input type="text" class="form-control" id="company_name"
                                        placeholder="Ingrese Razon Social">
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Ingrese Dirección">
                                </div>
                                <br>
                                <div class="col-md-4">



                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch" id="vat_responsible"
                                            name="vat_responsible">
                                        <label class="form-check-label" for="vat_responsible">Responsable de IVA</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_selfretaining"
                                            name="is_selfretaining">
                                        <label class="form-check-label" for="is_selfretaining">Es autorretenedor?</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_simple_taxation_regime" name="is_simple_taxation_regime">
                                        <label class="form-check-label" for="is_simple_taxation_regime">Es Regimen
                                            Simple?</label>
                                    </div>
                                </div>
                                <div class="col-md-6 row g-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-check-info">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="is_ica_withholding_agent" name="is_ica_withholding_agent">
                                            <label class="form-check-label" for="is_ica_withholding_agent">Es Agente
                                                retenedor
                                                de
                                                ICA
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el
                                            cual es
                                            agente retenedor</label>
                                        <input type="text" class="form-control"
                                            id="municipality_ica_withholding_agent" placeholder="Ingrese municipio">
                                    </div>
                                </div>
                                <div class="col-md-6 row g-4">
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-check-info">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="is_ica_withholding_agent" name="is_ica_withholding_agent">
                                            <label class="form-check-label" for="is_ica_withholding_agent">Es Agente
                                                Autoretenedor de
                                                ICA
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el
                                            cual es
                                            agente Autoretenedor</label>
                                        <input type="text" class="form-control"
                                            id="municipality_ica_withholding_agent" placeholder="Ingrese municipio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="employee_id" class="form-label">Empleado que atiende</label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="Empleado 1">Empleado 1</option>
                                        <option value="Empleado2">Empleado2</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="observation" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones."
                                        rows="3"></textarea>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <button class="btn btn-primary px-4" onclick="stepper1.next()">Siguiente<i
                                            class='bx bx-right-arrow-alt ms-2'></i></button>
                                </div>
                            </div><!---end row-->

                        </div>

                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

                            <h5 class="mb-1">Informacion de contacto</h5>
                            <p class="mb-4">Ingrese la información de contacto</p>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="firstname" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Ingrese Nombres">
                                </div>
                                <div class="col-md-4">
                                    <label for="lastname" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Ingrese Apellidos">
                                </div>
                                <div class="col-md-4">
                                    <label for="job_title" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                        placeholder="Ingrese Cargo">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Ingrese Correo">
                                </div>
                                <div class="col-md-6">
                                    <label for="cellphone" class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="cellphone" name="cellphone"
                                        placeholder="Ingrese Celular">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()"><i
                                                class='bx bx-left-arrow-alt me-2'></i>Anterior</button>
                                        <button class="btn btn-success px-4" onclick="stepper1.next()">Guardar</button>
                                    </div>
                                </div>
                            </div><!---end row-->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--end stepper one-->
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/bs-stepper/js/main.js') }}"></script>

@endsection
