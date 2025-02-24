@extends('layouts.master')

@section('title', 'Alternate')
@section('css')
    <link href="{{ URL::asset('build/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/plugins/select2/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

    <style>
        /* Puntos de color */
        .select2-results__option span.color-dot,
        .select2-selection__rendered span.color-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            /* Hace que el punto sea redondo */
            margin-right: 8px;
            /* Espacio entre el punto y el texto */
            vertical-align: middle;
            /* Alinea el punto con el texto */
        }

        /* Colores específicos para las opciones */
        .select2-results__option--alta span.color-dot,
        .select2-selection__rendered--alta span.color-dot {
            background-color: #dc3545;
            /* Rojo */
        }

        .select2-results__option--media span.color-dot,
        .select2-selection__rendered--media span.color-dot {
            background-color: #ffc107;
            /* Amarillo */
        }

        .select2-results__option--baja span.color-dot,
        .select2-selection__rendered--baja span.color-dot {
            background-color: #28a745;
            /* Verde */
        }
    </style>


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
                    <div class="step" data-target="#test-l-4">
                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Responsabilidades Fiscales</h5>
                                <p class="mb-0 steper-sub-title">Agrega las responsabilidades del cliente</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">3</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Datos de contacto</h5>
                                <p class="mb-0 steper-sub-title">Agrega los datos de contacto</p>
                            </div>
                        </div>
                    </div>


                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-3">
                        <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">4</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Asociar Empleado que atiende</h5>
                                <p class="mb-0 steper-sub-title">Agrega los empleados que atienden</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-body">

                <div class="bs-stepper-content">
                    <form id="formClient" onSubmit="return false">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <h5 class="mb-1">Informacion cliente</h5>
                            <p class="mb-4">Ingrese la información del cliente</p>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="person_type_id" class="form-label">Tipo Persona <span
                                            style="color: red">*</span></label>
                                    <select name="person_type_id" id="person_type_id" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($person_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="document_type_id" class="form-label">Tipo documento <span
                                            style="color: red">*</span></label>
                                    <select name="document_type_id" id="document_type_id" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($document_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nit" class="form-label">NIT/Identificacion <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="nit" name="nit"
                                        placeholder="Ingrese Nit" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="company_name" class="form-label">Razon social/Nombre <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        placeholder="Ingrese Razon Social" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Dirección Empresa <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Ingrese Dirección" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_company" class="form-label">Correo Electrónico Corporativo <span
                                            style="color: red">*</span></label>
                                    <input type="email_company" class="form-control" id="email_company"
                                        name="email_company" placeholder="Ingrese Dirección" required>
                                </div>
                                <br>

                                <div class="col-md-12">
                                    <label for="category" class="form-label">Prioridad <span
                                            style="color: red">*</span></label>
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="MEDIA">MEDIA</option>
                                        <option value="BAJA">BAJA</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="review" class="form-label">Reseña</label>
                                    <textarea class="form-control" id="review" name="review" placeholder="Ingrese Reseña" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="observation" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones."
                                        rows="3"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 text-end">
                                    <button class="btn btn-primary px-4" onclick="stepper1.next()">
                                        Siguiente<i class='bx bx-right-arrow-alt ms-2'></i>
                                    </button>
                                </div>
                            </div><!---end row-->

                        </div>
                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">

                            <h5 class="mb-1">Responsabilidades del cliente</h5>
                            <p class="mb-4">Seleccione las responsabilidades</p>
                            <div class="row g-3">
                                <br>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-4">
                                        <label for="is_simple_taxation_regime" class="form-label">Regimen Simple de
                                            Tributación
                                            <select name="is_simple_taxation_regime" id="is_simple_taxation_regime"
                                                class="form-control">
                                                <option value="FALSE">NO</option>
                                                <option value="TRUE">SI</option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="simple_taxation_regime_advances"
                                            id="simple_taxation_regime_advances_lbl" class="form-label"
                                            style="display: none">Anticipo</label>
                                        <select name="simple_taxation_regime_advances"
                                            id="simple_taxation_regime_advances" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="simple_taxation_regime_consolidated_annual"
                                            id="simple_taxation_regime_consolidated_annual_lbl" class="form-label"
                                            style="display: none">Anual
                                            Consolidada</label>
                                        <select name="simple_taxation_regime_consolidated_annual" style="display: none"
                                            id="simple_taxation_regime_consolidated_annual" class="form-control">
                                            <option value="IVA">IVA</option>
                                            <option value="IRS">IRS</option>
                                            <option value="IVA E IRS">IVA E IRS</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_industry_commerce" class="form-label">Industria y Comercio</label>
                                        <select name="is_industry_commerce" id="is_industry_commerce"
                                            class="form-control" style="display: none">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="industry_commerce_periodicity" class="form-label"
                                            id="industry_commerce_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="industry_commerce_periodicity" id="industry_commerce_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 industry_commerce_display row">
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_department" style="display: none"
                                                id="industry_commerce_department_lbl"
                                                class="form-label">Departamento</label>
                                            <select name="industry_commerce_department" id="industry_commerce_department"
                                                class="form-control" style="display: none">
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_city" class="form-label"
                                                id="industry_commerce_city_lbl" style="display: none">Municipio</label>
                                            <select name="industry_commerce_city" id="industry_commerce_city"
                                                class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <button id="industry_commerce_places_add-row" style="display: none"
                                                class="btn btn-primary px-4 w-100 mt-5">+</button>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_places_table" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_industry_commerce_retainer" class="form-label">Retenedor Industria
                                            y Comercio</label>
                                        <select name="is_industry_commerce_retainer" id="is_industry_commerce_retainer"
                                            class="form-control" style="display: none">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="industry_commerce_retainer_periodicity" class="form-label"
                                            id="industry_commerce_retainer_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="industry_commerce_retainer_periodicity"
                                            id="industry_commerce_retainer_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 industry_commerce_retainer_display row">
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_retainer_department" style="display: none"
                                                id="industry_commerce_retainer_department_lbl"
                                                class="form-label">Departamento</label>
                                            <select name="industry_commerce_retainer_department"
                                                id="industry_commerce_retainer_department" class="form-control"
                                                style="display: none">
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_retainer_city" class="form-label"
                                                id="industry_commerce_retainer_city_lbl"
                                                style="display: none">Municipio</label>
                                            <select name="industry_commerce_retainer_city"
                                                id="industry_commerce_retainer_city" class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-md-1 ">
                                            <button id="industry_commerce_retainer_places_add-row" style="display: none"
                                                class="btn btn-primary px-4 w-100 mt-5">+</button>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_retainer_places_table" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_industry_commerce_selfretaining" class="form-label">Autorretenedor
                                            Industria
                                            y Comercio</label>
                                        <select name="is_industry_commerce_selfretaining"
                                            id="is_industry_commerce_selfretaining" class="form-control"
                                            style="display: none">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="industry_commerce_selfretaining_periodicity" class="form-label"
                                            id="industry_commerce_selfretaining_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="industry_commerce_selfretaining_periodicity"
                                            id="industry_commerce_selfretaining_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 row industry_commerce_selfretaining_display display">
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_selfretaining_department" style="display: none"
                                                id="industry_commerce_selfretaining_department_lbl"
                                                class="form-label">Departamento</label>
                                            <select name="industry_commerce_selfretaining_department"
                                                id="industry_commerce_selfretaining_department" class="form-control"
                                                style="display: none">
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label for="industry_commerce_selfretaining_city" class="form-label"
                                                id="industry_commerce_selfretaining_city_lbl"
                                                style="display: none">Municipio</label>
                                            <select name="industry_commerce_selfretaining_city"
                                                id="industry_commerce_selfretaining_city" class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-md-1 ">
                                            <button id="industry_commerce_selfretaining_places_add-row"
                                                style="display: none" class="btn btn-primary px-4 w-100 mt-5">+</button>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_selfretaining_places_table"
                                                    style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="vat_responsible" class="form-label">IVA</label>
                                        <select name="vat_responsible" id="vat_responsible" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vat_responsible_periodicity" class="form-label"
                                            id="vat_responsible_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="vat_responsible_periodicity" id="vat_responsible_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="vat_responsible_observation" id="vat_responsible_observation_lbl"
                                            class="form-label" style="display: none">Observaciones</label>
                                        <textarea class="form-control" id="vat_responsible_observation" name="vat_responsible_observation"
                                            style="display: none" placeholder="Ingrese observaciones." rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_rent" class="form-label">Renta</label>
                                        <select name="is_rent" id="is_rent" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rent_periodicity" class="form-label" id="rent_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="rent_periodicity" id="rent_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_supersociety" class="form-label">Supersociedades</label>
                                        <select name="is_supersociety" id="is_supersociety" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="supersociety_periodicity" class="form-label"
                                            id="supersociety_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="supersociety_periodicity" id="supersociety_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_supertransport" class="form-label">Supertransportes</label>
                                        <select name="is_supertransport" id="is_supertransport" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="supertransport_periodicity" class="form-label"
                                            id="supertransport_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="supertransport_periodicity" id="supertransport_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="supertransport_observation" id="supertransport_observation_lbl"
                                            class="form-label" style="display: none">Observaciones</label>
                                        <textarea class="form-control" id="supertransport_observation" name="supertransport_observation"
                                            style="display: none" placeholder="Ingrese observaciones." rows="3"></textarea>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_superfinancial" class="form-label">Superfinanciera</label>
                                        <select name="is_superfinancial" id="is_superfinancial" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="superfinancial_periodicity" class="form-label"
                                            id="superfinancial_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="superfinancial_periodicity" id="superfinancial_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_source_retention" class="form-label">Retención en la fuente</label>
                                        <select name="is_source_retention" id="is_source_retention" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="source_retention_periodicity" class="form-label"
                                            id="source_retention_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="source_retention_periodicity" id="source_retention_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_dian_exogenous_information" class="form-label">Información exógena
                                            DIAN</label>
                                        <select name="is_dian_exogenous_information" id="is_dian_exogenous_information"
                                            class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dian_exogenous_information_periodicity" class="form-label"
                                            id="dian_exogenous_information_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="dian_exogenous_information_periodicity"
                                            id="dian_exogenous_information_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_municipal_exogenous_information" class="form-label">Información
                                            Exógena Municipal</label>
                                        <select name="is_municipal_exogenous_information"
                                            id="is_municipal_exogenous_information" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="municipal_exogenous_information_periodicity" class="form-label"
                                            id="municipal_exogenous_information_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="municipal_exogenous_information_periodicity"
                                            id="municipal_exogenous_information_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 municipal_exogenous_information_display row">
                                        <div class="col-md-2 mt-3">
                                            <label for="municipal_exogenous_information_department" style="display: none"
                                                id="municipal_exogenous_information_department_lbl"
                                                class="form-label">Departamento</label>
                                            <select name="municipal_exogenous_information_department"
                                                id="municipal_exogenous_information_department" class="form-control"
                                                style="display: none">
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label for="municipal_exogenous_information_city" class="form-label"
                                                id="municipal_exogenous_information_city_lbl"
                                                style="display: none">Municipio</label>
                                            <select name="municipal_exogenous_information_city"
                                                id="municipal_exogenous_information_city" class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-md-1 ">
                                            <button id="municipal_exogenous_information_places_add-row"
                                                style="display: none" class="btn btn-primary px-4 w-100 mt-5">+</button>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered table-striped"
                                                    id="municipal_exogenous_information_places_table"
                                                    style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_wealth_tax" class="form-label">Impuesto al patrimonio</label>
                                        <select name="is_wealth_tax" id="is_wealth_tax" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="wealth_tax_periodicity" class="form-label"
                                            id="wealth_tax_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="wealth_tax_periodicity" id="wealth_tax_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_radian" class="form-label">Radian</label>
                                        <select name="is_radian" id="is_radian" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="radian_periodicity" class="form-label" id="radian_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="radian_periodicity" id="radian_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_e_payroll" class="form-label">Nómina electroníca</label>
                                        <select name="is_e_payroll" id="is_e_payroll" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="e_payroll_periodicity" class="form-label"
                                            id="e_payroll_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="e_payroll_periodicity" id="e_payroll_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_single_registry_final_benefeciaries" class="form-label">Registro
                                            único de beneficiarios finales</label>
                                        <select name="is_single_registry_final_benefeciaries"
                                            id="is_single_registry_final_benefeciaries" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="single_registry_final_benefeciaries_periodicity" class="form-label"
                                            id="single_registry_final_benefeciaries_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="single_registry_final_benefeciaries_periodicity"
                                            id="single_registry_final_benefeciaries_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_renovacion_esal" class="form-label">Renovación ESAL</label>
                                        <select name="is_renovacion_esal" id="is_renovacion_esal" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="renovacion_esal_periodicity" class="form-label"
                                            id="renovacion_esal_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="renovacion_esal_periodicity" id="renovacion_esal_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_assets_abroad" class="form-label">Activos en el exterior</label>
                                        <select name="is_assets_abroad" id="is_assets_abroad" class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="assets_abroad_periodicity" class="form-label"
                                            id="assets_abroad_periodicity_lbl" style="display: none">Periocididad</label>
                                        <select name="assets_abroad_periodicity" id="assets_abroad_periodicity"
                                            style="display: none" class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_single_registry_proposers" class="form-label">Registro único de
                                            proponentes</label>
                                        <select name="is_single_registry_proposers" id="is_single_registry_proposers"
                                            class="form-control" style="display: none">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="single_registry_proposers_periodicity" class="form-label"
                                            id="single_registry_proposers_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="single_registry_proposers_periodicity"
                                            id="single_registry_proposers_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 single_registry_proposers_display row">
                                        <div class="col-md-2 mt-3">
                                            <label for="single_registry_proposers_department" style="display: none"
                                                id="single_registry_proposers_department_lbl"
                                                class="form-label">Departamento</label>
                                            <select name="single_registry_proposers_department"
                                                id="single_registry_proposers_department" class="form-control"
                                                style="display: none">
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <label for="single_registry_proposers_city" class="form-label"
                                                id="single_registry_proposers_city_lbl"
                                                style="display: none">Municipio</label>
                                            <select name="single_registry_proposers_city"
                                                id="single_registry_proposers_city" class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-md-1 ">
                                            <button id="single_registry_proposers_places_add-row" style="display: none"
                                                class="btn btn-primary px-4 w-100 mt-5">+</button>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered table-striped"
                                                    id="single_registry_proposers_places_table" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_renewal_commercial_registration" class="form-label">Renovación de
                                            registro mercantil</label>
                                        <select name="is_renewal_commercial_registration"
                                            id="is_renewal_commercial_registration" class="form-control">

                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="renewal_commercial_registration_periodicity" class="form-label"
                                            id="renewal_commercial_registration_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="renewal_commercial_registration_periodicity"
                                            id="renewal_commercial_registration_periodicity" style="display: none"
                                            class="form-control">

                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_national_tourism_fund" class="form-label">Fondo nacional de
                                            turismo</label>
                                        <select name="is_national_tourism_fund" id="is_national_tourism_fund"
                                            class="form-control">

                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="national_tourism_fund_periodicity" class="form-label"
                                            id="national_tourism_fund_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="national_tourism_fund_periodicity"
                                            id="national_tourism_fund_periodicity" style="display: none"
                                            class="form-control">

                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_special_tax_regime" class="form-label">Regimen tributario
                                            especial</label>
                                        <select name="is_special_tax_regime" id="is_special_tax_regime"
                                            class="form-control">

                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="special_tax_regime_periodicity" class="form-label"
                                            id="special_tax_regime_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="special_tax_regime_periodicity" id="special_tax_regime_periodicity"
                                            style="display: none" class="form-control">

                                            <option value="MENSUAL">MENSUAL</option>
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div> --}}
                                </div>
                                <hr>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <label for="is_national_tourism_registry" class="form-label">Registro nacional de
                                            turismo</label>
                                        <select name="is_national_tourism_registry" id="is_national_tourism_registry"
                                            class="form-control">
                                            <option value="FALSE">NO</option>
                                            <option value="TRUE">SI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="national_tourism_registry_periodicity" class="form-label"
                                            id="national_tourism_registry_periodicity_lbl"
                                            style="display: none">Periocididad</label>
                                        <select name="national_tourism_registry_periodicity"
                                            id="national_tourism_registry_periodicity" style="display: none"
                                            class="form-control">
                                            <option value="BIMESTRAL">BIMESTRAL</option>
                                            <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                            <option value="ANUAL">ANUAL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Botón Anterior alineado a la izquierda -->
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()">
                                            <i class='bx bx-left-arrow-alt me-2'></i>Anterior
                                        </button>

                                        <!-- Botón Guardar o Siguiente alineado a la derecha -->
                                        <button class="btn btn-success px-4" onclick="stepper1.next()">Siguiente</button>
                                    </div>

                                </div>
                            </div><!---end row-->
                        </div>
                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

                            <h5 class="mb-1">Informacion de contacto</h5>
                            <p class="mb-4">Ingrese la información de contacto</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="contact_document_type_id" class="form-label">Tipo documento <span
                                            style="color: red">*</span></label>
                                    <select name="contact_document_type_id" id="contact_document_type_id"
                                        class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($document_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="identification" class="form-label">Identificación <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="identification" name="identification"
                                        placeholder="Ingrese identificacion">
                                </div>
                                <div class="col-md-6">
                                    <label for="firstname" class="form-label">Nombres <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Ingrese Nombres">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname" class="form-label">Apellidos <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Ingrese Apellidos">
                                </div>
                                <div class="col-md-6">
                                    <label for="birthday" class="form-label">Fecha de nacimiento <span
                                            style="color: red">*</span></label>
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                        placeholder="fecha de nacimiento">
                                </div>
                                <div class="col-md-6">
                                    <label for="job_title" class="form-label">Cargo <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                        placeholder="Ingrese Cargo">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo <span
                                            style="color: red">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Ingrese Correo">
                                </div>
                                <div class="col-md-6">
                                    <label for="cellphone" class="form-label">Celular <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="cellphone" name="cellphone"
                                        placeholder="Ingrese Celular">
                                </div>
                                <div class="col-md-6">
                                    <label for="cellphone" class="form-label">Medio de comunicación
                                        preferido <span style="color: red">*</span></label>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="emailCheck"
                                            name="channel_communication[]" value="email">
                                        <label class="form-check-label" for="emailCheck">Correo</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="whatsappCheck"
                                            name="channel_communication[]" value="whatsapp">
                                        <label class="form-check-label" for="whatsappCheck">WhatsApp</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="observationContact" class="form-label">Observación</label>
                                    <textarea type="text" class="form-control" id="observationContact" name="observationContact"></textarea>
                                </div>
                                <div class="col-md-12 " id="typeJuridic" style="display:none">
                                    <button id="add-row" class="btn btn-primary px-4 w-100">Agregar</button>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-bordered table-striped" id="contact-table">
                                            <thead>
                                                <tr>
                                                    <th>Tipo Iden.</th>
                                                    <th>Identificacion</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Fecha de nacimiento</th>
                                                    <th>Cargo</th>
                                                    <th>Correo</th>
                                                    <th>Celular</th>
                                                    <th>Medio de contacto</th>
                                                    <th>Observacion</th>
                                                    <th>Eliminar</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Botón Anterior alineado a la izquierda -->
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()">
                                            <i class='bx bx-left-arrow-alt me-2'></i>Anterior
                                        </button>

                                        <!-- Botón Guardar o Siguiente alineado a la derecha -->
                                        <button class="btn btn-success px-4" onclick="stepper1.next()">Siguiente</button>
                                    </div>

                                </div>
                            </div><!---end row-->
                        </div>
                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">

                            <h5 class="mb-1">Asociar Empleado que atiende</h5>
                            <p class="mb-4">Agregue los empleados que pueden atender </p>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="employee_id" class="form-label">Empleado que atiende<span
                                            style="color: red">*</span></label>
                                    <select name="employee_id" id="employee_id" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($employees as $item)
                                            <option value="{{ $item->id }}">{{ $item->firstname }}
                                                {{ $item->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Botón Anterior alineado a la izquierda -->
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()">
                                            <i class='bx bx-left-arrow-alt me-2'></i>Anterior
                                        </button>

                                        <!-- Botón Guardar o Siguiente alineado a la derecha -->
                                        <button class="btn btn-success px-4" id="saveClient">Guardar</button>
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
    {{-- <script src="{{ URL::asset('build/plugins/bs-stepper/js/main.js') }}"></script> --}}
    <script src="{{ URL::asset('build/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        document.querySelector(".industry_commerce_display").style.display = 'none';
        document.querySelector(".industry_commerce_retainer_display").style.display = 'none';
        document.querySelector(".industry_commerce_selfretaining_display").style.display = 'none';
        document.querySelector(".municipal_exogenous_information_display").style.display = 'none';
        document.querySelector(".single_registry_proposers_display").style.display = 'none';

        var stepper1
        document.addEventListener('DOMContentLoaded', function() {


            // Inicializar el Stepper principal
            stepper1 = new Stepper(document.querySelector('#stepper1'));

            var stepperFormEl = document.querySelector('#formClient');
            stepperForm = new Stepper(stepperFormEl, {
                animation: true
            });

            var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));
            var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'));
            var form = stepperFormEl.querySelector('.bs-stepper-content form');

            document.querySelector('#stepper1').addEventListener('show.bs-stepper', function(event) {
                const currentStepIndex = stepper1._currentIndex;
                const nextStepIndex = event.detail.indexStep;

                const currentPane = document.querySelectorAll('.bs-stepper-pane')[currentStepIndex];
                const inputs = currentPane.querySelectorAll('input, select, textarea');

                // // Validar los campos
                let isValid = true;
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        isValid = false;
                        input.classList.add('is-invalid'); // Agregar clase de error
                    } else {
                        input.classList.remove('is-invalid'); // Quitar clase de error
                    }
                });

                if (!isValid) {
                    console.log('Hay errores en el formulario. No se puede avanzar.');
                    event.preventDefault(); // Evita avanzar al siguiente paso
                } else {
                    console.log('Validación exitosa. Avanzando al siguiente paso.');
                }
            });
            // Avanzar al siguiente paso del wizard
            btnNextList.forEach(function(btn) {
                btn.addEventListener('click', function() {

                    stepperForm.next();
                });
            });

            // Evento que se ejecuta al mostrar un nuevo paso
            stepperFormEl.addEventListener('show.bs-stepper', function(event) {
                console.log(event)
                form.classList.remove('was-validated');
                var nextStep = event.detail.indexStep;

                var currentStep = nextStep;

                if (currentStep > 0) {
                    currentStep--;

                }

                var stepperPan = stepperPanList[currentStep];

                // Actualizar el dropdownParent de Select2 al contenedor del paso visible
                // $('#employee_id').select2({
                //     theme: 'bootstrap-5',
                //     placeholder: "Selecciona opciones",
                //     allowClear: true,
                //     closeOnSelect: false, // No cierra el menú al seleccionar una opción
                //     // Contenedor del paso actual
                // });
            });
            $('#person_type_id').select2();
            // Captura el evento de cambio
            $('#person_type_id').on('change', function() {
                const personType = $(this).val();
                const typeJuridic = document.getElementById('typeJuridic');
                if (personType === "2") { // Jurídica
                    typeJuridic.style.display = 'block'; // Mostrar el elemento
                } else {
                    typeJuridic.style.display = 'none'; // Ocultar el elemento
                }
            });

            // $('#is_simple_taxation_regime').select2();
            // Captura el evento de cambio
            $('#simple_taxation_regime_advances').parent().hide();
            $('#simple_taxation_regime_consolidated_annual').parent().hide();
            $('#is_simple_taxation_regime').on('change', function() {
                const is_simple_taxation_regime = $(this).val();
                const anticipo = document.getElementById('simple_taxation_regime_advances');
                const anticipoLbl = document.getElementById('simple_taxation_regime_advances_lbl');
                const annualConsolidada = document.getElementById(
                    'simple_taxation_regime_consolidated_annual');
                const annualConsolidadaLbl = document.getElementById(
                    'simple_taxation_regime_consolidated_annual_lbl');
                if (is_simple_taxation_regime === "TRUE") { // Jurídica
                    $('#simple_taxation_regime_advances').parent().show();
                    $('#simple_taxation_regime_consolidated_annual').parent().show();
                    anticipoLbl.style.display = 'block'
                    annualConsolidadaLbl.style.display = 'block'
                } else {
                    $('#simple_taxation_regime_advances').parent().hide();
                    $('#simple_taxation_regime_consolidated_annual').parent().hide();
                    anticipoLbl.style.display = 'none'
                    annualConsolidadaLbl.style.display = 'none'
                }
            });

            $('#industry_commerce_department').select2();
            $('#industry_commerce_city').select2();
            $('#industry_commerce_periodicity').parent().hide();
            $('#industry_commerce_department').parent().hide();
            $('#industry_commerce_city').parent().hide();
            $('#is_industry_commerce').on('change', function() {
                const is_industry_commerce = $(this).val();
                const industry_commerce_periocidad = document.getElementById(
                    'industry_commerce_periodicity');
                const industry_commerce_periocidadLbl = document.getElementById(
                    'industry_commerce_periodicity_lbl');
                const industry_commerce_department = document.getElementById(
                    'industry_commerce_department');
                const industry_commerce_departmentLbl = document.getElementById(
                    'industry_commerce_department_lbl');
                const industry_commerce_city = document.getElementById('industry_commerce_city');
                const industry_commerce_cityLbl = document.getElementById('industry_commerce_city_lbl');
                const industry_commerce_places_btn = document.getElementById(
                    'industry_commerce_places_add-row');
                const industry_commerce_places_table = document.getElementById(
                    'industry_commerce_places_table');


                if (is_industry_commerce === "TRUE") { // Jurídica
                    var deparments = [];
                    var repet = [];

                    fetch("{{ URL::asset('/build/js/deparmentsandcities.json') }}").then(data => data
                        .json()).then(
                        data => {
                            deparments = data;
                            document.querySelector("#industry_commerce_department").innerHTML =
                                '<option value="">Seleccione</option>';
                            deparments?.map(e => {
                                if (!repet.find(i => i.departamento == e.departamento)) {
                                    document.querySelector("#industry_commerce_department")
                                        .insertAdjacentHTML(
                                            'beforeend',
                                            `<option value="${e.departamento}">${e.departamento}</"option">`
                                        );
                                    repet.push(e);
                                }
                            });
                        });
                    $('#industry_commerce_department').on('change', function() {
                        selectDeparment(); // Llamar la función al cambiar el departamento
                    });



                    function selectDeparment() {
                        document.querySelector("#industry_commerce_city").innerHTML =
                            '<option value="">Seleccione</option>';
                        deparments?.map(e => {
                            if (e.departamento == document.querySelector(
                                    "#industry_commerce_department").value) {
                                document.querySelector("#industry_commerce_city")
                                    .insertAdjacentHTML('beforeend',
                                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                            }
                        });
                    }
                    industry_commerce_periocidadLbl.style.display = 'block'
                    $('#industry_commerce_periodicity').parent().show();

                    industry_commerce_departmentLbl.style.display = 'block'
                    $('#industry_commerce_department').parent().show();

                    industry_commerce_cityLbl.style.display = 'block'
                    $('#industry_commerce_city').parent().show();

                    industry_commerce_places_btn.style.display = 'block'
                    industry_commerce_places_table.style.display = 'table'
                    document.querySelector(".industry_commerce_display").style.display = 'flex';


                } else {
                    document.querySelector(".industry_commerce_display").style.display = 'none';

                    industry_commerce_periocidadLbl.style.display = 'none'
                    $('#industry_commerce_periodicity').parent().hide();

                    industry_commerce_departmentLbl.style.display = 'none'
                    $('#industry_commerce_department').parent().hide();

                    industry_commerce_cityLbl.style.display = 'none'
                    $('#industry_commerce_city').parent().hide();

                    industry_commerce_places_btn.style.display = 'none'
                    industry_commerce_places_table.style.display = 'none'

                }
            });
            $('#industry_commerce_places_add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const industry_commerce_department = $('#industry_commerce_department').val();
                const industry_commerce_city = $('#industry_commerce_city').val();

                if (industry_commerce_department && industry_commerce_city && email && cellphone) {
                    // Agregar fila a la tabla
                    $('#industry_commerce_places_table tbody').append(`
                        <tr>
                            <td>${industry_commerce_department}</td>
                            <td>${industry_commerce_city}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#industry_commerce_department').val(null).trigger('change');
                    $('#industry_commerce_city').val(null).trigger('change');
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            $('#industry_commerce_places_table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            $('#industry_commerce_retainer_department').select2();
            $('#industry_commerce_retainer_city').select2();
            $('#industry_commerce_retainer_periodicity').parent().hide();
            $('#industry_commerce_retainer_department').parent().hide();
            $('#industry_commerce_retainer_city').parent().hide();
            $('#is_industry_commerce_retainer').on('change', function() {
                const is_industry_commerce_retainer = $(this).val();

                const industry_commerce_retainer_periocidad = document.getElementById(
                    'industry_commerce_periodicity');

                const industry_commerce_retainer_periocidadLbl = document.getElementById(
                    'industry_commerce_retainer_periodicity_lbl');
                const industry_commerce_retainer_department = document.getElementById(
                    'industry_commerce_retainer_department');
                const industry_commerce_retainer_departmentLbl = document.getElementById(
                    'industry_commerce_retainer_department_lbl');
                const industry_commerce_retainer_city = document.getElementById(
                    'industry_commerce_retainer_city');
                const industry_commerce_retainer_cityLbl = document.getElementById(
                    'industry_commerce_retainer_city_lbl');
                const industry_commerce_retainer_places_btn = document.getElementById(
                    'industry_commerce_retainer_places_add-row');
                const industry_commerce_retainer_places_table = document.getElementById(
                    'industry_commerce_retainer_places_table');


                if (is_industry_commerce_retainer === "TRUE") { // Jurídica
                    var deparments = [];
                    var repet = [];

                    fetch("{{ URL::asset('/build/js/deparmentsandcities.json') }}").then(data => data
                        .json()).then(
                        data => {
                            deparments = data;
                            document.querySelector("#industry_commerce_retainer_department").innerHTML =
                                '<option value="">Seleccione</option>';
                            deparments?.map(e => {
                                if (!repet.find(i => i.departamento == e.departamento)) {
                                    document.querySelector(
                                            "#industry_commerce_retainer_department")
                                        .insertAdjacentHTML(
                                            'beforeend',
                                            `<option value="${e.departamento}">${e.departamento}</"option">`
                                        );
                                    repet.push(e);
                                }
                            });
                        });
                    $('#industry_commerce_retainer_department').on('change', function() {
                        selectDeparment(); // Llamar la función al cambiar el departamento
                    });



                    function selectDeparment() {
                        document.querySelector("#industry_commerce_retainer_city").innerHTML =
                            '<option value="">Seleccione</option>';
                        deparments?.map(e => {
                            if (e.departamento == document.querySelector(
                                    "#industry_commerce_retainer_department").value) {
                                document.querySelector("#industry_commerce_retainer_city")
                                    .insertAdjacentHTML('beforeend',
                                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                            }
                        });
                    }
                    document.querySelector(".industry_commerce_retainer_display").style.display = 'flex';

                    industry_commerce_retainer_periocidadLbl.style.display = 'block'
                    $('#industry_commerce_retainer_periodicity').parent().show();

                    industry_commerce_retainer_departmentLbl.style.display = 'block'
                    $('#industry_commerce_retainer_department').parent().show();

                    industry_commerce_retainer_cityLbl.style.display = 'block'
                    $('#industry_commerce_retainer_city').parent().show();

                    industry_commerce_retainer_places_btn.style.display = 'block'
                    industry_commerce_retainer_places_table.style.display = 'table'

                } else {
                    industry_commerce_retainer_periocidadLbl.style.display = 'none'
                    $('#industry_commerce_retainer_periodicity').parent().hide();

                    industry_commerce_retainer_departmentLbl.style.display = 'none'
                    $('#industry_commerce_retainer_department').parent().hide();

                    industry_commerce_retainer_cityLbl.style.display = 'none'
                    $('#industry_commerce_retainer_city').parent().hide();

                    industry_commerce_retainer_places_btn.style.display = 'none'
                    industry_commerce_retainer_places_table.style.display = 'none'

                    document.querySelector(".industry_commerce_retainer_display").style.display = 'none';


                }
            });
            $('#industry_commerce_retainer_places_add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const industry_commerce_retainer_department = $('#industry_commerce_retainer_department')
                    .val();
                const industry_commerce_retainer_city = $('#industry_commerce_retainer_city').val();

                if (industry_commerce_retainer_department && industry_commerce_retainer_city) {
                    // Agregar fila a la tabla
                    $('#industry_commerce_retainer_places_table tbody').append(`
                        <tr>
                            <td>${industry_commerce_retainer_department}</td>
                            <td>${industry_commerce_retainer_city}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#industry_commerce_retainer_department').val(null).trigger('change');
                    $('#industry_commerce_retainer_city').val(null).trigger('change');
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            $('#industry_commerce_retainer_places_table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            $('#industry_commerce_selfretaining_department').select2();
            $('#industry_commerce_selfretaining_city').select2();
            $('#industry_commerce_selfretaining_periodicity').parent().hide();
            $('#industry_commerce_selfretaining_department').parent().hide();
            $('#industry_commerce_selfretaining_city').parent().hide();
            $('#is_industry_commerce_selfretaining').on('change', function() {
                const is_industry_commerce_selfretaining = $(this).val();

                const industry_commerce_selfretaining_periocidad = document.getElementById(
                    'industry_commerce_selfretaining_periodicity');

                const industry_commerce_selfretaining_periocidadLbl = document.getElementById(
                    'industry_commerce_selfretaining_periodicity_lbl');
                const industry_commerce_selfretaining_department = document.getElementById(
                    'industry_commerce_selfretaining_department');
                const industry_commerce_selfretaining_departmentLbl = document.getElementById(
                    'industry_commerce_selfretaining_department_lbl');
                const industry_commerce_selfretaining_city = document.getElementById(
                    'industry_commerce_selfretaining_city');
                const industry_commerce_selfretaining_cityLbl = document.getElementById(
                    'industry_commerce_selfretaining_city_lbl');
                const industry_commerce_selfretaining_places_btn = document.getElementById(
                    'industry_commerce_selfretaining_places_add-row');
                const industry_commerce_selfretaining_places_table = document.getElementById(
                    'industry_commerce_selfretaining_places_table');


                if (is_industry_commerce_selfretaining === "TRUE") { // Jurídica

                    var deparments = [];
                    var repet = [];

                    fetch("{{ URL::asset('/build/js/deparmentsandcities.json') }}").then(data => data
                        .json()).then(
                        data => {
                            deparments = data;
                            document.querySelector("#industry_commerce_selfretaining_department")
                                .innerHTML =
                                '<option value="">Seleccione</option>';
                            deparments?.map(e => {
                                if (!repet.find(i => i.departamento == e.departamento)) {
                                    document.querySelector(
                                            "#industry_commerce_selfretaining_department")
                                        .insertAdjacentHTML(
                                            'beforeend',
                                            `<option value="${e.departamento}">${e.departamento}</"option">`
                                        );
                                    repet.push(e);
                                }
                            });
                        });
                    $('#industry_commerce_selfretaining_department').on('change', function() {
                        selectDeparment(); // Llamar la función al cambiar el departamento
                    });



                    function selectDeparment() {
                        document.querySelector("#industry_commerce_selfretaining_city").innerHTML =
                            '<option value="">Seleccione</option>';
                        deparments?.map(e => {
                            if (e.departamento == document.querySelector(
                                    "#industry_commerce_selfretaining_department").value) {
                                document.querySelector("#industry_commerce_selfretaining_city")
                                    .insertAdjacentHTML('beforeend',
                                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                            }
                        });
                    }
                    industry_commerce_selfretaining_periocidadLbl.style.display = 'block'
                    $('#industry_commerce_selfretaining_periodicity').parent().show();

                    industry_commerce_selfretaining_departmentLbl.style.display = 'block'
                    $('#industry_commerce_selfretaining_department').parent().show();

                    industry_commerce_selfretaining_cityLbl.style.display = 'block'
                    $('#industry_commerce_selfretaining_city').parent().show();

                    industry_commerce_selfretaining_places_btn.style.display = 'block'
                    industry_commerce_selfretaining_places_table.style.display = 'table'

                    document.querySelector(".industry_commerce_selfretaining_display").style.display =
                        'flex';


                } else {
                    industry_commerce_selfretaining_periocidadLbl.style.display = 'none'
                    $('#industry_commerce_selfretaining_periodicity').parent().hide();

                    industry_commerce_selfretaining_departmentLbl.style.display = 'none'
                    $('#industry_commerce_selfretaining_department').parent().hide();

                    industry_commerce_selfretaining_cityLbl.style.display = 'none'
                    $('#industry_commerce_selfretaining_city').parent().hide();

                    industry_commerce_selfretaining_places_btn.style.display = 'none'
                    industry_commerce_selfretaining_places_table.style.display = 'none'
                    document.querySelector(".industry_commerce_selfretaining_display").style.display =
                        'none';


                }
            });
            $('#industry_commerce_selfretaining_places_add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const industry_commerce_selfretaining_department = $(
                        '#industry_commerce_selfretaining_department')
                    .val();
                const industry_commerce_selfretaining_city = $('#industry_commerce_selfretaining_city')
                    .val();

                if (industry_commerce_selfretaining_department && industry_commerce_selfretaining_city) {
                    // Agregar fila a la tabla
                    $('#industry_commerce_selfretaining_places_table tbody').append(`
                        <tr>
                            <td>${industry_commerce_selfretaining_department}</td>
                            <td>${industry_commerce_selfretaining_city}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#industry_commerce_selfretaining_department').val(null).trigger('change');
                    $('#industry_commerce_selfretainings_city').val(null).trigger('change');
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            $('#industry_commerce_selfretaining_places_table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            $('#vat_responsible_periodicity').parent().hide();
            $('#vat_responsible').on('change', function() {
                const vat_responsible = $(this).val();
                const vat_responsible_periodicity = document.getElementById('vat_responsible_periodicity');
                const vat_responsible_periodicityLbl = document.getElementById(
                    'vat_responsible_periodicity_lbl');
                const vat_responsible_observation = document.getElementById(
                    'vat_responsible_observation');
                const vat_responsible_observationLbl = document.getElementById(
                    'vat_responsible_observation_lbl');
                if (vat_responsible === "TRUE") { // Jurídica
                    $('#vat_responsible_periodicity').parent().show();
                    vat_responsible_periodicityLbl.style.display = 'block'
                    vat_responsible_observation.style.display = 'block'
                    vat_responsible_observationLbl.style.display = 'block'
                } else {
                    $('#vat_responsible_periodicity').parent().hide();
                    vat_responsible_periodicityLbl.style.display = 'none'
                    vat_responsible_observation.style.display = 'none'
                    vat_responsible_observationLbl.style.display = 'none'
                }
            });

            $('#rent_periodicity').parent().hide();
            $('#is_rent').on('change', function() {
                const is_rent = $(this).val();
                const rent_periodicity = document.getElementById('rent_periodicity');
                const rent_periodicityLbl = document.getElementById(
                    'rent_periodicity_lbl');
                if (is_rent === "TRUE") { // Jurídica
                    $('#rent_periodicity').parent().show();
                    rent_periodicityLbl.style.display = 'block'

                } else {
                    $('#rent_periodicity').parent().hide();
                    rent_periodicityLbl.style.display = 'none'
                }
            });

            $('#supersociety_periodicity').parent().hide();
            $('#is_supersociety').on('change', function() {
                const is_supersociety = $(this).val();
                const supersociety_periodicity = document.getElementById('supersociety_periodicity');
                const supersociety_periodicityLbl = document.getElementById('supersociety_periodicity_lbl');
                if (is_supersociety === "TRUE") { // Jurídica
                    $('#supersociety_periodicity').parent().show();
                    supersociety_periodicityLbl.style.display = 'block';
                } else {
                    $('#supersociety_periodicity').parent().hide();
                    supersociety_periodicity.style.display = 'none';
                }
            });

            $('#supertransport_periodicity').parent().hide();
            $('#is_supertransport').on('change', function() {
                const is_supertransport = $(this).val();
                const supertransport_periodicity = document.getElementById('supertransport_periodicity');
                const supertransport_periodicityLbl = document.getElementById(
                    'supertransport_periodicity_lbl');
                const supertransport_observation = document.getElementById(
                    'supertransport_observation');
                const supertransport_observationLbl = document.getElementById(
                    'supertransport_observation_lbl');
                if (is_supertransport === "TRUE") { // Jurídica
                    $('#supertransport_periodicity').parent().show();
                    supertransport_periodicityLbl.style.display = 'block';
                    supertransport_observation.style.display = 'block'
                    supertransport_observationLbl.style.display = 'block'
                } else {
                    $('#supertransport_periodicity').parent().hide();
                    supertransport_periodicity.style.display = 'none';
                    supertransport_observation.style.display = 'none'
                    supertransport_observationLbl.style.display = 'none'
                }
            });

            $('#superfinancial_periodicity').parent().hide();
            $('#is_superfinancial').on('change', function() {
                const is_superfinancial = $(this).val();
                const superfinancial_periodicity = document.getElementById('superfinancial_periodicity');
                const superfinancial_periodicityLbl = document.getElementById(
                    'superfinancial_periodicity_lbl');
                if (is_superfinancial === "TRUE") { // Jurídica
                    $('#superfinancial_periodicity').parent().show();
                    superfinancial_periodicityLbl.style.display = 'block';
                } else {
                    $('#superfinancial_periodicity').parent().hide();
                    superfinancial_periodicity.style.display = 'none';
                }
            });

            $('#source_retention_periodicity').parent().hide();
            $('#is_source_retention').on('change', function() {
                const is_source_retention = $(this).val();
                const source_retention_periodicity = document.getElementById(
                    'source_retention_periodicity');
                const source_retention_periodicityLbl = document.getElementById(
                    'source_retention_periodicity_lbl');
                if (is_source_retention === "TRUE") { // Jurídica
                    $('#source_retention_periodicity').parent().show();
                    source_retention_periodicityLbl.style.display = 'block';
                } else {
                    $('#source_retention_periodicity').parent().hide();
                    source_retention_periodicity.style.display = 'none';
                }
            });

            $('#dian_exogenous_information_periodicity').parent().hide();
            $('#is_dian_exogenous_information').on('change', function() {
                const is_dian_exogenous_information = $(this).val();
                const dian_exogenous_information_periodicity = document.getElementById(
                    'dian_exogenous_information_periodicity');
                const dian_exogenous_information_periodicityLbl = document.getElementById(
                    'dian_exogenous_information_periodicity_lbl');
                if (is_dian_exogenous_information === "TRUE") { // Jurídica
                    $('#dian_exogenous_information_periodicity').parent().show();
                    dian_exogenous_information_periodicityLbl.style.display = 'block';
                } else {
                    $('#dian_exogenous_information_periodicity').parent().hide();
                    dian_exogenous_information_periodicity.style.display = 'none';
                }
            });

            $('#municipal_exogenous_information_department').select2();
            $('#municipal_exogenous_information_city').select2();
            $('#municipal_exogenous_information_periodicity').parent().hide();
            $('#municipal_exogenous_information_department').parent().hide();
            $('#municipal_exogenous_information_city').parent().hide();
            $('#is_municipal_exogenous_information').on('change', function() {
                const is_municipal_exogenous_information = $(this).val();

                const municipal_exogenous_information_periocidad = document.getElementById(
                    'municipal_exogenous_information_periodicity');

                const municipal_exogenous_information_periocidadLbl = document.getElementById(
                    'municipal_exogenous_information_periodicity_lbl');
                const municipal_exogenous_information_department = document.getElementById(
                    'municipal_exogenous_information_department');
                const municipal_exogenous_information_departmentLbl = document.getElementById(
                    'municipal_exogenous_information_department_lbl');
                const municipal_exogenous_information_city = document.getElementById(
                    'municipal_exogenous_information_city');
                const municipal_exogenous_information_cityLbl = document.getElementById(
                    'municipal_exogenous_information_city_lbl');
                const municipal_exogenous_information_places_btn = document.getElementById(
                    'municipal_exogenous_information_places_add-row');
                const municipal_exogenous_information_places_table = document.getElementById(
                    'municipal_exogenous_information_places_table');


                if (is_municipal_exogenous_information === "TRUE") { // Jurídica
                    var deparments = [];
                    var repet = [];

                    fetch("{{ URL::asset('/build/js/deparmentsandcities.json') }}").then(data => data
                        .json()).then(
                        data => {
                            deparments = data;
                            document.querySelector("#municipal_exogenous_information_department")
                                .innerHTML =
                                '<option value="">Seleccione</option>';
                            deparments?.map(e => {
                                if (!repet.find(i => i.departamento == e.departamento)) {
                                    document.querySelector(
                                            "#municipal_exogenous_information_department")
                                        .insertAdjacentHTML(
                                            'beforeend',
                                            `<option value="${e.departamento}">${e.departamento}</"option">`
                                        );
                                    repet.push(e);
                                }
                            });
                        });
                    $('#municipal_exogenous_information_department').on('change', function() {
                        selectDeparment(); // Llamar la función al cambiar el departamento
                    });



                    function selectDeparment() {
                        document.querySelector("#municipal_exogenous_information_city").innerHTML =
                            '<option value="">Seleccione</option>';
                        deparments?.map(e => {
                            if (e.departamento == document.querySelector(
                                    "#municipal_exogenous_information_department").value) {
                                document.querySelector("#municipal_exogenous_information_city")
                                    .insertAdjacentHTML('beforeend',
                                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                            }
                        });
                    }
                    municipal_exogenous_information_periocidadLbl.style.display = 'block'
                    $('#municipal_exogenous_information_periodicity').parent().show();

                    municipal_exogenous_information_departmentLbl.style.display = 'block'
                    $('#municipal_exogenous_information_department').parent().show();

                    municipal_exogenous_information_cityLbl.style.display = 'block'
                    $('#municipal_exogenous_information_city').parent().show();

                    municipal_exogenous_information_places_btn.style.display = 'block'
                    municipal_exogenous_information_places_table.style.display = 'table'
                    document.querySelector(".municipal_exogenous_information_display").style.display =
                        'flex';


                } else {
                    municipal_exogenous_information_periocidadLbl.style.display = 'none'
                    $('#municipal_exogenous_information_periodicity').parent().hide();

                    municipal_exogenous_information_departmentLbl.style.display = 'none'
                    $('#municipal_exogenous_information_department').parent().hide();

                    municipal_exogenous_information_cityLbl.style.display = 'none'
                    $('#municipal_exogenous_information_city').parent().hide();

                    municipal_exogenous_information_places_btn.style.display = 'none'
                    municipal_exogenous_information_places_table.style.display = 'none'
                    document.querySelector(".municipal_exogenous_information_display").style.display =
                        'none';


                }
            });
            $('#municipal_exogenous_information_places_add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const municipal_exogenous_information_department = $(
                        '#municipal_exogenous_information_department')
                    .val();
                const municipal_exogenous_information_city = $('#municipal_exogenous_information_city')
                    .val();

                if (municipal_exogenous_information_department && municipal_exogenous_information_city) {
                    // Agregar fila a la tabla
                    $('#municipal_exogenous_information_places_table tbody').append(`
                        <tr>
                            <td>${municipal_exogenous_information_department}</td>
                            <td>${municipal_exogenous_information_city}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#municipal_exogenous_information_department').val(null).trigger('change');
                    $('#municipal_exogenous_informations_city').val(null).trigger('change');
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            $('#municipal_exogenous_information_places_table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            $('#wealth_tax_periodicity').parent().hide();
            $('#is_wealth_tax').on('change', function() {
                const is_wealth_tax = $(this).val();
                const wealth_tax_periodicity = document.getElementById(
                    'wealth_tax_periodicity');
                const wealth_tax_periodicityLbl = document.getElementById(
                    'wealth_tax_periodicity_lbl');
                if (is_wealth_tax === "TRUE") { // Jurídica
                    $('#wealth_tax_periodicity').parent().show();
                    wealth_tax_periodicityLbl.style.display = 'block';
                } else {
                    $('#wealth_tax_periodicity').parent().hide();
                    wealth_tax_periodicity.style.display = 'none';
                }
            });

            $('#radian_periodicity').parent().hide();
            $('#is_radian').on('change', function() {
                const is_radian = $(this).val();
                const radian_periodicity = document.getElementById(
                    'radian_periodicity');
                const radian_periodicityLbl = document.getElementById(
                    'radian_periodicity_lbl');
                if (is_radian === "TRUE") { // Jurídica
                    $('#radian_periodicity').parent().show();
                    radian_periodicityLbl.style.display = 'block';
                } else {
                    $('#radian_periodicity').parent().hide();
                    radian_periodicity.style.display = 'none';
                }
            });

            $('#e_payroll_periodicity').parent().hide();
            $('#is_e_payroll').on('change', function() {
                const is_e_payroll = $(this).val();
                const e_payroll_periodicity = document.getElementById(
                    'e_payroll_periodicity');
                const e_payroll_periodicityLbl = document.getElementById(
                    'e_payroll_periodicity_lbl');
                if (is_e_payroll === "TRUE") { // Jurídica
                    $('#e_payroll_periodicity').parent().show();
                    e_payroll_periodicityLbl.style.display = 'block';
                } else {
                    $('#e_payroll_periodicity').parent().hide();
                    e_payroll_periodicity.style.display = 'none';
                }
            });

            $('#single_registry_final_benefeciaries_periodicity').parent().hide();
            $('#is_single_registry_final_benefeciaries').on('change', function() {
                const is_single_registry_final_benefeciaries = $(this).val();
                const single_registry_final_benefeciaries_periodicity = document.getElementById(
                    'single_registry_final_benefeciaries_periodicity');
                const single_registry_final_benefeciaries_periodicityLbl = document.getElementById(
                    'single_registry_final_benefeciaries_periodicity_lbl');
                if (is_single_registry_final_benefeciaries === "TRUE") { // Jurídica
                    $('#single_registry_final_benefeciaries_periodicity').parent().show();
                    single_registry_final_benefeciaries_periodicityLbl.style.display = 'block';
                } else {
                    $('#single_registry_final_benefeciaries_periodicity').parent().hide();
                    single_registry_final_benefeciaries_periodicity.style.display = 'none';
                }
            });

            $('#renovacion_esal_periodicity').parent().hide();
            $('#is_renovacion_esal').on('change', function() {
                const is_renovacion_esal = $(this).val();
                const renovacion_esal_periodicity = document.getElementById(
                    'renovacion_esal_periodicity');
                const renovacion_esal_periodicityLbl = document.getElementById(
                    'renovacion_esal_periodicity_lbl');
                if (is_renovacion_esal === "TRUE") { // Jurídica
                    $('#renovacion_esal_periodicity').parent().show();
                    renovacion_esal_periodicityLbl.style.display = 'block';
                } else {
                    $('#renovacion_esal_periodicity').parent().hide();
                    renovacion_esal_periodicity.style.display = 'none';
                }
            });

            $('#assets_abroad_periodicity').parent().hide();
            $('#is_assets_abroad').on('change', function() {
                const is_assets_abroad = $(this).val();
                const assets_abroad_periodicity = document.getElementById(
                    'assets_abroad_periodicity');
                const assets_abroad_periodicityLbl = document.getElementById(
                    'assets_abroad_periodicity_lbl');
                if (is_assets_abroad === "TRUE") { // Jurídica
                    $('#assets_abroad_periodicity').parent().show();
                    assets_abroad_periodicityLbl.style.display = 'block';
                } else {
                    $('#assets_abroad_periodicity').parent().hide();
                    assets_abroad_periodicity.style.display = 'none';
                }
            });

            $('#single_registry_proposers_department').select2();
            $('#single_registry_proposers_city').select2();
            $('#single_registry_proposers_periodicity').parent().hide();
            $('#single_registry_proposers_department').parent().hide();
            $('#single_registry_proposers_city').parent().hide();
            $('#is_single_registry_proposers').on('change', function() {
                const is_single_registry_proposers = $(this).val();

                const single_registry_proposers_periocidad = document.getElementById(
                    'single_registry_proposers_periodicity');

                const single_registry_proposers_periocidadLbl = document.getElementById(
                    'single_registry_proposers_periodicity_lbl');
                const single_registry_proposers_department = document.getElementById(
                    'single_registry_proposers_department');
                const single_registry_proposers_departmentLbl = document.getElementById(
                    'single_registry_proposers_department_lbl');
                const single_registry_proposers_city = document.getElementById(
                    'single_registry_proposers_city');
                const single_registry_proposers_cityLbl = document.getElementById(
                    'single_registry_proposers_city_lbl');
                const single_registry_proposers_places_btn = document.getElementById(
                    'single_registry_proposers_places_add-row');
                const single_registry_proposers_places_table = document.getElementById(
                    'single_registry_proposers_places_table');


                if (is_single_registry_proposers === "TRUE") { // Jurídica
                    var deparments = [];
                    var repet = [];

                    fetch("{{ URL::asset('/build/js/deparmentsandcities.json') }}").then(data => data
                        .json()).then(
                        data => {
                            deparments = data;
                            document.querySelector("#single_registry_proposers_department")
                                .innerHTML =
                                '<option value="">Seleccione</option>';
                            deparments?.map(e => {
                                if (!repet.find(i => i.departamento == e.departamento)) {
                                    document.querySelector(
                                            "#single_registry_proposers_department")
                                        .insertAdjacentHTML(
                                            'beforeend',
                                            `<option value="${e.departamento}">${e.departamento}</"option">`
                                        );
                                    repet.push(e);
                                }
                            });
                        });
                    $('#single_registry_proposers_department').on('change', function() {
                        selectDeparment(); // Llamar la función al cambiar el departamento
                    });



                    function selectDeparment() {
                        document.querySelector("#single_registry_proposers_city").innerHTML =
                            '<option value="">Seleccione</option>';
                        deparments?.map(e => {
                            if (e.departamento == document.querySelector(
                                    "#single_registry_proposers_department").value) {
                                document.querySelector("#single_registry_proposers_city")
                                    .insertAdjacentHTML('beforeend',
                                        `<option value="${e.municipio}">${e.municipio}</"option">`);
                            }
                        });
                    }
                    single_registry_proposers_periocidadLbl.style.display = 'block'
                    $('#single_registry_proposers_periodicity').parent().show();

                    single_registry_proposers_departmentLbl.style.display = 'block'
                    $('#single_registry_proposers_department').parent().show();

                    single_registry_proposers_cityLbl.style.display = 'block'
                    $('#single_registry_proposers_city').parent().show();

                    single_registry_proposers_places_btn.style.display = 'block'
                    single_registry_proposers_places_table.style.display = 'table'

                    document.querySelector(".single_registry_proposers_display").style.display = 'flex';


                } else {
                    single_registry_proposers_periocidadLbl.style.display = 'none'
                    $('#single_registry_proposers_periodicity').parent().hide();

                    single_registry_proposers_departmentLbl.style.display = 'none'
                    $('#single_registry_proposers_department').parent().hide();

                    single_registry_proposers_cityLbl.style.display = 'none'
                    $('#single_registry_proposers_city').parent().hide();

                    single_registry_proposers_places_btn.style.display = 'none'
                    single_registry_proposers_places_table.style.display = 'none'
                    document.querySelector(".single_registry_proposers_display").style.display = 'none';


                }
            });
            $('#single_registry_proposers_places_add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const single_registry_proposers_department = $(
                        '#single_registry_proposers_department')
                    .val();
                const single_registry_proposers_city = $('#single_registry_proposers_city')
                    .val();

                if (single_registry_proposers_department && single_registry_proposers_city) {
                    // Agregar fila a la tabla
                    $('#single_registry_proposers_places_table tbody').append(`
                        <tr>
                            <td>${single_registry_proposers_department}</td>
                            <td>${single_registry_proposers_city}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#single_registry_proposers_department').val(null).trigger('change');
                    $('#single_registry_proposerss_city').val(null).trigger('change');
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            $('#single_registry_proposers_places_table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            $('#renewal_commercial_registration_periodicity').parent().hide();
            $('#is_renewal_commercial_registration').on('change', function() {
                const is_renewal_commercial_registration = $(this).val();
                const renewal_commercial_registration_periodicity = document.getElementById(
                    'renewal_commercial_registration_periodicity');
                const renewal_commercial_registration_periodicityLbl = document.getElementById(
                    'renewal_commercial_registration_periodicity_lbl');
                if (is_renewal_commercial_registration === "TRUE") { // Jurídica
                    $('#renewal_commercial_registration_periodicity').parent().show();
                    renewal_commercial_registration_periodicityLbl.style.display = 'block';
                } else {
                    $('#renewal_commercial_registration_periodicity').parent().hide();
                    renewal_commercial_registration_periodicity.style.display = 'none';
                }
            });

            $('#national_tourism_fund_periodicity').parent().hide();
            $('#is_national_tourism_fund').on('change', function() {
                const is_national_tourism_fund = $(this).val();
                const national_tourism_fund_periodicity = document.getElementById(
                    'national_tourism_fund_periodicity');
                const national_tourism_fund_periodicityLbl = document.getElementById(
                    'national_tourism_fund_periodicity_lbl');
                if (is_national_tourism_fund === "TRUE") { // Jurídica
                    $('#national_tourism_fund_periodicity').parent().show();
                    national_tourism_fund_periodicityLbl.style.display = 'block';
                } else {
                    $('#national_tourism_fund_periodicity').parent().hide();
                    national_tourism_fund_periodicity.style.display = 'none';
                }
            });

            // $('#special_tax_regime_periodicity').parent().hide();
            // $('#is_special_tax_regime').on('change', function() {
            //     const is_special_tax_regime = $(this).val();
            //     const special_tax_regime_periodicity = document.getElementById(
            //         'special_tax_regime_periodicity');
            //     const special_tax_regime_periodicityLbl = document.getElementById(
            //         'special_tax_regime_periodicity_lbl');
            //     if (is_special_tax_regime === "TRUE") { // Jurídica
            //         $('#special_tax_regime_periodicity').parent().show();
            //         special_tax_regime_periodicityLbl.style.display = 'block';
            //     } else {
            //         $('#special_tax_regime_periodicity').parent().hide();
            //         special_tax_regime_periodicity.style.display = 'none';
            //     }
            // });

            $('#national_tourism_registry_periodicity').parent().hide();
            $('#is_national_tourism_registry').on('change', function() {
                const is_national_tourism_registry = $(this).val();
                const national_tourism_registry_periodicity = document.getElementById(
                    'national_tourism_registry_periodicity');
                const national_tourism_registry_periodicityLbl = document.getElementById(
                    'national_tourism_registry_periodicity_lbl');
                if (is_national_tourism_registry === "TRUE") { // Jurídica
                    $('#national_tourism_registry_periodicity').parent().show();
                    national_tourism_registry_periodicityLbl.style.display = 'block';
                } else {
                    $('#national_tourism_registry_periodicity').parent().hide();
                    national_tourism_registry_periodicity.style.display = 'none';
                }
            });

            let editingRow = null; // Para rastrear la fila que se está editando
            $('#add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const contactDocumentTypeId = $('#contact_document_type_id').val(); // Obtiene el ID
                const contactDocumentTypeText = $('#contact_document_type_id option:selected')
                    .text(); // Obtiene el texto

                const identification = $('#identification').val();
                const firstname = $('#firstname').val();
                const lastname = $('#lastname').val();
                const jobTitle = $('#job_title').val();
                const email = $('#email').val();
                const cellphone = $('#cellphone').val();
                const birthday = $('#birthday').val();
                const observationContact = $('#observationContact').val();

                const channelCommunication = [];
                $('input[name="channel_communication[]"]:checked').each(function() {
                    channelCommunication.push($(this).val());
                });


                if (firstname && lastname && email && cellphone) {
                    if (editingRow) {
                        // Si estamos editando, actualizar la fila existente
                        editingRow.find('td:eq(0)').text(contactDocumentTypeId);
                        editingRow.find('td:eq(1)').text(contactDocumentTypeText);
                        editingRow.find('td:eq(2)').text(identification);
                        editingRow.find('td:eq(3)').text(firstname);
                        editingRow.find('td:eq(4)').text(lastname);
                        editingRow.find('td:eq(5)').text(birthday);
                        editingRow.find('td:eq(6)').text(jobTitle);
                        editingRow.find('td:eq(7)').text(email);
                        editingRow.find('td:eq(8)').text(cellphone);
                        editingRow.find('td:eq(9)').text(channelCommunication.join(', '));
                        editingRow.find('td:eq(10)').text(observationContact);

                        // Resetear variable de edición
                        editingRow = null;
                        $('#add-row').text('Agregar');
                    } else {
                        // Agregar fila a la tabla
                        $('#contact-table tbody').append(`
                        <tr>
                            <td class="hidden-id" style="display:none;">${contactDocumentTypeId}</td> <!-- ID oculto -->
                            <td>${$('#contact_document_type_id option:selected').text()}</td>
                            <td>${identification}</td>
                            <td>${firstname}</td>
                            <td>${lastname}</td>
                            <td>${birthday}</td>
                            <td>${jobTitle}</td>
                            <td>${email}</td>
                            <td>${cellphone}</td>
                            <td>${channelCommunication.join(', ')}</td>
                            <td>${observationContact}</td>
                            <td>   <button class="btn btn-warning btn-sm edit-row">Editar</button><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);
                    }
                    $('#contact_document_type_id').val(null).trigger('change'); // Resetear Select2
                    // Limpiar campos
                    $('#identification,#firstname, #lastname, #job_title, #email, #cellphone,#birthday,#observationContact')
                        .val('');
                    $('input[name="channel_communication[]"]').prop('checked', false);
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            // Eliminar fila de la tabla
            $('#contact-table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Editar fila de la tabla
            $('#contact-table').on('click', '.edit-row', function() {
                editingRow = $(this).closest('tr'); // Guardamos la fila en edición
                // Obtener el ID desde el <td> oculto
                const contactDocumentTypeId = editingRow.find('td.hidden-id').text();
                // Cargar valores en el formulario
                // Cargar valores en el formulario
                $('#contact_document_type_id').val(contactDocumentTypeId).trigger(
                    'change'); // Asigna el ID y actualiza Select2
                $('#identification').val(editingRow.find('td:eq(2)').text());
                $('#firstname').val(editingRow.find('td:eq(3)').text());
                $('#lastname').val(editingRow.find('td:eq(4)').text());
                $('#birthday').val(editingRow.find('td:eq(5)').text());
                $('#job_title').val(editingRow.find('td:eq(6)').text());
                $('#email').val(editingRow.find('td:eq(7)').text());
                $('#cellphone').val(editingRow.find('td:eq(8)').text());
                $('#observationContact').val(editingRow.find('td:eq(10)').text());

                // Cargar checkboxes de "channel_communication"
                let selectedChannels = editingRow.find('td:eq(9)').text().split(', ');
                $('input[name="channel_communication[]"]').each(function() {
                    $(this).prop('checked', selectedChannels.includes($(this).val()));
                });

                // Cambiar el texto del botón para indicar que estamos editando
                $('#add-row').text('Actualizar');
            });
            $('#saveClient').on('click', function(e) {
                e.preventDefault();
                isLoading(true)

                const form = document.getElementById('formClient'); // Obtener el formulario
                const formData = new FormData(form); // Crear el objeto FormData

                const data = {};

                // Procesar los valores del formulario
                formData.forEach((value, key) => {
                    if (key === 'channel_communication[]') {
                        if (!data['channel_communication']) {
                            data['channel_communication'] = [];
                        }
                        data['channel_communication'].push(value); // Agregar valores seleccionados
                    } else if (value === "on") {
                        data[key] = true; // Convertir checkboxes marcados a booleano true
                    } else if (!formData.has(key) && $(`[name="${key}"]`).attr('type') ===
                        'checkbox') {
                        data[key] = false; // Convertir checkboxes no marcados a booleano false
                    } else {
                        data[key] = value; // Otros valores
                    }
                });

                // 🔹 Agregar el Tipo de Documento (Select2)
                data['contact_document_type_id'] = $('#contact_document_type_id').val() || null;
                // Agregar valores múltiples al objeto data
                const personType = $('#person_type_id').val();
                // Agregar contactos si el tipo de persona es jurídica
                if (personType === "2") {
                    data.contacts = [];
                    $('#contact-table tbody tr').each(function() {
                        const row = $(this).find('td');
                        const contact = {
                            contact_document_type_id: $(this).find('.hidden-id').text()
                                .trim(), // 🔹 Buscar por clase
                            identification: row.eq(2).text().trim(),
                            firstname: row.eq(3).text().trim(),
                            lastname: row.eq(4).text().trim(),
                            birthday: row.eq(5).text().trim(),
                            job_title: row.eq(6).text().trim(),
                            email: row.eq(7).text().trim(),
                            cellphone: row.eq(8).text().trim(),
                            channel_communication: row.eq(9).text().trim(),
                            observationContact: row.eq(10).text().trim(),
                        };
                        data.contacts.push(contact);
                    });
                }

                const industryCommerce = $('#is_industry_commerce').val();
                if (industryCommerce == "TRUE") {
                    data.industry_commerce_places = [];
                    $('#industry_commerce_places_table tbody tr ').each(function() {
                        const row = $(this).find('td');
                        const places = {
                            deparment: row.eq(0).text(),
                            city: row.eq(1).text(),
                        }
                        data.industry_commerce_places.push(places);
                    })
                }

                const industryCommerceRetainer = $('#is_industry_commerce_retainer').val();
                if (industryCommerceRetainer == "TRUE") {
                    data.industry_commerce_retainer_places = [];
                    $('#industry_commerce_retainer_places_table tbody tr ').each(function() {
                        const row = $(this).find('td');
                        const places = {
                            deparment: row.eq(0).text(),
                            city: row.eq(1).text(),
                        }
                        data.industry_commerce_retainer_places.push(places);
                    })
                }

                const industryCommerceSelfretaining = $('#is_industry_commerce_selfretaining').val();
                if (industryCommerceSelfretaining == "TRUE") {
                    data.industry_commerce_selfretaining_places = [];
                    $('#industry_commerce_selfretaining_places_table tbody tr ').each(function() {
                        const row = $(this).find('td');
                        const places = {
                            deparment: row.eq(0).text(),
                            city: row.eq(1).text(),
                        }
                        data.industry_commerce_selfretaining_places.push(places);
                    })
                }

                const municipalExogenousInformation = $('#is_municipal_exogenous_information').val();
                if (municipalExogenousInformation == "TRUE") {
                    data.municipal_exogenous_information_places = [];
                    $('#municipal_exogenous_information_places_table tbody tr ').each(function() {
                        const row = $(this).find('td');
                        const places = {
                            deparment: row.eq(0).text(),
                            city: row.eq(1).text(),
                        }
                        data.municipal_exogenous_information_places.push(places);
                    })
                }

                const singleRegistryProposers = $('#is_single_registry_proposers').val();
                if (singleRegistryProposers == "TRUE") {
                    data.single_registry_proposers_places = [];
                    $('#single_registry_proposers_places_table tbody tr ').each(function() {
                        const row = $(this).find('td');
                        const places = {
                            deparment: row.eq(0).text(),
                            city: row.eq(1).text(),
                        }
                        data.single_registry_proposers_places.push(places);
                    })
                }


                console.log('Datos a enviar:', data);

                if (personType == 1) {
                    data["channel_communication"] = data["channel_communication"]?.join(", ");

                }

                // Enviar los datos al servidor con AJAX
                $.ajax({
                    url: "{{ route('client.store') }}", // Cambiar por la URL de tu API
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                        isLoading(false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Se ha creado el Cliente',
                            text: 'El Cliente se ha registrado exitosamente.',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            // Redirigir a la página de creación de empleado
                            window.location.href = "{{ route('client.index') }}";
                        });
                    },
                    error: function(error) {
                        isLoading(false)
                        console.error('Error al guardar el cliente:', error.responseJSON
                            .message);

                        Swal.fire({
                            icon: 'error',
                            title: 'No ha creado el Cliente',
                            text: 'Error al crear el cliente:' + error.responseJSON
                                .message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });



        });

        $(document).ready(function() {
            $('#category').select2({
                theme: 'bootstrap-5', // Aplica el tema Bootstrap 5
                // width: '100%',
                templateResult: formatCategory, // Personaliza las opciones desplegables
                templateSelection: formatSelectedCategory // Personaliza la opción seleccionada
            });

            // Función para las opciones del menú desplegable
            function formatCategory(category) {
                if (!category.id) {
                    return category.text; // Retorna la opción predeterminada ("Seleccione...")
                }

                const colorClass = {
                    'ALTA': 'select2-results__option--alta',
                    'MEDIA': 'select2-results__option--media',
                    'BAJA': 'select2-results__option--baja'
                } [category.id] || '';

                return $(
                    `<span class="${colorClass}">
                <span class="color-dot"></span> ${category.text}
            </span>`
                );
            }

            // Función para la opción seleccionada
            function formatSelectedCategory(category) {
                if (!category.id) {
                    return category.text; // Retorna la opción predeterminada ("Seleccione...")
                }

                const colorClass = {
                    'ALTA': 'select2-selection__rendered--alta',
                    'MEDIA': 'select2-selection__rendered--media',
                    'BAJA': 'select2-selection__rendered--baja'
                } [category.id] || '';

                return $(
                    `<span class="${colorClass}">
                <span class="color-dot"></span> ${category.text}
            </span>`
                );
            }
        });
    </script>
@endsection
