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
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Responsable de IVA:</h6>
                                        <p class="fw-bold" id="fiscalIva">NO</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Es autorretenedor:</h6>
                                        <p class="fw-bold" id="fiscalSelfRetention">NO</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Es Régimen Simple:</h6>
                                        <p class="fw-bold" id="fiscalSimpleRegime">NO</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Agente retenedor ICA:</h6>
                                        <p class="fw-bold" id="icaWithholdingAgent">NO</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Municipio:</h6>
                                        <p class="fw-bold" id="icaWithholdingMunicipality">Medellín</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Agente Autoretenedor ICA:</h6>
                                        <p class="fw-bold" id="icaSelfRetentionAgent">NO</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Municipio:</h6>
                                        <p class="fw-bold" id="icaSelfRetentionMunicipality">Medellín</p>
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
