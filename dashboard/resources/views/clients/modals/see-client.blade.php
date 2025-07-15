<!-- Modal -->
<div class="modal fade" id="seeClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameClient">Detalles del cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Información del Cliente -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3">Información del Cliente</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Tipo Persona:</h6>
                                        <p class="fw-bold" id="clientType">Natural</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Tipo Documento:</h6>
                                        <p class="fw-bold" id="documentType">Cedula</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Nombre:</h6>
                                        <p class="fw-bold" id="clientName">Juan Pérez</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Identificación:</h6>
                                        <p class="fw-bold" id="clientId">123456789</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Dirección Corporativa:</h6>
                                        <p class="fw-bold" id="clientAddress">Calle 123 #45-67</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Email:</h6>
                                        <p class="fw-bold" id="clientEmail">juan.perez@example.com</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Categoría:</h6>
                                        <p class="fw-bold" id="clientCategory">Alta</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Atendido por:</h6>
                                        <p class="fw-bold" id="clientAgent">Carlos Hoyos</p>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <h6 class="text-muted">Review:</h6>
                                        <p class="fw-bold" id="clientReview">Texto del review</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Observación:</h6>
                                        <p class="fw-bold" id="clientObservation">Texto de observación</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información Fiscal -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3">Información Fiscal</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">Regimen Simple de Tributación:</h6>
                                            <p class="fw-bold" id="is_simple_taxation_regimen"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="simple_taxation_regime_advances_lbl">Anticipo
                                            </h6>
                                            <p class="fw-bold" id="simple_taxation_regime_advances"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted"id="simple_taxation_regime_consolidated_annual_lbl">
                                                Anual Consolidada</h6>
                                            <p class="fw-bold" id="simple_taxation_regime_consolidated_annual"></p>
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">Industria y Comercio
                                                :</h6>
                                            <p class="fw-bold" id="is_industry_commerce"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="industry_commerce_periodicity_lbl">Periocidad
                                            </h6>
                                            <p class="fw-bold" id="industry_commerce_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_places_table" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">Retenedor Industria y Comercio:</h6>
                                            <p class="fw-bold" id="is_industry_commerce_retainer"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="industry_commerce_retainer_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="industry_commerce_retainer_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_retainer_places_table"
                                                    style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">
                                                Autoretenedor Industria y Comercio:</h6>
                                            <p class="fw-bold" id="is_industry_commerce_selfretaining"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted"
                                                id="industry_commerce_selfretaining_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="industry_commerce_selfretaining_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped"
                                                    id="industry_commerce_selfretaining_places_table"
                                                    style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">IVA:</h6>
                                            <p class="fw-bold" id="vat_responsibles"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="vat_responsible_periodicity_lbl">Periociodad
                                            </h6>
                                            <p class="fw-bold" id="vat_responsible_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="vat_responsible_observation_lbl">Observacion
                                            </h6>
                                            <p class="fw-bold" id="vat_responsible_observation"></p>
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Renta:</h6>
                                            <p class="fw-bold" id="is_rent"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="rent_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="rent_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Supersociedades:</h6>
                                            <p class="fw-bold" id="is_supersociety"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="supersociety_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="supersociety_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">Supertransporte:</h6>
                                            <p class="fw-bold" id="is_supertransport"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="supertransport_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="supertransport_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="supertransport_observation_lbl">Observacion
                                            </h6>
                                            <p class="fw-bold" id="supertransport_observation"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Superfinanciera:</h6>
                                            <p class="fw-bold" id="is_superfinancial"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="superfinancial_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="superfinancial_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Retención en la fuente:</h6>
                                            <p class="fw-bold" id="is_source_retention"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="source_retention_periodicity_lbl">Periocidad
                                            </h6>
                                            <p class="fw-bold" id="source_retention_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Información exógena DIAN:</h6>
                                            <p class="fw-bold" id="is_dian_exogenous_information"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="dian_exogenous_information_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="dian_exogenous_information_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">
                                                Información Exógena Municipal:</h6>
                                            <p class="fw-bold" id="is_municipal_exogenous_information"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted"
                                                id="municipal_exogenous_information_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="municipal_exogenous_information_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped"
                                                    id="municipal_exogenous_information_places_table"
                                                    style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Impuesto al patrimonio:</h6>
                                            <p class="fw-bold" id="is_wealth_tax"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="wealth_tax_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="wealth_tax_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Radian:</h6>
                                            <p class="fw-bold" id="is_radian"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="radian_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="radian_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Nómina electroníca:</h6>
                                            <p class="fw-bold" id="is_e_payroll"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="e_payroll_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="e_payroll_periodicity"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Registro único de beneficiarios finales:</h6>
                                            <p class="fw-bold" id="is_single_registry_final_benefeciaries"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted"
                                                id="single_registry_final_benefeciaries_periodicity_lbl">Periocidad
                                            </h6>
                                            <p class="fw-bold" id="single_registry_final_benefeciaries_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Renovación ESAL:</h6>
                                            <p class="fw-bold" id="is_renovacion_esal"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="renovacion_esal_periodicity_lbl">Periocidad
                                            </h6>
                                            <p class="fw-bold" id="renovacion_esal_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Activos en el exterior:</h6>
                                            <p class="fw-bold" id="is_assets_abroad"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="assets_abroad_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="assets_abroad_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-4">
                                            <h6 class="text-bold">
                                                Registro único de proponentes:</h6>
                                            <p class="fw-bold" id="is_single_registry_proposers"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-muted" id="single_registry_proposers_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="single_registry_proposers_periodicity"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped"
                                                    id="single_registry_proposers_places_table" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Municipio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Renovación de registro mercantil:</h6>
                                            <p class="fw-bold" id="is_renewal_commercial_registration"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted"
                                                id="renewal_commercial_registration_periodicity_lbl">Periocidad</h6>
                                            <p class="fw-bold" id="renewal_commercial_registration_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Fondo nacional de turismo:</h6>
                                            <p class="fw-bold" id="is_national_tourism_fund"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="national_tourism_fund_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="national_tourism_fund_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <h6 class="text-bold">Regimen tributario especial:</h6>
                                        <p class="fw-bold" id="is_special_tax_regime"></p>
                                    </div>
                                    <div class="col-md-12 mb-3 row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">Registro nacional de turismo:</h6>
                                            <p class="fw-bold" id="is_national_tourism_registry"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted" id="national_tourism_registry_periodicity_lbl">
                                                Periocidad</h6>
                                            <p class="fw-bold" id="national_tourism_registry_periodicity">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Datos de Contacto -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="mb-3">Datos de Contacto</h6>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="contactTable">
                                            <thead>
                                                <tr>
                                                    <th>Tipo Documento</th>
                                                    <th>Documento</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Fecha de nacimiento</th>
                                                    <th>Cargo</th>
                                                    <th>Medio de contacto</th>
                                                    <th>Correo</th>
                                                    <th>Celular</th>
                                                    <th>Observación</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contactTableBody">
                                                <!-- Datos dinámicos aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Comentarios -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="mb-3">Comentarios del Cliente</h6>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="commentsTable">
                                            <thead>
                                                <tr>
                                                    <th>Comentario</th>
                                                    <th>Fecha Comentario</th>
                                                    <th>Realizado por</th>
                                                </tr>
                                            </thead>
                                            <tbody id="commentsTableBody">
                                                <!-- Comentarios dinámicos aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <!-- Carpetas -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="mb-3">Carpetas del Cliente</h6>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="foldersTable">
                                            <thead>
                                                <tr>
                                                    <th>Carpeta</th>
                                                    <th>Periocidad</th>

                                                </tr>
                                            </thead>
                                            <tbody id="foldersTableBody">
                                                <!-- Comentarios dinámicos aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
