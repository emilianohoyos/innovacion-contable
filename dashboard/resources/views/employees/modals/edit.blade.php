<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Tipo Documento</label>
                            <select name="" class="form-control" id="">
                                <option value="">Seleccione tipo documento</option>
                                <option value="CEDULA">CEDULA</option>
                                <option value="CEDULA EXTRANJERIA">CEDULA EXTRANJERIA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">Identificación</label>
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
                        <div class="col-md-6">
                            <label for="cellphone" class="form-label">Correo</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"
                                placeholder="Ingrese Celular">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
