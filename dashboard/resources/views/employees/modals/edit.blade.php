<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditEmployee">
                <div class="modal-body">
                    <div class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Tipo Documento <span
                                    style="color: red">*</span></label>
                            <select name="document_type_id" class="form-control" id="document_type_id">

                                @foreach ($document_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Identificación <span
                                    style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nit" name="nit"
                                placeholder="Ingrese Nit">
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">Nombres <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Ingrese Nombres">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Apellidos <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Ingrese Apellidos">
                        </div>
                        <div class="col-md-6">
                            <label for="cellphone" class="form-label">Celular <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"
                                placeholder="Ingrese Celular">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Ingrese Correo">
                        </div>

                        <div class="col-md-4">
                            <label for="job_title" class="form-label">Cargo <span style="color: red">*</span></label>
                            <select name="job_title" class="form-control" id="job_title">
                                <option value="">Seleccione Cargo</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="CONTADOR">CONTADOR</option>
                                <option value="AUXILIAR CONTABLE">AUXILIAR CONTABLE</option>
                                <option value="AUXILIAR ADMINISTRATIVO">AUXILIAR ADMINISTRATIVO</option>
                                <option value="AUDITORIA">AUDITORIA</option>
                                <option value="RECURSO HUMANO">RECURSO HUMANO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="role" class="form-label">Rol <span style="color: red">*</span></label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Seleccione Rol</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="CONTADOR">CONTADOR</option>
                                <option value="AUXILIAR">AUXILIAR</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="profession" class="form-label">Formación <span
                                    style="color: red">*</span></label>
                            <select name="profession" class="form-control" id="profession">
                                <option value="">Seleccione formación</option>
                                <option value="PROFESIONAL">PROFESIONAL</option>
                                <option value="TECNOLOGO">TECNOLOGO</option>
                                <option value="TECNICO">TECNICO</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="emergency_contact_name" class="form-label">Nombre del contacto de
                                emergencia</label>
                            <input type="emergency_contact_name" class="form-control" id="emergency_contact_name"
                                name="emergency_contact_name" placeholder="Ingrese nombre">
                        </div>
                        <div class="col-md-4">
                            <label for="emergency_contact_phone" class="form-label">Teléfono del contacto de
                                emergencia</label>
                            <input type="emergency_contact_phone" class="form-control" id="emergency_contact_phone"
                                name="emergency_contact_phone" placeholder="Ingrese teléfono">
                        </div>
                        <div class="col-md-4">
                            <label for="emergency_contact_address" class="form-label">Dirección del contacto de
                                emergencia</label>
                            <input type="emergency_contact_address" class="form-control"
                                id="emergency_contact_address" name="emergency_contact_address"
                                placeholder="Ingrese dirección">
                        </div>

                        <div class="col-md-12">
                            <label for="profession_description" class="form-label">Observaciones de Formación</label>
                            <textarea class="form-control" id="profession_description" name="profession_description" rows="3"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="observation" class="form-label">Observaciones Generales</label>
                            <textarea class="form-control" id="observation" name="observation" rows="3"></textarea>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
