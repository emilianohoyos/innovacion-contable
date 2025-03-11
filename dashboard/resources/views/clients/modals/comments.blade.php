<!-- Modal -->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameClient"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form onSubmit="return false">
                            <div class="col-md-12 gap-0">
                                <input type="hidden" name="client_id" id="client_id">
                                <label for="comment" class="form-label">Agregar Comentario</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mt-1" onclick="saveComment()">Agregar
                                    Comentario</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="container mt-4">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Comentario</th>
                                        <th scope="col">Fecha Comentario</th>
                                        <th scope="col">Realizado por</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Este es un comentario de ejemplo.</td>
                                        <td>2024-10-30</td>
                                        <td>Juan Pérez</td>
                                    </tr>
                                    <tr>
                                        <td>Revisión del documento completada.</td>
                                        <td>2024-10-29</td>
                                        <td>María González</td>
                                    </tr>
                                    <tr>
                                        <td>Se aprobaron los cambios solicitados.</td>
                                        <td>2024-10-28</td>
                                        <td>Carlos Ramírez</td>
                                    </tr>
                                    <!-- Agrega más filas según sea necesario -->
                                </tbody>
                            </table>
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
