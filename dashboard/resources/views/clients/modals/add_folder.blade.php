<div class="modal fade" id="addFolderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameClientFolder">agregar folders al cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="hidden" name="client_id" id="client_id">
                            <label for="folders" class="form-label">Seleccione La carpeta a asociar</label>
                            <select name="folders" id="folders" class="form-control">
                                <!-- Opciones dinámicas cargadas vía AJAX -->
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
                                    <th>Folder</th>
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
