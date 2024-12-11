<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameTipodoc"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="hidden" name="apply_type_id" id="apply_type_id">
                            <label for="documentType" class="form-label">Seleccione Tipo de documentos a asociar</label>
                            <select name="documentType" id="documentType" class="form-control">
                                <!-- Opciones dinámicas cargadas vía AJAX -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="is_required" class="form-label">El documento es requerido?</label>
                            <select name="is_required" id="is_required" class="form-control">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary mt-4"
                                onclick="agregarItems()">Agregar</button>
                        </div>
                    </div>

                    <!-- Tabla para mostrar los elementos agregados -->
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="itemsTable">
                            <thead>
                                <tr>
                                    <th>Tipo de Documento</th>
                                    <th>Requerido</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán dinámicamente las filas -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" onclick="guardariItems()">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
