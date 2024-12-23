<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Tipo Solicitud</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="TAREA">TAREA</option>
                                <option value="SOLICITUD INICIAL">SOLICITUD INICIAL</option>
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
                        <div class="col-md-6">
                            <label for="estimated_delevery_date" class="form-label">Fecha estimada de atencion</label>
                            <input type="date" class="form-control" id="estimated_delevery_date"
                                name="estimated_delevery_date">
                        </div>
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Seleccione Prioridad</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="1216715427">Critica</option>
                                <option value="1216715427">Alta</option>
                                <option value="1216715427">Normal</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="person_type_id" class="form-label">Seleccione Responsable atencion</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="1">Andres Martinez</option>
                                <option value="2">Pablo lopez</option>
                                <option value="3">Luis Diaz</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="observation" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones." rows="3"></textarea>
                        </div>

                        <h6>anexos</h6>
                        <hr>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger px-4 raised d-flex gap-2"><i
                                    class="material-icons-outlined">picture_as_pdf</i>Ver anexo 1</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger px-4 raised d-flex gap-2"><i
                                    class="material-icons-outlined">picture_as_pdf</i>Ver anexo 2</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger px-4 raised d-flex gap-2"><i
                                    class="material-icons-outlined">picture_as_pdf</i>Ver anexo 3</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <button type="button" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>
