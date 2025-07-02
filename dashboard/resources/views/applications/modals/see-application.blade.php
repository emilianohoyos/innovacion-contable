<!-- Modal -->
<div class="modal fade" id="seeApplicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Detalles de la solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Información del Cliente -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3">Informacion Solicitud</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Tipo Solicitud:</h6>
                                        <p class="fw-bold" id="applyType">Natural</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Nit:</h6>
                                        <p class="fw-bold" id="nit">Cedula</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Nombre Cliente:</h6>
                                        <p class="fw-bold" id="clientName">Juan Pérez</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Fecha creacion:</h6>
                                        <p class="fw-bold" id="created_at">123456789</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Fecha estimada de atencion:</h6>
                                        <p class="fw-bold" id="estimated_delevery_date">123456789</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Prioridad:</h6>
                                        <p class="fw-bold" id="priority">Calle 123 #45-67</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Responsable atención:</h6>
                                        <p class="fw-bold" id="employee">juan.perez@example.com</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Estado:</h6>
                                        <p class="fw-bold" id="state_name">juan.perez@example.com</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <h6 class="text-muted">Observaciones:</h6>
                                        <p class="fw-bold" id="observation">Alta</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Adjuntos:</h6>
                                        <div class="row" id="adjuntos"></div>
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
</div>
