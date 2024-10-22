@extends('layouts.master')

@section('title', 'Alternate')
@section('css')

@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Registro de Clientes" />

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Formulario Clientes</h5>
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Tipo Persona</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="NATURAL">NATURAL</option>
                                <option value="JURIDICA">JURIDICA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" class="form-control" id="nit" placeholder="Ingrese Nit">
                        </div>
                        <div class="col-md-6">
                            <label for="company_name" class="form-label">Razon social</label>
                            <input type="text" class="form-control" id="company_name" placeholder="Ingrese Razon Social">
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Ingrese Dirección">
                        </div>
                        <br>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vat_responsible" name="vat_responsible">
                                <label class="form-check-label" for="vat_responsible">Responsable de IVA</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_selfretaining"
                                    name="is_selfretaining">
                                <label class="form-check-label" for="is_selfretaining">Es autorretenedor?</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_simple_taxation_regime"
                                    name="is_simple_taxation_regime">
                                <label class="form-check-label" for="is_simple_taxation_regime">Es Regimen Simple?</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_ica_withholding_agent"
                                    name="is_ica_withholding_agent">
                                <label class="form-check-label" for="is_ica_withholding_agent">Es Agente retenedor de
                                    ICA
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el cual es
                                agente retenedor</label>
                            <input type="text" class="form-control" id="municipality_ica_withholding_agent"
                                placeholder="Ingrese municipio">
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_ica_withholding_agent"
                                    name="is_ica_withholding_agent">
                                <label class="form-check-label" for="is_ica_withholding_agent">Es Agente Autoretenedor de
                                    ICA
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el cual es
                                agente Autoretenedor</label>
                            <input type="text" class="form-control" id="municipality_ica_withholding_agent"
                                placeholder="Ingrese municipio">
                        </div>
                        <div class="col-md-12">
                            <label for="observation" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones." rows="3"></textarea>
                        </div>
                        <!-- Separador con hr y texto en el centro -->
                        <div class="d-flex align-items-center my-4">
                            <hr class="flex-grow-1">
                            <span class="px-3">Datos de contacto</span>
                            <hr class="flex-grow-1">
                        </div>
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
