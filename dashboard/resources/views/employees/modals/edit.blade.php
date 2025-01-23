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
                            <label for="nit" class="form-label">Tipo Documento</label>
                            <select name="document_type_id" class="form-control" id="document_type_id">

                                @foreach ($document_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="nit" name="nit"
                                placeholder="Ingrese Nit">
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
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Ingrese Correo">
                        </div>

                        <div class="col-md-6">
                            <label for="job_title" class="form-label">Cargo</label>
                            <select name="job_title" class="form-control" id="job_title">
                                <option value="">Seleccione Cargo</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="CONTADOR">CONTADOR</option>
                                <option value="AUXILIAR">AUXILIAR</option>
                                <option value="AUXILIAR ADMINISTRATIVO">AUXILIAR ADMINISTRATIVO</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Seleccione Cargo</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="CONTADOR">CONTADOR</option>
                                <option value="AUXILIAR">AUXILIAR</option>
                            </select>
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
